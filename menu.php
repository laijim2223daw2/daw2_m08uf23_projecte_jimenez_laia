<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="bg-dark text-white text-center py-4">
        <h1>Menú</h1>
    </header>
    <div class="container">
        <h2 class="text-center my-4">MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
        <p class="text-center">Aquí puedes añadir, modificar, borrar y visualizar usuarios en la base de datos LDAP.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between my-3">
                	<a href="visualizar_usuario.php" class="btn btn-info">Visualizar Usuario</a>
                    <a href="crear_usuario.php" class="btn btn-success">Añadir Usuario</a>
                    <a href="modificar_usuario.php" class="btn btn-warning">Modificar Usuario</a>
                    <a href="borrar_usuario.php" class="btn btn-danger">Borrar Usuario</a>
                </div>
               
                <div class="text-center">
                    <a href="http://zend-lajiiz.fjeclot.net/zendldapProject/index.php">Torna a la pàgina inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
