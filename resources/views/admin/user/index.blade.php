@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-lara-admin-index-page name="user" route="users">
        <x-slot name="content">
            @livewire('admin.user.user-table')
        </x-slot>
    </x-lara-admin-index-page>
@endsection
