<?php 
session_start();

if (isset($_SESSION["id"])){ 

header("Location: index.php");

}
require_once("clases.php");
require_once("top.php");
?>
	<link rel="stylesheet" href="js/jquery-ui-1.11.3.custom/jquery-ui.css">  
  <script src="js/jquery-ui-1.11.3.custom/jquery-ui.js"></script>
 
<script>
	function validarCampos(){
		var nombre = $('#nombre').val();
		var apellidos = $('#apellidos').val();
		var nacionalidad = $('#nacionalidad').val();
		var fechanacimiento = $('#datepicker').val();
		var email = $('#email').val();
		var contrasena = $('#contrasena').val();
		var error="";
	if(nombre==""){
		error += " -Nombre \n";
	}

	if(apellidos==""){
		error += " -Apellidos \n";
	}	
	
	if(nacionalidad==""){
		error += " -Nacionalidad \n";
	}
	if(fechanacimiento==""){
		error += " -Fecha de nacimiento \n";
		
	}
	if(sexo==""){
		error += " -Sexo \n";
		
	}
	if(contrasena==""){
		error += " -Password \n";
	}
	
	if(email==""){
		error += " -Email \n";
	}
	
	if(error !=""){

		alert("Compruebe que ha rellenado los siguientes campos: \n " + error);

	}else{
		formulario.submit();
	}
	}
	
	$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "1970:2015",
	  showAnim: "explode"
		});
	  });
	
</script>
	<div id="central">
		<h2><?php echo $util->trad("formulario_registro",$lang);?></h2>
		
		<form name="formulario" method="POST" action="do.php">
			<input type="hidden" name="op" value="registro">
			
			<div id="sidebar">
				<div >
					<label for="nombre"><?php echo $util->trad("nombre",$lang);?></label>
					<input type="text" name="nombre" id="nombre" value="" />
				</div><br>
				<div >
					<label for="apellidos"><?php echo $util->trad("apellidos",$lang);?></label>
					<input type="text" name="apellidos" id="apellidos" value="" />
				</div>
				<br>
				<div >
					<label for="nacionalidad"><?php echo $util->trad("nacionalidad",$lang);?></label>					
					<select name="nacionalidad" id="nacionalidad">
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
							<option value="<?php echo $nacionalidad?>"><?php echo $nacionalidad?></option>
						<?php }	?>
					
						
					</select>
				</div><br>
				<div >
					<label for="fechanacimiento"><?php echo $util->trad("nacimiento",$lang);?></label>
					<input type="text" name="fechanacimiento" id="datepicker" value="" />
				</div><br>
				<div >
					<label for="sexo"><?php echo $util->trad("sexo",$lang);?></label>
					<select name="sexo" id="sexo">
						<option value="F"><?php echo $util->trad("femenino",$lang);?></option>
						<option value="M"><?php echo $util->trad("masculino",$lang);?></option>
					</select>
				</div>
				<br>
				<div>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="" />
				</div><br>
				<div >
					<label for="contrasena"><?php echo $util->trad("contrasena",$lang);?></label>
					<input type="password" name="contrasena" id="contrasena" value="" />
				</div><br>
				<div >
					<label for="contrasena"><?php echo $util->trad("repetir ",$lang);?></label>
					<input type="password" name="contrasena2" id="contrasena2" value="" />
				</div><br>
				
				<input type="button" value="<?php echo $util->trad("registro",$lang);?>" onclick="validarCampos()" style="margin:15px;">
				
			</div>
		</form>
	</div>
	
<?php

require_once("bottom.php"); 

?>