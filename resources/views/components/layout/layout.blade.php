<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Idea</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    <x-layout.nav></x-layout.nav>
    <main class="max-w-7x1 mx-auto items-center ">
        {{ $slot }}
    </main>
@session('success')
    <div x-data="{show:true}"
    x-init="setTimeout( ()=> show = false,3000)"
    x-show="show"
    x-transition.opacity.duration.300ms
        class="bg-primary px-4 py-3 buttom-4 right-4 rounded-lg">
        {{ $value }}
    </div>
@endsession
</body>

</html>