<?php
session_start();

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogiendo los datos del formulario
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    
    // Configuración y conexión LDAP
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
    
    // Eliminando la entrada
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    try {
        $ldap->delete($dn);
        $_SESSION['message'] = "<b>Entrada esborrada</b><br>";
        $_SESSION['message_type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = "<b>Aquesta entrada no existeix</b><br>";
        $_SESSION['message_type'] = 'error';
    }
    
    // Redirigir a la misma página para limpiar el formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario LDAP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Eliminar usuario en LDAP</h1>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['message_type']; ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label for="uid">UID:</label>
                <input type="text" name="uid" id="uid" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unorg">Unidad Organizativa:</label>
                <input type="text" name="unorg" id="unorg" class="form-control" required>
            </div>
            <input type="submit" value="Eliminar Usuario" class="btn btn-danger">
        </form>
    </div>
</body>
</html>

