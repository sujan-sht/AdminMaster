@extends('lara-admin::admin.layouts.app')

@section('content')
    <x-index-page name="role" route="roles">
        <x-slot name="content">
            @livewire('lara-admin::admin.role.role-table')
            {{-- <table id="example" class="display table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($roles->count()>0)
                        @foreach ($roles as $role)
                            <tr>
                                <td></td>
                                <td>
                                    <x-action :model="$role" route="roles" :show="false">

                                    </x-action>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table> --}}
        </x-slot>
    </x-index-page>
@endsection
