<?php 
session_start();

if (isset($_SESSION["id"])){ 

header("Location: index.php");

}
require_once("clases.php");
require_once("top.php");
?>
  
 
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
	<div id="central" class="bloqueBordesAzul bloqueSombra bloqueRedondo" >
		<h2><?php echo $util->trad("formulario_registro",$lang);?></h2>
		
		<form name="formulario" method="POST" action="do.php">
			<input type="hidden" name="op" value="registro">
			
			<fieldset class="bloqueSombra bloqueRedondo">
			<legend class="bloqueRedondo">Datos Personales</legend>
				<div class="bloque_campoForumulario">
					<label for="nombre"><?php echo $util->trad("nombre",$lang);?></label>
					<input type="text" name="nombre" id="nombre" value="" value="" class="input_tamanhoNormal" />
				</div>
				<div class="bloque_campoForumulario">
					<label for="apellidos"><?php echo $util->trad("apellidos",$lang);?></label>
					<input type="text" name="apellidos" id="apellidos" value=""  class="input_tamanhoNormal"/>
				</div>
			
			
				<div class="bloque_campoForumulario">
					<label for="sexo"><?php echo $util->trad("sexo",$lang);?></label>
					<select name="sexo" id="sexo" class="select_tamanhoPequenho">
						<option value="F"><?php echo $util->trad("femenino",$lang);?></option>
						<option value="M"><?php echo $util->trad("masculino",$lang);?></option>
					</select>
				</div>
				<div class="bloque_campoForumulario">
					<label for="fechanacimiento"><?php echo $util->trad("nacimiento",$lang);?></label>
					<input type="text" name="fechanacimiento" id="datepicker" value="" class="input_tamanhoPequenho" />
				</div>
				<div class="bloque_campoForumulario">
					<label for="telefono"><?php echo $util->trad("telefono",$lang);?></label>
					<input type="text" name="telefono" id="telefono" value=""  class="input_tamanhoMediano"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="cp"><?php echo $util->trad("cp",$lang);?></label>
					<input type="text" name="cp" id="cp" value=""  class="input_tamanhoNormal"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="ciudad"><?php echo $util->trad("ciudad",$lang);?></label>
					<input type="text" name="ciudad" id="ciudad" value=""  class="input_tamanhoNormal"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="nacionalidad"><?php echo $util->trad("nacionalidad",$lang);?></label>					
					<select name="nacionalidad" id="nacionalidad" class="select_tamanhoMediano">
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
							<option value="<?php echo $nacionalidad?>"><?php echo $nacionalidad?></option>
						<?php }	?>
					
						
					</select>
				</div>
			
			
			</fieldset>
			<fieldset class="bloqueSombra bloqueRedondo" style="height:140px">
			<legend class="bloqueRedondo">Datos Acceso</legend>
				<div class="bloque_campoForumulario">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="" class="input_tamanhoNormal"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena"><?php echo $util->trad("contrasena",$lang);?></label>
					<input type="password" name="contrasena" id="contrasena" value="" class="input_tamanhoNormal"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena"><?php echo $util->trad("repetir ",$lang);?></label>
					<input type="password" name="contrasena2" id="contrasena2" value="" class="input_tamanhoNormal"/>
				</div>
			</fieldset	>
			<div class="divBoton" >
				<input type="button" value="<?php echo $util->trad("registro",$lang);?>" onclick="validarCampos()" style="margin:15px;">
			</div>
		</form>
		
	</div>
	
<?php

require_once("bottom.php"); 

?>