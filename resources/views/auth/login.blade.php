<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="emp_user">Username:</label>
            <input type="text" id="emp_user" name="emp_user" required>
        </div>
        <div>
            <label for="emp_pass">Password:</label>
            <input type="password" id="emp_pass" name="emp_pass" required>
        </div>
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <div id="recaptchaError" style="color: red; display: none;">Please complete the reCAPTCHA.</div>
        <button type="submit">Login</button>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                event.preventDefault();
                document.getElementById('recaptchaError').style.display = 'block';
            } else {
                document.getElementById('recaptchaError').style.display = 'none';
            }
        });
    </script>
</body>
</html>