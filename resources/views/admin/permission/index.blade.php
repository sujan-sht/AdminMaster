@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-lara-admin-index-page name="permission" route="permissions">
        <x-slot name="content">
            @livewire('admin.permission.permission-table')
        </x-slot>
    </x-lara-admin-index-page>
@endsection
