<?php 
require_once "../modelos/Estado.php";

$estado=new Estado();

$txtidestado=isset($_POST["txtidestado"])? limpiarCadena($_POST["txtidestado"]):"";
$txtestado=isset($_POST["txtestado"])? limpiarCadena($_POST["txtestado"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($txtidestado)){
			$rspta=$estado->insertar($txtestado);
			echo $rspta ? "Estado registrado" : "Estado no se pudo registrar";
		}
		else {
			$rspta=$estado->editar($txtidestado,$txtestado);
			echo $rspta ? "Estado actualizado" : "Estado no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$estado->desactivar($txtidestado);
 		echo $rspta ? "Estado Desactivado" : "Estado no se puede desactivar";
	break;

	case 'activar':
		$rspta=$estado->activar($txtidestado);
 		echo $rspta ? "Estado activada" : "Estado no se puede activar";
	break;

	case 'mostrar':
		$rspta=$estado->mostrar($txtidestado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$estado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idestado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idestado.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idestado.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idestado.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->estado,
 				"2"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>