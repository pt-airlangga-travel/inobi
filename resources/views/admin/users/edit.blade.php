@extends('layouts.admin')

@section('title', 'Edit User — INOBI')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header"><div><h1>Edit User</h1><p>Perbarui informasi dan hak akses akun.</p></div></div>
    @include('admin.users.form', ['action' => route('admin.users.update', $user), 'method' => 'PUT', 'user' => $user])
</div>
@endsection
