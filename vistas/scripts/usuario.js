var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
    })
    $("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$("#txtidusuario").val("");
    $("#txtnombre").val("");
    $("#txtdui").val("");
    $("#txtnit").val("");
    $("#txtemail").val("");
    $("#txtlogin").val("");
    $("#txtclave").val("");
    $("#imagenmuestra").attr("src","");
    $("#txtimagen").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoRegistros").hide();
		$("#formularioRegistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
	}
	else
	{
		$("#listadoRegistros").show();
		$("#formularioRegistros").hide();
		$("#btnAgregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tblListado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/usuario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	        bootbox.alert(datos);	          
	        mostrarform(false);
	        tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(txtidusuario)
{
	$.post("../ajax/usuario.php?op=mostrar",{txtidusuario : txtidusuario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#txtidusuario").val(data.idusuario);
        $("#txtnombre").val(data.nombre);
        $("#txtdui").val(data.dui);
        $("#txtnit").val(data.nit);
        $("#txtemail").val(data.email);
        $("#txtlogin").val(data.login);
        $("#txtclave").val(data.clave);
        $("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
		$("#imagenactual").val(data.imagen);

 	})
}

//Función para desactivar registros
function desactivar(txtidusuario)
{
	bootbox.confirm("¿Está Seguro de desactivar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=desactivar", {txtidusuario : txtidusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(txtidusuario)
{
	bootbox.confirm("¿Está Seguro de activar el usuario?", function(result){
		if(result)
        {
        	$.post("../ajax/usuario.php?op=activar", {txtidusuario : txtidusuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();