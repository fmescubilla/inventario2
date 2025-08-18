<?php
# Almacenando datos del formulario

$usuario=limpiar_cadena($_POST['login_usuario']);
$clave=limpiar_cadena($_POST['login_clave']);

if ($usuario=="" || $clave=="") {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios.
          </div>';
    exit();
}

# Verificando integridad de los datos
if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El Usuario no coincide con el formato solicitado.
          </div>';
    exit();
}
if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
           La clave no coincide con el formato solicitado.
          </div>';
    exit();
}

$check_user=conexion();
$check_user=$check_user->query("SELECT * FROM usuarios WHERE usuario='$usuario'");

if($check_user->rowCount()==1){

   $check_user=$check_user->fetch();

   if($check_user['usuario'] == $usuario && password_verify($clave,$check_user['clave'])){

        //session_start();

        $_SESSION['usuario_id'] =$check_user['usuario_id'];
        $_SESSION['nombre'] =$check_user['nombre'];
        $_SESSION['apellido'] =$check_user['apellido'];
        $_SESSION['usuario'] =$check_user['usuario'];

        if(headers_sent()){
				echo "<script> window.location.href='index.php?vista=home'; </script>";
			}else{
				header("Location: index.php?vista=home");
			}

    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Usuario o clave incorrectos
	            </div>
	        ';
    	}
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                Usuario o clave incorrectos
            </div>
        ';
    }
$check_user=null;