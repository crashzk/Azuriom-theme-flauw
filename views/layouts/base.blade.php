<!DOCTYPE html>
@include('elements.base')
@php
    $version_theme = json_decode(file_get_contents(theme_path().'/theme.json'), true);

    function hexToRGB($theme_path){return implode(", ", sscanf($theme_path, "#%02x%02x%02x"));}
    function RGBnocommas($rgb){return str_replace(',', '', $rgb);}
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="#3490DC">
    <meta name="author" content="Azuriom">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ site_name() }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ favicon() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <!-- Page level scripts -->
    @stack('scripts')

    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ theme_asset('css/styles.css').'?ver='.$version_theme['version'] }}" rel="stylesheet">
    <link href="{{ theme_asset('css/override_bootstrap.css').'?ver='.$version_theme['version'] }}" rel="stylesheet">

    <style>
        :root{
            --bs-primary: rgba(var(--bs-primary-rgb), 1);
            --bs-primary-rgb: {{hexToRGB(theme_config('general.color.primary')??'#ddb72c')}};
            --bs-primary-rgb-no_commas: {{RGBnocommas(hexToRGB(theme_config('general.color.primary')??'#ddb72c'))}};

            --bs-secondary: rgba(var(--bs-secondary-rgb), 1);
            --bs-secondary-rgb: {{hexToRGB(theme_config('general.color.secondary')??'#6C757D')}};
            --bs-secondary-rgb-no_commas: {{RGBnocommas(hexToRGB(theme_config('general.color.secondary')??'#6C757D'))}};

            --bs-white: rgba(var(--bs-white-rgb), 1);
            --bs-white-rgb: {{hexToRGB(theme_config('general.color.white')??'#E5E5E5')}};

            --bs-light: rgba(var(--bs-light-rgb), 1);
            --bs-light-rgb: {{hexToRGB(theme_config('general.color.light')??'#33404C')}};

            --bs-dark: rgba(var(--bs-dark-rgb), 1);
            --bs-dark-rgb: {{hexToRGB(theme_config('general.color.dark')??'#2D3C46')}};
            --bs-dark-rgb-no_commas: {{RGBnocommas(hexToRGB(theme_config('general.color.dark')??'#2D3C46'))}};

            --bs-black: rgba(var(--bs-black-rgb), 1);
            --bs-black-rgb: {{hexToRGB(theme_config('general.color.black')??'#000000')}};

            --bs-body-bg: rgba(var(--bs-body-bg-rgb), 1);
            --bs-body-rgb: {{hexToRGB(theme_config('general.color.body')??'#212529')}};

            /* couleur txt */
            --bs-body-color: var(--bs-white);

            /*  custom color by client  */
            --primary-btn: {{hexToRGB(theme_config('general.color.textbtnprimary') ?? 'var(--bs-white)')}};
            --secondary-btn: {{hexToRGB(theme_config('general.color.textbtnsecondary') ?? 'var(--bs-white)')}};

        }
        .btn-primary,.btn-primary i,.btn-primary i:hover,.btn-primary:hover,.btn-primary:active,.btn-primary:focus{
            color: var(--primary-btn);
        }
        .btn-secondary,.btn-secondary i,.btn-secondary i:hover,.btn-secondary:hover,.btn-secondary:active,.btn-secondary:focus{
            color: var(--primary-btn);
        }
    </style>
    @stack('styles')
</head>

<body>
<div id="app">
    <header class="position-absolute end-0 start-0 top-0">
        @include('elements.navbar')
    </header>

    @yield('app')
</div>

<footer class="@if(!theme_config('footer.box.toggle')) bg-dark @else bg-body @endif mt-auto py-4">
    @if(!theme_config('footer.box.toggle'))
        @include('elements.footer')
    @else
        @include('elements.small-footer')
    @endif
</footer>

@stack('footer-scripts')
<script type="text/javascript">
        const serverCounter = document.querySelector('.server_count');
        let serverCounterSpan = document.querySelector('.server_count_span')
        const serverSpan = serverCounterSpan.innerText;
        serverCounterSpan.innerHTML = ""
        if(serverCounter.innerText.includes('{online}')){serverCounter.innerText = serverCounter.innerText.replace('{online}', serverSpan) }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>

<script type="text/javascript">
    var clipboard = new ClipboardJS('.copy_ip')
    clipboard.on('success', function(e) {
        let elm = document.querySelector(".ip_address");
        elm.innerHTML = '{{mb_strtoupper(trans('theme::theme.hero.ip_copy'))}}';
        setTimeout(function () {
            elm.innerHTML = '{{theme_config('hero.server.ip') ?? 'play.dixept.fr'}}';
        }, 1500);
    });
</script>

</body>
</html>
