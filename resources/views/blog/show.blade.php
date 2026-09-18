@extends('layouts.app')

@section('title', $post->translated('title') . ' — INOBI')

@section('description', $post->translated('excerpt') ?? $post->translated('title'))

@section('content')

{{-- =========================================================
     BLOG DETAIL
========================================================= --}}
<section class="blog-detail-page">
    <div class="container">

        {{-- BACK BUTTON --}}
        <a href="{{ route('blog.index') }}" class="blog-back-link">
            <span class="blog-back-arrow">←</span>
            {{ __('ui.back_to_blog') }}
        </a>

        {{-- =========================================================
             TOP SECTION: COVER IMAGE + INFO ARTIKEL
        ========================================================= --}}
        <div class="blog-detail-top">

            {{-- LEFT: COVER IMAGE --}}
            <div class="blog-detail-image-wrapper">
                @if($post->cover_image)
                    <img
                        src="{{ asset($post->cover_image) }}"
                        alt="{{ $post->translated('title') }}"
                        class="blog-detail-image"
                    >
                @else
                    <div class="blog-detail-no-image">
                        <span>📄 {{ __('ui.no_cover') }}</span>
                    </div>
                @endif
            </div>

            {{-- RIGHT: INFO ARTIKEL --}}
            <div class="blog-detail-info">

                <span class="blog-detail-kicker">{{ __('ui.research_insight') }}</span>
                @if($post->category)
                    <span class="blog-detail-category">{{ $post->translated('category') }}</span>
                @endif

                {{-- JUDUL --}}
                <h1 class="blog-detail-title">
                    {{ $post->translated('title') }}
                </h1>

                <div class="blog-detail-divider"></div>

                {{-- EXCERPT / RINGKASAN --}}
                @if($post->excerpt)
                    <div class="blog-detail-excerpt">
                        <p>{{ $post->translated('excerpt') }}</p>
                    </div>
                @endif

                {{-- TANGGAL --}}
                @if($post->published_at)
                    <div class="blog-detail-date-bottom">
                        <span>📅 {{ $post->published_at->format('d F Y') }}</span>
                        <span>·</span>
                        <span>PT. Inovasi Bioproduk Indonesia</span>
                    </div>
                @endif

            </div>

        </div>

        {{-- =========================================================
             BOTTOM: KONTEN ARTIKEL
        ========================================================= --}}
        <div class="blog-content-bottom">
            <div class="blog-content-header">
                <span class="section-label">{{ __('ui.full_article') }}</span>
                <h2>{{ __('ui.article_content') }}</h2>
                <div class="section-line"></div>
            </div>

            <article class="blog-content-body">
                {!! \Illuminate\Support\Str::markdown($post->translated('content'), [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]) !!}
            </article>
        </div>

    </div>
</section>

@endsection