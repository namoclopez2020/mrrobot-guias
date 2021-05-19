	<?php
		require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  //$products = join_product_table();
	?>	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg "  id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
			  <div class="modal-dialog modal-lg" role="document">
				 <div class="modal-content" style="background-color:transparent;">
				  <div class="modal-header">
				<form id="form-cliente" method="POST">
					<table class="form-cliente1"  >
						<tr><td colspan="2" rowspan="7">
							<img src="libs/images/usuario.png" class="imagen-taco10">
							</td>
						</tr>
						<tr>
							<td class="celda">Nombre: </td>
							<td class="celda">
							<input type="text" name="name" id="name" class ="textbox2" required>
						   </td>
						</tr>
						
						<tr>
							<td class="celda">Telefono:</td>
							<td class="celda"><input type="text" name="tlf" id="tlf" class ="textbox2" ></td>
						</tr>
						<tr>
							<td class="celda">DNI o RUC: </td>
							<td class="celda"><input type="text" name="dni_a" id="dni_a"  class ="textbox2" ></td>
						</tr>
						<tr>
						<td class="celda">Direccion: </td>
						<td class="celda"><input type="text" name="address" id="address" class ="textbox2" ></td>
						</tr>
						<tr>
							<td class="celda">Email: </td>
							<td class="celda"><input type="text" name="email_cliente" id="email_cliente" class ="textbox2" ></td>
						</tr>
						<tr>
							<td class="celda"><button type="submit" name="guardar_cliente" id="guardar_cliente" class="btn-success">Guardar Datos</button> </td>
						</tr>
						
				</table>
		</form>
					 
			  </div>
			</div>
		</div>
	</div>
	<?php
		
	?>