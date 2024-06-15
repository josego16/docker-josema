<html lang="es">
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <?php
    echo "<h1>¡Hola, Jose Maria te da la bienvenida!</h1>";

    $conn = mysqli_connect('db-dbuser', 'josema', 'josema', "dbuser");
    $query = 'SELECT * From dbuser.usuarios';
    $result = mysqli_query($conn, $query);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th>id</th><th>email</th><th>password</th><th>telefono</th><th>nombre</th><th>imagen</th><th>disponible</th><th>token</th><th>admin</th></tr></thead>';
    while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
        foreach ($value as $element) {
            echo '<td>' . $element . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';

    $result->close();
    mysqli_close($conn);
    ?>
</div>
</body>
</html>