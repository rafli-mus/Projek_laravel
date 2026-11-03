<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login SIM-Surat</title>
</head>
<body>
    <main>
        <h1>Login SIM-Surat</h1>

        @if ($errors->has('email'))
            <p role="alert" style="color: #b91c1c">{{ $errors->first('email') }}</p>
        @endif

        @if ($errors->has('password'))
            <p role="alert" style="color: #b91c1c">{{ $errors->first('password') }}</p>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <p>
                <label for="email">Email</label><br>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </p>
            <p>
                <label for="password">Password</label><br>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </p>
            <button type="submit">Masuk</button>
        </form>
    </main>
</body>
</html>
