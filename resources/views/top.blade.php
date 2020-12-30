<!DOCTYPE html>
<html>
<head>
</head>
<body>
@include('components.header')
<main>
	<h1>テスト</h1>
</main>
@php
    logger("that's test log !!");
@endphp
@include('components.footer')
</body>
</html>