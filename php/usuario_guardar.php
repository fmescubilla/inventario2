<?php
require_once "main.php";

# Almacenando datos del formulario
$nombre    = isset($_POST['usuario_nombre']) ? limpiar_cadena($_POST['usuario_nombre']) : '';
$apellido  = isset($_POST['usuario_apellido']) ? limpiar_cadena($_POST['usuario_apellido']) : '';
$usuario   = isset($_POST['usuario_usuario']) ? limpiar_cadena($_POST['usuario_usuario']) : '';
$email     = isset($_POST['usuario_email']) ? limpiar_cadena($_POST['usuario_email']) : '';
$clave_1   = isset($_POST['usuario_clave_1']) ? limpiar_cadena($_POST['usuario_clave_1']) : '';
$clave_2   = isset($_POST['usuario_clave_2']) ? limpiar_cadena($_POST['usuario_clave_2']) : '';

# Verificando campos obligatorios
if ($nombre == "" || $apellido == "" || $usuario == "" || $clave_1 == "" || $clave_2 == "") {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios.
          </div>';
    exit();
}

# Verificando integridad de los datos
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El nombre no coincide con el formato solicitado.
          </div>';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El apellido no coincide con el formato solicitado.
          </div>';
    exit();
}

if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El nombre de usuario no coincide con el formato solicitado.
          </div>';
    exit();
}

if (
    verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_1) ||
    verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_2)
) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La contraseña no coincide con el formato solicitado.
          </div>';
    exit();
}

# Verificando el email (si se ingresó)
if ($email != "") {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El email ingresado no es válido.
              </div>';
        exit();
    }

    # Verificando que el email no exista ya
    $check_email = conexion();
    $check_email = $check_email->query("SELECT email FROM usuarios WHERE email='$email'");
    if ($check_email->rowCount() > 0) {
        echo '<div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                El email ya está registrado. Por favor, ingresa otro.
              </div>';
        exit();
    }
    $check_email = null;
}

# Verificando que el usuario no exista ya
$check_usuario = conexion();
$check_usuario = $check_usuario->query("SELECT usuario FROM usuarios WHERE usuario='$usuario'");
if ($check_usuario->rowCount() > 0) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El nombre de usuario ya está registrado. Por favor, elige otro.
          </div>';
    exit();
}
$check_usuario = null;

# Verificando que las claves coincidan
if ($clave_1 != $clave_2) {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Las contraseñas no coinciden.
          </div>';
    exit();
} 

$clave = password_hash($clave_1, PASSWORD_BCRYPT, ["cost" => 10]);

# Guardando datos en la base de datos
$guardar_usuario = conexion();
//prepare= prepara una consulta para evitar inyeccion sql
//en el primer () ponemos los campos 
$marcadores = [
    ":nombre"   => $nombre,
    ":apellido" => $apellido,
    ":usuario"  => $usuario,
    ":clave"    => $clave,
    ":email"    => $email
];
$guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuarios(nombre, apellido, usuario, clave, email) VALUES(:nombre, :apellido, :usuario, :clave, :email)");

if ($guardar_usuario->execute($marcadores)) {
    echo '<div class="notification is-success is-light">
            <strong>¡USUARIO REGISTRADO!</strong><br>
            El usuario se registró exitosamente.
          </div>';
} else {
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo registrar el usuario, intenta nuevamente.
          </div>';
}

$guardar_usuario = null;
