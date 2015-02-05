<!DOCTYPE html>
<html lang="en">
<head>
    <title>Timer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
<div class="menu-bar">
    <div class="menu-inner">
        <div class="row">
            <h2>Timer</h2>
            <div class="menu">
                <a href="/dashboard">Dashboard</a>
                <a href="/projects">Projects</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    @yield('content')
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
@yield('scripts')
</body>
</html>