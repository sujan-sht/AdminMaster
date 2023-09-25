@extends('lara-admin::admin.layouts.app')

@section('content')

<x-lara-admin-edit-page name="user" route="users" :model="$user">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.user.form')
   </x-slot>
</x-lara-admin-edit-page>
@endsection
