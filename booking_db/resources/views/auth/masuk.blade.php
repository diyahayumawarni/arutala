<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>
<body>
<main class="container">
    <h1>Masuk</h1>

    @if ($errors->any())
        <article style="background-color: black; border: 1px solid white; color: white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </article>
    @endif

    <form method="POST" action="{{ route('masuk') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required autofocus>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Masuk</button>
    </form>
</main>
</body>
</html>
