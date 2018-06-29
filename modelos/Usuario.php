<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($txtnombre,$txtdui,$txtnit,$txtemail,$txtlogin,$txtclave,$txtimagen)
	{
		$sql="INSERT INTO usuario (nombre,dui,nit,email,login,clave,imagen,condicion)
		VALUES ('$txtnombre','$txtdui','$txtnit','$txtemail','$txtlogin','$txtclave','$txtimagen','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($txtidusuario,$txtnombre,$txtdui,$txtnit,$txtemail,$txtlogin,$txtclave,$txtimagen)
	{
		$sql="UPDATE usuario SET nombre='$txtnombre',dui='$txtdui',nit='$txtnit',email='$txtemail',
        login='$txtlogin',clave='$txtclave',imagen='$txtimagen' WHERE idusuario='$txtidusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($txtidusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$txtidusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($txtidusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$txtidusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($txtidusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$txtidusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}
}

?>