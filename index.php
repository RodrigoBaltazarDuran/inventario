<!-- REPOSITORIO https://github.com/Carlos007007/INVENTARIO/blob/main/vistas/user_new.php -->
<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./inc/head.php"; ?>
</head>
<body>
    <?php

        if (!isset($_GET['vista']) || empty($_GET['vista'])) {
            $_GET['vista'] = 'login';
        }

        if (is_file('./vistas/'.$_GET['vista'].'.php') && $_GET['vista'] != 'login' && $_GET['vista'] != '404') {

            // Cerrar sesión
            if ((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")) {
                include "./vistas/logout.php";
                exit();
            }

            include "./inc/navbar.php";
            include "./vistas/".$_GET['vista'].".php";
            include "./inc/script.php";
        } else {
            if ($_GET['vista'] === 'login') {
                include "./vistas/login.php";
            } else {
                include "./vistas/404.php";
            }
        }

    ?>
</body>
</html>