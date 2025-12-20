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

    $("#realizar_trabajo").on("submit", function()
    {
        var tr = $("input[name='tr']").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'realizar_trabajo_accion',
            data: {tr: tr},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#miperfil-coach").on("submit", function()
    {
        var server = $("select[name='servidor']").val();
        var level = $("select[name='level']").val();
        var division = $("select[name='division']").val();
        if(level == '6')
        {
            division = '0';
        }
        else
        {
            division = $("select[name='division']").val();
        }
        var champion1 = $("select[name='champion1']").val();
        var champion2 = $("select[name='champion2']").val();
        var champion3 = $("select[name='champion3']").val();
        var champion4 = $("select[name='champion4']").val();
        var roles = new Array();
        $("input[name='roles[]']:checked").each(function(){
            roles.push($(this).val());
        });
        var idiomas = new Array();
        $("input[name='idiomas[]']:checked").each(function(){
            idiomas.push($(this).val());
        });
        var precio_personal = $("input[name='precio_personal']").val();
        var precio_team = $("input[name='precio_team']").val();
        var contenido = $(".nicEdit-main").html();
        
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'miperfil_coach_accion',
            data: {server:server, contenido:contenido, level:level, division:division, champion1: champion1, champion2: champion2, champion3: champion3, champion4:champion4, roles: roles, idiomas: idiomas, precio_personal:precio_personal, precio_team:precio_team},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });
    
    $("#editar-miperfil-coach").on("submit", function(){
        var server = $("select[name='servidor']").val();
        var level = $("select[name='level']").val();
        var division = $("select[name='division']").val();
        if(level == '6')
        {
            division = '0';
        }
        else
        {
            division = $("select[name='division']").val();
        }
        var champion1 = $("select[name='champion1']").val();
        var champion2 = $("select[name='champion2']").val();
        var champion3 = $("select[name='champion3']").val();
        var champion4 = $("select[name='champion4']").val();
        var roles = new Array();
        $("input[name='roles[]']:checked").each(function(){
            roles.push($(this).val());
        });
        var idiomas = new Array();
        $("input[name='idiomas[]']:checked").each(function(){
            idiomas.push($(this).val());
        });
        var precio_personal = $("input[name='precio_personal']").val();
        var precio_team = $("input[name='precio_team']").val();
        var contenido = $(".nicEdit-main").html();
        
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'editarmiperfil_coach_accion',
            data: {server:server, contenido:contenido, level:level, division:division, champion1: champion1, champion2: champion2, champion3: champion3, champion4:champion4, roles: roles, idiomas: idiomas, precio_personal:precio_personal, precio_team:precio_team},
            beforeSend: inicioEnvio,
            timeout: 50000,
            success: function(data){$('#resultado').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#act_t").on("click", function(){
        var restantes = $("input[name='restantes']").val();
        var trabajo = $("#trabajo").val();
        
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'act_t',
            data: {restantes: restantes, trabajo: trabajo},
            beforeSend: function(data){$('#rlt_act').html('<div id="alert-msg">Actualizando trabajo</div>');},
            timeout: 50000,
            success: function(data){$('#rlt_act').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#tm_t").on("click", function(){
        var trabajo = $("#trabajo").val();

        $.ajax
        ({
            async:true,
            type:'POST',
            url:'tm_t',
            data: {trabajo: trabajo},
            beforeSend: function(data){$('#rlt_t').html('<div id="alert-msg">Finalizando trabajo</div>');},
            timeout: 50000,
            success: function(data){$('#rlt_t').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#chatSend").on("click", function(){
        var message = $("#chatText").val();
        var id_conver = $("#chatboxconv").val();
        var id_user = $("#chatboxid").val();
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
                data: {message: message, id_conver: id_conver, id_user: id_user, trabajo: trabajo},
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
    
    function inicioEnvio()
    {
        $("#resultado").html('<div id="alert-msg">Cargando</div>');
    }
});