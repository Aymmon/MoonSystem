<!DOCTYPE html>
<html lang="en" data-assets-path="{{ asset('assets/') }}/" data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Moon System' }}</title>
    <meta name="description" content="" />
    {{-- Include head section (favicon, fonts, styles) --}}
    @include('components.head')
</head>
<body>

    {{-- Page content --}}
    @yield('content')

    {{-- Include Footer --}}
    @include('components.footer')
    {{-- Include scripts --}}
    @include('components.scripts')
</body>
</html>
