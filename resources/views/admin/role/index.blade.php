@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-lara-admin-index-page name="role" route="roles">
        <x-slot name="content">
            @livewire('admin.role.role-table')

        </x-slot>
    </x-lara-admin-index-page>
@endsection
