@extends('admin-master::admin.layouts.app')

@section('content')
    <x-admin-master-index-page name="role" route="roles">
        <x-slot name="content">
            @livewire('admin.role.role-table')

        </x-slot>
    </x-admin-master-index-page>
@endsection
