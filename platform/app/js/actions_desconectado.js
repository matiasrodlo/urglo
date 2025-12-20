$(document).on("ready", function()
{
	$("#form-registro").on("submit",function()
	{ 	
		var nombre = $("input[name='nombre']").val();
		var apellido = $("input[name='apellido']").val();
		var email = $("input[name='correo']").val();
		var paypal = $("input[name='paypal']").val();
		var telefono = $("input[name='telefono']").val();
		var pais = $("select[name='pais']").val();
		var user_platform = $("input[name='user_platform']").val();
		var pass_platform = $("input[name='pass_platform']").val();
		var pass2_platform = $("input[name='pass2_platform']").val();

		$.ajax
		({
			async:true,
			type:'POST',
			url:'agregar_usuario',
			data: {nombre: nombre, apellido: apellido, email: email, paypal: paypal, telefono: telefono, pais: pais, user_platform: user_platform, pass_platform: pass_platform, pass2_platform: pass2_platform},
			beforeSend: inicioEnvio,
			timeout: 50000,
			success: function(data){if(data == 1){location.reload();}else{$("#resultado").html('<div id="alert-msg">'+data+'</div>');}
			},
		});
		return false;
	});

    $("#form-login").on("submit", function()
    {
    	var	user_login = $("input[name='user_login']").val();
    	var pass_login = $("input[name='pass_login']").val();

    	$.ajax
		({
			async:true,
			type:'POST',
			url:'conectar_usuario',
			data: {user_login: user_login, pass_login: pass_login},
			beforeSend: inicioEnvio,
			timeout: 50000,
			success: function(data){if(data == '1'){location.reload();}else{$('#resultado').html('<div id="alert-msg">'+data+'</div>');}},
		});
		return false;
    })

    function inicioEnvio()
	{
		$("#resultado").html('<div id="alert-msg">Cargando</div>');
	}
});