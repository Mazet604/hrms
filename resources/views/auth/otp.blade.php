<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>