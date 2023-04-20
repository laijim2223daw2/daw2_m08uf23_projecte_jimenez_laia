<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-lajiiz.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Datos de usuario LDAP</h1>
        <h2 class="text-center mt-5">Formulario de selección de usuario</h2>
        <form action="visualizar_usuario.php" method="GET" class="mt-3">
            <div class="form-group">
                <label for="ou">Unidad Organizativa:</label>
                <input type="text" name="ou" id="ou" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="usr">Usuario:</label>
                <input type="text" name="usr" id="usr" class="form-control" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Buscar Usuario" class="btn btn-primary">
                <input type="reset" value="Limpiar" class="btn btn-secondary">
            </div>
            <div class="text-center">
    			<a href="http://zend-lajiiz.fjeclot.net/zendldapProject/menu.php">Torna al menú</a>
    		</div>
        </form>
        <?php if (isset($usuari)): ?>
            <div class="card mt-4">
                <div class="card-header">
                    <b><?php echo $usuari["dn"]; ?></b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <?php foreach ($usuari as $atribut => $dada): ?>
                            <?php if ($atribut != "dn"): ?>
                                <tr>
                                    <th><?php echo $atribut; ?></th>
                                    <td><?php echo $dada[0]; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                       
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
                       