@extends('lara-admin::admin.layouts.app')

@section('content')
<x-lara-admin-create-page name="permission" route="permissions">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.permission.form')
   </x-slot>
</x-lara-admin-create-page>
@endsection
