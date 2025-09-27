<section>
    <header>
        <h2 class="h4 text-primary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mb-4 text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mb-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="npm" class="form-label">{{ __('NPM') }}</label>
            <input id="npm" name="npm" type="text" class="form-control" value="{{ old('npm', $user->npm) }}" autocomplete="off" />
            @error('npm')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fakultas" class="form-label">{{ __('Fakultas') }}</label>
            <input id="fakultas" name="fakultas" type="text" class="form-control" value="{{ old('fakultas', $user->fakultas) }}" autocomplete="off" />
            @error('fakultas')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">{{ __('Prodi') }}</label>
            <input id="prodi" name="prodi" type="text" class="form-control" value="{{ old('prodi', $user->prodi) }}" autocomplete="off" />
            @error('prodi')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">{{ __('Angkatan') }}</label>
            <input id="angkatan" name="angkatan" type="text" class="form-control" value="{{ old('angkatan', $user->angkatan) }}" autocomplete="off" />
            @error('angkatan')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nomor_telpon" class="form-label">{{ __('Nomor Telpon') }}</label>
            <input id="nomor_telpon" name="nomor_telpon" type="text" class="form-control" value="{{ old('nomor_telpon', $user->nomor_telpon) }}" autocomplete="off" />
            @error('nomor_telpon')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="profile_photo" class="form-label">{{ __('Profile Photo') }}</label>
            <input id="profile_photo" name="profile_photo" type="file" class="form-control" />
            @error('profile_photo')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="mt-2 rounded-circle" style="width: 80px; height: 80px; object-fit: cover;" />
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </div>
            @endif
        </div>
    </form>
</section>
