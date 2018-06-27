<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Estado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($txtestado)
	{
		$sql="INSERT INTO tblestado (estado,condicion)
		VALUES ('$txtestado','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($txtidestado,$txtestado)
	{
		$sql="UPDATE tblestado SET estado='$txtestado' WHERE idestado='$txtidestado'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($txtidestado)
	{
		$sql="UPDATE tblestado SET condicion='0' WHERE idestado='$txtidestado'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($txtidestado)
	{
		$sql="UPDATE tblestado SET condicion='1' WHERE idestado='$txtidestado'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($txtidestado)
	{
		$sql="SELECT * FROM tblestado WHERE idestado='$txtidestado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tblestado";
		return ejecutarConsulta($sql);		
	}
}

?>