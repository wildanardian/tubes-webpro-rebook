<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome to the Index Page</h1>
    <p>This is the content of the index page.</p>

    <h1>Data User</h1>
    <p>{{ Auth::user()->username }}</p>
    <p>{{ Auth::user()->email }}</p>

    <a href="{{ route('logout') }}">Logout</a>

</body>
</html>
