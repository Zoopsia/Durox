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
    
    $(".chosen-select").chosen({ width: '100%' });
    

	$(".select2").select2({ 
		width: '100%',
		tags: true,
	});
	
	$('.datepicker').attr("onkeypress", 'return false');

});

$(function() {
    $( ".datepicker" ).datepicker();
    
     $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});

function confirmar($id,$tipo){
	var c = confirm("Los datos no han sido guardados.\n¿Está seguro que quiere salir?");
	if (c==true){
		if($tipo==1){
			window.history.back();
		}
		else if($tipo==2)
			window.history.back();	
	}
}

function confirmarGrupo(){
	var c = confirm("Los datos no han sido guardados.\n¿Está seguro que quiere salir?");
	if (c==true){
			window.history.back();
			//window.location.assign("/durox/index.php/Grupos/adminClientes");
	}
}

function confirmarVisita(){
	var c = confirm("Los datos no han sido guardados.\n¿Está seguro que quiere salir?");
	if (c==true){
			window.history.back();
			//window.location.assign("/Durox/index.php/Visitas/visitas_abm/tab1");
	}
}

function confirmarPresupuesto(){
	var c = confirm("Los datos no han sido guardados.\n¿Está seguro que quiere salir?");
	if (c==true){
			window.history.back();
			//window.location.assign("/Durox/index.php/Presupuestos/presupuestos_abm/tab1");
	}
}

$('#btn-guardar').click(function() {
	$(this).addClass("slideDown");
});	
	
$('#btn-cancelar').click(function() {
	$(this).addClass("slideDown");
});	

$(function() {
	startTime();
    $(".center").center();
    $(window).resize(function() {
    	$(".center").center();
    });
});

function startTime(){
	var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);

    //Check for PM and AM
    var day_or_night = (h > 11) ? "PM" : "AM";

    //Convert to 12 hours system
    if (h > 12)
    	h -= 12;

	//Add time to the headline and update every 500 milliseconds
    $('#time').html("<i class='fa fa-clock-o'></i> " + h + ":" + m + ":" + s + " " + day_or_night);
    setTimeout(function() {
    	startTime();
    }, 500);
}

function checkTime(i){
	if (i < 10){
		i = "0" + i;
    }
    return i;
}

