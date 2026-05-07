<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Adeel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('lol.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <section id="side-panel">
        <h1>ADEEL</h1>
        <div class="sidebar">
            <ul id="side-links">
                <li><a href="{{ url('/admin') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ url('/admin/about') }}"><i class="fas fa-user"></i> About</a></li>
                <li><a href="{{ url('/admin/services') }}"><i class="fas fa-briefcase"></i> Services</a></li>
                <li><a href="{{ url('/admin/skills') }}"><i class="fas fa-code"></i> Skills</a></li>
                <li><a href="{{ url('/admin/contacts') }}"><i class="fas fa-envelope"></i> Contacts</a></li>
            </ul>
        </div>
    </section>

    <section id="main">
        @yield('content')
    </section>

</body>
</html>