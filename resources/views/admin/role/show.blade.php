@extends('admin-master::admin.layouts.app')

@section('content')
<x-admin-master-show-page name="role" route="roles">
    <x-slot name="content">

        @livewire('admin.role.role-has-permission-table', ['role' => $role])


    </x-slot>
</x-show-page>
@endsection
