@include('layouts.dashboard.header')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
            <p class="section-lead">
                Kamu bisa edit profilmu di sini.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('assets-stisla/img/avatar/avatar-1.png') }}"
                                class="rounded-circle profile-widget-picture">

                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ auth()->user()->name }}</div>
                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> {{ auth()->user()->role }}
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-github mr-1">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')

                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>

                            <div class="card-body">

                                {{-- Alert sukses --}}
                                @if (session('status') === 'profile-updated')
                                    <div class="alert alert-success">
                                        Profil berhasil diperbarui!
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama</label>
                                        <input @if (auth()->user()->role !== 'owner') disabled @endif type="text"
                                            name="name" class="form-control"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input @if (auth()->user()->role !== 'owner') disabled @endif type="email"
                                            name="email" class="form-control"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div
                                        class="form-group
@if (auth()->user()->role == 'admin') col-12
@else
                                    col-md-6 @endif">
                                        <label>Phone</label>
                                        <input @if (auth()->user()->role !== 'owner') disabled @endif type="number"
                                            name="phone" class="form-control"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                    </div>
                                    @if (auth()->user()->role === 'owner')
                                        <div class="form-group col-md-6 col-12">
                                            <label>Password (Opsional)</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Kosongkan jika tidak diubah">
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Alamat</label>
                                        <textarea @if (auth()->user()->role !== 'owner') disabled @endif name="address" class="form-control" rows="3"
                                            placeholder="Masukkan alamat lengkap">{{ old('address', auth()->user()->address) }}</textarea>
                                    </div>
                                </div>

                            </div>
                            @if (auth()->user()->role === 'owner')
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.dashboard.footer')
