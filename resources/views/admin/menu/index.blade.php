@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-lara-admin-index-page name="menu" route="menus">
        <x-slot name="content">
            @livewire('admin.menu.menu-table')
        </x-slot>
    </x-lara-admin-index-page>
@endsection
