<form action="{{ $action }}" method="POST" class="card admin-card p-4">
    @csrf
    @if($method !== 'POST') @method($method) @endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama</label><input name="name" class="form-control" value="{{ old('name', $user?->name) }}" required></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user?->email) }}" required></div>
        <div class="col-md-6"><label class="form-label">Password {{ $user ? '(opsional)' : '' }}</label><input type="password" name="password" class="form-control" {{ $user ? '' : 'required' }}></div>
        <div class="col-md-6"><label class="form-label">Konfirmasi Password</label><input type="password" name="password_confirmation" class="form-control" {{ $user ? '' : 'required' }}></div>
        <div class="col-12"><div class="form-check"><input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin" @checked(old('is_admin', $user?->is_admin ?? false))><label class="form-check-label" for="is_admin">Berikan akses administrator</label></div></div>
    </div>
    <div class="d-flex gap-2 mt-4"><button class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button><a href="{{ route('admin.users.index') }}" class="btn btn-light">Batal</a></div>
</form>
