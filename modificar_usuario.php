<?php
session_start();
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $atribut = $_POST['atribut'];
    $nou_contingut = $_POST['nou_contingut'];
    
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
    
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    $entrada = $ldap->getEntry($dn);
    if ($entrada) {
        Attribute::setAttribute($entrada, $atribut, $nou_contingut);
        try {
            $ldap->update($dn, $entrada);
            $_SESSION['message'] = "Atribut modificat";
            $_SESSION['message_type'] = 'success';
        } catch (Exception $e) {
            $_SESSION['message'] = "Error al modificar el usuario: " . $e->getMessage();
            $_SESSION['message_type'] = 'error';
        }
    } else {
        
        $_SESSION['message'] = "<b>Aquesta entrada no existeix</b><br><br>";
        $_SESSION['message_type'] = 'error';
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario LDAP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Modificar usuario en LDAP</h1>
        
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
            <div class="form-group">
<label>Atributo a modificar:</label><br>
<input type="radio" id="uidNumber" name="atribut" value="uidNumber" required>
<label for="uidNumber">uidNumber</label><br>
<input type="radio" id="gidNumber" name="atribut" value="gidNumber">
<label for="gidNumber">gidNumber</label><br>
<input type="radio" id="directorio" name="atribut" value="homeDirectory">
<label for="directorio">Directorio personal</label><br>
<input type="radio" id="shell" name="atribut" value="loginShell">
<label for="shell">Shell</label><br>
<input type="radio" id="cn" name="atribut" value="cn">
<label for="cn">cn</label><br>
<input type="radio" id="sn" name="atribut" value="sn">
<label for="sn">sn</label><br>
<input type="radio" id="givenName" name="atribut" value="givenName">
<label for="givenName">givenName</label><br>
<input type="radio" id="postalAddress" name="atribut" value="postalAddress">
<label for="postalAddress">PostalAddress</label><br>
<input type="radio" id="mobile" name="atribut" value="mobile">
<label for="mobile">mobile</label><br>
<input type="radio" id="telephoneNumber" name="atribut" value="telephoneNumber">
<label for="telephoneNumber">telephoneNumber</label><br>
<input type="radio" id="title" name="atribut" value="title">
<label for="title">title</label><br>
<input type="radio" id="description" name="atribut" value="description">
<label for="description">description</label><br>
</div>
<div class="form-group">
<label for="nou_contingut">Nuevo valor:</label>
<input type="text" name="nou_contingut" id="nou_contingut" class="form-control" required>
</div>
<input type="submit" value="Modificar Usuario" class="btn btn-primary">
</form>
<div class="text-center">
	<a href="http://zend-lajiiz.fjeclot.net/zendldapProject/menu.php">Torna al menú</a>
</div>
</div>

</body>
</html>