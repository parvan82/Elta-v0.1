<?php

namespace App\Http\Controllers;

use App\Models\Advatisement;
use App\Models\NewProject;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SearchController extends Controller
{
    public function searchFreelancer(Request $request)
    {
        $clickedUserId = $request->input('clickedUserId');
        $clickedUser = null;
        $query = $request->input('q');
        $users = collect();
        $similarUsers = collect();
        $clickedAdId = $request->input('clickedAdId');
        $clickedAd = null;

        if ($clickedAdId) {
            $clickedAd = Advatisement::with([
                'images',
                'tags',
                'user',
            ])->find($clickedAdId);
        }

        if ($clickedUserId) {
            $clickedUser = User::with([
                'personalInformation',
                'educationalHistories',
                'languages',
                'jobHistories',
                'portfolios',
                'companies',
                'skillMapping.skill'
            ])->find($clickedUserId);
        }


        // فریلنسرهای مشابه
        if ($clickedUser) {
            $clickedSkills = $clickedUser->skillMapping->pluck('skill.skill')->toArray();

            $similarUsers = User::with('skillMapping.skill')
                ->where('id', '!=', $clickedUser->id)
                ->get()
                ->map(function($user) use ($clickedSkills) {
                    $userSkills = $user->skillMapping->pluck('skill.skill')->toArray();
                    $user->shared_count = count(array_intersect($clickedSkills, $userSkills));
                    $user->skills = array_slice(array_intersect($clickedSkills, $userSkills), 0, 7);
                    return $user;
                })
                ->filter(fn($user) => $user->shared_count > 0)
                ->sortByDesc('shared_count')
                ->take(7);
        }

        // آگهی‌های مشابه
        $similarAds = collect();
        if ($clickedAd) {
            $clickedTags = $clickedAd->tags->pluck('name')->toArray();

            $similarAds = Advatisement::with(['images', 'tags'])
                ->where('id', '!=', $clickedAd->id)
                ->get()
                ->map(function($ad) use ($clickedTags) {
                    $adTags = $ad->tags->pluck('name')->toArray();
                    $ad->shared_count = count(array_intersect($clickedTags, $adTags));
                    return $ad;
                })
                ->filter(fn($ad) => $ad->shared_count > 0)
                ->sortByDesc('shared_count')
                ->take(7);
        }

        // موارد موردعلاقه
        $favoritedIds = DB::table('ch_favorites')
            ->where('user_id', auth()->id())
            ->pluck('favorite_id')
            ->toArray();

        $users = $users->map(function ($user) use ($favoritedIds) {
            $user->is_favorite = in_array($user->id, $favoritedIds);
            return $user;
        });

        // آگهی‌های کاربر
        $userAds = collect();
        if ($clickedUser) {
            $userAds = $clickedUser->ads()
                ->with(['images', 'tags'])
                ->latest()
                ->get();
        }

        $showRecentResults =
            ($request->redirect === 'search-results' && empty($query))
            || $clickedAdId
            || $clickedUserId;

        if ($showRecentResults) {
            // آخرین پروژه‌ها
            $relatedAds = Advatisement::with(['images', 'tags', 'user'])
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($ad) {
                    return (object)[
                        'type' => 'ad',

                        'id' => $ad->id,
                        'title' => $ad->title,
                        'description' => $ad->description,
                        'service_type' => $ad->service_type,
                        'price' => $ad->price,
                        'created_at' => $ad->created_at,

                        'user' => (object)[
                            'id' => $ad->user->id,
                            'name' => $ad->user->name,
                            'username' => $ad->user->username,
                            'profilepic' => $ad->user->profilepic,
                        ],

                        // برای Blade
                        'tags' => $ad->tags,



                        'images' => $ad->images,

                        'image' => optional($ad->mainImage)->image_path,
                    ];
                });

            // آخرین فریلنسرها
            $users = User::with(['skillMapping.skill'])
                ->where('role', 'freelancer')
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($u)  {

                    return (object)[
                        'type' => 'user',
                        'id' => $u->id,
                        'name' => $u->name,
                        'username' => $u->username,
                        'profilepic' => $u->profilepic,
                        'aboutme' => $u->aboutme,
                        'workarea' => $u->workarea,
                        'skills' => $u->skillMapping
                            ->pluck('skill.skill')
                            ->unique()
                            ->values(),
                    ];
                });
            return view('search-result', [
                'users' => $users,
                'query' => $query,
                'relatedAds' => $relatedAds,
                'clickedUser' => $clickedUser,
                'similarUsers' => $similarUsers,
                'userAds' => $userAds,
                'clickedAd' => $clickedAd,
                'similarAds' => $similarAds,
            ]);
        }
        elseif ($query) {

            // normalize ورودی کاربر
            $q = mb_strtolower(trim($query));

            // n-gram ساختن:
            $words = explode(' ', $q);
            $ngrams = [];

            // تک‌کلمه
            foreach ($words as $w) {
                if (strlen($w) > 1) $ngrams[] = $w;
            }

            // دوتایی
            if (count($words) >= 2) {
                for ($i = 0; $i < count($words) - 1; $i++) {
                    $ngrams[] = $words[$i] . ' ' . $words[$i+1];
                }
            }

            // جمله کامل
            if (strlen($q) > 2) $ngrams[] = $q;


            // تمام مهارت‌ها + کی‌وردها
            $allSkills = UserSkill::with('keywordMapping.keyword')->get();

            $skillScores = []; // skill_id => score

            foreach ($allSkills as $skill) {

                $skillName = mb_strtolower($skill->skill);
                $kwList = $skill->keywordMapping->pluck('keyword.keyword')
                    ->map(fn($k) => mb_strtolower($k))
                    ->toArray();

                foreach ($ngrams as $ng) {

                    // 1) exact equal با نام مهارت
                    if ($skillName === $ng) {
                        $skillScores[$skill->id] = ($skillScores[$skill->id] ?? 0) + 15;
                    }

                    // 2) exact equal با کی‌وردها
                    foreach ($kwList as $kw) {
                        if ($kw === $ng) {
                            $skillScores[$skill->id] = ($skillScores[$skill->id] ?? 0) + 12;
                        }
                    }

                    // 3) phrase match در نام مهارت
                    if (str_contains($skillName, $ng)) {
                        $skillScores[$skill->id] = ($skillScores[$skill->id] ?? 0) + 8;
                    }

                    // 4) phrase match در کی‌ورد
                    foreach ($kwList as $kw) {
                        if (str_contains($kw, $ng)) {
                            $skillScores[$skill->id] = ($skillScores[$skill->id] ?? 0) + 5;
                        }
                    }

                    // 5) تک‌کلمه match → امتیاز کم
                    if (count($words) == 1) {
                        foreach ($kwList as $kw) {
                            if ($kw === $words[0]) {
                                $skillScores[$skill->id] = ($skillScores[$skill->id] ?? 0) + 3;
                            }
                        }
                    }
                }
            }

            // فقط مهارت‌هایی که امتیاز ≥ 6 دارند (حداقل مرتبط)
            $matchedSkillIds = collect($skillScores)
                ->filter(fn($score) => $score >= 6)
                ->keys()
                ->toArray();


            // اگر هیچ مهارتی match نشد → خروجی خالی
            if (empty($matchedSkillIds)) {
                $users = collect();
            } else {
                $users = User::with(['skillMapping.skill'])
                    ->where('role', 'freelancer')   // ✅ فقط فریلنسرها
                    ->whereHas('skillMapping', function ($q) use ($matchedSkillIds) {
                        $q->whereIn('skill_id', $matchedSkillIds);
                    })
                    ->get()
                    ->map(function ($u) use ($skillScores) {

                        // جمع امتیاز مهارت‌های این کاربر
                        $score = 0;
                        foreach ($u->skillMapping as $map) {
                            $sid = $map->skill->id;
                            if (isset($skillScores[$sid])) {
                                $score += $skillScores[$sid];
                            }
                        }

                        return (object)[
                            'id' => $u->id,
                            'name' => $u->name,
                            'username' => $u->username,
                            'profilepic' => $u->profilepic,
                            'aboutme' => $u->aboutme,
                            'workarea' => $u->workarea,
                            'skills' => $u->skillMapping->pluck('skill.skill')->unique()->values(),
                            'skill_ids' => $u->skillMapping->pluck('skill.id')->unique()->values(),
                            'score' => $score,
                        ];
                    })
                    ->sortByDesc('score')   // مرتب‌سازی بر اساس بیشترین امتیاز
                    ->values();
            }
            $relatedAds = collect();
            if ($query) {
                $q = mb_strtolower(trim($request->input('keyword') ?? $query));

                // n-gram
                $words = explode(' ', $q);
                $ngrams = [];
                foreach ($words as $w) {
                    if (strlen($w) > 1) $ngrams[] = $w; // تک‌کلمه
                }
                if (count($words) >= 2) {
                    for ($i = 0; $i < count($words) - 1; $i++) {
                        $ngrams[] = $words[$i] . ' ' . $words[$i+1]; // bigram
                    }
                }
                if (strlen($q) > 2) $ngrams[] = $q; // عبارت کامل

                $ads = Advatisement::with(['images', 'tags'])->get();

                $ads = $ads->map(function ($ad) use ($ngrams) {
                    $score = 0;

                    $title = mb_strtolower($ad->title);
                    $desc = mb_strtolower($ad->description);
                    $tags = $ad->tags->pluck('name')->map(fn($t) => mb_strtolower($t))->toArray();

                    foreach ($ngrams as $ng) {
                        // exact phrase match
                        if ($title === $ng) $score += 15;
                        if ($desc === $ng) $score += 12;
                        if (in_array($ng, $tags)) $score += 12;

                        // partial match
                        if (str_contains($title, $ng)) $score += 8;
                        if (str_contains($desc, $ng)) $score += 5;
                        foreach ($tags as $tag) {
                            if (str_contains($tag, $ng)) $score += 5;
                        }
                    }

                    $ad->score = $score;
                    return $ad;
                });

                // فقط آگهی‌های با score > 0
                $relatedAds = $ads->filter(fn($ad) => $ad->score > 0)
                    ->sortByDesc('score')
                    ->values();
            }
        }


        return view('search-result', [
            'users' => $users,
            'query' => $query,
            'clickedUser' => $clickedUser,
            'similarUsers' => $similarUsers,
            'relatedAds' => $relatedAds,
            'userAds' => $userAds,
            'clickedAd' => $clickedAd,
            'similarAds' => $similarAds,
        ]);
    }


    public function searchProjects(Request $request)
    {
        $projectId = $request->input('projectId');
        $clickedUserId = $request->input('clickedUserId');
        $query = $request->input('q', ''); // همیشه مقدار داشته باشه
        $keywords = explode(' ', $query);

        $favoritedIds = DB::table('ch_favorites')
            ->where('user_id', auth()->id())
            ->pluck('favorite_id')
            ->toArray();

        $projects = collect();
        $users = collect();
        $clickedUser = null;
        $clickedproject = null;

        // -----------------------------
        // پروژه کلیک‌شده
        // -----------------------------
        if ($projectId) {
            $clickedproject = \App\Models\NewProject::with('skills')->find($projectId);
            if ($clickedproject) {
                $clickedproject->services = DB::table('services_map')
                    ->join('services_tags', 'services_map.tag_id', '=', 'services_tags.id')
                    ->where('services_map.project_id', $projectId)
                    ->pluck('services_tags.name')
                    ->filter()
                    ->unique()
                    ->values();
            }
        }

        // -----------------------------
        // کاربر کلیک‌شده
        // -----------------------------
        if ($clickedUserId) {
            $clickedUser = \App\Models\User::with([
                'personalInformation',
                'educationalHistories',
                'languages',
                'jobHistories',
                'portfolios',
                'companies',
                'skillMapping.skill',
                'NewProject'
            ])->find($clickedUserId);
        }

        // -----------------------------
        // جستجوی پروژه‌ها
        // -----------------------------

            if ($request->redirect === 'search-results' && empty($query)) {

                // آخرین پروژه‌های کارفرماها
                $projects = NewProject::with([
                    'user',
                    'skills',
                ])
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($project) use ($favoritedIds) {

                        $project->services = DB::table('services_map')
                            ->join('services_tags', 'services_map.tag_id', '=', 'services_tags.id')
                            ->where('services_map.project_id', $project->id)
                            ->pluck('services_tags.name');

                        return (object)[
                            'type' => 'project',
                            'id' => $project->id,
                            'title' => $project->title,
                            'description' => $project->description,
                            'priority' => $project->priority,
                            'budget' => $project->budget,
                            'created_at' => $project->created_at,

                            'user' => (object)[
                                'id' => $project->user->id,
                                'name' => $project->user->name,
                                'username' => $project->user->username,
                                'profilepic' => $project->user->profilepic,
                            ],

                            'is_favorite' => in_array($project->user_id, $favoritedIds),

                            'skills' => $project->skills
                                ->pluck('skill')
                                ->unique()
                                ->values(),

                            'keywords' => collect(),

                            'services' => $project->services,
                        ];
                    });

                // آخرین کارفرماها
                $users = User::with(['companies', 'skillMapping.skill'])
                    ->where('role', 'employer')
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($user) use ($favoritedIds) {

                        return (object)[
                            'type' => 'user',
                            'id' => $user->id,
                            'name' => $user->name,
                            'username' => $user->username,
                            'profilepic' => $user->profilepic,
                            'aboutme' => $user->aboutme,
                            'workarea' => $user->workarea,

                            'company_name' => $user->companies->company_name ?? '',
                            'company_info' => $user->companies->company_info ?? '',

                            'is_favorite' => in_array($user->id, $favoritedIds),

                            'skills' => $user->skillMapping
                                ->pluck('skill.skill')
                                ->unique()
                                ->values(),

                            'created_at' => $user->created_at,
                        ];
                    });

            }
            else {


                $results = DB::table('new_projects')
                    ->join('users', 'new_projects.user_id', '=', 'users.id')
                    ->leftJoin('project_skill_mapping', 'new_projects.id', '=', 'project_skill_mapping.project_id')
                    ->leftJoin('user_skill', 'project_skill_mapping.skill_id', '=', 'user_skill.id')
                    ->leftJoin('keyword_mapping', 'user_skill.id', '=', 'keyword_mapping.skill_id')
                    ->leftJoin('keyword', 'keyword_mapping.keyword_id', '=', 'keyword.id')
                    ->leftJoin('services_map', 'new_projects.id', '=', 'services_map.project_id')
                    ->leftJoin('services_tags', 'services_map.tag_id', '=', 'services_tags.id')
                    ->where(function ($q) use ($keywords) {
                        foreach ($keywords as $word) {
                            $q->orWhere('keyword.keyword', 'like', "%$word%")
                                ->orWhere('user_skill.skill', 'like', "%$word%")
                                ->orWhere('new_projects.title', 'like', "%$word%")
                                ->orWhere('services_tags.name', 'like', "%$word%");
                        }
                    })
                    ->select(
                        'new_projects.id as project_id',
                        'new_projects.title',
                        'new_projects.description',
                        'new_projects.priority',
                        'new_projects.budget',
                        'new_projects.created_at',
                        'users.id as user_id',
                        'users.username',
                        'users.name as user_name',
                        'users.profilepic',
                        'user_skill.skill as skill',
                        'keyword.keyword as keyword',
                        'services_tags.name as service'
                    )
                    ->get();

                $grouped = $results->groupBy('project_id')->map(function ($items) use ($favoritedIds) {
                    $first = $items->first();
                    return (object)[
                        'type' => 'project',
                        'id' => $first->project_id,
                        'title' => $first->title,
                        'description' => $first->description,
                        'priority' => $first->priority,
                        'budget' => $first->budget,
                        'created_at' => $first->created_at,
                        'user' => (object)[
                            'id' => $first->user_id,
                            'username' => $first->username,
                            'name' => $first->user_name,
                            'profilepic' => $first->profilepic,
                        ],
                        'is_favorite' => in_array($first->user_id, $favoritedIds),
                        'skills' => $items->pluck('skill')->filter()->unique()->values(),
                        'keywords' => $items->pluck('keyword')->filter()->unique()->values(),
                        'services' => $items->pluck('service')->filter()->unique()->values(),
                    ];
                });

                $projects = $grouped->values();

                // -----------------------------
                // جستجوی کاربران (فقط کارفرما)
                // -----------------------------
                $users = \App\Models\User::where('role', 'employer')
                    ->where(function ($q) use ($keywords) {
                        $q->whereHas('skillMapping.skill', function ($sq) use ($keywords) {
                            foreach ($keywords as $word) {
                                $sq->orWhere('user_skill.skill', 'like', "%$word%");
                            }
                        })->orWhereHas('skillMapping.skill.keywordMapping.keyword', function ($sq) use ($keywords) {
                            foreach ($keywords as $word) {
                                $sq->orWhere('keyword.keyword', 'like', "%$word%");
                            }
                        });
                    })
                    ->with(['skillMapping.skill.keywordMapping.keyword'])
                    ->get()
                    ->map(function ($user) use ($keywords, $favoritedIds) {
                        $keywordsLower = array_map(fn($k) => mb_strtolower($k), $keywords);

                        $matchedSkills = $user->skillMapping->filter(function ($sm) use ($keywordsLower) {
                            $skillName = mb_strtolower($sm->skill->skill ?? '');
                            $directMatch = collect($keywordsLower)->contains(fn($kw) => str_contains($skillName, $kw));
                            $keywordMatch = $sm->skill->keywordMapping
                                ->pluck('keyword.keyword')
                                ->map(fn($kwd) => mb_strtolower($kwd))
                                ->contains(fn($kwdLower) => collect($keywordsLower)->contains(fn($kw) => str_contains($kwdLower, $kw)));
                            return $directMatch || $keywordMatch;
                        })->pluck('skill.skill')->unique()->values();

                        return (object)[
                            'type' => 'user',
                            'id' => $user->id,
                            'name' => $user->name,
                            'aboutme' => $user->aboutme,
                            'workarea' => $user->workarea,
                            'username' => $user->username,
                            'profilepic' => $user->profilepic,
                            'company_name' => $user->companies->company_name ?? '',
                            'company_info' => $user->companies->company_info ?? '',
                            'is_favorite' => in_array($user->id, $favoritedIds),
                            'skills' => $matchedSkills,
                        ];
                    })
                    ->filter(fn($u) => $u->skills->isNotEmpty())
                    ->values();            }



        // -----------------------------
        // پروژه‌های مشابه
        // -----------------------------
        $similarProjects = collect();
        if ($clickedproject) {
            $clickedSkillIds = $clickedproject->skills->pluck('id')->toArray();
            $clickedServiceIds = DB::table('services_map')
                ->where('project_id', $projectId)
                ->pluck('tag_id')
                ->toArray();

            $similarProjectsQuery = DB::table('new_projects')
                ->leftJoin('project_skill_mapping', 'new_projects.id', '=', 'project_skill_mapping.project_id')
                ->leftJoin('services_map', 'new_projects.id', '=', 'services_map.project_id')
                ->where(function ($q) use ($clickedSkillIds) {
                    if (!empty($clickedSkillIds)) {
                        $q->whereIn('project_skill_mapping.skill_id', $clickedSkillIds);
                    }
                })
                ->orWhere(function ($q) use ($clickedServiceIds) {
                    if (!empty($clickedServiceIds)) {
                        $q->whereIn('services_map.tag_id', $clickedServiceIds);
                    }
                })
                ->where('new_projects.id', '!=', $projectId)
                ->select('new_projects.*')
                ->distinct()
                ->limit(10);

            $similarProjects = $similarProjectsQuery->get();
            foreach ($similarProjects as $p) {
                $p->serviceTags = DB::table('services_map')
                    ->join('services_tags', 'services_map.tag_id', '=', 'services_tags.id')
                    ->where('services_map.project_id', $p->id)
                    ->select('services_tags.id', 'services_tags.name')
                    ->get();

                $p->skills = DB::table('project_skill_mapping')
                    ->join('user_skill', 'project_skill_mapping.skill_id', '=', 'user_skill.id')
                    ->where('project_skill_mapping.project_id', $p->id)
                    ->select('user_skill.id', 'user_skill.skill')
                    ->get();
            }
            $userId = auth()->id();

            $favorites = auth()->check()
                ? DB::table('ch_favorites')
                    ->where('user_id', $userId)
                    ->pluck('favorite_id')
                    ->toArray()
                : [];

            foreach ($similarProjects as $p) {

                $p->type = 'project';

                $p->services = collect($p->serviceTags ?? [])
                    ->pluck('name')
                    ->toArray();

                $p->skills = collect($p->skills ?? [])
                    ->pluck('skill')
                    ->toArray();

                $p->user = (object)[
                    'id' => $p->user_id ?? null,
                    'profilepic' => DB::table('users')
                        ->where('id', $p->user_id)
                        ->value('profilepic'),
                ];

                $p->is_favorite = in_array($p->id, $favorites);
            }

        }

        // -----------------------------
        // ترکیب پروژه‌ها و کاربران
        // -----------------------------
        $results = collect()
            ->merge($projects)
            ->merge($users)
            ->shuffle()
            ->values();


        if (!empty($clickedUser)) {
            $clickedUserSkillIds = $clickedUser->skills->pluck('id')->toArray();

            $similarEmployers = \App\Models\User::where('role', 'employer')
                ->where('id', '!=', $clickedUser->id)
                ->whereHas('skillMapping', function ($q) use ($clickedUserSkillIds) {
                    $q->whereIn('skill_id', $clickedUserSkillIds);
                })
                ->with(['skillMapping.skill'])
                ->get()
                ->map(function ($user) use ($clickedUserSkillIds) {
                    // فقط مهارت‌های مشترک با کارفرمای کلیک شده
                    $matchedSkills = $user->skillMapping->filter(fn($sm) => in_array($sm->skill_id, $clickedUserSkillIds))
                        ->pluck('skill.skill')
                        ->unique()
                        ->values();

                    return (object)[
                        'id' => $user->id,
                        'name' => $user->name,
                        'workarea' => $user->workarea,
                        'company_name' => $user->companies->company_name ?? '',
                        'company_info' => $user->companies->company_info ?? '',
                        'aboutme' => $user->aboutme,
                        'username' => $user->username,
                        'profilepic' => $user->profilepic,
                        'skills' => $matchedSkills,
                    ];
                });
        } else {
            $similarEmployers = collect();
        }

        return view('search-result-employer', compact(
            'results',
            'query',
            'clickedUser',
            'clickedproject',
            'similarProjects',
            'similarEmployers'
        ));
    }



    public function mobileProfile($id)
    {
        $similarUsers = collect();
        $similarCompanies = collect();

        $clickedUser = User::with([
            'personalInformation',
            'educationalHistories',
            'languages',
            'jobHistories',
            'portfolios',
            'companies',
            'skillMapping.skill'
        ])->find($id);

        if (!$clickedUser) {
            abort(404);
        }

        if (!empty($clickedUser)) {
            $clickedUserSkillIds = $clickedUser->skills->pluck('id')->toArray();

            $similarEmployers = \App\Models\User::where('role', 'employer')
                ->where('id', '!=', $clickedUser->id)
                ->whereHas('skillMapping', function ($q) use ($clickedUserSkillIds) {
                    $q->whereIn('skill_id', $clickedUserSkillIds);
                })
                ->with(['skillMapping.skill'])
                ->get()
                ->map(function ($user) use ($clickedUserSkillIds) {
                    // فقط مهارت‌های مشترک با کارفرمای کلیک شده
                    $matchedSkills = $user->skillMapping->filter(fn($sm) => in_array($sm->skill_id, $clickedUserSkillIds))
                        ->pluck('skill.skill')
                        ->unique()
                        ->values();

                    return (object)[
                        'id' => $user->id,
                        'name' => $user->name,
                        'workarea' => $user->workarea,
                        'company_name' => $user->companies->company_name ?? '',
                        'company_info' => $user->companies->company_info ?? '',
                        'aboutme' => $user->aboutme,
                        'username' => $user->username,
                        'profilepic' => $user->profilepic,
                        'skills' => $matchedSkills,
                    ];
                });
        } else {
            $similarEmployers = collect();
        }

        $users = collect([$clickedUser])->map(function ($user) {
            return (object)[
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'profilepic' => $user->profilepic,
                'aboutme' => $user->aboutme,
                'workarea' => $user->workarea,
                'skills' => $user->skillMapping->pluck('skill.skill')->unique()->values(),
            ];
        });

        $favoritedIds = DB::table('ch_favorites')
            ->where('user_id', auth()->id())
            ->pluck('favorite_id')
            ->toArray();

        $users = $users->map(function ($user) use ($favoritedIds) {
            $user->is_favorite = in_array($user->id, $favoritedIds);
            return $user;
        });

        if ($clickedUser) {
            $clickedSkills = $clickedUser->skillMapping->pluck('skill.skill')->toArray();

            $similarUsers = User::with('skillMapping.skill')
                ->where('id', '!=', $clickedUser->id)
                ->get()
                ->map(function($user) use ($clickedSkills) {
                    $userSkills = $user->skillMapping->pluck('skill.skill')->toArray();
                    $user->shared_count = count(array_intersect($clickedSkills, $userSkills));
                    $user->skills = array_slice(array_intersect($clickedSkills, $userSkills), 0, 7);
                    return $user;
                })
                ->filter(fn($user) => $user->shared_count > 0)
                ->sortByDesc('shared_count')
                ->take(7);
        }

        $userAds = $clickedUser->ads()
            ->with(['images', 'tags'])
            ->latest()
            ->get();

        $projects = NewProject::with(['serviceTags', 'skills'])
            ->where('user_id', $clickedUser->id)
            ->latest()
            ->get();


        return view('mobile-search-result', [
            'users' => $users,
            'clickedUser' => $clickedUser,
            'query' => null,
            'similarUsers' => $similarUsers,
            'similarEmployers' => $similarEmployers,
            'userAds' => $userAds,
            'projects' => $projects,
        ]);
    }
    public function mobileProject(Request $request)
    {
        $type = $request->query('type');   // project یا ad
        $id   = $request->query('id');

        if (!$type || !$id) {
            abort(404);
        }

        $favoritedIds = [];
        if (auth()->check()) {
            $favoritedIds = DB::table('ch_favorites')
                ->where('user_id', auth()->id())
                ->pluck('favorite_id')
                ->toArray();
        }
        // -----------------------------
        // اگر پروژه باشد
        // -----------------------------
        if ($type === 'project') {

            $clickedProject = \App\Models\NewProject::with(['skills'])
                ->findOrFail($id);

            // سرویس‌های پروژه
            $services = DB::table('services_map')
                ->join('services_tags', 'services_map.tag_id', '=', 'services_tags.id')
                ->where('services_map.project_id', $id)
                ->pluck('services_tags.name')
                ->unique()
                ->values();

            $clickedProject->services = $services;

            // کاربر پروژه
            $clickedUser = \App\Models\User::with('companies')
                ->select('id', 'name', 'username', 'profilepic', 'workarea', 'aboutme')
                ->find($clickedProject->user_id);

            // مهارت های پروژه فعلی
            $projectSkillIds = $clickedProject->skills->pluck('id');

            // پیدا کردن پروژه‌های شبیه به پروژه فعلی
            $similarProjects = \App\Models\NewProject::with(['skills'])
                ->where('id', '!=', $clickedProject->id) // حذف پروژه فعلی
                ->whereHas('skills', function ($q) use ($projectSkillIds) {
                    $q->whereIn('user_skill.id', $projectSkillIds);
                })
                ->withCount(['skills as matching_skills_count' => function ($q) use ($projectSkillIds) {
                    $q->whereIn('user_skill.id', $projectSkillIds);
                }])
                ->orderByDesc('matching_skills_count') // بیشترین شباهت اول
                ->limit(8)
                ->get();

            return view('content', [
                'type' => 'project',
                'clickedproject' => $clickedProject,
                'clickedUser' => $clickedUser,
                'similarProjects' => $similarProjects,
            ]);
        }


        // -----------------------------
        // اگر آگهی باشد
        // -----------------------------
        if ($type === 'ad') {

            $clickedAd = \App\Models\Advatisement::with(['images', 'mainImage', 'tags'])
                ->findOrFail($id);

            // کاربر آگهی
            $clickedUser = \App\Models\User::with('companies', 'portfolios')
                ->select('id', 'name', 'username', 'profilepic', 'workarea', 'aboutme')
                ->find($clickedAd->user_id);

            // آگهی‌های مشابه
            $similarAds = Advatisement::with(['mainImage', 'user'])
                ->where('service_type', $clickedAd->service_type)
                ->where('id', '!=', $clickedAd->id)
                ->limit(8)
                ->get();

            foreach ($similarAds as $ad) {
                $ad->user->is_favorite = in_array($ad->user->id, $favoritedIds);
            }

            return view('content', [
                'type' => 'ad',
                'item' => $clickedAd,
                'clickedUser' => $clickedUser,
                'similarAds' => $similarAds,
            ]);
        }


        abort(404);
    }


}
