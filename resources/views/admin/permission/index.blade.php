@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-index-page name="permission" route="permissions">
        <x-slot name="content">
            @livewire('lara-admin::admin.permission.permission-table')
        </x-slot>
    </x-index-page>
@endsection
