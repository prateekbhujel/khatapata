@extends('layouts.admin')

@section('title', 'Website Settings')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>Web Settings</h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.settings.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (!empty($setting->updated_at))
                    <div class='my-3 badge bg-dark text-white'>
                      <i class="fas fa-clock me-2"></i>  Last Updated On: {{ $setting->updated_at->diffForHumans() }}
                    </div>
                  @endif

                    <div class="col-5 mx-auto">
                        <div class="mb-3">
                            <label for="name" class="form-label">App Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $setting->name ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">App Description</label>
                            <textarea name="description" id="description" class="form-control editor">{{ old('description', $setting->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="about_us_description" class="form-label">About Us Description</label>
                            <textarea name="about_us_description" id="about_us_description" class="form-control editor">{{ old('about_us_description', $setting->about_us_description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="btn_name" class="form-label">Name of the Button</label>
                            <input type="text" name="btn_name" id="btn_name" class="form-control" value="{{ old('btn_name', $setting->btn_name ?? '') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="btn_route" class="form-label">Route of the Button</label>
                            <input type="text" name="btn_route" id="btn_route" class="form-control" value="{{ old('btn_route', $setting->btn_route ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="website_title" class="form-label">Webiste Ttitle</label>
                            <input type="text" name="website_title" id="website_title" class="form-control" value="{{ old('website_title', $setting->website_title ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="seo_description" class="form-label">Seo Description</label>
                            <textarea name="seo_description" id="seo_description" class="form-control">{{ old('seo_description', $setting->seo_description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="seo_keywords" class="form-label">SEO Keywords <span class="text text-muted">(Use commas to seperate keywords)</span></label>
                            <input type="text" name="seo_keywords" id="seo_keywords" class="form-control" value="{{ old('seo_keywords', $setting->seo_keywords ?? '') }}" placeholder="Finace advisour, expense tracker, budget planning">
                        </div>

                        <div class="mb-3">
                            <label for="banner" class="form-label">Banner Image</label>
                            <input type="file" name="banner" id="bannerInput" class="form-control" accept="image/*" data-preview="#banner-preview" data-existing="{{ $setting->banner ?? '' }}">
                        </div>
                        <div class="row mt-3" id="banner-preview"></div>
                        
                        <div class="mb-3">
                            <label for="favico" class="form-label">Favico Image</label>
                            <input type="file" name="favico" id="favicoInput" class="form-control" accept="image/*" data-preview="#favico-preview" data-existing="{{ $setting->favico ?? '' }}">
                        </div>
                        <div class="row mt-3" id="favico-preview"></div>
                        
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Image</label>
                            <input type="file" name="logo" id="logoInput" class="form-control" accept="image/*" data-preview="#logo-preview" data-existing="{{ $setting->logo ?? '' }}">
                        </div>
                        <div class="row my-3" id="logo-preview"></div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-save me-2"></i>Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection