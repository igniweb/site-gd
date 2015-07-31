<html>
<head>
    <meta charset="utf-8">
    <title>Sandbox</title>
</head>
<body>
<pre><?php
print_r($request->ip());
echo PHP_EOL;
print_r($request->route());
echo PHP_EOL;
print_r($request->url());
?></pre>
</body>
</html>
