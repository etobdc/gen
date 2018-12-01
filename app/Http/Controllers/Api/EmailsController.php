<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\ApiMailHelper;

class EmailsController extends Controller
{
    private function send_email($title, $html, $destiny)
    {
        $send_status = ApiMailHelper::sendEmail($title, $html, $destiny);
        return is_numeric($send_status);
    }

    public function product(Request $request)
    {
        $data = $request->all();

        $html = "
            <p>
                Alguém se interessou por um produto da <b>COPPI</b><br><br>
                <b>Dados do formulário:</b>
                <ul>
                    <li><b>Nome: </b> $data[name]<br></li>
                    <li><b>E-mail: </b> $data[email]</li>
                    <li><b>Produto: </b> $data[origin]</li>
                </ul>
            </p>
        ";

        if(!$this->sendEmail('Novo interesse em produto', $html)){
          return response()->json(['error' => 'Erro ao enviar o e-mail'], 500);
        }
        return response()->json(['success' => 'E-mail enviado com sucesso'], 200);
    }

    public function news(Request $request)
    {
        $data = $request->all();

        $html = "
            <p>
                Alguém deseja receber novidades sobre a <b>Pienza Imóveis</b><br><br>
                <b>Dados do formulário:</b>
                <ul>
                    <li><b>Nome: </b> $data[name]<br></li>
                    <li><b>E-mail: </b> $data[email]</li>
                </ul>
            </p>
        ";

        if(!$this->sendEmail('Alguém deseja receber novidades', $html)){
          return response()->json(['error' => 'Erro ao enviar o e-mail'], 500);
        }
        return response()->json(['success' => 'E-mail enviado com sucesso'], 200);
    }

    public function contact(Request $request)
    {
        $data = $request->all();

        $html = "
            <p>
                Novo contato recebido através do Website <b>Pienza Imóveis</b><br><br>
                <b>Dados do formulário:</b>
                <ul>
                    <li><b>Nome: </b> $data[name]<br></li>
                    <li><b>E-mail: </b> $data[email]<br></li>
                    <li><b>Telefone: </b> $data[phone]<br></li>
                    <li><b>Assunto: </b> $data[subject]<br></li>
                    <li><b>Mensagem: </b> $data[message]<br></li>
                </ul>
            </p>
        ";

        if(!$this->sendEmail('Novo contato recebido', $html)){
          return response()->json(['error' => 'Erro ao enviar o e-mail'], 500);
        }
        return response()->json(['success' => 'E-mail enviado com sucesso'], 200);
    }

    public function more_info_imovel(Request $request)
    {
        $data = $request->all();

        $html = "
            <p>
                Alguém deseja receber mais informações sobre um imóvel da <b>Pienza Imóveis</b><br><br>
                <b>Dados do formulário:</b>
                <ul>
                    <li><b>Imóvel: </b> $data[imovel]<br></li>
                    <li><b>Nome: </b> $data[name]<br></li>
                    <li><b>E-mail: </b> $data[email]<br></li>
                    <li><b>Telefone: </b> $data[phone]<br></li>
                    <li><b>Cidade/UF: </b> $data[city] - $data[state]<br></li>
                    <li><b>Mensagem: </b> $data[message]<br></li>
                </ul>
            </p>
        ";

        if(!$this->sendEmail('Novo interesse em mais informações sobre imóvel', $html)){
          return response()->json(['error' => 'Erro ao enviar o e-mail'], 500);
        }
        return response()->json(['success' => 'E-mail enviado com sucesso'], 200);
    }

    public function interested_imovel(Request $request)
    {
        $data = $request->all();

        $html = "
            <p>
                Alguém esta interessado em um imóvel da <b>Pienza Imóveis</b><br><br>
                <b>Dados do formulário:</b>
                <ul>
                    <li><b>Imóvel: </b> $data[imovel]<br></li>
                    <li><b>Nome: </b> $data[name]<br></li>
                    <li><b>E-mail: </b> $data[email]<br></li>
                    <li><b>Telefone: </b> $data[phone]<br></li>
                </ul>
            </p>
        ";

        if(!$this->sendEmail('Novo interesse em imóvel', $html)){
          return response()->json(['error' => 'Erro ao enviar o e-mail'], 500);
        }
        return response()->json(['success' => 'E-mail enviado com sucesso'], 200);
    }    


    private function sendEmail($titulo, $html){
      if(!$this->send_email($titulo, $html, config('constants.options.MAIL_DESTINY_ADDRESS'))){
        return false;
      }

      return true;
    }

}
