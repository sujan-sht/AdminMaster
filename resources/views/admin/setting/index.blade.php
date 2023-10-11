@extends('lara-admin::admin.layouts.app')

@section('content')
@php
    use SujanSht\LaraAdmin\Models\Admin\Setting;
@endphp
    <x-lara-admin-index-page name="setting" route="settings">
        <x-slot name="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Checkout Steps -->
                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0 active">
                                        <i class="mdi mdi-cog font-18"></i>
                                        <span class="d-none d-lg-block">Settings</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#setting-list" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                        <i class="mdi mdi-format-list-bulleted font-18"></i>
                                        <span class="d-none d-lg-block">Setting List</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Steps Information -->
                            <div class="tab-content">

                                <!-- Settings-->
                                <div class="tab-pane show active" id="settings">
                                    @isset($setting_grouped)
                                        <form action="{{ route('setting_store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                                @foreach ($setting_grouped as $key => $group)
                                                    <li class="nav-item">
                                                        <a href="#{{ strtolower(str_replace(' ', '_', $key)) }}" data-bs-toggle="tab" aria-expanded="false"
                                                            class="nav-link rounded-0 {{$loop->first ? 'active' : ''}}">
                                                            <span class="d-none d-lg-block">{{$key}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                            <div class="tab-content">
                                                @foreach ($setting_grouped as $key => $group)
                                                    <div class="tab-pane {{$loop->first ? 'show active' : ''}}" id="{{ strtolower(str_replace(' ', '_', $key)) }}">
                                                        @foreach ($group as $setting)
                                                            @if ($setting->getRawOriginal('setting_type') == Setting::STRING)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.string')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::INTEGER)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.integer')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::TEXT)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.text')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::TEXTEDITOR)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.rich_text')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::SWITCH)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.switch')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::CHECKBOX)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.checkbox')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::SELECT)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.select')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::MULTIPLE)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.multiple')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::TAG)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.tag')
                                                            @elseif ($setting->getRawOriginal ('setting_type') == Setting::IMAGE)
                                                                @include('lara-admin::admin.layouts.modules.setting.components.image')
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                <input type="submit" value="Save Settings" class="btn btn-success">
                                            </div>

                                        </form>
                                    @endisset
                                </div>
                                <!-- End Settings-->

                                <!-- Setting List-->
                                <div class="tab-pane" id="setting-list">
                                    @livewire('admin.setting.setting-table')
                                </div>
                                <!-- End Setting List-->



                            </div> <!-- end tab content-->

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
        </x-slot>
    </x-lara-admin-index-page>
@endsection
@section('scripts')
@include('lara-admin::admin.layouts.modules.setting.scripts')
@endsection
