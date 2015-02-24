<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 

?>
<?php require_once("menu_admin.php"); 
if (isset($dict['buscador'])){
	$filtro=$dict['buscador'];
}else{
	$filtro="";
}
?>
<script>
	function eliminar(){
		$('#buscador_input').val('');
		$("#buscador").submit();
	}
	
</script>

<h2>Gestion de alumnos</h2>
		<div style="margin-left:19.5%">
			<div style="float:left">
				<form name="buscador" method="get" action="index.php" id="buscador">
					<input type="text" name="buscador" value="<?php echo $filtro?>" class="buscador" id="buscador_input">
				
				</form>
			</div>
			<div style="float:left">
				<input type="button" name="buscar" value="Buscar" onclick="buscador.submit()">
			</div>
			<div style="float:left;margin-left:10px;">
				<input type="button" name="limpiar" value="Limpiar" onclick="eliminar()" id="limpiar">
			</div>
			<div style="float:right;margin-right:24%;">
				<input type="button" name="nuevo" value="Nuevo" onclick="alert('aa')">
			</div>
			</div>
			<br><br>
	<div id="central">
		
		
		<div class="datagrid">
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Nacionalidad</th>	
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$usuario= new clsUsuario();					
					$filas = $usuario->getEstudiantes($filtro);
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filas)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><?php echo $rowEmp["nombre"]?></td>
						<td><?php echo $rowEmp["apellidos"]?></td>
						<td><?php echo $rowEmp["email"]?></td>
						<td><?php echo $rowEmp["nacionalidad"]?></td>
						<td></td>
						<td></td>
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
			</table>
		</div>
	</div>
<?php

require_once("bottom.php"); 

?>