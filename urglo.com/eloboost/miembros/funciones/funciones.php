<?php
function check_email($variable)
{
  if(preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$/", $variable ))
  return true;
  else
  return false;
}
function level($id_level, $id_division)
{
	$level = array();

	if($id_level == '5' and $id_division == '5')
	{
		$level['imagen'] = '54462111-6c03-47d1-b42d-01be036c2712.png';
		$level['nombre'] = 'Bronce V';
		$level['nom'] = "Bronce";
		$level['div'] = "V";
	}
	elseif($id_level == '5' and $id_division == '4')
	{
		$level['imagen'] = '34c46afd-0042-44b7-9363-b52373b0d7b6.png';
		$level['nombre'] = 'Bronce IV';
		$level['nom'] = "Bronce";
		$level['div'] = "IV";
	}
	elseif($id_level == '5' and $id_division == '3')
	{
		$level['imagen'] = '1cd507e9-1426-454b-906d-ca2901b6c006.png';
		$level['nombre'] = 'Bronce III';
		$level['nom'] = "Bronce";
		$level['div'] = "III";
	}
	elseif($id_level == '5' and $id_division == '2')
	{
		$level['imagen'] = 'bcea731d-3e32-4d77-9fa5-f767f8bfd491.png';
		$level['nombre'] = 'Bronce II';
		$level['nom'] = "Bronce";
		$level['div'] = "II";
	}
	elseif($id_level == '5' and $id_division == '1')
	{
		$level['imagen'] = '30852b39-89e9-4bad-9cf0-a637b6917fc1.png';
		$level['nombre'] = 'Bronce I';
		$level['nom'] = "Bronce";
		$level['div'] = "I";
	}
	elseif($id_level == '5' and $id_division == '0')
	{
		$level['imagen'] = '30852b39-89e9-4bad-9cf0-a637b6917fc1.png';
		$level['nombre'] = 'Bronce';
		$level['nom'] = "Bronce";
		$level['div'] = "0";
	}
	elseif($id_level == '4' and $id_division == '5')
	{
		$level['imagen']= '62003196-fcc1-4b45-9e3a-3e84fa95db9d.png';
		$level['nombre'] = 'Plata V';
		$level['nom'] = "Plata";
		$level['div'] = "V";
	}
	elseif($id_level == '4' and $id_division == '4')
	{
		$level['imagen'] = 'bf91db2a-2b72-4d07-9e18-440720ed1ae9.png';
		$level['nombre'] = 'Plata IV';
		$level['nom'] = "Plata";
		$level['div'] = "IV";
	}
	elseif($id_level == '4' and $id_division == '3')
	{
		$level['imagen'] = '87e396f5-d22a-40fa-987b-91c32526e9ae.png';
		$level['nombre'] = 'Plata III';
		$level['nom'] = "Plata";
		$level['div'] = "III";
	}
	elseif($id_level == '4' and $id_division == '2')
	{
		$level['imagen'] = '92e80b91-b388-4d61-b173-d04739e43fb8.png';
		$level['nombre'] = 'Plata II';
		$level['nom'] = "Plata";
		$level['div'] = "II";
	}
	elseif($id_level == '4' and $id_division == '1')
	{
		$level['imagen'] = '52570517-9566-4459-911a-dde96be9e2b1.png';
		$level['nombre'] = 'Plata I';
		$level['nom'] = "Plata";
		$level['div'] = "I";
	}
	elseif($id_level == '4' and $id_division == '0')
	{
		$level['imagen'] = '52570517-9566-4459-911a-dde96be9e2b1.png';
		$level['nombre'] = 'Plata';
		$level['nom'] = "Plata";
		$level['div'] = "0";
	}
	elseif($id_level == '3' and $id_division == '5')
	{
		$level['imagen'] = 'b3c8b95a-82cf-4d86-8cba-f6ceffd45d65.png';
		$level['nombre'] = 'Oro V';
		$level['nom'] = "Oro";
		$level['div'] = "V";
	}
	elseif($id_level == '3' and $id_division == '4')
	{
		$level['imagen'] = 'ddb3ecbe-3f37-4f3b-877b-01ee03f1f0a1.png';
		$level['nombre'] = 'Oro IV';
		$level['nom'] = "Oro";
		$level['div'] = "IV";
	}
	elseif($id_level == '3' and $id_division == '3')
	{
		$level['imagen'] = '8eb10d7f-3ffd-4ae2-a584-dbe443615695.png';
		$level['nombre'] = 'Oro III';
		$level['nom'] = "Oro";
		$level['div'] = "III";
	}
	elseif($id_level == '3' and $id_division == '2')
	{
		$level['imagen'] = '3dc8fb37-5653-4c05-8ee8-7dbdcc3f2bf4.png';
		$level['nombre'] = 'Oro II';
		$level['nom'] = "Oro";
		$level['div'] = "II";
	}
	elseif($id_level == '3' and $id_division == '1')
	{
		$level['imagen'] = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2.png';
		$level['nombre'] = 'Oro I';
		$level['nom'] = "Oro";
		$level['div'] = "I";
	}
	elseif($id_level == '3' and $id_division == '0')
	{
		$level['imagen'] = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2.png';
		$level['nombre'] = 'Oro';
		$level['nom'] = "Oro";
		$level['div'] = "0";
	}
	elseif($id_level == '3' and $id_division == '24')
	{
		$level['imagen'] = 'dbed347e-55e1-4b8e-a01e-712594dcb8a2.png';
		$level['nombre'] = 'Oro';
		$level['nom'] = "Oro";
		$level['div'] = "0";
	}
	elseif($id_level == '2' and $id_division == '5')
	{
		$level['imagen'] = '4932644a-65a6-4475-9a4e-80be930bd8d6.png';
		$level['nombre'] = 'Platino V';
		$level['nom'] = "Platino";
		$level['div'] = "V";
	}
	elseif($id_level == '2' and $id_division == '4')
	{
		$level['imagen'] = '33d258b1-e222-45ea-8518-4da73b2a0578.png';
		$level['nombre'] = 'Platino IV';
		$level['nom'] = "Platino";
		$level['div'] = "IV";
	}
	elseif($id_level == '2' and $id_division == '3')
	{
		$level['imagen'] = 'b98cb628-7cd3-4e3e-98d3-54e636505a31.png';
		$level['nombre'] = 'Platino III';
		$level['nom'] = "Platino";
		$level['div'] = "III";
	}
	elseif($id_level == '2' and $id_division == '2')
	{
		$level['imagen'] = '69654f19-c11d-409b-b296-0227a60e9f3d.png.png';
		$level['nombre'] = 'Platino II';
		$level['nom'] = "Platino";
		$level['div'] = "II";
	}
	elseif($id_level == '2' and $id_division == '1')
	{
		$level['imagen'] = 'f18ef92a-ec97-4642-a37a-f031306b8640.png';
		$level['nombre'] = 'Platino I';
		$level['nom'] = "Platino";
		$level['div'] = "I";
	}
	elseif($id_level == '2' and $id_division == '0')
	{
		$level['imagen'] = 'f18ef92a-ec97-4642-a37a-f031306b8640.png';
		$level['nombre'] = 'Platino';
		$level['nom'] = "Platino";
		$level['div'] = "0";
	}
	elseif($id_level == '1' and $id_division == '5')
	{
		$level['imagen'] = '210f3b0b-1faa-4e20-aa78-7ef1ee0c2139.png';
		$level['nombre'] = 'Diamante V';
		$level['nom'] = "Diamante";
		$level['div'] = "V";
	}
	elseif($id_level == '1' and $id_division == '4')
	{
		$level['imagen'] = '266848b9-8b95-490e-9041-b9d95cfcc31a.png';
		$level['nombre'] = 'Diamante IV';
		$level['nom'] = "Diamante";
		$level['div'] = "IV";
	}
	elseif($id_level == '1' and $id_division == '3')
	{
		$level['imagen'] = '0c757285-76ad-455a-a8d6-884d3c9bb821.png';
		$level['nombre'] = 'Diamante III';
		$level['nom'] = "Diamante";
		$level['div'] = "III";
	}
	elseif($id_level == '1' and $id_division == '2')
	{
		$level['imagen'] = '6d2eb145-76cc-4a5c-925b-eefb5307ee77.png';
		$level['nombre'] = 'Diamante II';
		$level['nom'] = "Diamante";
		$level['div'] = "II";
	}
	elseif($id_level == '1' and $id_division == '1')
	{
		$level['imagen'] = '4eba264c-9bf4-4d71-b16b-81a8949b984f.png';
		$level['nombre'] = 'Diamante I';
		$level['nom'] = "Diamante";
		$level['div'] = "I";
	}
	elseif($id_level == '1' and $id_division == '0')
	{
		$level['imagen'] = '4eba264c-9bf4-4d71-b16b-81a8949b984f.png';
		$level['nombre'] = 'Diamante';
		$level['nom'] = "Diamante";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '0')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '5')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '4')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '3')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '2')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '6' and $id_division == '1')
	{
		$level['imagen'] = 'd7a48073-e32c-4aa6-a35b-21ef5d08c8e3.png';
		$level['nombre'] = 'Retador';
		$level['nom'] = "Retador";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and ($id_division == '0' or $id_division == '')) 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and $id_division == '1') 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and $id_division == '2') 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and $id_division == '3') 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and $id_division == '4') 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	elseif($id_level == '7' and $id_division == '5') 
	{
		$level['imagen'] = 'cdd340be-cd00-445a-ac22-70db7e5ec109.png';
		$level['nombre'] = 'Unranked';
		$level['nom'] = "Unranked";
		$level['div'] = "0";
	}
	return $level;
}
function version($file) {
    return $file.'?'.filemtime($file);
}
?>
