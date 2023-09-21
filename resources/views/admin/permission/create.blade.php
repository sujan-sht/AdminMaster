@extends('lara-admin::admin.layouts.app')

@section('content')
<x-create-page name="permission" route="permissions">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.permission.form')
   </x-slot>
</x-create-page>
@endsection
