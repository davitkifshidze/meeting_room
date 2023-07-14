<header class="header">
    <div class="info__container">

        <div class="lang__switcher">
            <ul class="default__lang">
                <li>
                    {{ LaravelLocalization::getCurrentLocalenative() }}
                </li>
                <li class="icon">
                    <i class="fa-solid fa-chevron-down"></i>
                </li>
            </ul>
            <ul class="lang__select">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="lang">
                        <a rel="alternate" hreflang="{{ $localeCode }}"
                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>

        <div class="notification__container">
            <i class="fa-solid fa-bell notification__bell"></i>
        </div>
        <div class="notification__container">
            <i class="fa-solid fa-gear setting"></i>
        </div>
        <div class="header__user__container">
            <img class="user__img" src="{{ asset('assets/images/logo/logo.png')  }}" alt="Admin Img">
        </div>
    </div>
</header>
