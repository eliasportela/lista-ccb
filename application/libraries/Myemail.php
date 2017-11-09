<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Myemail{
    protected $CI;
  
    public function __construct(){
      $this->CI =& get_instance();
    }
  
    public function EnviarPoRegiao($regiao)
    {
        $config['protocol'] = 'mail'; // define o protocolo utilizado
        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
        $config['validate'] = FALSE; // define se haverá validação dos endereços de email

        $config['mailtype'] = 'html';
        $this->CI->load->library('email');
        // Inicializa a library Email, passando os parâmetros de configuração
        $this->CI->email->initialize($config);
        // Define remetente e destinatário
        $this->CI->email->from('contato@listaccb.com', 'Lista CCB'); // Remetente
          
        //Configurando email
        $sql = "SELECT * FROM contato WHERE id_regiao = $regiao and fg_ativo = 1";
        $result = $this->CI->Crud_model->Query($sql);
        //die(var_dump($result));
        if($result){
          $lista = array();
          foreach ($result as $contato) {
           $lista[] = $contato->email_contato;
          }
          $this->CI->email->to('contato@listaccb.com'); // Destinatário
          $this->CI->email->bcc($lista);
        // Define o assunto do email
          $dia = date('d-m-Y');
          $data['title'] = "Nova Lista em sua Região ". $dia . ":)";
          $data['regiao'] = $regiao;
          $this->CI->email->subject('Lista de Batismo e Diversos '. $dia);
          $this->CI->email->message($this->CI->load->view('adm/mail/generico',$data,TRUE));
          if($this->CI->email->send()){
              return true;
            }else{
              return false;
            }
        }else{
          return true;
        }
    }
  
  public function Cadastrar($dados){
      //pega os dados do parametro
      $this->CI->load->library('email');
      $email = $dados['email']; 
      $nome = $dados['nome'];
      //die(var_dump($dados));
      //Inicia o processo de configuração para o envio do email
      $config['protocol'] = 'mail'; // define o protocolo utilizado
      $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
      $config['validate'] = TRUE; // define se haverá validação dos endereços de email
      $config['mailtype'] = 'html';
      // Inicializa a library Email, passando os parâmetros de configuração
      $this->CI->email->initialize($config);
      // Define remetente e destinatário
      $this->CI->email->from('contato@listaccb.com', 'Lista CCB'); // Remetente
      $this->CI->email->to($email,$nome); // Destinatário
      $this->CI->email->bcc('edwportela@gmail.com');
      $this->CI->email->cc('contato@listaccb.com');
      // Define o assunto do email
      $dia = date('d-m-Y');
      $this->CI->email->subject('Confirmação de Inscrição Lista CCB '.$dia);
      $data['nome'] = $nome;
      $this->CI->email->message($this->CI->load->view('adm/mail/msg-confirmacao',$data,TRUE));
      if($this->CI->email->send()){
          return 1;
       }else {
          return 0;
      }
    }

    public function EnviarEmail($dados){
      //pega os dados do parametro
      $this->CI->load->library('email');
      $email = $dados['email']; 
      $nome = $dados['nome'];
      $assunto = $dados['assunto'];
      //$msg = $dados['msg'];
      //die(var_dump($dados));
      //Inicia o processo de configuração para o envio do email
      $config['protocol'] = 'mail'; // define o protocolo utilizado
      $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
      $config['validate'] = TRUE; // define se haverá validação dos endereços de email
      $config['mailtype'] = 'html';
      // Inicializa a library Email, passando os parâmetros de configuração
      $this->CI->email->initialize($config);
      // Define remetente e destinatário
      $this->CI->email->from('contato@listaccb.com', 'Lista CCB'); // Remetente
      $this->CI->email->to($email,$nome); // Destinatário
      $this->CI->email->bcc('edwportela@gmail.com');
      // Define o assunto do email
      $dia = date('d-m-Y');
      $this->CI->email->subject($assunto .' - '.$dia);
      $data['nome'] = $nome;
      //$data['msg'] = $msg;

      $this->CI->email->message($this->CI->load->view('adm/mail/msg',$data,TRUE));
      if($this->CI->email->send()){
          return 1;
       }else {
          return 0;
      }
    }

}