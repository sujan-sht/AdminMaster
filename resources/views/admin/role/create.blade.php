@extends('lara-admin::admin.layouts.app')

@section('content')
<x-create-page name="role" route="roles">
    <x-slot name="content">
         @include('lara-admin::admin.layouts.modules.role.form')
    </x-slot>
 </x-create-page>
@endsection
