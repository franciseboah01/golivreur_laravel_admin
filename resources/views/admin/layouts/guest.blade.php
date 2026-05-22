<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoLivreur Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #0A0A0A; color: #FFFFFF; font-family: 'Segoe UI', sans-serif; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    @yield('content')
</body>
</html>