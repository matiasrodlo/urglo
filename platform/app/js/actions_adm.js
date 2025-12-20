$(document).on("ready", function()
{
    $("#edit-personal-info").on("submit", function()
    {
        var id_usuario = $("input[name='id_usuario']").val();
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        var tipo_cuenta = $("select[name='tipo_cuenta']").val();
        var nombre = $("input[name='nombre']").val();
        var apellido = $("input[name='apellido']").val();
        var correo = $("input[name='correo']").val();
        var paypal = $("input[name='paypal']").val();
        var telefono = $("input[name='telefono']").val();
        var pais = $("select[name='pais']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'editar_perfil_accion',
            data: {id_usuario: id_usuario, username: username, password: password, tipo_cuenta: tipo_cuenta, nombre: nombre, apellido: apellido, correo: correo, paypal: paypal, telefono: telefono, pais: pais},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#img_up").on("click", function()
    {   
        var imagen = new FormData($("#form-perfil")[0]);

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'img_perfil',
            data: imagen,
            contentType:false,
            processData: false,
            beforeSend: function(){$("#resultado-img").html('<div id="alert-msg">Subiendo imagen</div>');},
            timeout: 50000,
            success: function(data){
                if(data != 'Tu imagen de perfil se subio correctamente.')
                {
                    $('#resultado-img').html('<div id="alert-msg">'+data+'</div>');
                }
                else
                {
                    $('#resultado-img').html('<div id="alert-msg">'+data+'</div>');location.reload(5000);
                }
            },
        });
        return false;
    });
    
    $("#responder_mensaje").on("submit", function()
    {
        var asunto = $("input[name='asunto']").val();
        var contenido = $("textarea[name='contenido']").val();
        var rp = $("input[name='rp']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'responder_mensaje_accion',
            data: {asunto: asunto, contenido: contenido, rp: rp},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#enviar_mensaje").on("submit", function()
    {
        var receptor = $("input[name='receptor']").val();
        var asunto = $("input[name='asunto']").val();
        var contenido = $("textarea[name='contenido']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'enviar_mensaje_accion',
            data: {receptor: receptor, asunto: asunto, contenido: contenido},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#edit-personal").on("submit", function()
    {
        var nombre = $("input[name='nombre']").val();
        var apellido = $("input[name='apellido']").val(); 
        var correo = $("input[name='correo']").val();
        var paypal = $("input[name='paypal']").val();
        var telefono = $("input[name='telefono']").val();
        var pais = $("select[name='pais']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'editar_personal_accion',
            data: {nombre: nombre, apellido: apellido, correo: correo, paypal: paypal, telefono: telefono, pais: pais},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#edit-password").on("submit", function()
    {
        var old_contraseña = $("input[name='old-contraseña']").val();
        var contraseña = $("input[name='contraseña']").val();
        var re_contraseña = $("input[name='re-contraseña']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'editar_password_accion',
            data: {old_contraseña: old_contraseña, contraseña: contraseña, re_contraseña: re_contraseña},
            beforeSend: function(){$("#resultado-pass").html('<div id="alert-msg">Cargando</div>');},
            timeout: 50000,
            success: function(data){$('#resultado-pass').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#actv").on("click", function(){
        var pedido = $("input[name='pedido']").val();
        var mensaje = $("#mensaje_coach").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'activar_pedido',
            data: {pedido: pedido, mensaje: mensaje},
            beforeSend: function(){$("#resultado").html('<div id="alert-msg">Cargando</div>');},
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#chatSend").on("click", function(){
        var message = $("#chatText").val();
        var id_conver = $("#chatboxconv").val();
        var id_coach = $("#chatboxcoach").val();
        var trabajo = $("#trabajo").val();
        if(message == '')
        {
            $('#msg-rlt').html('No se puede enviar mensajes vacios. Escribe algo, por favor.');
        }
        else
        {
            $.ajax
            ({  
                async:true,
                type:'POST',
                url: '/app/mensajes/sendMessage',
                data: {message: message, id_conver: id_conver, id_coach: id_coach, trabajo: trabajo},
                beforeSend: function(){},
                timeout: 50000,
                success: function(data){
                    if(data == '1')
                    {
                        $("#chatText").val("");
                        chat();
                    }
                    else
                    {
                        //alert('Hubo un error al enviar el mensaje.');
                    }
                },
            });
        }
        return false;
    });
    
    $("#chatSendx").on("click", function(){
        var message = $("#chatText").val();
        var id_conver = $("#chatboxconv").val();
        var receptor = $("#chatboxrecep").val();
        var trabajo = $("#trabajo").val();

        if(message == '')
        {
            $('#msg-rlt').html('No se puede enviar mensajes vacios. Escribe algo, por favor.');
        }
        else
        {
            $.ajax
            ({  
                async:true,
                type:'POST',
                url: '/app/mensajes/sendMessage',
                data: {trabajo:trabajo, message: message, id_conver: id_conver, receptor: receptor},
                beforeSend: function(){},
                timeout: 50000,
                success: function(data){
                    if(data == '1')
                    {
                        chat();
                        $("#chatText").val("");
                        loadLog();
                    }
                    else
                    {
                          //alert('Hubo un error al enviar el mensaje.');
                    }
                },
            });
        }
        return false;
    });

    $("#actp").on("click", function(){
        var precio_coach = $("input[name='precio_coach']").val();
        var pedido = $("input[name='pedido']").val();
        if(precio_coach == '')
        {
            alert('Ingresa una ganancia para el coach');
        }
        else
        {
            $.ajax
            ({
                async:true,
                type:'POST',
                url:'activar_pedido',
                data: {pedido: pedido, precio_coach: precio_coach},
                beforeSend: function(){$("#resultado").html('<div id="alert-msg">Activando pedido</div>');},
                timeout: 50000,
                success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
            });
            return false;
        }
    });

    $("#actd").on("click", function(){
        var precio_coach = $("input[name='precio_coach']").val();
        var pedido = $("input[name='pedido']").val();
        if(precio_coach == '')
        {
            alert('Ingresa una ganancia para el coach');
        }
        else
        {
            $.ajax
            ({
                async:true,
                type:'POST',
                url:'actualizar_pedido',
                data: {pedido: pedido, precio_coach: precio_coach},
                beforeSend: function(){$("#resultado").html('<div id="alert-msg">Actualizando pedido</div>');},
                timeout: 50000,
                success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
            });
            return false;
        }
    });

    $("#mandaremail").on("click", function(){
            $.ajax
            ({
                async:true,
                type:'POST',
                url:'/app/enviar_email_coaches',
                data: {},
                beforeSend: function(){$("#resultado").html('<div id="alert-msg">Enviando</div>');},
                timeout: 50000,
                success: function(data){$('#resultado').html('<div id="alert-msg">Enviado</div>');},
            });
    });

    $("#bclick").on("click", function(){
        var user = $("input[name='g']").val();
        if(user == '')
        {
            alert('Ingresa un usuario para buscar');
        }
        else
        {
            $.ajax
            ({
                async:true,
                type:'POST',
                url:'buscar_usuario',
                data: {user: user},
                beforeSend: function(){$("#resultado").html('<div id="alert-msg">Buscando usuario</div>');},
                timeout: 50000,
                success: function(data){$('#resultado').html(data);},
            });
            return false;
        } 
    });

    function inicioEnvio()
	{
		$("#resultado").html('<div id="alert-msg">Cargando</div>');
	}
});