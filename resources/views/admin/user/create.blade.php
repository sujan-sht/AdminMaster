@extends('lara-admin::admin.layouts.app')

@section('content')
<x-lara-admin-create-page name="user" route="users">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.user.form')
   </x-slot>
</x-lara-admin-create-page>
@endsection
