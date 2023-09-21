@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-index-page name="user" route="users">
        <x-slot name="content">
            @livewire('lara-admin::admin.user.user-table')
        </x-slot>
    </x-index-page>
@endsection
