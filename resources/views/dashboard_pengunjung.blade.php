<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticketing System</title>
    <style>

        body{
            margin:0;
            font-family: Arial;
            background-color:#f4f4f4;
        }

        .navbar{
            background:#333;
            padding:15px;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            margin-right:20px;
            font-weight:bold;
        }

        .container{
            padding:30px;
        }

    </style>

</head>

<body>

<div class="navbar">
    <a href="/">Home</a>
    <a href="/dashboard">Dashboard</a>
    <a href="/events">Events</a>
    <a href="/tickets">Tickets</a>
    <a href="/contact">Contact</a>
</div>

<div class="container">

    <h1>Dashboard Admin</h1>
    <p>Selamat datang di Sistem Manajemen Event & Ticketing</p>

</div>

</body>
</html>