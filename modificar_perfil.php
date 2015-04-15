<?php 
session_start();

/*if (isset($_SESSION["id"])){ 

header("Location: index.php");

}*/
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
	

$( "#datepicker" ).blur(function() {
//$('#datepicker').removeClass('error');
alert("oli");
});

	
	

</script>
<?php
$alumno= new ClsUsuario();
$alumno->id = $_SESSION['id'];
$fila = $alumno->getUsuarioById();


?>
<h2><?php echo $util->trad("modificar_perfil",$lang);?></h2>
	<div id="central1" class="bloqueBordesAzul bloqueSombra bloqueRedondo" >
	<?php 
		if($_SESSION['rol']=='E'){
			require_once("menu_alumno.php");
		}else if($_SESSION['rol']=='P'){
			require_once("menu_profesor.php");
		}
		?>
		<br>
		
		<?php if(isset($dict['estado'])){?>
			<h3 class="perfil_modificado"><?php echo $util->trad("perfil_modificado",$lang);?></h3>
		<?php }?>
		<?php if(isset($dict['error'])){
			if($dict['error']=='no_coincide'){?>
			<h3 class="perfil_error"><?php echo $util->trad("actual_no_coincide",$lang);?></h3>
			<?php }?>
		<?php }?>
		<?php if(isset($dict['error'])){
			if($dict['error']=='noiguales'){?>
			<h3 class="perfil_error"><?php echo $util->trad("contrasena_no_coincide",$lang);?></h3>
			<?php }?>
		<?php }?>
		<form name="form_modificar" id="form_modificar" method="POST" action="do.php">
			<input type="hidden" name="op" value="modificar_perfil">
			
			<fieldset class="bloqueSombra bloqueRedondo">
			<legend class="bloqueRedondo">Datos Personales</legend>
				<div class="bloque_campoForumulario">
					<label for="nombre"><?php echo $util->trad("nombre",$lang);?></label>
					<input type="text" name="nombre" id="nombre" value="<?php echo $fila['nombre']?>" class="input input_tamanhoNormal" tabindex="1"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="apellidos"><?php echo $util->trad("apellidos",$lang);?></label>
					<input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['apellidos']?>"  class="input input_tamanhoNormal" tabindex="2"/>
				</div>
			
			
				<div class="bloque_campoForumulario">
					<label for="sexo"><?php echo $util->trad("sexo",$lang);?></label>
					<select name="sexo" id="sexo" class="select_tamanhoPequenho" tabindex="3">
						<option value="F" <?php if($fila['sexo']=='F'){?>selected<?php }?>><?php echo $util->trad("femenino",$lang);?></option>
						<option value="M" <?php if($fila['sexo']=='M'){?>selected<?php }?>><?php echo $util->trad("masculino",$lang);?></option>
					</select>
				</div>
				<div class="bloque_campoForumulario">
					<label for="fechanacimiento"><?php echo $util->trad("nacimiento",$lang);?></label>
					<input type="text" name="fechanacimiento" id="datepicker" value="<?php echo $fila['fechanacimiento']?>" class="input_tamanhoPequenho" tabindex="4"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="telefono"><?php echo $util->trad("telefono",$lang);?></label>
					<input type="text" name="telefono" id="telefono" value="<?php echo $fila['telefono']?>"  class="input_tamanhoMediano" tabindex="5"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="direccion"><?php echo $util->trad("direccion",$lang);?></label>
					<input type="text" name="direccion" id="direccion" value="<?php echo $fila['direccion']?>"  class="input_tamanhoMediano" tabindex="5"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="cp"><?php echo $util->trad("cp",$lang);?></label>
					<input type="text" name="cp" id="cp" value="<?php echo $fila['cp']?>"  class="input_tamanhoPequenho" tabindex="6"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="ciudad"><?php echo $util->trad("ciudad",$lang);?></label>
					<input type="text" name="ciudad" id="ciudad" value="<?php echo $fila['ciudad']?>"  class="input_tamanhoNormal" tabindex="7"/>
				</div>
				<div class="bloque_campoForumulario">
					
					<label for="nacionalidad"><?php echo $util->trad("nacionalidad",$lang);?></label>					
					<select name="nacionalidad" id="nacionalidad" class="select_tamanhoMediano" tabindex="8">
						<option value="" selected></option>
					<?php 
						$util=new ClsUtil();
						$ar_nacionalidades= $util->getNacionalidades();
						foreach($ar_nacionalidades as $nacionalidad){ ?>
						
							<option value="<?php echo $nacionalidad?>" <?php if($nacionalidad==$fila['nacionalidad']){?>selected<?php }?>><?php echo $nacionalidad?></option>
						<?php }	?>
					
						
					</select>
				</div>
				<div class="bloque_campoForumulario">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?php echo $fila['email']?>" class="input_tamanhoNormal" tabindex="9"/>
				</div>

				<div class="bloque_campoForumulario">
					<label for="contrasena antigua"><?php echo $util->trad("contrasena_actual",$lang);?></label>
					<input type="password" name="contrasena_antigua" id="contrasena_antigua"   value=""  class="input_tamanhoNormal" tabindex="10" />
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena nueva"><?php echo $util->trad("contrasena_nueva ",$lang);?></label>
					<input type="password" name="contrasena" id="contrasena" value="" class="input_tamanhoNormal" tabindex="11"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena nueva2"><?php echo $util->trad("confirmar_contrasena_nueva ",$lang);?></label>
					<input type="password" name="contrasena2" id="contrasena2" value="" class="input_tamanhoNormal" tabindex="12"/>
				</div>
			
			</fieldset>
		
			
			<div class="divBoton" >
				<!-- <input type="button" name="b_registro" value="<?php // echo $util->trad("registro",$lang);?>" onclick="validarCampos()" style="margin:15px;"> -->
				<input type="submit" name="b_registro" value="<?php echo $util->trad("modificar",$lang);?>" style="margin:15px;">
			</div>
		</form>
		
	</div>
	
<?php

require_once("bottom.php"); 

?>