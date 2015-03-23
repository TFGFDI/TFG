<?php
$util = new ClsUtil();
$url=$util->getPagina();

?>
<div id="buscador" class=" bloqueSombra bloqueRedondo">
	<div id="buscadorIzq">
		<form name="formulario" method="get" action="<?php echo $url?>" id="formulario">
			<div class="divCampo">
				<input type="text" name="buscador" value="<?php echo $buscador?>" class="input input_tamanhoGrande" id="buscador_input">
			</div>
			<div id="oculto" <?php if(($activo!="")||($nac!="")){?><?php }else{?> style="display:none; padding:10px"<?php }?>>
		
				<div class="bloque_campoForumulario">
					<label class="labelBuscador">Activos/Desactivos:</label>
					<select name="activo" id="activo" class="select_tamanhoPequenho_1" >
						<option value="" <?php if($activo==""){?>selected<?php }?>>Todos</option>
						<option value="1" <?php if($activo=="1"){?>selected<?php }?>>Activos</option>
						<option value="0" <?php if($activo=="0"){?>selected<?php }?>>Desactivo</option>
					</select>
				</div>
				<div class="bloque_campoForumulario divCampo"  style="margin-top:10px;" >
					<label class="labelBuscador">Nacionalidad:</label>
					<select name="nac" id="nac" class="select_tamanhoPequenho" >
						<option value="" <?php if($nac==""){?>selected<?php }?>>--Seleccione--</option>
						<?php 
							$util=new ClsUtil();
							$ar_nacionalidades= $util->getNacionalidades();
							foreach($ar_nacionalidades as $nacionalidad){ ?>
								<option value="<?php echo $nacionalidad?>" <?php if($nac==$nacionalidad){?>selected<?php }?>><?php echo $nacionalidad?></option>
							<?php }	?>
					</select>
				</div>

			</div>
		</form>
	</div>
	<div id="buscadorDch">
		<input type="button" name="buscar" value="Buscar" onclick="formulario.submit()" style="margin-right:10px;">
		<input type="button" name="limpiar" value="Limpiar" onclick="limpiar()" id="limpiar">
	</div>
	<div id="buscadorDch" style="margin-left:10px">
		<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
		<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
	</div>
	
</div>
