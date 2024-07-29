<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var countdownElement = document.getElementById('countdown');
            var countdownTime = 300; // 5 minutes in seconds

            function updateCountdown() {
                var minutes = Math.floor(countdownTime / 60);
                var seconds = countdownTime % 60;
                countdownElement.textContent = minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
                if (countdownTime > 0) {
                    countdownTime--;
                } else {
                    document.getElementById('resend-otp-form').style.display = 'block';
                }
            }

            setInterval(updateCountdown, 1000);
        });
    </script>
</head>
<body>
    <h2>OTP Verification</h2>
    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif
    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify</button>
    </form>
    <div id="countdown">4:59</div>
    </form>
</body>
</html>