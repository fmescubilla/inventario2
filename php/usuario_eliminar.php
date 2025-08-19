<?php
$user_id_del=limpiar_cadena($_GET['user_id_del']);
//en la variable $user_id_del => esta almacenando el id de la base de datos

//verificando usuario
$check_usuario=conexion();
$check_usuario=$check_usuario->query("SELECT usuario_id FROM usuarios WHERE usuario_id='$user_id_del'");
if($check_usuario->rowCount()==1){
        
    $check_productos=conexion();
    $check_productos=$check_productos->query("SELECT usuario_id FROM producto WHERE usuario_id= '$user_id_del' LIMIT 1");
    if($check_productos->rowCount()<=0){
        $elimar_usuario=conexion();
        $elimar_usuario=$elimar_usuario->prepare("DELETE FROM usuarios WHERE usuario_id=:id"); //vamos a eliminar mediante el id, le decimos que es igual al macrador (pq el valor actaual estara almacenado en ese marcador id)

        $elimar_usuario->execute([":id"=>$user_id_del]);

        //para verificar si hicimos bien la eliminacion de datos
        if($elimar_usuario->rowCount()==1){
             echo '<div class="notification is-info is-light">
             <strong>¡Usuario eliminado!</strong><br>
               Los datos del usuario se eliminaron con exito
            </div>';

        }else{
                 echo '<div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se puso eliminar el usuario.
                    </div>';
        }
        $elimar_usuario=null; //$eliminar_usuario tiene la conexion a la base de datos
    }else{
            echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No podemos eliminar el usuario ya que tiene productos registrados 
          </div>';
    }

}else{
     echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario que intenta eliminar no existe.
          </div>';
}
$check_usuario=null;
