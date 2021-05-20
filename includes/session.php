<?php
 session_start();

class Session {

 public $msg;
 private $user_is_logged_in = false;

 function __construct(){
   $this->flash_msg();
   $this->userLoginSetup();
 }

  public function isUserLoggedIn(){
    return $this->user_is_logged_in;
  }
  public function login($user_id){
    $_SESSION['user_id'] = $user_id;
  }
  function elegir_sucursal ($id_sucursal){

    $db = new  MySqli_DB();
    $consulta="SELECT * FROM sucursales WHERE id=$id_sucursal";
    $query=$db->query($consulta);
    while($data=$db->fetch_array($query)){
      $_SESSION['id_sucursal']=$data['id'];
      $_SESSION['nombre_sucursal']=$data['nombre_sucursal'];
      $_SESSION['telefono_sucursal']=$data['telefono_sucursal'];
      $_SESSION['ruc_sucursal']=$data['RUC_SUCURSAL'];
      $_SESSION['ruta_imagen']=$data['image_path'];
      $_SESSION['direccion_sucursal']=$data['direccion_sucursal'];
      $_SESSION['wsp_sucursal']="";
      $_SESSION['email_sucursal']=$data['email'];
    }

  }


 
  private function userLoginSetup()
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_is_logged_in = true;
    } else {
      $this->user_is_logged_in = false;
    }

  }
  public function logout(){
    unset($_SESSION['user_id']);
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}

$session = new Session();
$msg = $session->msg();

?>
