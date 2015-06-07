
<?php
include_once("./clases.php");
session_start();
$usuario= new ClsUsuario();
$util=new ClsUtil();
$usuario->id = $_SESSION['id'];
$fila = $usuario->getUsuarioById();

if(isset($dict['lang'])){
	$lang=$dict['lang'];
	$_SESSION['lang']=$lang;
}else if (isset($_SESSION['lang'])){
	$lang=$_SESSION['lang'];
}else{
	$lang='es';
}

?>
<script>
	$(document).ready(function() {
		 
		$( "#datepicker" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  yearRange: "1970:2015",
		  showAnim: "explode"
		});

		$("#b_cancelarRegistro").click(function(evento){ 
			$("#cuenta").removeClass();
			$("#destino").empty();
					
	   });


	});
	
	

</script>

<section id="derecho_general" class="bloqueRedondo bloqueSombra">

        <form name="form_modificar" id="form_modificar" method="POST" action="./do.php">
			<input type="hidden" name="op" value="modificar_perfil">
			
			<fieldset class="bloqueSombra bloqueRedondo" style="width:630px;">
			<legend class="bloqueRedondo"><?php echo $util->trad("datos_personales",$lang);?></legend>
				<div class="bloque_campoForumulario">
					<label for="nombre"><?php echo $util->trad("nombre",$lang);?>:</label>
					<input type="text" name="nombre" id="nombre" value="<?php echo $fila['nombre']?>" class="input input_tamanhoMediano" tabindex="1"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="apellidos"><?php echo $util->trad("apellidos",$lang);?></label>
					<input type="text" name="apellidos" id="apellidos" value="<?php echo $fila['apellidos']?>"  class="input input_tamanhoNormal" tabindex="2"/>
				</div>
			
			
				<div class="bloque_campoForumulario">
					<label for="sexo"><?php echo $util->trad("sexo",$lang);?>:</label>
					<select name="sexo" id="sexo" class="select_tamanhoPequenho" tabindex="3">
						<option value="F" <?php if($fila['sexo']=='F'){?>selected<?php }?>>Femenino</option>
						<option value="M" <?php if($fila['sexo']=='M'){?>selected<?php }?>>Masculino</option>
					</select>
				</div>
				<div class="bloque_campoForumulario">
					<label for="fechanacimiento"><?php echo $util->trad("nacimiento",$lang);?>:</label>
					<input type="text" name="fechanacimiento" id="datepicker" value="<?php echo $fila['fechanacimiento']?>" class="input_tamanhoPequenho" tabindex="4"/>
				</div><br>
				<div class="bloque_campoForumulario">
					<label for="telefono"><?php echo $util->trad("telefono",$lang);?>:</label>
					<input type="text" name="telefono" id="telefono" value="<?php echo $fila['telefono']?>"  class="input_tamanhoPequenho" tabindex="5"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="direccion"><?php echo $util->trad("direccion",$lang);?>:</label>
					<input type="text" name="direccion"  value="<?php echo $fila['direccion']?>"  class="input_tamanhoNormal" tabindex="6"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="cp"><?php echo $util->trad("cp",$lang);?>:</label>
					<input type="text" name="cp" id="cp" value="<?php echo $fila['cp']?>"  class="input_tamanhoPequenho" tabindex="7"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="ciudad"><?php echo $util->trad("ciudad",$lang);?>:</label>
					<input type="text" name="ciudad" id="ciudad" value="<?php echo $fila['ciudad']?>"  class="input_tamanhoMediano" tabindex="8"/>
				</div>
				<div class="bloque_campoForumulario">
					
					<label for="nacionalidad"><?php echo $util->trad("pais",$lang);?>:</label>					
					<select name="nacionalidad" id="nacionalidad" class="select_tamanhoPequenho" tabindex="9">
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
					<label for="email"><?php echo $util->trad("email",$lang);?></label>
					<input type="text" name="email" id="email" value="<?php echo $fila['email']?>" class="input_tamanhoNormal" tabindex="10"/>
				</div>
				<br>
				<div class="bloque_campoForumulario">
					<label for="contrasena antigua"><?php echo $util->trad("contrasena_actual",$lang);?>:</label>
					<input type="password" name="contrasena_antigua" id="contrasena_antigua"   value=""  class="input_tamanhoMediano" tabindex="11" />
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena nueva"><?php echo $util->trad("contrasena_nueva",$lang);?>:</label>
					<input type="password" name="contrasena" id="contrasena" value="" class="input_tamanhoMediano" tabindex="12"/>
				</div>
				<div class="bloque_campoForumulario">
					<label for="contrasena nueva2"><?php echo $util->trad("confirmar_contrasena_actual",$lang);?>:</label>
					<input type="password" name="contrasena2" id="contrasena2" value="" class="input_tamanhoMediano" tabindex="13"/>
				</div>
			
			</fieldset>
		
			
			<div class="divBoton" >
				<!-- <input type="button" name="b_registro" value="<?php // echo $util->trad("registro",$lang);?>" onclick="validarCampos()" style="margin:15px;"> -->
				<input type="submit" name="b_registro" value="Modificar" style="margin:15px;">
				<input type="button" id="b_cancelarRegistro" name="b_cancelarRegistro"  value="Cancelar" style="margin:15px;">
			
				<?php if(isset($dict['estado'])){?>
					<h3 class="perfil_modificado">Perfil Modificado Correctamente</h3>
				<?php }?>
				<?php if(isset($dict['error'])){
					if($dict['error']=='no_coincide'){?>
					<h3 class="perfil_error">Contrase&ntilde;a actual no coincide</h3>
					<?php }?>
				<?php }?>
				<?php if(isset($dict['error'])){
					if($dict['error']=='noiguales'){?>
					<h3 class="perfil_error">Las contrase&ntilde;as nuevas no coinciden</h3>
					<?php }?>
				<?php }?>
			</div>
		
		</form>
</section>


			