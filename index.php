<?php
session_start();
var_dump($_GET);

var_dump($_SERVER['REQUEST_URI']);

?>
<h1>HOME HYPNOS</h1>
<?php die();
// $get = $_GET['admin'];

// if(isset($_GET['admin'])){
//     echo "ADMINSITATOR";
// }
// $message = date('d-m-Y'). ' '.$_SERVER['REQUEST_URI'].PHP_EOL;
// error_log($message, 3, './error_log.log');

// if (array_key_exists ('ENV_HTACCESS_READING', $_SERVER))
// {
//   echo "Yes ! .htaccess is read and used !!\n";
// }
// else
// {
//   echo "BAD : The .htaccess is not read : add 'AllowOverride All' in your Apache configuration\n";
// }

// var_dump($_SERVER);
$route = explode('/', $_SERVER['REQUEST_URI']);

switch ($route) {
    case $route[1] == 'Establishment':
        require('./test/EstablishmentTest.php');        
        break;
    case $route[1] == 'Users':
        require('./test/UserTest.php');
        break;
        case $route[1] == "managers":
            require('./test/manager.php');
            break;     
    default:
    echo "<h1>Hypnos Home</h1> ";
}