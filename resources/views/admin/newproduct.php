<?php
namespace views;
require "../../../app/autoloader.php";
include "../layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
head($ua);
?>

<h1>todavia no se añade ningun producto</h1>
<?php
    scripts();
?>
<?php
    foot();