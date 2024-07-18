@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-create-page name="user" route="users">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.user.form')
   </x-slot>
</x-admin-master-create-page>
@endsection
