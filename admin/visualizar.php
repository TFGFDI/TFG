<?php 
session_start();
include_once("../modelos/clsUsuario.php");
if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}

function getRequest() {

		global $_GET,$_POST;
		$dict=$_GET;
		if (count($dict)==0) $dict = $_POST;
		return $dict;

	}


$dict = getRequest();
$lang='es';

$usuario= new clsUsuario();
$usuario->estableceCampos($dict);
$user = $usuario->getUsuarioById();

?>
<script type="text/javascript"  src="../js/jquery-1.8.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen" />
<link rel="stylesheet" href="../css/formulario.css" type="text/css" media="screen"/>
<div class="visualizar">
			
			<table class="ver">

					<tr>

						<td class="sub">Nombre</b></td>

						<td><input type="text" name="nombre" id="nombre" value="<?php echo $user['nombre']?>" readonly style="width:100%;border:none">

						</td>

						

					</tr>

					<tr>

						<td class="sub">Apellidos</b></td>

						<td><input type="text" name="apellidos" id="apellidos" value="<?php echo $user['apellidos']?>" readonly style="width:100%;border:none">

						</td>

						

					</tr>
					<tr>

						<td class="sub">Sexo</td>

						<td><input type="text" name="sexo" id="sexo" value="<?php echo $user['sexo']?>" readonly style="width:100%;border:none">

						</td>					

					</tr>

					<tr>

						<td class="sub">Fecha de Nacimiento</td>

						<td style="width:650px">

						<input type="text" name="fechanacimiento" id="fechanacimiento" value="<?php echo $user['fechanacimiento']?>" readonly style="width:100%;border:none">

						</td>

					</tr>	
					<tr>

						<td class="sub">Email</td>

						<td style="width:650px">

						<a href="mailto:<?php echo $user['email']?>"><?php echo $user['email']?></a>

						</td>

					</tr>	
					<tr>

						<td class="sub">Nacionalidad</td>

						<td>

							<input type="text" name="nacionalidad" id="nacionalidad" value="<?php echo $user['nacionalidad']?>" readonly style="width:100%;border:none" style="width:100%;border:none">

						</td>						

					</tr>
					<tr>

						<td class="sub">Contrase&ntilde;a</td>

						<td>

							<input type="text" name="contrasena" id="contrasena" value="<?php echo $user['contrasena']?>" readonly style="width:100%;border:none" style="width:100%;border:none">

						</td>						

					</tr>

					
				</table>
	
			
		</div>