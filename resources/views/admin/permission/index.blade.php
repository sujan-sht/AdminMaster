@extends('admin-master::admin.layouts.app')

@section('content')
    <x-admin-master-index-page name="permission" route="permissions">
        <x-slot name="content">
            @livewire('admin.permission.permission-table')
        </x-slot>
    </x-admin-master-index-page>
@endsection
