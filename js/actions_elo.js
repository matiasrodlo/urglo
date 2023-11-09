$(document).on("ready", function()
{
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
            beforeSend: function(){$("#resultado-img").html('<div id="alert-msg">Subiendo imagen...</div>');},
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
            beforeSend: function(){$("#resultado-pass").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){$('#resultado-pass').html('<div id="alert-msg">'+data+'</div>');},
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
    
    $("#chatSend").on("click", function(){
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
                url: 'http://urglo.com/miembros/mensajes/sendMessage',
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
                          alert('Hubo un error al enviar el mensaje.');
                    }
                },
            });
        }
        return false;
    });

    $("#rl_d").on("click", function(){
        var pedido = $("input[name='pedido']").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'realizar_pedido',
            data: {pedido: pedido},
            beforeSend: function(){$("#resultado").html('<div id="alert-msg">Tomando pedido...</div>');},
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#ac_tra").on("click", function(){
        var current = $("#cur").val();
        var pedido = $("#trabajo").val();
        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'actualizar_pedido',
            data: {pedido: pedido, current: current},
            beforeSend: function(){$("#resultado_t").html('<div id="alert-msg">Actualizando el pedido...</div>');},
            timeout: 50000,
            success: function(data){$('#resultado_t').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#act_bos").on("click", function(){
        var leaguecurrent = $("#sllevel").val();
        var divisioncurrent = $("#sldivision").val();
        var pedido = $("#trabajo").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'actualizar_pedido_ac',
            data: {leaguecurrent: leaguecurrent, divisioncurrent: divisioncurrent, pedido: pedido},
            beforeSend: function(){$("#resultado_t").html('<div id="alert-msg">Actualizando el pedido...</div>');},
            timeout: 50000,
            success: function(data){$('#resultado_t').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#t_tra").on("click", function(){
        var pedido = $("#trabajo").val();
        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'terminar_pedido',
            data: {pedido: pedido},
            beforeSend: function(){$("#resultado_t").html('<div id="alert-msg">Terminado el pedido...</div>');},
            timeout: 50000,
            success: function(data){$('#resultado_t').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#s_elo").on("click", function(){
        var el = $("#s_elo").attr("data");
        var trabajo = $("#trabajo").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'actualizar_servicio',
            data: {el: el, trabajo: trabajo},
            beforeSend: function(){$("#resultado_t").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == 1){location.reload();}else{}},
        });
        return false;
    });

    function inicioEnvio()
    {
        $("#resultado").html('<div id="alert-msg">Cargando...</div>');
    }
});