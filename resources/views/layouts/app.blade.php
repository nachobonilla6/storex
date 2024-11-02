<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your App</title>
    @vite('resources/js/app.js') <!-- Asegúrate de que Alpine.js esté en tu archivo de JavaScript -->
    <script src="//unpkg.com/alpinejs" defer></script> <!-- Agrega esto si no está incluido -->
</head>
<body>
    <!-- Aquí va el contenido de tu aplicación -->
    @yield('content')
</body>
</html>
