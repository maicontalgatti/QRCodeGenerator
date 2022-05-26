<?php
session_start();
include "conectadb.php";
if ($_SESSION["logado_site"] == 'true') {
phpinfo();
}

?>