@extends('admin-master::admin.layouts.app')

@section('content')

<x-admin-master-edit-page name="setting" route="settings" :model="$setting">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.setting.form')
   </x-slot>
</x-admin-master-edit-page>
@endsection

