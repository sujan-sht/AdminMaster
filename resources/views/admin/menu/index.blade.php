@extends('admin-master::admin.layouts.app')

@section('content')
    <x-admin-master-index-page name="menu" route="menus">
        <x-slot name="content">
            @livewire('admin.menu.menu-table')
        </x-slot>
    </x-admin-master-index-page>
@endsection
