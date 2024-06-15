<!doctype html>
<html lang="es">
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
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
    echo '<thead><tr>';
    echo '<th class="text-center"></th>'; // Agregamos la clase text-center al primer th
    echo '<th class="text-center">id</th>';
    echo '<th class="text-center">email</th>';
    echo '<th class="text-center">password</th>';
    echo '<th class="text-center">telefono</th>';
    echo '<th class="text-center">nombre</th>';
    echo '<th class="text-center">imagen</th>';
    echo '<th class="text-center">disponible</th>';
    echo '<th>token</th>';
    echo '<th class="text-center">admin</th>';
    echo '</tr></thead>';
    echo '<tbody>';
    while ($value = $result->fetch_array(MYSQLI_ASSOC)) {
        echo '<tr>';
        echo '<td class="text-center"><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>'; // Agregamos la clase text-center al primer td
        foreach ($value as $element) {
            echo '<td class="text-center">' . $element . '</td>'; // Agregamos la clase text-center a cada td
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    $result->close();
    mysqli_close($conn);
    ?>
</div>
</body>
</html>