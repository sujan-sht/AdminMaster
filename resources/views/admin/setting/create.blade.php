@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-create-page name="setting" route="settings">
    <x-slot name="content">
         @include('admin-master::admin.layouts.modules.setting.form')
    </x-slot>
 </x-admin-master-create-page>
@endsection
