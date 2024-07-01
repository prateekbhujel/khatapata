<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = WebSetting::first();

        return view('admin.settings.index', compact('setting'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'                      => 'nullable|max:200',
            'description'               => 'nullable|max:1600',
            'about_us_description'      => 'nullable|max:1600',
            'btn_name'                  => 'nullable|min:1|max:30',
            'btn_route'                 => 'nullable|min:1|max:50',
            'website_title'             => 'nullable|min:1|max:150',
            'seo_description'           => 'nullable|min:1|max:20054',
            'seo_keywords'              => 'nullable|min:1|max:10000',
            'banner'                    => 'image|max:2048|mimes:jpeg,jpg,webp,png',
            'favico'                    => 'image|max:512|mimes:jpeg,jpg,webp,png',
            'logo'                      => 'image|max:1024|mimes:jpeg,jpg,webp,png',
        ]);
        
        $web_settings       = WebSetting::findOrFail($id);
        $banner             = handleUpload('banner', $web_settings);
        $favico             = handleUpload('favico', $web_settings);
        $logo               = handleUpload('logo', $web_settings);

         WebSetting::updateOrCreate(
            [
                'id'                    => $id
            ],
            [
                'name'                  => $request->name,
                'description'           => $request->description,
                'about_us_description'  => $request->about_us_description,
                'btn_name'              => $request->btn_name,
                'btn_route'             => $request->btn_route,
                'website_title'         => $request->website_title,
                'seo_description'       => $request->seo_description,
                'seo_keywords'          => $request->seo_keywords,
                'banner'                => (!empty($banner) ? $banner : $web_settings->banner),
                'favico'                => (!empty($favico) ? $favico : $web_settings->favico),
                'logo'                  => (!empty($logo) ? $logo : $web_settings->logo),
                'updated_at'            => Carbon::now(),
            ]
         );
    
         return redirect()->back()->withSuccess('Setting was Updated.');

    }//End Method
}
