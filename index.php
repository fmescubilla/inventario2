<?php require "./inc/session_start.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include "./inc/head.php"; ?>
    </head>
    <body>
        <?php

            if(!isset($_GET['vista']) || $_GET['vista']==""){
                $_GET['vista']="login";
            }


            if(is_file("./vista/".$_GET['vista'].".php") && $_GET['vista']!="login" && $_GET['vista']!="404"){

                /*== Cerrar sesion ==*/
                // if((!isset($_SESSION['usuario_id]) || $_SESSION['usuario_id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
                //     include "./vista/logout.php";
                //     exit();
                // }

                include "./inc/navbar.php";

                include "./vista/".$_GET['vista'].".php";

                // require_once "./inc/footer.php";

                include "./inc/script.php";

            }else{
                if($_GET['vista']=="login"){
                    include "./vista/login.php";
                }else{
                    include "./vista/404.php";
                }
            }
        ?>
    </body>
</html> 