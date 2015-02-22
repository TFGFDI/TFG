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
<form name="buscador" method="get" action="index.php">
	<input type="text" name="buscador" value="<?php echo $filtro?>">
	
</form>


<input type="button" name="buscar" value="Buscar" onclick="buscador.submit()">
	<div id="central">Gestion de alumnos
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