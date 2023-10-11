@extends('admin-master::admin.layouts.app')

@section('content')

<x-admin-master-edit-page name="role" route="roles" :model="$role">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.role.form')
   </x-slot>
</x-admin-master-edit-page>
@endsection

