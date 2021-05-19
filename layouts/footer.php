
      
    

<!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!--datepicker-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

  <!--librerias de autocomplete -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="./js/jquery-ui.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="datatables/datatables.min.js"></script>    
<script type="text/javascript" src="datatables/main.js"></script>  

    

   
<script language="javascript">
	
	$('.datepicker')
        .datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true
        });
	
function calcular() { 

var revision = parseFloat(document.datos.revision.value); 
var costo =parseFloat(document.datos.costo.value); 
var repuesto=parseFloat(document.datos.repuesto.value);
var adelanto=parseFloat(document.datos.adelanto.value);
	var subtotal= revision+costo+repuesto;
var saldo= subtotal-adelanto;
document.datos.total.value=(subtotal).toFixed(0); 
document.datos.saldo.value=(saldo).toFixed(0);

}
	

</script>