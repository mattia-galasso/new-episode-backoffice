<section class="space-y-6">
    <header class="mb-4">
        <h5 class="fw-bold mb-1">
            Elimina account
        </h5>
        <p class="description-category mb-0">
            Una volta eliminato il tuo account, tutti i dati verranno eliminati definitivamente.
        </p>
    </header>

    <!-- Modal trigger button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-account">
        Elimina account
    </button>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="delete-account" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="delete-account-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-account-label">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                        Elimina account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h5 class="fw-bold">
                        Sei sicuro di voler eliminare il tuo account?
                    </h5>
                    <p class="text-secondary mb-0">
                        Una volta eliminato il tuo account, tutti i dati verranno eliminati definitivamente.
                        Inserisci la tua password per confermare l'eliminazione permanente dell'account.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Annulla
                    </button>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="input-group">
                            <input id="password" name="password" type="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="Password">

                            @error('password', 'userDeletion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>
                                Elimina account
                            </button>
                            <!--  -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>