<div class="side-navbar d-none d-sm-flex flex-column flex-shrink-0">
    <a href="/" class="">
        <div class="logo-next-episode">
            {{-- LOGO FULL --}}
            <img src="{{ asset('./img/logo_nextepisode.png') }}" alt="NewEpisode" class="logo-full">

            {{-- LOGO COLLAPSED ONLY ICON --}}
            <img src="{{ asset('./img/logo.png') }}" alt="NewEpisode" class="logo-icon">

            <p class="administration-logo-text">- Administration</p>
        </div>
    </a>
    @include('partials.navigation')
</div>