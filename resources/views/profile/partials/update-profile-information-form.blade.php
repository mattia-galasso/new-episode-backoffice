<section>

    <header class="mb-4">

        <h5 class="fw-bold mb-1">
            Informazioni profilo
        </h5>

        <p class="description-category mb-0">
            Aggiorna le informazioni del tuo account e il tuo indirizzo email.
        </p>

    </header>

    {{-- EMAIL VERIFICATION --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">

        @csrf
    </form>

    {{-- UPDATE PROFILE FORM --}}
    <form method="POST" action="{{ route('profile.update') }}">

        @csrf
        @method('PATCH')

        {{-- NAME --}}
        <div class="mb-3">

            <label for="name" class="form-label">
                Nome
            </label>

            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                autocomplete="name" value="{{ old('name', $user->name) }}" required autofocus>

            @error('name')

            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">

            <label for="email" class="form-label">
                Email
            </label>

            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username">

            @error('email')

            <div class="invalid-feedback">
                {{ $message }}
            </div>

            @enderror

            {{-- EMAIL VERIFICATION --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="mt-3">

                <p class="text-secondary mb-2">
                    Il tuo indirizzo email non è stato verificato.
                </p>

                <button type="submit" form="send-verification" class="btn btn-outline-secondary">

                    Invia nuovamente l'email di verifica

                </button>

                @if (session('status') === 'verification-link-sent')

                <p class="text-success mt-2 mb-0">
                    <i class="bi bi-check-circle me-1"></i>
                    Un nuovo link di verifica è stato inviato al tuo indirizzo email.
                </p>
                @endif
            </div>
            @endif
        </div>

        {{-- ACTIONS --}}
        <div class="d-flex align-items-center gap-3">

            <button type="submit" class="btn btn-info">

                Salva modifiche

            </button>

            @if (session('status') === 'profile-updated')

            <p id="profile-status" class="text-success mb-0">

                <i class="bi bi-check-circle me-1"></i>
                Modifiche salvate

            </p>

            <script>
                const profileStatus = document.getElementById('profile-status');

                setTimeout(() => {
                    profileStatus.style.display = 'none';
                }, 2000);
            </script>
            @endif
        </div>
    </form>
</section>