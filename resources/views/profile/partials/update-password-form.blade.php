<section>
    <header class="mb-4">
        <h5 class="fw-bold mb-1">
            Modifica password
        </h5>
        <p class="description-category mb-0">
            Assicurati che il tuo account utilizzi una password sicura.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">
                Password attuale
            </label>
            <input class="form-control" type="password" name="current_password" id="current_password"
                autocomplete="current-password">
            @error('current_password')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('current_password') }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">
                Nuova password
            </label>
            <input class="form-control" type="password" name="password" id="password" autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('password') }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                Conferma password
            </label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                autocomplete="new-password">
            @error('password_confirmation')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('password_confirmation') }}</strong>
            </span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-info">
                Salva modifiche
            </button>

            @if (session('status') === 'password-updated')
            <script>
                const show = true;
                setTimeout(() => show = false, 2000)
                const el = document.getElementById('status')
                if (show) {
                    el.style.display = 'block';
                }
            </script>
            <p id="status" class="fs-5 text-muted mb-0">
                Modifiche salvate.
            </p>
            @endif
        </div>
    </form>
</section>