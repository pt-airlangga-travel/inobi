@extends('layouts.admin')

@section('title', 'Edit Featured Work — INOBI')

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header"><div><h1>Edit Featured Work</h1><p>Perbarui foto atau informasi kegiatan.</p></div></div>
    @include('admin.featured-works.form', ['action' => route('admin.featured-works.update', $featuredWork), 'method' => 'PUT', 'featuredWork' => $featuredWork])
</div>
@endsection
