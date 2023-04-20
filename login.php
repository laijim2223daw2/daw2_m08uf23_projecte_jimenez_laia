<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTENTICANT AMB LDAP DE L'USUARI admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">AUTENTICANT AMB LDAP DE L'USUARI admin</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="http://zend-lajiiz.fjeclot.net/zendldapProject/auth.php" method="POST">
                    <div class="form-group">
                        <label for="adm">Usuari amb permisos d'administració LDAP:</label>
                        <input type="text" class="form-control" id="adm" name="adm" required>
                    </div>
                    <div class="form-group">
                        <label for="cts">Contrasenya de l'usuari:</label>
                        <input type="password" class="form-control" id="cts" name="cts" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Envia">
                        <input type="reset" class="btn btn-secondary" value="Neteja">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
