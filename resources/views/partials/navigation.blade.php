<ul class="nav-list-items mt-4 nav nav-pills flex-column mb-auto gap-3">
    <li class="nav-item">
        <a href="/" class="nav-link {{ Route::is('dashboard') ? 'active' : ''}}" aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-house-door"></i>
            </span>
            <span class="sidebar-text">
                Dashboard
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('tvseries.index') }}" class="nav-link {{ Route::is('tvseries.*') ? 'active' : ''}}"
            aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-film"></i>
            </span>
            <span class="sidebar-text">
                Serie TV
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('actors.index') }}" class="nav-link {{ Route::is('actors.*') ? 'active' : ''}}">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-people"></i>
            </span>
            <span class="sidebar-text">
                Attori
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('genres.index') }}" class="nav-link {{ Route::is('genres.*') ? 'active' : ''}}"
            aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-collection"></i>
            </span>
            <span class="sidebar-text">
                Generi
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link" aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-laptop"></i>
            </span>
            <span class="sidebar-text">
                Piattaforme
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/" class="nav-link" aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-building"></i>
            </span>
            <span class="sidebar-text">
                Case Produttrici
            </span>
        </a>
    </li>
    <hr class="hr-color mt-3 mb-0">
    <p class="m-0 ps-3 fw-bold text-secondary">CONFIGURAZIONE</p>
    <li class="nav-item">
        <a href="/" class="nav-link" aria-current="page">
            <span class="sidebar-icon pe-none">
                <i class="bi bi-person"></i>
            </span>
            <span class="sidebar-text">
                Utenti
            </span>
        </a>
    </li>
</ul>

<ul class="nav nav-pills flex-column gap-1">
    <li class="show-frontend-website nav-item">
        <a href="/" class="nav-link">
            <span class="sidebar-icon">
                <i class="bi bi-globe2"></i>
            </span>
            <span class="sidebar-text">
                Visualizza Sito
            </span>
        </a>
    </li>
    <hr class="hr-color">
    <li class="nav-item sidebar-toggle d-none d-md-block">
        <button type="button" class="nav-link w-100 border-0 bg-transparent" id="sidebar-toggle">
            <span class="sidebar-icon">
                <i id="sidebar-toggle-icon" class="bi bi-layout-sidebar-inset"></i>
            </span>
            <span class="sidebar-text">
                Riduci menu
            </span>
        </button>
    </li>
</ul>