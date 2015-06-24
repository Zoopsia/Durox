$(document).ready(function(){
     
    $('.prueba').DataTable({
    	
    	
    	"language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
    		
    });
    
    $(".chosen-select").chosen();
	
});


addEvent(window,'load',inicializarEventos,false);

function inicializarEventos()
{
  	var ob=document.getElementById('btn-cancelar');
  	addEvent(ob,'click',presionBoton,false);
}

function presionBoton()
{
	var ob=document.getElementById('id_pais').selectedIndex;
  	//recuperarDatos(ob.value);
  	//alert(document.getElementsByTagName("option")[ob].value);
  	recuperarDatos(document.getElementsByTagName("option")[ob].value);
}


var conexion1;

function recuperarDatos(id_pais) 
{
	alert(id_pais);
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','localhost/Durox/index.php/direcciones/prueba/', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(id_pais);
}

function procesarEventos()
{
  var resultados = document.getElementById("resultados");
  if(conexion1.readyState == 4)
  {
    var datos=conexion1.responseText;
    alert(datos);
    var salida = "Provincia:"+datos.nombre+"<br>";
    salida = salida+"Filas:"+datos.filas+"<br>";
    resultados.innerHTML = salida;
  } 
  else 
  {
    resultados.innerHTML = "Cargando...";
  }
}

//***************************************
//Funciones comunes a todos los problemas
//***************************************

function addEvent(elemento,nomevento,funcion,captura)
{
  if (elemento.attachEvent)
  {
    elemento.attachEvent('on'+nomevento,funcion);
    return true;
  }
  else  
    if (elemento.addEventListener)
    {
      elemento.addEventListener(nomevento,funcion,captura);
      return true;
    }
    else
      return false;
}

function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}


