<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}

require_once("top.php"); 
$lang='es';

if($dict['menu']==1){
	$tipoUser="E";
}
if($dict['menu']==2){
	$tipoUser="P";
}

?>

<script>
$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "1970:2015",
	  showAnim: "explode"
		});
	  });
	
</script>
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_admin.php");  ?>
	<h2>Gestion de <?php if($tipoUser=="E"){echo "Alumno";}else{ echo "Profesor";}?></h2>
	

	<div id="divMenu_Vertical" class="bloqueRedondo_2 ">
		<ul class="menuVertical ">
			<li  style="border-top-left-radius: 0.5em;"><a href="<?php echo $dict['page'].".php?menu=".$dict['menu']; ?>" >Consulta</a></li>
			<li class="activo" style="border-bottom-left-radius: 0.5em;"><a href="./nuevo.php" >Alta</a></li>
			<li class="noMenu ">&nbsp;asd</li> 
		</ul>
	</div>
	<form name="form_nuevo" id="form_nuevo" method="POST" action="../do.php">
	<input type="hidden" name="op" value="altaUsuario">
	<div id="contenidoBuscador" >
	<div class="subtitulo">Alta <?php if($tipoUser=="E"){echo "Alumno";}else{ echo "Profesor";}?></div>
		<div id="formIzquierdo">
			<div class="bloque_campoForumulario">
				<label class="labelPequenho" for="email">Email</label>
				<input type="text" name="email" id="email" value="" class="input_tamanhoNormal" tabindex="1"/>
			</div>
			<div class="bloque_campoForumulario">
				<label class="labelPequenho" for="nombre"><?php echo $util->trad("nombre",$lang);?></label>
				<input type="text" name="nombre" id="nombre" value="" value="" class="input input_tamanhoNormal" tabindex="2"/>
			</div>
			
			<div class="bloque_campoForumulario">
				<label class="labelPequenho" for="sexo"><?php echo $util->trad("sexo",$lang);?></label>
				<select name="sexo" id="sexo" class="select_tamanhoPequenho" tabindex="4">
					<option value="" selected></option>
					<option value="F"><?php echo $util->trad("femenino",$lang);?></option>
					<option value="M"><?php echo $util->trad("masculino",$lang);?></option>
				</select>
			</div>
			<div class="bloque_campoForumulario">
				<label class="labelPequenho" for="telefono"><?php echo $util->trad("telefono",$lang);?></label>
				<input type="text" name="telefono" id="telefono" value=""  class="input_tamanhoMediano" tabindex="6"/>
			</div>
			<div class="bloque_campoForumulario">
				<label class="labelPequenho" for="ciudad"><?php echo $util->trad("ciudad",$lang);?></label>
				<input type="text" name="ciudad" id="ciudad" value=""  class="input_tamanhoNormal" tabindex="8"/>
			</div>
		</div>
		<div id="formDerecho">
			<div class="bloque_campoForumulario">
				<label  for="rol">tipo Usuario<?php echo $util->trad("tipo Usurio",$lang);?></label>
				<input type="text" name="rol" id="rol" value="<?php echo $tipoUser?>" readonly class="input input_tamanhoPequenho consulta" />
			</div>
			<div class="bloque_campoForumulario">
				<label for="apellidos"><?php echo $util->trad("apellidos",$lang);?></label>
				<input type="text" name="apellidos" id="apellidos" value=""  class="input input_tamanhoNormal" tabindex="3"/>
			</div>
			<div class="bloque_campoForumulario">
				<label for="fechanacimiento"><?php echo $util->trad("nacimiento",$lang);?></label>
				<input type="text" name="fechanacimiento" id="datepicker" value="" class="input_tamanhoPequenho" tabindex="5"/>
			</div>
			<div class="bloque_campoForumulario">
				<label for="cp"><?php echo $util->trad("cp",$lang);?></label>
				<input type="text" name="cp" id="cp" value=""  class="input_tamanhoPequenho" tabindex="7"/>
			</div>
			<div class="bloque_campoForumulario">
				<label for="nacionalidad"><?php echo $util->trad("nacionalidad",$lang);?></label>					
				<select name="nacionalidad" id="nacionalidad" class="select_tamanhoMediano" tabindex="9">
					<option value="" selected></option>
				<?php 
					$util=new ClsUtil();
					$ar_nacionalidades= $util->getNacionalidades();
					foreach($ar_nacionalidades as $nacionalidad){ ?>
					
						<option value="<?php echo $nacionalidad?>"><?php echo $nacionalidad?></option>
					<?php }	?>
	
				</select>
			</div>
		</div>
		
	</div>
	
	<div id="contenido1" style="padding-top:50px;">
			<div class="divBoton" >
				<input type="submit" name="b_registro" value="<?php echo $util->trad("registro",$lang);?>" style="margin:15px;">
			</div>
	</div>		
		
	</form>	
	
</div>

<?php

require_once("bottom.php"); 

?>