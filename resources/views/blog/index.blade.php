@extends('layouts.app')

@section('title', __('ui.blog_title').' — INOBI')

@section('description', 'Informasi, riset, produk, dan berita terbaru dari PT. Inovasi Bioproduk Indonesia.')

@section('content')

{{-- =========================================================
     BLOG HEADER
========================================================= --}}
<section class="blog-header-section">
    <div class="container">
        <div class="blog-header-content">
            <span class="blog-header-badge">{{ __('ui.our_blog') }}</span>
            <h1>{{ __('ui.blog_title') }}</h1>
            <p>
                {{ __('ui.blog_description') }}
            </p>
            <div class="blog-header-line"></div>
        </div>
    </div>
</section>

{{-- =========================================================
     BLOG GRID
========================================================= --}}
<section class="blog-section">
    <div class="container">

        {{-- BLOG GRID --}}
        @if($posts->count() > 0)

            <div class="blog-grid">

                @foreach($posts as $post)

                    <article class="blog-card {{ $loop->first ? 'blog-card-featured' : '' }}">

                        {{-- IMAGE --}}
                        <a href="{{ route('blog.show', $post) }}" class="blog-image-wrapper">
                            @if($post->cover_image)
                                <img
                                    src="{{ asset($post->cover_image) }}"
                                    alt="{{ $post->translated('title') }}"
                                    class="blog-image"
                                    loading="lazy"
                                >
                            @else
                                <div class="blog-no-image">
                                    <span>INOBI</span>
                                </div>
                            @endif
                        </a>

                        {{-- CONTENT --}}
                        <div class="blog-card-content">

                            {{-- TANGGAL --}}
                            <div class="blog-meta">
                                @if($post->category)
                                    <span class="blog-category">{{ $post->translated('category') }}</span>
                                @endif
                                @if($post->published_at)
                                    <span class="blog-date">{{ $post->published_at->format('d M Y') }}</span>
                                @endif
                            </div>

                            {{-- TITLE --}}
                            <h3 class="blog-title">
                                <a href="{{ route('blog.show', $post) }}">
                                    {{ $post->translated('title') }}
                                </a>
                            </h3>

                            {{-- EXCERPT --}}
                            <p class="blog-excerpt">
                                {{ Str::limit($post->translated('excerpt') ?? strip_tags($post->translated('content')), 110) }}
                            </p>

                            {{-- FOOTER --}}
                            <div class="blog-card-footer">
                                <span class="blog-card-author">INOBI Insight</span>
                                <a href="{{ route('blog.show', $post) }}" class="blog-read-more">
                                    {{ __('ui.read_article') }} <span>→</span>
                                </a>
                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            {{-- PAGINATION --}}
            @if($posts->hasPages())
                <div class="blog-pagination">
                    {{ $posts->links() }}
                </div>
            @endif

        @else

            {{-- EMPTY --}}
            <div class="blog-empty">
                <div class="blog-empty-icon">📝</div>
                <h2>{{ __('ui.no_articles') }}</h2>
                <p>
                    {{ __('ui.no_articles_description') }}
                </p>
            </div>

        @endif

    </div>
</section>

@endsection