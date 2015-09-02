function colorSelect(){
	var color = $('#color').val();
	$('#color').removeClass();
	$('#color').addClass('form-control alert-'+color);
}
