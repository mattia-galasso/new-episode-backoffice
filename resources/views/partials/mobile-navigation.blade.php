<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="/" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('tvseries.index') }}"
           class="nav-link {{ Route::is('tvseries.*') ? 'active' : '' }}">
            <i class="bi bi-film"></i>
            <span>Serie TV</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-people"></i>
            <span>Attori</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-collection"></i>
            <span>Generi</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-laptop"></i>
            <span>Piattaforme</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-building"></i>
            <span>Case Produttrici</span>
        </a>
    </li>
    <hr class="my-3">
    <small class="text-secondary fw-bold px-2">
        CONFIGURAZIONE
    </small>
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-person"></i>
            <span>Utenti</span>
        </a>
    </li>
    <hr class="my-3">
    <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="bi bi-globe2"></i>
            <span>Visualizza sito</span>
        </a>
    </li>
</ul>