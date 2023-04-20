<?php
session_start();
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogiendo los datos del formulario
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $num_id = $_POST['num_id'];
    $grup = $_POST['grup'];
    $dir_pers = $_POST['dir_pers'];
    $sh = $_POST['sh'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['nom'];
    $mobil = $_POST['mobil'];
    $adressa = $_POST['adressa'];
    $telefon = $_POST['telefon'];
    $titol = $_POST['titol'];
    $descripcio = $_POST['descripcio'];
    $objcl = array('inetOrgPerson', 'organizationalPerson', 'person', 'posixAccount', 'shadowAccount', 'top');
    
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
    
    // Creando la nueva entrada
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    
    if ($ldap->add($dn, $nova_entrada)) {
        $_SESSION['message'] = "Usuari creat";
    } else {
        $_SESSION['message'] = "Error al crear el usuario";
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
    <title>Formulario de Creación de Usuarios LDAP</title>
    <!-- Añadiendo Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Crear usuario en LDAP</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='alert alert-info'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
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
                <label for="num_id">Número de ID:</label>
                <input type="number" name="num_id" id="num_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="grup">Grupo:</label>
                <input type="number" name="grup" id="grup" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dir_pers">Directorio Personal:</label>
                <input type="text" name="dir_pers" id="dir_pers" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sh">Shell:</label>
                <input type="text" name="sh" id="sh" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cn">Nombre Completo (CN):</label>
                <input type="text" name="cn" id="cn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sn">Apellido (SN):</label>
                <input type="text" name="sn" id="sn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nom">Nombre (Given Name):</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobil">Móvil:</label>
                            <input type="text" name="mobil" id="mobil" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adressa">Dirección Postal:</label>
            <input type="text" name="adressa" id="adressa" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefon">Teléfono:</label>
            <input type="text" name="telefon" id="telefon" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="titol">Título:</label>
            <input type="text" name="titol" id="titol" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="descripcio">Descripción:</label>
            <input type="text" name="descripcio" id="descripcio" class="form-control" required>
        </div>
        <input type="submit" value="Crear Usuario" class="btn btn-primary">
    </form>
</div>
</body>
</html>

