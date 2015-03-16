
<div id="buscador" class=" bloqueSombra bloqueRedondo">
	<div id="buscadorIzq">
		<form name="buscador" method="get" action="alumnos.php" id="buscador">
			<div class="divCampo">
				<input type="text" name="campo_b" value="<?php echo $buscador?>" class="input input_tamanhoGrande" >
			</div>
			<div id="oculto" style="display:none; padding:10px">
		
				<div class="bloque_campoForumulario">
					<label class="labelBuscador">Activos/Desactivos:</label>
					<select name="activo_b" id="activo_b" class="select_tamanhoPequenho_1" >
						<option value="0" selected>Activos & Desactivos</option>
						<option value="1">Activos</option>
						<option value="2">Desactivo</option>
					</select>
				</div>
				<div class="bloque_campoForumulario divCampo"  style="margin-top:10px;" >
					<label class="labelBuscador">Nacionalidad:</label>
					<select name="nacionalidad_b" id="activo_b" class="select_tamanhoPequenho" >
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
		<input type="button" name="buscar" value="Buscar" onclick="buscador.submit()" style="margin-right:10px;">
		<input type="button" name="limpiar" value="Limpiar" onclick="eliminar()" id="limpiar">
	</div>
	<div id="buscadorDch" style="margin-left:10px">
		<span class="avanzada" id="avanzada" onclick="mostrar();">B&uacute;squeda avanzada</span>
		<span class="avanzada" id="simple" onclick="mostrar();" style="display:none;">[X]</span>
	</div>
	
</div>
