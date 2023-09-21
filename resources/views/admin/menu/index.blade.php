@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-index-page name="menu" route="menus">
        <x-slot name="content">
            @livewire('lara-admin::admin.menu.menu-table')
        </x-slot>
    </x-index-page>
@endsection
