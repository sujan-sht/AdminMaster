@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-create-page name="role" route="roles">
    <x-slot name="content">
         @include('admin-master::admin.layouts.modules.role.form')
    </x-slot>
 </x-admin-master-create-page>
@endsection
