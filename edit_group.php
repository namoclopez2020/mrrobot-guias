<?php
  $page_title = 'Editar Grupo';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('group.php');
  }
?>
<?php
  if(isset($_POST['update'])){

   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}',group_level='{$level}',group_status='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<head>
  <?php include ("./layouts/header.php");?>
    
  </head>
<body>
    
    <header>
    <?php include ("./layouts/nav.php");?>
  </header>
  <body> 
<div class ="container-fluid" style="padding-top: 60px;">
<div class="row">
  <div  id="resu" class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar nuevo grupo</span>
         </strong>
        </div>
      <!-- formulario general -->
      
        <div class="panel-body" id="padre">
         <div class="col-md-12">
          <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">
        <div class="form-group">
              <label for="name" class="control-label">Nombre del grupo</label>
              <input type="name" class="form-control" name="group-name" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
        </div>
        <div class="form-group">
              <label for="level" class="control-label">Nivel del grupo</label>
              <input type="number" class="form-control" name="group-level" value="<?php echo (int)$e_group['group_level']; ?>">
        </div>
        <div class="form-group">
          <label for="status">Estado</label>
              <select class="form-control" name="status">
                <option <?php if($e_group['group_status'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                
              </select>
        </div>
        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Actualizar</button>
        </div>
    </form>
         </div>
        </div>
      <!-- formulario de formulario -->
    
      
      
      </div>
    </div>
  </div>




<?php include_once('layouts/footer.php'); ?>
