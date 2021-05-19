<?php include_once('includes/load.php'); ?>
<?php

$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
 $current_user1 = find_by_id('users',$user_id);

  if($user_id){

    //crea session con el id
    if(!($current_user1['status'] == 0)){
      $session->login($user_id);
    //actualiza ultimo login
     updateLastLogIn($user_id);
     $session->msg("s", "Bienvenido a sistema de inventario  ");
     redirect('seleccionar_sucursal.php',false);
    }else{
       $session->msg("d", "El usuario esta inactivo, contacte con el administrador");
    redirect('index.php',false);
    }

    
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}
?>