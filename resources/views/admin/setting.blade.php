@extends('layouts.admin')

@section('title', __('ui.settings').' - INOBI '. __('ui.admin'))

@section('content')
<div class="container-fluid admin-page">
    <div class="admin-page-header">
        <div>
            <h1>Settings</h1>
            <p>{{ app()->getLocale() === 'id' ? 'Atur informasi dasar yang digunakan oleh website INOBI.' : 'Manage the basic information used by the INOBI website.' }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('ui.site_name') }}</label>
                        <input type="text" name="site_name" class="form-control" 
                               value="{{ old('site_name', $settings['site_name'] ?? 'INOBI') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('ui.company_email') }}</label>
                        <input type="email" name="company_email" class="form-control" 
                               value="{{ old('company_email', $settings['company_email'] ?? $settings['admin_email'] ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('ui.contact_phone') }}</label>
                        <input type="text" name="contact_phone" class="form-control" 
                               value="{{ old('contact_phone', $settings['contact_phone'] ?? '+62 812 3456 7890') }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('ui.site_description') }}</label>
                        <textarea name="site_description" class="form-control" rows="3">{{ old('site_description', $settings['site_description'] ?? 'PT. Inovasi Bioproduk Indonesia menyediakan bioproduk, biomaterial, peralatan laboratorium, dan solusi penelitian.') }}</textarea>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('ui.address') }}</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $settings['address'] ?? 'Jakarta, Indonesia') }}</textarea>
                    </div>

                    <div class="col-12">
                        <h5 class="mt-2 mb-3">Media Sosial dan Kontak Publik</h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" name="instagram_url" class="form-control"
                               placeholder="https://www.instagram.com/inobi.id/"
                               value="{{ old('instagram_url', $settings['instagram_url'] ?? 'https://www.instagram.com/inobi.id/') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" name="facebook_url" class="form-control"
                               placeholder="https://www.facebook.com/inobi.id"
                               value="{{ old('facebook_url', $settings['facebook_url'] ?? 'https://www.facebook.com/inobi.id') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="form-control"
                               placeholder="https://www.linkedin.com/company/..."
                               value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">WhatsApp URL</label>
                        <input type="url" name="whatsapp_url" class="form-control"
                               placeholder="https://wa.me/628..."
                               value="{{ old('whatsapp_url', $settings['whatsapp_url'] ?? 'https://wa.me/6281237411413') }}">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> {{ __('ui.save') }} {{ __('ui.settings') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection