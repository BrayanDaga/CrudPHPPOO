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
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">

	<link href="css/style_nav.css" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="index.php">Inicio</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav ">
					<li class="active"><a href="index.php">Lista de empleados</a></li>
					<li><a href="add.php">Agregar datos</a></li>
				</ul>
			</div><!--/.nav-collapse -->
	</div>	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de empleados</h2>
			<hr />

			
			<form class="form-inline" method="get">
				<div class="form-group">
<!-------------------Este es el filtro ------------------------------->			
<!---Esto es un formulario mandara get y refrescara la pagina con el value de filtro ejemplo filter=1--->
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filtros de datos de empleados</option>
<!---Si se envio dato mediante metodo get lo almaceno en $filter si no envio guardar un dato null--->
			
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Tetap'){ echo 'selected'; } ?>>Fijo</option>
						<option value="2" <?php if($filter == 'Kontrak'){ echo 'selected'; } ?>>Contratado</option>
                        <option value="3" <?php if($filter == 'Outsourcing'){ echo 'selected'; } ?>>Outsourcing</option>
					</select>
			
				</div>
<!---------------------------------------------------------->
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>Código</th>
					<th>Nombre</th>
                    <th>Lugar de nacimiento</th>
                    <th>Fecha de nacimiento</th>
                    <th>Direccion</th>
					<th>Teléfono</th>
					<th>Cargo</th>
					<th>Estado</th>
                    <th>Acciones</th>
				</tr>
				
						
		<?php 
			if($filter){
				//Si recibio  get invocar al metodo filtro
				 $reg=$conn->filter($filter);;
				}
				else{
					//si no recibio invocar listar
					$reg=$conn->read();
				}

				$res=$conn->num_rows();
				$filas=$res->filas;
				if($filas==0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}
				else{
					echo "Numero de registros : ".$filas;
				}	
				$no=0;
				//Hacer el recorrida de los valores obtenidods del $reg bien filtro o bien el listado
					foreach ($reg->fetchAll(PDO::FETCH_OBJ) as $row) {
						$codigo=$row->codigo;
						$nombres=$row->nombres;
						$lugar_nacimiento=$row->lugar_nacimiento;
						$fecha_nacimiento=$row->fecha_nacimiento;
						$direccion=$row->direccion;
						$telefono=$row->telefono;
						$puesto=$row->puesto;
						$estado=$row->estado;
						$no++;
						echo '<tr>
								<td>'.$no.'</td>
								<td>'.$codigo.'</td>
								<td><a href="profile.php?nik='.$codigo.'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$nombres.'</a></td>
								<td>'.$lugar_nacimiento.'</td>
								<td>'.$fecha_nacimiento.'</td>
								<td>'.$direccion.'</td>
								<td>'.$telefono.'</td>
								<td>'.$puesto.'</td>
								<td>';
									switch ($estado) {
										case '1': echo '<span class="label label-success">Fijo</span>';	break;
										case '2': echo '<span class="label label-info">Contratado</span>';	break;
										case '3': echo '<span class="label label-warning">Outsourcing</span>';	break;
									}
								echo '</td>
								<td>
									<a href="edit.php?nik='.$codigo.'" title="Editar datos" class="btn btn-primary btn-sm">Editar</a>
								</td>
							  </tr>';
					} 				
		?>

			</table>
			</div>
		</div>
	</div>
	<center>
	<p>&copy; Pie de Pagina</p>
	</center>
		 <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>