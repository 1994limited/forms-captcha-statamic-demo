<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dog-ear Books' }}</title>
    <s:partial src="styles" />
</head>
<body>
    <s:partial src="header" />
    <main>@yield('content')</main>
    <s:partial src="footer" />
</body>
</html>
