@extends('admin-master::admin.layouts.app')

@section('content')
    <x-admin-master-index-page name="user" route="users">
        <x-slot name="content">
            @livewire('admin.user.user-table')
        </x-slot>
    </x-admin-master-index-page>
@endsection
