var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

//Función limpiar
function limpiar()
{
	$("#txtidestado").val("");
	$("#txtestado").val("");
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
					url: '../ajax/estado.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
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
		url: "../ajax/estado.php?op=guardaryeditar",
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

function mostrar(txtidestado)
{
	$.post("../ajax/estado.php?op=mostrar",{txtidestado : txtidestado}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#txtidestado").val(data.idestado);
		$("#txtestado").val(data.estado);

 	})
}

//Función para desactivar registros
function desactivar(txtidestado)
{
	bootbox.confirm("¿Está Seguro de desactivar el estado?", function(result){
		if(result)
        {
        	$.post("../ajax/estado.php?op=desactivar", {txtidestado : txtidestado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(txtidestado)
{
	bootbox.confirm("¿Está Seguro de activar el estado?", function(result){
		if(result)
        {
        	$.post("../ajax/estado.php?op=activar", {txtidestado : txtidestado}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

init();