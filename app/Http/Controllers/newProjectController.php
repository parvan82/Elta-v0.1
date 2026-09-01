<?php

namespace App\Http\Controllers;

use App\Models\NewProject;
use App\Models\UserSkill;
use App\Models\SkillMapping;
use App\Models\ServicesTag;
use App\Models\ServicesMap;
use App\Models\ProjectSkillMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class newProjectController extends Controller
{
    public function store(Request $request)
    {
        // دریافت آیدی پروژه برای تمدید
        $renewProjectId = $request->input('renew_project_id');

        // پردازش JSON مهارت‌ها و سرویس‌ها
        $selectedSkills = $this->parseJsonArray($request->input('selected_skills'));
        $selectedServices = $this->parseJsonArray($request->input('selected_services'));
        $eltaServices = $this->parseJsonArray($request->input('elta_services'));

        if ($request->has('renew_project_id')) {
            $project = NewProject::findOrFail($request->renew_project_id);
            $project->update([
                'expires_at' => now()->addDays(30),
                'status' => 'open',
            ]);

            return response()->json(['success' => true, 'message' => 'پروژه تمدید شد']);
        }

        // اعتبارسنجی ورودی‌ها
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'service' => ['nullable', 'string', 'max:100'],
            'priority' => ['nullable', 'string', 'max:50'],
            'budget' => ['nullable', 'string', 'max:50'],
            'expires_at' => ['nullable', 'date', 'after:today'],
        ]);

        try {
            DB::beginTransaction();

            if ($renewProjectId) {
                // ✅ تمدید پروژه
                $project = NewProject::findOrFail($renewProjectId);
                $project->expires_at = Carbon::now()->addDays(30); // ۳۰ روز تمدید
                $project->status = 'open';
                $project->save();
            } else {
                // ✅ ثبت پروژه جدید
                $project = NewProject::create([
                    'user_id' => Auth::id(),
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'service' => $validated['service'] ?? null,
                    'priority' => $validated['priority'] ?? null,
                    'budget' => $validated['budget'] ?? null,
                    'status' => 'open',
                    'expires_at' => $validated['expires_at'] ?? now()->addDays(30),
                ]);

                // ذخیره سرویس‌ها
                foreach ($selectedServices as $serviceName) {
                    if (!$serviceName) continue;
                    $serviceTag = ServicesTag::firstOrCreate(['name' => $serviceName]);
                    ServicesMap::firstOrCreate([
                        'tag_id' => $serviceTag->id,
                        'project_id' => $project->id,
                    ]);
                }

                // ذخیره مهارت‌ها
                foreach ($selectedSkills as $skillData) {
                    $skillName = $skillData['skill'] ?? null;
                    if (!$skillName) continue;

                    // مهارت پروژه
                    $skill = UserSkill::firstOrCreate(['skill' => $skillName]);
                    ProjectSkillMapping::updateOrCreate(
                        ['project_id' => $project->id, 'skill_id' => $skill->id],
                    );

                    // مهارت کاربر
                    SkillMapping::updateOrCreate(
                        ['user_id' => Auth::id(), 'skill_id' => $skill->id],
                        ['level' => $level]
                    );
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $renewProjectId ? 'پروژه با موفقیت تمدید شد' : 'پروژه با موفقیت ثبت شد',
                    'project_id' => $project->id,
                ]);
            }

            return redirect()->route('employerHome')
                ->with('success', $renewProjectId ? 'پروژه با موفقیت تمدید شد' : 'پروژه با موفقیت ثبت شد');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در ثبت/تمدید پروژه: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'خطا در ثبت/تمدید پروژه: ' . $e->getMessage());
        }
    }

    /**
     * تبدیل رشته یا آرایه JSON به آرایه PHP
     */
    private function parseJsonArray($value): array
    {
        if (!$value) return [];
        if (is_array($value)) return $value;
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [];
    }

    /**
     * دریافت اطلاعات پروژه برای نمایش در چت
     */
    public function getProjectInfo($id)
    {
        $project = NewProject::find($id);
        
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json([
            'id' => $project->id,
            'title' => $project->title,
            'description' => $project->description,
        ]);
    }
    
    /**
     * دریافت project_id برای یک conversation
     */
    public function getConversationProject(Request $request)
    {
        $userId = Auth::id();
        $contactId = $request->input('contact_id');
        
        if (!$contactId) {
            return response()->json(['error' => 'contact_id is required'], 400);
        }
        
        $conversationProject = \App\Models\ChConversationProject::getProjectForConversation($userId, $contactId);
        
        if ($conversationProject && $conversationProject->project_id) {
            return response()->json([
                'project_id' => $conversationProject->project_id,
            ]);
        }
        
        return response()->json(['project_id' => null]);
    }
    
    /**
     * ذخیره project_id برای یک conversation
     */
    public function saveConversationProject(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|integer',
            'project_id' => 'required|integer|exists:new_projects,id',
        ]);
        
        $userId = Auth::id();
        $contactId = $request->input('contact_id');
        $projectId = $request->input('project_id');
        
        \App\Models\ChConversationProject::setProjectForConversation($userId, $contactId, $projectId);
        
        return response()->json([
            'success' => true,
            'message' => 'Project saved for conversation',
        ]);
    }
}
