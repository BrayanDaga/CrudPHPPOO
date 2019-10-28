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

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
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
			<h2>Datos del empleados &raquo; Editar datos</h2>
			<hr />
			
			<?php
			$nik = $_GET["nik"];
			$num_rows=$conn->num_rows_ById($nik);
			if($num_rows->filas== 0){
				header("Location: index.php");
			}else{
				$res=$conn->single_record($nik);
				$empleado=$res;
			}
			if(isset($_POST['save'])){
				$codigo		     	= $_POST["codigo"];
				$nombres		     = $_POST["nombres"];
				$lugar_nacimiento	 = $_POST["lugar_nacimiento"];
				$fecha_nacimiento	 =$_POST["fecha_nacimiento"] ;
				$direccion	    	 = $_POST["direccion"];
				$telefono			 =$_POST["telefono"];
				$puesto				 = $_POST["puesto"];
				$estado			 	=$_POST["estado"];  
				
				$update = $conn->update($codigo,$nombres,$lugar_nacimiento,$fecha_nacimiento,$direccion,$telefono,$puesto,$estado,$nik);
				if($update){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Código</label>
					<div class="col-sm-2">
						<input type="text" name="codigo" value="<?php echo $empleado->codigo; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombres" value="<?php echo $empleado->nombres; ?>" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Lugar de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="lugar_nacimiento" value="<?php echo $empleado->lugar_nacimiento; ?>" class="form-control" placeholder="Lugar de nacimiento" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Fecha de nacimiento</label>
					<div class="col-sm-4">
						<input type="text" name="fecha_nacimiento" value="<?php echo $empleado->fecha_nacimiento; ?>" class="input-group date form-control" date="" data-date-format="yyyy-mm-dd" placeholder="0000-00-00" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-3">
						<textarea name="direccion" class="form-control" placeholder="Dirección"><?php echo $empleado->direccion; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-3">
						<input type="text" name="telefono" value="<?php echo $empleado->telefono; ?>" class="form-control" placeholder="Teléfono" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Puesto</label>
					<div class="col-sm-3">
						
						<input type="text" name="puesto" value="<?php echo $empleado->puesto; ?>" class="form-control" placeholder="Puesto" required>
					</div>
                    
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Estado</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value="" selected="" disabled="">- Selecciona estado -</option>
                            <option value="1" <?php if ($empleado->estado==1){echo "selected";} ?>>Fijo</option>
							<option value="2" <?php if ($empleado->estado==2){echo "selected";} ?>>Contratado</option>
							<option value="3" <?php if ($empleado->estado==3){echo "selected";} ?>>Outsourcing</option>

						</select> 
					</div>
                   
                </div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>