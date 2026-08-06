<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        const savedTheme = localStorage.getItem('theme');

        const theme = savedTheme
            ? savedTheme
            : (window.matchMedia('(prefers-color-scheme: dark)').matches
                ? 'dark'
                : 'light');

        document.documentElement.setAttribute('data-bs-theme', theme);
    </script>
    @vite(['resources/css/bootstrap-app.css', 'resources/js/bootstrap-app.js', 'resources/css/fontawesome-app.css'])
    <title>@yield('pageTitle')</title>
</head>
<body>
@include('navigation-admin')

@yield('pageContent')

@include('footer')
</body>
</html>
