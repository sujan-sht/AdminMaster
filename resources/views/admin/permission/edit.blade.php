@extends('admin-master::admin.layouts.app')

@section('content')

<x-admin-master-edit-page name="permission" route="permissions" :model="$permission">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.permission.form')
   </x-slot>
</x-admin-master-edit-page>
@endsection
