<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("clases.php"); 
require_once("top.php"); 

if (isset($dict['buscador'])){
	$buscador=$dict['buscador'];
}else{
	$buscador="";
}
if (isset($dict['filtro'])){
	$filtro = $dict['filtro'];
}else{
	$filtro="";
}

if (isset($dict['activo'])){
	$activo=$dict['activo'];
}else{
	$activo="";
}

if (isset($dict['nac'])){
	$nac=$dict['nac'];
}else{
	$nac="";
}



if (isset($dict['orden'])){
	$orden = $dict['orden'];
}else{
	$orden="";
}
?>

	
	<h2>Gestion de profesores</h2>
	
<div id="central1" class="bloqueBordesAzul_1 bloqueSombra bloqueRedondo" >
<?php require_once("menu_profesor.php");  ?>
	<section id="izquierdo_general" class="bloqueRedondo">
	    <article id="caja0" class="caja" >
                	<div class="caja_titulo">
		                <p>Cuenta Usuario</p>
                    </div>
                    <div class="caja_contenido"  >
		                <ul>
                            <li><a href="./consultaCuentaUsuario.php"  title="Inicio">Modificar Cuenta</a></li>
                        </ul>
                    </div>
                </article>
		
		
	</section>
	
	<section id="derecho_general" class=" bloqueRedondeado">
        <div class="datagrid" style="width:auto;">
			<table>
				<thead>
					<tr>
						<th onclick="orden('nombre','<?php echo $orden?>');" style="cursor:pointer"><span>Nombre</span>
							<?php 
								if($filtro=="nombre"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('apellidos','<?php echo $orden?>');" style="cursor:pointer"><span>Apellidos</span>
							<?php 
								if($filtro=="apellidos"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('email','<?php echo $orden?>');" style="cursor:pointer"><span>Email</span>
							<?php 
								if($filtro=="email"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>
						<th onclick="orden('nacionalidad','<?php echo $orden?>');" style="cursor:pointer"><span>Nacionalidad</span>
							<?php 
								if($filtro=="nacionalidad"){
									if($orden=="DESC"){ ?>
										<img src="../imagenes/flecha-abajo.png">
									<?php }else if($orden=="ASC"){ ?>
										<img src="../imagenes/flecha-arriba.png">
									<?php }
								}
							?>
						</th>	
						
					</tr>
				</thead>
				<tbody>
				<?php
					$usuario= new clsUsuario();					
					
					//$filas = $usuario->getProfesores($buscador,$activo,$nac,$filtro,$orden);
					$filasTot = $usuario->getProfesores($buscador,$activo,$nac,$filtro,$orden);
					
					$totEmp = mysqli_num_rows($filasTot);
					$pag = isset($dict['pag']) ? $dict['pag'] : 1;				
					$numer_reg = 11; 
					$totalPag = ceil($totEmp / $numer_reg);				
					$itemsInicio = $numer_reg * ($pag - 1);
					$filasPag = $usuario->getProfesoresPaginacion($buscador,$activo,$nac,$filtro,$orden,$itemsInicio,$numer_reg);
					
					$total=mysqli_num_rows($filasTot);
					
				
					$i=0;//Saber si es una fila par o impar para estilos
					while ($rowEmp = mysqli_fetch_assoc($filasPag)) { 
				?>
					<tr <?php if($i%2==0){?>class="alt"<?php }else{?>class="impar"<?php }?> >
						<td><a class="ifancybox" href="visualizar.php?id=<?php echo $rowEmp['id']?>"><?php echo $rowEmp['nombre']?></a></td>
						<td><?php echo $rowEmp["apellidos"]?></td>
						<td><?php echo $rowEmp["email"]?></td>
						<td><?php echo $rowEmp["nacionalidad"]?></td>
						
					</tr>
					<?php 
					$i++;
					}?>
				</tbody>
				
				<?php require_once("paginador.php"); ?>
			</table>
		</div> 
    </section>
	
</div>
	
	
<?php

require_once("bottom.php"); 

?>