<?php
include("database.php");
$conn=new Database();
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de empleados</title>

	<!-- Bootstrap -->

	<link href="css/style_nav.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Datos del empleados &raquo; Perfil</h2>
			<hr />
			
			<?php
			$nik = $_GET["nik"];
			$num_rows=$conn->num_rows_ById($nik);
			if($num_rows->filas == 0){
				header("Location: index.php");
			}else{
				$res =$conn->single_record($nik);
				$empleado= $res;
			}
			if(isset($_GET['aksi']) == 'delete'){
				$delete=$conn->delete($nik);
				if($delete){
					echo '<div class="alert alert-info alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Datos eliminados con éxito..</div>';
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No se pudieron eliminar los datos.</div>';
				}
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">Código</th>
					<td><?php echo $empleado->codigo; ?></td>
				</tr>
				<tr>
					<th>Nombre del empleado</th>
					<td><?php echo $empleado->nombres; ?></td>
				</tr>
				<tr>
					<th>Lugar y Fecha de Nacimiento</th>
					<td><?php echo $empleado->lugar_nacimiento.', '.$empleado->fecha_nacimiento ; ?></td>
				</tr>
				<tr>
					<th>Dirección</th>
					<td><?php echo $empleado->direccion; ?></td>
				</tr>
				<tr>
					<th>Teléfono</th>
					<td><?php echo $empleado->telefono; ?></td>
				</tr>
				<tr>
					<th>Puesto</th>
					<td><?php echo $empleado->puesto; ?></td>
				</tr>
				<tr>
					<th>Estado</th>
					<td>
						<?php 
							if ($empleado->estado==1) {
								echo "Fijo";
							} else if ($empleado->estado==2){
								echo "Contratado";
							} else if ($empleado->estado==3){
								echo "Outsourcing";
							}
						?>
					</td>
				</tr>
				
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
			<a href="edit.php?nik=<?php  echo $empleado->codigo;; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos</a>
			<a href="profile.php?aksi=delete&nik=<?php echo $empleado->codigo; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos <?php echo $empleado->nombres; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>