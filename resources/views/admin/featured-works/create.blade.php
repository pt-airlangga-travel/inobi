@extends('layouts.admin')

@section('title', 'Tambah Featured Work — INOBI')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header"><div><h1>Tambah Featured Work</h1><p>Tambahkan foto kegiatan baru ke carousel homepage.</p></div></div>
    @include('admin.featured-works.form', ['action' => route('admin.featured-works.store'), 'method' => 'POST', 'featuredWork' => null])
</div>
@endsection
