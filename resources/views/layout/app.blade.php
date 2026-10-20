<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>

    <header>
        <h2> Sistem Informasi Surat</h2>
        <nav>
            <a href="{{route('dashboard')}}">dashboard</a>
            <a href="{{route('surat-masuk.index')}}">surat masuk</a>
            <a href="{{route('surat-keluar.index')}}">surat keluar</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Copyright 2024 - Sistem Informasi Surat</p>
    </footer>

</body>
</html>