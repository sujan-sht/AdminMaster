@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-create-page name="permission" route="permissions">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.permission.form')
   </x-slot>
</x-admin-master-create-page>
@endsection
