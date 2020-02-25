<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $timestamp }}</title>
</head>
<body>
<h1>ERROR: {{ $timestamp }}</h1>
LINE:
<pre>{{ $line }}</pre>
<hr>
FILE:
<pre>{{ $file }}</pre>
<hr>
ERROR:
<pre>{{ print_r($error) }}</pre>
<hr>
TRACE:
<pre>{{ print_r($traceAsString) }}</pre>
</body>
</html>