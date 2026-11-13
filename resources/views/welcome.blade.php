
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ikigai Masho!</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F5F7F0;
            text-align: center;
        }

        .container {
            padding: 80px 20px;
        }

        h1 {
            color: #52745C;
            font-size: 32px;
        }

        p {
            color: #666;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            margin: 10px;
            background-color: #52745C;
            color: white;
            text-decoration: none;
            border-radius: 25px;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Ikigai Masho!</h1>

        <p>Let's Reach a Balanced Life!</p>

        <p>
            Understand your lifestyle.
            Discover your patterns.
            Build a balanced life.
        </p>

        <a href="{{route('login')}}" class="btn">Log In</a>

        <a href="{{route('register')}}" class="btn">Sign Up</a>

    </div>

</body>
</html>
