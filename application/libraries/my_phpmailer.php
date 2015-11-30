<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_PHPMailer {
	
	private $SMTPAuth;
	private $SMTPSecure;
	private $Host;
	private $Port;
	private $Username;
	private $Password;
	private	$From;
	private	$HTML;
	private $SMTPDebug;
	private $lenguaje;
	protected $ci;
	
    public function My_PHPMailer() {
        require_once('libraries/PHPMailer/PHPMailerAutoload.php');
		
		$this->ci =& get_instance();
		$this->ci->load->model('perfil_model');
		
		$config_correo = $this->ci->perfil_model->getConfiguracion();
		
		if($config_correo){
			if($config_correo['autorizacion_smtp'] == 1)
				$this->SMTPAuth 		= TRUE;
			else
				$this->SMTPAuth 		= FALSE;
			
			if($config_correo['html_enable'] == 1)
				$this->HTML 		= TRUE;
			else
				$this->HTML 		= FALSE;
			
			$this->SMTPSecure 		= $config_correo['seguridad_smtp'];
			$this->Host				= $config_correo['host'];
			$this->Port				= $config_correo['puerto'];
			$this->SMTPDebug		= 4;
				
			$this->Username			= $config_correo['correo'];
			$this->Password			= "tmsgroup2015";
			$this->From				= utf8_decode($config_correo['from']);
			$this->lenguaje			= $config_correo['lenguaje'];	
		}	
    }
	
	

	
	public function send($mensaje,$destino,$asunto){
		
		$mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->SMTPAuth   	= $this->SMTPAuth; 
        $mail->SMTPSecure 	= $this->SMTPSecure;  
        $mail->Host       	= $this->Host;
        $mail->Port       	= $this->Port;
		$mail->isHTML($this->HTML);
		$mail->SMTPDebug 	= $this->SMTPDebug;
		$mail->SetLanguage($this->lenguaje);
		
        $mail->Username   	= $this->Username;
        $mail->Password   	= $this->Password;
        $mail->SetFrom($this->Username,$this->From);  
        $mail->AddReplyTo($this->Username,$this->From); 
        
        $mail->Subject    	= $asunto;
        $mail->Body      	= $mensaje;
        
        $mail->AddAddress($destino);
		
		if(!$mail->Send()) {
            $return =  "Error: " . $mail->ErrorInfo;
        } else {
            $return =  "Message sent correctly!";
        }
		
		return $return;
	}
}
?>