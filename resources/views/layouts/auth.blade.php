<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#000000" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ asset('css/user.css') }}" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <title>{{ trans('panel.site_title') }}</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        @livewireStyles
        @stack('styles')
    </head>
    <body class="text-gray-800 bg-repeat heropattern-moroccan-blue-200 bg-blue-800 dark:bg-gray-900 antialiased font-inter">
        <noscript>You need to enable JavaScript to run this app.</noscript>

            <div id="app" class="w-full">
                @yield('content')
            </div>
            @if(session('status'))
                <x-alert message="{{ session('status') }}" variant="indigo" role="alert" />
            @endif
        </div>
        <script type="text/javascript" src="{{ asset('js/user.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        @livewireScripts
        @yield('scripts')
        @stack('scripts')
    </body>
</html>