<!DOCTYPE html>
<html>
<head>
    <title>Meu Gráfico</title>
    {!! Charts::assets() !!}
</head>
<body>
    <div class="container">
        <h1>Meu Gráfico</h1>
        {!! $chart->html() !!}
    </div>
</body>
</html>
