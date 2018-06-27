<?php 
require_once "../modelos/Empleado.php";

$empleado=new Empleado();

$txtidpersona=isset($_POST["txtidpersona"])? limpiarCadena($_POST["txtidpersona"]):"";
$txtnombre=isset($_POST["txtnombre"])? limpiarCadena($_POST["txtnombre"]):"";
$txtdui=isset($_POST["txtdui"])? limpiarCadena($_POST["txtdui"]):"";
$txtnit=isset($_POST["txtnit"])? limpiarCadena($_POST["txtnit"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($txtidpersona)){
			$rspta=$empleado->insertar($txtnombre,$txtdui,$txtnit);
			echo $rspta ? "Estado registrado" : "Estado no se pudo registrar";
		}
		else {
			$rspta=$empleado->editar($txtidpersona,$txtnombre,$txtdui,$txtnit);
			echo $rspta ? "Estado actualizado" : "Estado no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$empleado->mostrar($txtidpersona);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$empleado->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpersona.')"><i class="fa fa-pencil"></i></button>',
                "1"=>$reg->idpersona,
                "2"=>$reg->nombre,
                "3"=>$reg->dui,
                "4"=>$reg->nit
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