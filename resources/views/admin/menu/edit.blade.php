@extends('admin-master::admin.layouts.app')

@section('content')

<x-admin-master-edit-page name="menu" route="menus" :model="$menu">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.menu.form')
   </x-slot>
</x-admin-master-edit-page>
@endsection
