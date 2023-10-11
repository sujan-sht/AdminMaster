@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-create-page name="menu" route="menus">
   <x-slot name="content">
        @include('admin-master::admin.layouts.modules.menu.form')
   </x-slot>
</x-admin-master-create-page>
@endsection
