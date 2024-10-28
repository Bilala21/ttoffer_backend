<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TTOffer</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <!--<p>Your password reset code is <b>{{ $mailData['body'] }}</b></p>-->
    <p>To reset your TToffer account your password please use code :<b>{{ $mailData['body'] }}</b></p>
</body>
</html>