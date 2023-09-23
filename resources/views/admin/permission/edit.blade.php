@extends('lara-admin::admin.layouts.app')

@section('content')

<x-lara-admin-edit-page name="permission" route="permissions" :model="$permission">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.permission.form')
   </x-slot>
</x-edit-page>
@endsection
