@extends('admin.layouts.admin')

@section('title', 'Pengaturan - Admin CIO')
@section('page_title', 'Pengaturan Global')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ url('/cms/settings') }}">
                @csrf
                @method('PUT')

                <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                    <li class="nav-item"><button type="button" class="nav-link active" id="nav-tab" data-bs-toggle="tab" data-bs-target="#nav">Navbar</button></li>
                    <li class="nav-item"><button type="button" class="nav-link" id="footer-tab" data-bs-toggle="tab" data-bs-target="#footer">Footer</button></li>
                    <li class="nav-item"><button type="button" class="nav-link" id="socmed-tab" data-bs-toggle="tab" data-bs-target="#socmed">Sosial Media</button></li>
                    <li class="nav-item"><button type="button" class="nav-link" id="jam-tab" data-bs-toggle="tab" data-bs-target="#jam">Jam Layanan</button></li>
                    <li class="nav-item"><button type="button" class="nav-link" id="kontak-tab" data-bs-toggle="tab" data-bs-target="#kontak">Info Kontak</button></li>
                </ul>

                <div class="tab-content">
                    @php
                        $tabGroups = [
                            'nav' => ['navbar'],
                            'footer' => ['footer'],
                            'socmed' => ['social_media'],
                            'jam' => ['jam_layanan'],
                            'kontak' => ['contact_info'],
                        ];
                    @endphp

                    @foreach($tabGroups as $tabKey => $groups)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $tabKey }}">
                            <div class="row g-4">
                                @foreach($groups as $group)
                                    @foreach(($settings->get($group, collect())) as $setting)
                                        <div class="col-md-6">
                                            <label class="form-label">{{ $setting->label }}</label>
                                            @if(in_array($setting->key, ['footer_desc', 'wa_message', 'alamat', 'maps_embed_url', 'jam_cs', 'jam_technical', 'jam_kantor']))
                                                <textarea name="{{ $setting->key }}" class="form-control" rows="3">{{ old($setting->key, $setting->value) }}</textarea>
                                            @else
                                                <input type="text" name="{{ $setting->key }}" class="form-control" value="{{ old($setting->key, $setting->value) }}">
                                            @endif
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-3 border-top d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-5 shadow-sm">
                        <i class="fa-solid fa-save me-1"></i> Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
