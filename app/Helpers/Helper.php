<?php
function mask_cpf($cpf, $hasMask = false){
	if(strlen($cpf) == 0)
		return $cpf;

	if($hasMask){
		return preg_replace('/\D/', '', $cpf);
	}else{
		return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
	}
}

function mask_phone($string, $hasMask = false){
	if(strlen($string) == 0)
		return $string;

	if($hasMask){
		return preg_replace('/\D/', '', $string);
	}else{
		if(strlen($string) == 10)
			return '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) . '-' . substr($string, 6, 9);
		else
			return '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 5) . '-' . substr($string, 7, 11);
	}
}

function mask_date($date, $hasMask = false){
	if($hasMask){
		$date = str_replace('/', '-', $date);
		return date("Y-m-d", strtotime($date));
	}else{
		return date("d/m/Y", strtotime($date));
	}
}

function mask_datetime($date, $hasMask = false){
	if($hasMask){
		$date = str_replace('/', '-', $date);
		return date("Y-m-d H:i:s", strtotime($date));
	}else{
		return date("d/m/Y H:i:s", strtotime($date));
	}
}

function uf_states(){
	return json_encode([
		[
			"value" => "AC",
			"label" => "Acre"
		],
		[
			"value" => "AL",
			"label" => "Alagoas"
		],
		[
			"value" => "AP",
			"label" => "Amapá"
		],
		[
			"value" => "AM",
			"label" => "Amazonas"
		],
		[
			"value" => "BA",
			"label" => "Bahia"
		],
		[
			"value" => "CE",
			"label" => "Ceará"
		],
		[
			"value" => "DF",
			"label" => "Distrito Federal"
		],
		[
			"value" => "ES",
			"label" => "Espírito Santo"
		],
		[
			"value" => "GO",
			"label" => "Goiás"
		],
		[
			"value" => "MA",
			"label" => "Maranhão"
		],
		[
			"value" => "MT",
			"label" => "Mato Grosso"
		],
		[
			"value" => "MS",
			"label" => "Mato Grosso do Sul"
		],
		[
			"value" => "MG",
			"label" => "Minas Gerais"
		],
		[
			"value" => "PA",
			"label" => "Pará"
		],
		[
			"value" => "PB",
			"label" => "Paraíba"
		],
		[
			"value" => "PR",
			"label" => "Paraná"
		],
		[
			"value" => "PE",
			"label" => "Pernambuco"
		],
		[
			"value" => "PI",
			"label" => "Piauí"
		],
		[
			"value" => "RJ",
			"label" => "Rio de Janeiro"
		],
		[
			"value" => "RN",
			"label" => "Rio Grande do Norte"
		],
		[
			"value" => "RS",
			"label" => "Rio Grande do Sul"
		],
		[
			"value" => "RO",
			"label" => "Rondônia"
		],
		[
			"value" => "RR",
			"label" => "Roraima"
		],
		[
			"value" => "SC",
			"label" => "Santa Catarina"
		],
		[
			"value" => "SP",
			"label" => "São Paulo"
		],
		[
			"value" => "SE",
			"label" => "Sergipe"
		],
		[
			"value" => "TO",
			"label" => "Tocantins"
		]
	]);
}

function validate_strdate(String $strDate, String $format){
	switch ($format) {
		case 'm-Y':
			if(strlen($strDate) != 7)
				return false;

			$splitted = explode('-', $strDate);

			if(sizeof($splitted) != 2)
				return false;

			if(strlen($splitted[0]) != 2 || strlen($splitted[1]) != 4)
				return false;

			if(!ctype_digit($splitted[0]) || !ctype_digit($splitted[1]))
				return false;

			return checkdate($splitted[0], 01, $splitted[1]);

			break;
		
		default:
			# code...
			break;
	}
}