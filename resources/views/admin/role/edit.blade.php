@extends('lara-admin::admin.layouts.app')

@section('content')

<x-edit-page name="role" route="roles" :model="$role">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.role.form')
   </x-slot>
</x-edit-page>
@endsection

