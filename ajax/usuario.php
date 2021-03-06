<?php 
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$txtidusuario=isset($_POST["txtidusuario"])? limpiarCadena($_POST["txtidusuario"]):"";
$txtnombre=isset($_POST["txtnombre"])? limpiarCadena($_POST["txtnombre"]):"";
$txtdui=isset($_POST["txtdui"])? limpiarCadena($_POST["txtdui"]):"";
$txtnit=isset($_POST["txtnit"])? limpiarCadena($_POST["txtnit"]):"";
$txtemail=isset($_POST["txtemail"])? limpiarCadena($_POST["txtemail"]):"";
$txtlogin=isset($_POST["txtlogin"])? limpiarCadena($_POST["txtlogin"]):"";
$txtclave=isset($_POST["txtclave"])? limpiarCadena($_POST["txtclave"]):"";
$txtimagen=isset($_POST["txtimagen"])? limpiarCadena($_POST["txtimagen"]):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
        if(!file_exists($_FILES['txtimagen']['tmp_name']) || !is_uploaded_file($_FILES['txtimagen']['tmp_name'])){
            $txtimagen=$_POST['imagenactual'];
        }
        else{
            $ext=explode(".",$_FILES["txtimagen"]["name"]);
            if($_FILES['txtimagen']['type']== "image/jpg" || $_FILES['txtimagen']['type']== "image/jpeg" || 
            $_FILES['txtimagen']['type']== "image/png"){
                $txtimagen=round(microtime(true)).'.'.end($ext);
                move_uploaded_file($_FILES["txtimagen"]["tmp_name"],"../files/usuarios/".$txtimagen);
            }
		}
		
		//Hasg SHA256 en la contraseña
		$clavehash=hash("SHA256",$txtclave);

		if (empty($txtidusuario)){
			$rspta=$usuario->insertar($txtnombre,$txtdui,$txtnit,$txtemail,$txtlogin,$clavehash,$txtimagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($txtidusuario,$txtnombre,$txtdui,$txtnit,$txtemail,$txtlogin,$clavehash,$txtimagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado" : "No se pudieron actualizar todos los datos del usuario";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($txtidusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($txtidusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($txtidusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->dui,
                "3"=>$reg->nit,
                "4"=>$reg->email,
                "5"=>$reg->login,
                "6"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
 				"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos (insert)
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario (update)
		$id=$_GET['id'];
		$marcados=$usuario->listarmarcados($id);
		$valores=array();

		//Almacena los permisos asignados al usuario en el array
		while($per=$marcados->fetch_object()){
			array_push($valores,$per->idpermiso);
		}

		while($reg = $rspta->fetch_object()){
			$sw=in_array($reg->idpermiso,$valores)?'checked':'';
			echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'"> '.$reg->nombre.'</li>';
		}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina,$clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['login']=$fetch->login;

	    }
	    echo json_encode($fetch);
	break;
}
?>