<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
   <p> Hi {{ $name }}</p> 
   <p>Click on below link to Verify your account</p>
   <a href="{{ $url }}">Click to Verify</a>
</body>
</html>