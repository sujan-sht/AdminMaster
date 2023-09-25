@extends('lara-admin::admin.layouts.app')

@section('content')

<x-lara-admin-edit-page name="setting" route="settings" :model="$setting">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.setting.form')
   </x-slot>
</x-lara-admin-edit-page>
@endsection

