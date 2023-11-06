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

    $("#glpurchaseconfirm").on("click", function()
    {
        var leaguecurrent = $("#ddlLeagueBoostingCurrentLeague").val();
        var divisioncurrent = $("#ddlLeagueBoostingCurrentDivision").val();
        var points = $("#cphBody_ucDivisionBoosting1_txtCurrentLp").val();
        var lpgain = $("#cphBody_ucDivisionBoosting1_txtCurrentLPG").val();
        var leaguedesired = $("#ddlLeagueBoostingDesiredLeague").val();
        var divisiondesired = $("#ddlLeagueBoostingDesiredDivision").val();
        var price = $("#cphBody_ucDivisionBoosting1_hfPriceusd").val();
        var currency = $("#cphBody_ucDivisionBoosting1_hfcurrency").val();
        var rate = $("#cphBody_ucDivisionBoosting1_hfcurrencyrate").val();
        var lolserver = $("#ddlLeagueBoostinglolserver").val();
        var lolnick = $("#ddlLeagueBoostinglolnick").val();
        var loluser = $("#ddlLeagueBoostingloluser").val();
        var lolpass = $("#ddlLeagueBoostinglolpass").val();
        var rp = $("input[name='rp']:checked").val();
        var ip = $("input[name='ip']:checked").val();
        var pay = $("input[name='pay']:checked").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'gl_purchase',
            data: {leaguecurrent: leaguecurrent, divisioncurrent: divisioncurrent, points: points, lpgain: lpgain, leaguedesired: leaguedesired, divisiondesired: divisiondesired, price: price, lolserver: lolserver, lolnick: lolnick, loluser: loluser, lolpass: lolpass, rp: rp, ip: ip},
            beforeSend: function(){$("#rlt1").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){
                if(data == '1')
                    {
                        if(currency == '$US')
                        {
                            price = price;
                            currency = "USD";
                        }
                        else
                        {
                            price = price * rate;
                            price = price.toFixed(0);
                            currency = "CLP";
                        }
                        if(pay == "paypal")
                        {
                            if(currency == 'USD')
                            {
                                price = price;
                            }
                            else
                            {
                                price = price / 500;
                            }
                            var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Impulso Liga / División&amount=1&quantity=1&amount="+price+"";
                            $(location).attr('href', url);    
                        }
                        else if(pay == "kiphu")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 650;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'kiphu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "mercadopago")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 16;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'mercadopago',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "mercadopagochile")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 650;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'mercadopagochile',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "payuperu")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 3.27;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'payuperu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "payumexico")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 21;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'payumexico',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "payuchile")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 650;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'payuchile',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "payucolombia")
                        {
                            var tipo = "Impulso Liga / División";
                            var total = price;
                            if(currency == 'USD')
                            {
                                total = total * 2906;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'payucolombia',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-1').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "efectivo")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                        else if(pay == "wu")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                    }
                    else
                    {
                        $('#rlt1').html('<div id="alert-msg">'+data+'</div>');
                    };},
            });
            return false;
    });
    
    $("#dqbpurchaseconfirm").on("click", function(){
        var leaguecurrent = $("#ddlDuoQueueBoostingCurrentLeague").val();
        var divisioncurrent = $("#ddlDuoQueueBoostingCurrentDivision").val();
        var number_games = $("#cphBody_ucDuoQueBoosting1_hfGameAmount").val();
        var precio = $("#cphBody_ucDuoQueBoosting1_hfPrice").val();
        var lolnick = $("#dqblolnick").val();
        var lolserver = $("#dqblolserver").val();
        var pay = $("input[name='paydqb']:checked").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'dqb_purchase',
            data: {leaguecurrent: leaguecurrent, divisioncurrent: divisioncurrent, number_games: number_games, precio: precio, lolnick: lolnick, lolserver: lolserver},
            beforeSend: function(){$("#rlt2").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == '1')
                    {
                        if(currency == '$US')
                        {
                            precio = precio;
                            currency = "USD";
                        }
                        else
                        {
                            precio = precio * rate;
                            precio = precio.toFixed(0);
                            currency = "CLP";
                        }
                        if(pay == "paypal")
                        {
                            if(currency == 'USD')
                            {
                                precio = precio;
                            }
                            else
                            {
                                precio = precio / 500;
                            }
                            var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Duo Queue Boosting&amount=1&quantity=1&amount="+precio+"";
                            $(location).attr('href', url);    
                        }
                        else if(pay == "kiphu")
                        {
                            var tipo = "Impulso Duo Queue";
                            var total = precio;
                            if(currency == 'USD')
                            {
                                total = total * 500;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'kiphu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#paydqb').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "efectivo")
                        {
                            $('#rlt2').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                        else if(pay == "wu")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                    }
                    else
                    {
                        $('#rlt2').html('<div id="alert-msg">'+data+'</div>')
                    };},
        });
        return false;
    });
    
    $("#unrankedwinpurchase-confirm").on("click", function(){
        var leaguecurrent = $("#ddlUnrankedWinBoostingCurrentLeague").val();
        var number_wins = $("#cphBody_ucUnrankedWinBoosting1_txtNumberOfWins").val();
        var precio = $("#cphBody_ucUnrankedWinBoosting1_hfPriceusd").val();
        var price = $("#cphBody_ucUnrankedWinBoosting1_hfPriceusd").val();
        var currency = $("#cphBody_ucUnrankedWinBoosting1_hfcurrency").val();
        var rate = $("#cphBody_ucUnrankedWinBoosting1_hfcurrencyrate").val();
        var lolserver = $("#unrankedwinBoostinglolserver").val();
        var lolnick = $("#unrankedwinBoostinglolnick").val();
        var loluser = $("#unrankedwinBoostingloluser").val();
        var lolpass = $("#unrankedwinBoostinglolpass").val();
        var rp = $("input[name='rpunrankedwin']:checked").val();
        var ip = $("input[name='ipunrankedwin']:checked").val();
        var pay = $("input[name='payunrankedwin']:checked").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'pg_purchase',
            data: {leaguecurrent: leaguecurrent, number_wins: number_wins, precio: precio, lolserver: lolserver, lolnick: lolnick, loluser: loluser, lolpass: lolpass, rp: rp, ip: ip},
            beforeSend: function(){$("#rlt3").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == '1')
                    {
                        if(currency == '$US')
                        {
                            precio = precio;
                            currency = "USD";
                        }
                        else
                        {
                            precio = precio * rate;
                            precio = precio.toFixed(0);
                            currency = "CLP";
                        }
                        if(pay == "paypal")
                        {
                            if(currency == 'USD')
                            {
                                price = price;
                            }
                            else
                            {
                                price = price / 500;
                            }
                            var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Victorias Unranked&amount=1&quantity=1&amount="+price+"";
                            $(location).attr('href', url);    
                        }
                        else if(pay == "kiphu")
                        {
                            var tipo = "Victorias Unranked";
                            var total = precio;
                            if(currency == 'USD')
                            {
                                total = total * 500;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'kiphu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#payunrankedwin').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "efectivo")
                        {
                            $('#rlt3').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                        else if(pay == "wu")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                    }
                    else
                    {
                        $('#rlt3').html('<div id="alert-msg">'+data+'</div>')
                    };},
        });
        return false;
    });
    
    $("#ul-confirm").on("click", function(){
        var leaguepasado = $("#ddlUnrankedBoostingCurrentLeague").val();
        var leaguedesired = $("#ddlUnrankedBoostingDesiredLeague").val();
        var divisiondesired = $("#ddlUnrankedBoostingDesiredDivision").val();
        var lolserver = $("#ulBoostinglolserver").val();
        var lolnick = $("#ulBoostinglolnick").val();
        var loluser = $("#ulBoostingloluser").val();
        var lolpass = $("#ulBoostinglolpass").val();
        var rp = $("input[name='rpul']:checked").val();
        var ip = $("input[name='ipul']:checked").val();
        var precio = $("#cphBody_ucUnrankedBoosting1_hfPriceusd").val();
        var price = $("#cphBody_ucUnrankedBoosting1_hfPriceusd").val();
        var currency = $("#cphBody_ucUnrankedBoosting1_hfcurrency").val();
        var rate = $("#cphBody_ucUnrankedBoosting1_hfcurrencyrate").val();
        var pay = $("input[name='payul']:checked").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'ul_purchase',
            data: {leaguepasado: leaguepasado, leaguedesired: leaguedesired, precio: precio, divisiondesired: divisiondesired, lolserver: lolserver, lolnick: lolnick, loluser: loluser, lolpass: lolpass, rp: rp, ip: ip},
            beforeSend: function(){$("#rlt4").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == '1')
                    {
                        if(currency == '$US')
                        {
                            precio = precio;
                            currency = "USD";
                        }
                        else
                        {
                            precio = precio * rate;
                            precio = precio.toFixed(0);
                            currency = "CLP";
                        }
                        if(pay == 'paypal')
                        {
                            if(currency == 'USD')
                            {
                                price = price;
                            }
                            else
                            {
                                price = price / 500;
                            }
                            var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Impulso Sin clasificar Liga / División&amount=1&quantity=1&amount="+price+"";
                            $(location).attr('href', url);    
                        }
                        else if(pay == "kiphu")
                        {
                            var tipo = "Impulso Sin clasificar Liga / División";
                            var total = precio;
                            if(currency == 'USD')
                            {
                                total = total * 500;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'kiphu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-ul').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "efectivo")
                        {
                            $('#rlt4').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                        else if(pay == "wu")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                    }
                    else
                    {
                        $('#rlt4').html('<div id="alert-msg">'+data+'</div>')
                    };},
        });
        return false;
    });
    
    $("#win-confirm").on("click", function(){
        var leaguecurrent = $("#ddlWinBoostingCurrentLeague").val();
        var divisioncurrent = $("#ddlWinBoostingCurrentDivision").val();
        var wins = $("#cphBody_ucWinBoosting1_txtNumberOfWins").val();
        var precio = $("#cphBody_ucWinBoosting1_hfPrice").val();
        var price = $("#cphBody_ucWinBoosting1_hfPriceusd").val();
        var currency = $("#cphBody_ucWinBoosting1_hfcurrency").val();
        var rate = $("#cphBody_ucWinBoosting1_hfcurrencyrate").val();
        var lolserver = $("#winBoostinglolserver").val();
        var lolnick = $("#winBoostinglolnick").val();
        var loluser = $("#winBoostingloluser").val();
        var lolpass = $("#winBoostinglolpass").val();
        var rp = $("input[name='rpwin']:checked").val();
        var ip = $("input[name='ipwin']:checked").val();
        var pay = $("input[name='paywin']:checked").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'win_purchase',
            data: {leaguecurrent: leaguecurrent, divisioncurrent: divisioncurrent, precio: precio, wins: wins, lolserver: lolserver, loluser: loluser, lolnick: lolnick, lolpass: lolpass, rp: rp, ip: ip},
            beforeSend: function(){$("#rlt5").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == '1')
                    {
                        if(currency == '$US')
                        {
                            precio = precio;
                            currency = "USD";
                        }
                        else
                        {
                            precio = precio * rate;
                            precio = precio.toFixed(0);
                            currency = "CLP";
                        }
                        if(pay == 'paypal')
                        {
                            if(currency == 'USD')
                            {
                                precio = precio;
                            }
                            else
                            {
                                precio = precio / 500;
                            }
                            var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Impulso Victorias&amount=1&quantity=1&amount="+precio+"";
                            $(location).attr('href', url);    
                        }
                        else if(pay == "kiphu")
                        {
                            var tipo = "Impulso Victorias";
                            var total = precio;
                            if(currency == 'USD')
                            {
                                total = total * 500;
                            }

                            $.ajax
                            ({
                                async:true,
                                type:'POST',
                                url:'kiphu',
                                data: {total:total, tipo:tipo},
                                timeout: 50000,
                                success: function(data){$('#pay-win').html('</form>'+data);},
                            });
                            return false;
                        }
                        else if(pay == "efectivo")
                        {
                            $('#rlt5').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                        else if(pay == "wu")
                        {
                            $('#rlt1').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                            var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                        }
                    }
                    else
                    {
                        $('#rlt5').html('<div id="alert-msg">'+data+'</div>')
                    };},
        });
        return false;
    });

    $("#conf-ord").on("click", function(){
        var total = $("#cphBody_hfSingle_hfPriceusd").val();
        var horas = $("#cphBody_hfSingleAmount").val();
        var intereses = $("#int-personal").val();
        var lolserver = $("#plolserver").val();
        var nicklol = $("#plolname").val();
        var coach = $("input[name='ctl00$cphBody$hfcoach']").val();
        var pays = $("input[name='pays']:checked").val();
        var price = $("#cphBody_hfSingle_hfPriceusd").val();
        var currency = $("#cphBody_hfSingle_hfcurrency").val();
        var rate = $("#cphBody_hfSingle_hfcurrencyrate").val();
        if(currency == '$US')
        {
            price = price;
            total =  total;
        }
        else
        {
            price = price * rate;
            price = price.toFixed(0);
            total = price;
        }
        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'buy_personal',
            data: {total: total, horas: horas, intereses: intereses, lolserver: lolserver, nicklol: nicklol, coach: coach, pays: pays},
            beforeSend: function(){$("#resultado").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){
            if(data == '1')
            {
                if(pays == "paypal")
                {
                    if(currency == '$US')
                    {
                        price = price;
                    }
                    else
                    {
                        price = price / 500;
                    }
                    var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Entrenamientos Personales&amount=1&quantity=1&amount="+price+"";$(location).attr('href', url);
                }
                else if(pays == "kiphu")
                {
                    var tipo = "Entrenamientos Personales";
                    var total = price;
                    if(currency == '$US')
                    {
                        var total = total * 500;
                        total = total.toFixed(0);
                    }
                    else
                    {
                        total = total;
                    }

                    $.ajax
                    ({
                        async:true,
                        type:'POST',
                        url:'kiphu',
                        data: {total:total, tipo:tipo},
                        timeout: 50000,
                        success: function(data){$('#pays-p').html(data);},
                    });
                    return false;
                }
                else if(pays == "efectivo")
                {
                    $('#resultado').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                    var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                }
                else if(pays == "wu")
                {
                    $('#resultado').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                    var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                }
            }
            else
            {
                $('#resultado').html('<div id="alert-msg">'+data+'</div>')
            };},
        });
        return false;
    });

    $("#conf-ord-t").on("click", function(){
        var total = $("#cphBody_hfTeam_hfPriceusd").val();
        var horas = $("#cphBody_hfTeamAmount").val();
        var intereses = $("#int-team").val();
        var lolserver = $("#tlolserver").val();
        var nicklol = $("#tlolname").val();
        var coach = $("input[name='ctl00$cphBody$hfcoach']").val();
        var payt = $("input[name='payt']:checked").val();
        var price = $("#cphBody_hfTeam_hfPriceusd").val();
        var currency = $("#cphBody_hfTeam_hfcurrency").val();
        var rate = $("#cphBody_hfTeam_hfcurrencyrate").val();
        if(currency == '$US')
        {
            price = price;
            total = total;
        }
        else
        {
            price = price * rate;
            price = price.toFixed(0);
            total = price;
        }
        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'buy_team',
            data: {total: total, horas: horas, intereses: intereses, lolserver: lolserver, nicklol: nicklol, coach: coach},
            beforeSend: function(){$("#resultado2").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){
            if(data == '1')
                {
                    if(payt == "paypal")
                    {
                        if(currency == '$US')
                        {
                            price = price;
                        }
                        else
                        {
                            price = price / 500;
                        }
                        var url = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&upload=1&business=ventas2@urglo.com/eloboost&currency_code=USD&charset=ISO-8859-1&no_shipping=1&return=http://urglo.com/eloboost/&cancel_return=http://urglo.com/eloboost/&custom=NDQ0MTQsMzMxMDUw&no_note=1&item_name=Entrenamiento de equipos&amount=1&quantity=1&amount="+price+"";$(location).attr('href', url);
                    }
                    else if(payt == "kiphu")
                    {
                        var tipo = "Entrenamiento de equipos";
                        var total = price;
                        if(currency == '$US')
                        {
                            var total = total * 500;
                            total = total.toFixed(0);
                        }
                        else
                        {
                            total = total;
                        }

                        $.ajax
                        ({
                            async:true,
                            type:'POST',
                            url:'kiphu',
                            data: {total:total, tipo:tipo},
                            timeout: 50000,
                            success: function(data){$('#pays-t').html(data);},
                        });
                        return false;
                    }
                    else if(payt == "efectivo")
                    {
                        $('#resultado2').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                        var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                    }
                    else if(payt == "wu")
                    {
                        $('#resultado2').html('<div id="alert-msg">Cargando instrucciones de pago..</div>');
                        var url = "http://urglo.com/eloboost/miembros/pago_efectivo";$(location).attr('href', url);
                    }
                }
                else
                {
                     $('#resultado2').html('<div id="alert-msg">'+data+'</div>')
                };
            },
        });
        return false;
    });
    
    $("#pay-kiphu").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/kiphu',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paykiph').html(data);},
        });
        return false;
    });

    
    $("#pay-mercadopagochile").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/mercadopagochile',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paymercadopagochile').html(data);},
        });
        return false;
    });

    
    $("#pay-mercadopago").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/mercadopago',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paymercadopago').html(data);},
        });
        return false;
    });

    
    $("#pay-payuperu").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/payuperu',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paypayuperu').html(data);},
        });
        return false;
    });

    
    $("#pay-payumexico").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/payumexico',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paypayumexico').html(data);},
        });
        return false;
    });

    
    $("#pay-payucolombia").on("click", function(){
        var tipo = $("#tipo").val();
        var total = $("#total").val();
        var rate = 560.00;
        total = total * rate;
        total = total.toFixed(0);
        $.ajax
        ({
            async:true,
            type:'POST',
            url:'http://urglo.com/eloboost/miembros/payucolombia',
            data: {total:total, tipo:tipo},
            timeout: 50000,
            success: function(data){$('#paypayucolombia').html(data);},
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
                url: 'http://urglo.com/eloboost/miembros/mensajes/sendMessage',
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
                url: 'http://urglo.com/eloboost/miembros/mensajes/sendMessage_boosting',
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

    $("#calificar").on("click", function(){
        var calificacionText = $("#calificacionText").val();
        var point = $("#i").html();
        var trabajo = $("#trabajo").val();
        
        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'calificar_coach',
            data: {calificacionText: calificacionText, point: point, trabajo: trabajo},
            beforeSend: function(){$("#califacion_r").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){$('#califacion_r').html('<div id="alert-msg">'+data+'</div>');},
        });
        return false;
    });

    $("#servicio").on("click", function(){
        var us = $("#servicio").attr("data");
        var trabajo = $("#trabajo").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:'actualizar_servicio',
            data: {us: us, trabajo: trabajo},
            beforeSend: function(){$("#resultado_t").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == 1){location.reload();}else{}},
        });
        return false;
    });

    $("#cancel_coach").on("click", function(){
        var trabajo = $("input[name='billing']").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:''+trabajo+'/cancelar',
            data: {trabajo: trabajo},
            beforeSend: function(){$("#cancel_coach").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == 1){location.reload();}else{$("#cancel_coach").append(data);}},
        });
        return false;
    });

    $("#cancel_boost").on("click", function(){
        var trabajo = $("input[name='billing']").val();

        $.ajax
        ({  
            async:true,
            type:'POST',
            url:''+trabajo+'/cancelar',
            data: {trabajo: trabajo},
            beforeSend: function(){$("#cancel_boost").html('<div id="alert-msg">Cargando...</div>');},
            timeout: 50000,
            success: function(data){if(data == 1){location.reload();}else{$("#cancel_boost").append(data);}},
        });
        return false;
    });

    function inicioEnvio()
	{
		$("#resultado").html('<div id="alert-msg">Cargando...</div>');
	}
});