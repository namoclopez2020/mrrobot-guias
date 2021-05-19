<?php 
if(isset($_POST['categoria'])){
	$categoria=$_POST['categoria'];
}else{
	$categoria="";
}
?>


<h3>Precio de compra</h3>
              <div class="form-group">
               <div class="row">
				   
				   
                 
                 <div class="col-md-4">
                   <div class="input-group">
					   
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="text" class="form-control" name="buying_price" placeholder="Precio de compra" required>
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
				   
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="text" class="form-control" name="sale_price" placeholder="Precio de Venta Unitario" required>
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
