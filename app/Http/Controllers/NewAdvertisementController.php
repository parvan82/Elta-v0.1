<?php

namespace App\Http\Controllers;

use App\Models\Advatisement;
use App\Models\ServicesMap;
use App\Models\ServicesTag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewAdvertisementController extends Controller
{
    public function store(Request $request)
    {
        try {
            $ad = Advatisement::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'service_type' => $request->service,
                'price' => $request->price,
                'status' => 'open',
                'expires_at' => Carbon::now()->addMinute(),
            ]);


            // ذخیره تصاویر
            if ($request->hasFile('main_image')) {
                $path = $request->file('main_image')->store('ads', 'public');
                $ad->images()->create(['image_path' => $path, 'is_main' => true]);
            }
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $file) {
                    $path = $file->store('ads', 'public');
                    $ad->images()->create(['image_path' => $path, 'is_main' => false]);
                }
            }

            // ذخیره تگ‌ها
            if ($request->filled('tags')) {
                foreach ($request->tags as $tagName) {
                    $tag = ServicesTag::firstOrCreate(['name' => $tagName]);
                    \DB::table('service_type_map')->insert([
                        'ads_id' => $ad->id,
                        'service_type_id' => $tag->id,
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function renew(Request $request)
    {
        $request->validate([
            'ad_id' => 'required|exists:advatisement,id'
        ]);

        $ad = Advatisement::where('id', $request->ad_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $ad->expires_at = now()->addDays(30);
        $ad->status = 'open';
        $ad->save();

        return response()->json(['success' => true]);
    }

}
