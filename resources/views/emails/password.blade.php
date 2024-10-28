<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Credentials</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Your Email is <b>{{ $mailData['email'] }}</b></p>
    <p>Your password is <b>{{ $mailData['password'] }}</b></p>
    <p>You are assigned with the Role <b>{{ $mailData['role'] }}</b> Of TTOffer Application.</p>
    <p>Login with these credentials on TTOffer Admin Panel</p>
</body>
</html>