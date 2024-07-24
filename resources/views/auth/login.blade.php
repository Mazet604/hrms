<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="emp_user">Username:</label>
            <input type="text" id="emp_user" name="emp_user" required>
        </div>
        <div>
            <label for="emp_pass">Password:</label>
            <input type="password" id="emp_pass" name="emp_pass" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>