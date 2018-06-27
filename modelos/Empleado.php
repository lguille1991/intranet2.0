<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empleado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($txtnombre,$txtdui,$txtnit)
	{
		$sql="INSERT INTO tblpersona (nombre,dui,nit)
		VALUES ('$txtnombre','$txtdui','$txtnit')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($txtidpersona,$txtnombre,$txtdui,$txtnit)
	{
		$sql="UPDATE tblpersona SET nombre='$txtnombre', dui='$txtdui', nit='$txtnit' WHERE idpersona='$txtidpersona'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($txtidpersona)
	{
		$sql="SELECT * FROM tblpersona WHERE idpersona='$txtidpersona'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tblpersona";
		return ejecutarConsulta($sql);		
	}
}

?>