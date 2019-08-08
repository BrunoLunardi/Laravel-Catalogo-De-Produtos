<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Mail;
class ContatoController extends Controller{
  public function index(){
    $data['titulo'] = "Minha página de contato.";
    return view('contato',$data);
  }
  public function enviar(Request $request){
    $data = array(
      'assunto' => $request->input('assunto'),
      'mensagem' => $request->input('mensagem'),
    );
    Mail::send('mensagem', $data, function ($message) {
      $message->from('nardi273@gmail.com', 'Bruno Lunardi');
      $message->subject("Mensagem encaminhada por meio do formulário de contato.");
      $message->to('nardi273@gmail.com')->cc('nardi273@gmail.com');
    });
    return redirect ('contato');
  }
}


/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//requisições de formulário
use App\Http\Requests;
//para envio de email
use Mail;

class ContatoController extends Controller
{
    //função principal
    public function index(){
        $data['titulo'] = "Minha página de contato.";
        return view('contato', $data);
    }

    //enviar email
    //quanto recebe post do formulário de envio de email
        //rota Route::post('contato/enviar', 'ContatoController@enviar');
    public function enviar(Request $request){
        $data = array(
            'assunto' => $request->input('assunto'),
            'mensagem' => $request->input('mensagem'),
        );

        //Enviar email
        Mail::send('mensagem', $data, function ($message){
            $message->from('usuario@provedor.com', 'Nome que aparece na mensagem.');
            $message->subject("Mensagem encaminhada por meio do formulário de contato.");
            $message->to('nardi273@gmail.com')->cc('nardi273@gmail.com');
        });
        //após envio da mensagem, retorna para a página de contatos
        return redirect('contato');
    }

}
*/