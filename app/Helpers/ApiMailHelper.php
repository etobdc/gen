<?php
namespace App\Helpers;

class ApiMailHelper
{
	public static function sendEmail($assunto, $mensagem, $destinatarios = false, $fromName = false, $fromMail = false){
		$htmlMsg = '';
		if(is_array($mensagem)){
			foreach ($mensagem as $key => $value) {
				$htmlMsg .= utf8_encode(addslashes("{$key}: {$value} <br>"));
			}
		}else{
			$htmlMsg = utf8_encode($mensagem);
		}

		$data['authenticator'] = config('constants.options.API_TOKEN');
		$data['from_name'] = $fromName ? $fromName : config('constants.options.MAIL_FROM_NAME');
		$data['from'] = $fromMail ? $fromMail : config('constants.options.MAIL_FROM_ADDRESS');
		$data['assunto'] = $assunto;
		$data['mensagem'] = utf8_decode($htmlMsg);
		$url = 'https://api.o2.ag/api_cms/email/automacao/';
		$data['destinatarios'] = $destinatarios ? $destinatarios : config('constants.options.MAIL_DESTINY_ADDRESS');
		$data = json_encode($data);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$resposta = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status == 200){
			return $resposta;
			curl_close($ch);
		} else {
			return $status;
			curl_close($ch);
		}
	}
}
