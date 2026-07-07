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

class newProjectController extends Controller
{
    public function store(Request $request)
    {
        // Debug: نمایش داده‌های دریافتی
        \Log::info('Request data:', $request->all());

        // پردازش داده‌های JSON
        $selectedSkills = [];
        if ($request->has('selected_skills') && !empty($request->selected_skills)) {
            if (is_string($request->selected_skills)) {
                $selectedSkills = json_decode($request->selected_skills, true) ?: [];
            } else {
                $selectedSkills = $request->selected_skills;
            }
        }

        \Log::info('Selected skills:', $selectedSkills);

        $selectedServices = [];
        if ($request->has('selected_services') && !empty($request->selected_services)) {
            if (is_string($request->selected_services)) {
                $selectedServices = json_decode($request->selected_services, true) ?: [];
            } else {
                $selectedServices = $request->selected_services;
            }
        }

        $eltaServices = [];
        if ($request->has('elta_services') && !empty($request->elta_services)) {
            if (is_string($request->elta_services)) {
                $eltaServices = json_decode($request->elta_services, true) ?: [];
            } else {
                $eltaServices = $request->elta_services;
            }
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'service' => ['nullable', 'string', 'max:100'],
            'priority' => ['nullable', 'string', 'max:50'],
            'budget' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            DB::beginTransaction();

            // ایجاد پروژه
            $project = NewProject::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'service' => $validated['service'] ?? null,
                'priority' => $validated['priority'] ?? null,
                'budget' => $validated['budget'] ?? null,
            ]);

            // ذخیره تگ‌های خدمات
            if (!empty($selectedServices)) {
                foreach ($selectedServices as $serviceName) {
                    $serviceTag = ServicesTag::firstOrCreate(['name' => $serviceName]);
                    ServicesMap::create([
                        'tag_id' => $serviceTag->id,
                        'project_id' => $project->id,
                    ]);
                }
            }

            // ذخیره مهارت‌های پروژه
            if (!empty($selectedSkills)) {
                foreach ($selectedSkills as $skillData) {
                    $skillName = $skillData['skill'] ?? null;
                    $level = $skillData['level'] ?? null;

                    if ($skillName) {
                        $skill = UserSkill::firstOrCreate(['skill' => $skillName]);
                        ProjectSkillMapping::create([
                            'project_id' => $project->id,
                            'skill_id' => $skill->id,
                            'level' => $level,
                        ]);
                    }
                }
            }

            // ذخیره مهارت‌های کاربر (برای skill_mapping)
            if (!empty($selectedSkills)) {
                foreach ($selectedSkills as $skillData) {
                    $skillName = $skillData['skill'] ?? null;
                    $level = $skillData['level'] ?? null;

                    if ($skillName) {
                        $skill = UserSkill::where('skill', $skillName)->first();
                        if ($skill) {
                            SkillMapping::updateOrCreate(
                                [
                                    'user_id' => Auth::id(),
                                    'skill_id' => $skill->id,
                                ],
                                ['level' => $level]
                            );
                        }
                    }
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'پروژه با موفقیت ثبت شد ✅'
                ]);
            }

            return redirect()->back()->with('success', 'پروژه با موفقیت ثبت شد ✅');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در ثبت پروژه: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'خطا در ثبت پروژه: ' . $e->getMessage());
        }
    }
}
