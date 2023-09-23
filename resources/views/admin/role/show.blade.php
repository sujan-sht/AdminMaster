@extends('lara-admin::admin.layouts.app')

@section('content')
<x-lara-admin-show-page name="role" route="roles">
    <x-slot name="content">

        @livewire('admin.role.role-has-permission-table', ['role' => $role])


    </x-slot>
</x-show-page>
@endsection
