@extends('admin-master::admin.layouts.app')

@section('content')

<x-admin-master-edit-page name="user" route="users" :model="$user">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.user.form')
   </x-slot>
</x-admin-master-edit-page>
@endsection
