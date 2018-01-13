<!-- default.blade.php -->
<!doctype html>
<html>
<head>
    @include('shared.head')
</head>

<body>
    <div class="container">
        <header class="row">
            @include('shared.header')
        </header>
        <div id="main" class="row">
            @include('_container_content')
        </div>

        <footer class="row">
            @include('shared.footer')
        </footer>

    </div>
</body>
</html>
