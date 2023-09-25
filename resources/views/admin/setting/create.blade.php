@extends('lara-admin::admin.layouts.app')

@section('content')
<x-lara-admin-create-page name="setting" route="settings">
    <x-slot name="content">
         @include('lara-admin::admin.layouts.modules.setting.form')
    </x-slot>
 </x-lara-admin-create-page>
@endsection
