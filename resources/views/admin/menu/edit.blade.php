@extends('lara-admin::admin.layouts.app')

@section('content')

<x-edit-page name="menu" route="menus" :model="$menu">
   <x-slot name="content">
        @include('lara-admin::admin.layouts.modules.menu.form')
   </x-slot>
</x-edit-page>
@endsection
