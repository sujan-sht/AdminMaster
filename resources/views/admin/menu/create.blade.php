@extends('lara-admin::admin.layouts.app')

@section('content')
<x-lara-admin-create-page name="menu" route="menus">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.menu.form')
   </x-slot>
</x-lara-admin-create-page>
@endsection
