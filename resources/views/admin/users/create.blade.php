@extends('layouts.admin')

@section('title', 'Tambah User — INOBI')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header"><div><h1>Tambah User</h1><p>Buat akun baru untuk akses admin.</p></div></div>
    @include('admin.users.form', ['action' => route('admin.users.store'), 'method' => 'POST', 'user' => null])
</div>
@endsection
