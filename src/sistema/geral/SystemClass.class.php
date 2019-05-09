<?php
/**
 * Classe que controla o núcleo do sistema
 * @author André de Mello
 * @copyright Agência Inovar.
 * @name System
 * @since 20/07/2011
 */
class System {
	private static $system;
	/**
	 * Converte um padrão brasileiro para americano e vice-versa
	 * 
	 * @author André de Mello
	 * @name converteMoeda
	 * @version 1.0
	 * 
	 * @return string
	 */
	public function autoCompleteCidade(&$bd) {
		$sql = 'SELECT CONCAT(CI.nome, " - ", UF.sigla) AS cidade FROM tbl_cidade CI INNER JOIN tbl_uf UF ON UF.id_uf=CI.id_uf ORDER BY CI.nome';
		$mostraCidades = $bd->query ( $sql );
		$varCidades = '<script> var cidades=[';
		for($i = 0; $i < count ( $mostraCidades ); $i ++) {
			$varCidades .= '"' . utf8_encode ( $mostraCidades [$i] ['cidade'] ) . '",';
		}
		$varCidades = substr ( $varCidades, 0, - 1 );
		$varCidades .= ']; </script>';
		echo $varCidades;
	}
	public function selecionaIdCidade(&$bd, $cidade, $uf) {
		$sql = 'SELECT CI.id_cidade,UF.id_uf FROM tbl_cidade CI INNER JOIN tbl_uf UF ON UF.id_uf=CI.id_uf WHERE (CI.nome="' . $cidade . '" AND UF.sigla="' . $uf . '")';
		$resultado = $bd->query ( $sql );
		return $resultado;
	}
	public function converteMoeda($valor) {
                if($valor == '' || $valor == '0,00' || $valor == '0.00'){
                    return '0.00';}
                else if (strrpos ( $valor, ',' ) != false)
			return (str_replace ( ',', '.', (str_replace ( '.', '', $valor )) ));
		else
			return (number_format ( $valor, 2, ',', '.' ));
                }
	
	/**
	 * transforma telefone sem mascara em telefone com mascara
	 * @param char $telefone
	 * @return string
	 */
	public function escreveTelefone($telefone) {
		return $telefone = '(' . substr ( $telefone, 0, 2 ) . ')' . substr ( $telefone, 2, 4 ) . '-' . substr ( $telefone, 6, 4 ) . '';
	}
	
	/**
	 * valida email sem considerar existência de servidor
	 * @param $email
	 * @return string
	 */
	public function validarEmail($email) {
		if (! filter_var ( $email, FILTER_VALIDATE_EMAIL ))
			return false;
		return true;
	}
	
	/**
	 * tira todos caracteres acentuados e Ç
	 * @param  $var
	 */
	public function limpaString($var) {
		$var = ereg_replace ( "[ÁÀÂÃ]", "A", $var );
		$var = ereg_replace ( "[áàâãª]", "a", $var );
		$var = ereg_replace ( "[ÉÈÊ]", "E", $var );
		$var = ereg_replace ( "[éèê]", "e", $var );
		$var = ereg_replace ( "[ÓÒÔÕ]", "O", $var );
		$var = ereg_replace ( "[óòôõº]", "o", $var );
		$var = ereg_replace ( "[ÚÙÛ]", "U", $var );
		$var = ereg_replace ( "[úùû]", "u", $var );
		$var = str_replace ( "Ç", "C", $var );
		$var = str_replace ( "ç", "c", $var );
		return $var;
	}
	
	/**
	 * converte data padrao americano p/ brasileiro e vice-versa
	 * @param $data
	 */
	public function converteData($data) {
		return implode ( ! strstr ( $data, '/' ) ? "/" : "-", array_reverse ( explode ( ! strstr ( $data, '/' ) ? "-" : "/", $data ) ) );
	}
	
	/**
	 * pega uma string e extrai apenas algarismos
	 * @param string $str
	 * @return int
	 */
	public function soNumero($str) {
		return preg_replace ( "/[^0-9]/", "", $str );
	}
	
	/**
	 * retorna cep com mascara
	 * @param int $cep
	 * @return int
	 */
	public function mostraCEP($cep) {
		return $cep = substr ( $cep, 0, 5 ) . '-' . substr ( $cep, 5, 3 );
	}
	
	/**
	 * retorna CNPJ com mascara
	 * @param int $cnpj
	 * @return char
	 */
	public function mostraCNPJ($cnpj) {
		return $cnpj = substr ( $cnpj, 0, 2 ) . '.' . substr ( $cnpj, 2, 3 ) . '.' . substr ( $cnpj, 5, 3 ) . '/' . substr ( $cnpj, 8, 3 ) . '-' . substr ( $cnpj, 12, 2 );
	}
	
	/**
	 * retorna CPF com mascara
	 * @param int $cpf
	 * @return char
	 */
	public function mostraCPF($cpf) {
		return $cpf = substr ( $cpf, 0, 3 ) . '.' . substr ( $cpf, 3, 3 ) . '.' . substr ( $cpf, 6, 3 ) . '-' . substr ( $cpf, 9, 2 );
	}
	
	/**
	 * retorna a extensao do arquivo
	 * @param $arquivo
	 * return @string;
	 */
	public function verExtensao($arquivo) {
		$extensao = array_reverse ( explode ( ".", $arquivo ) );
		return $extensao [0];
	}
	
	/**
	 * Funcao responsavel pela soma de datas
	 * @param $data - dd/mm/yyyy
	 * @param $dias
	 * @param $meses
	 * @param $ano
	 * @return date - dd/mm/yyyy
	 */
	public function SomarData($data, $dias, $meses, $ano) {
		//passe a data no formato dd/mm/yyyy 
		$data = explode ( "/", $data );
		$newData = date ( "d/m/y", mktime ( 0, 0, 0, $data [1] + $meses, $data [0] + $dias, $data [2] + $ano ) );
		return $newData;
	}

        public function exibeMensagem($msg, $titulo, $redirecionar=NULL){
            $html = '<script>jAlert("'.$msg.'", "'.$titulo.'");</script>';
            if($redirecionar!=NULL)
                $html .= '<script>pageload("'.$redirecionar.'")</script>';
            return $html;
        }
        
        /**
         * $name exibeMensagemAlert - Alternativa do exibe mensagem usando o alert
         * @return string 
         */
        public function exibeMensagemAlert($msg, $titulo, $redirecionar=NULL){
            $html = '<script>alert("'.$msg.'", "'.$titulo.'");</script>';
            if($redirecionar!=NULL)
                $html .= '<script>pageload("'.$redirecionar.'")</script>';
            return $html;
        }


        function enviaEmail($mensagem, $resumo, $assunto, $emailDestinatario, $nomeDestinatario, $emailRemetente, $emailRespostaRemetente, $nomeRemetente, $smtp, $porta, $usuario, $senha, $anexo = NULL, $cc = NULL, $cco = NULL) {

	require_once ('sistema/email/class.phpmailer.php');
	$mail = new PHPMailer ( );
	$mail->CharSet = 'UTF-8';
	if ($smtp == NULL or $smtp == '') {
		if (is_array ( $emailDestinatario )) {
			foreach ( $emailDestinatario as $valorEmail )
				$mail->AddAddress ( $valorEmail, utf8_encode ( $nomeDestinatario ) );
		} else {
			$mail->AddAddress ( $emailDestinatario, utf8_encode ( $nomeDestinatario ) );
		}

		$mail->SetFrom ( $emailRemetente, utf8_encode ( $nomeRemetente ) );
		$mail->AddReplyTo ( $emailRespostaRemetente, utf8_encode ( $nomeRemetente ) );
		$mail->Subject = ($assunto);
		$mail->AltBody = utf8_encode ( $resumo ); // optional - MsgHTML will create an alternate automatically
		$mail->MsgHTML ( $mensagem );
		if($cco!=NULL){
			if(is_array($cco)){
				foreach($cco AS $emailCopiaOculta)
					$mail->AddBCC($emailCopiaOculta, '');
			}else
				$mail->AddBCC ( $cco, '');
		}
		if (! $mail->Send ()) {
			return false;
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} else
			return true;

	} else {
		$mail->IsSMTP (); // telling the class to use SMTP
		$mail->SMTPDebug = false;
		$mail->SMTPAuth = true; // enable SMTP authentication
		if($smtp=='smtp.gmail.com' || $smtp=='smtp.live.com')
			$mail->SMTPSecure = 'tls';
		$mail->Host = $smtp; // SMTP server
		$mail->Host = $smtp; // SMTP server
		$mail->Port = $porta; // set the SMTP port for the LOCAWEB SERVER
		$mail->Username = $usuario; // SMTP account username
		$mail->Password = $senha; // SMTP account password
		$mail->From = $emailRemetente;
		$mail->FromName = utf8_encode ( $nomeRemetente );
		$mail->AddReplyTo ( $emailRespostaRemetente, utf8_encode ( $nomeRemetente ) );
		$mail->Subject = ($assunto);
		$mail->AltBody = utf8_encode ( $resumo ); // optional, comment out and test
		$mail->MsgHTML ( $mensagem );
		if($cco!=NULL){
			if(is_array($cco)){
				foreach($cco AS $emailCopiaOculta)
					$mail->AddBCC($emailCopiaOculta, '');
			}else
				$mail->AddBCC ( $cco, '');
		}
		if ($anexo != NULL) {
			foreach ( $anexo as $valor )
				$mail->AddAttachment ( $valor );
		}
		if (is_array ( $emailDestinatario )) {
			foreach ( $emailDestinatario as $valorEmail ) {
				$mail->AddAddress ( $valorEmail, utf8_encode ( $nomeDestinatario ) );
			}
		} else {
			$mail->AddAddress ( $emailDestinatario, utf8_encode ( $nomeDestinatario ) );
		}
		if ($cc != NULL)
			$mail->AddBcc ( $cc );

		if (! $mail->Send ()) {
			return false;
		} else
			return true;
	}

}
/**
 *
 * @return boll
 */
function verificaSMTP($smtp, $porta, $usuario, $senha) {
	require_once '../class/class.smtp.php';
	$sucesso = 0;
	$mail = new SMTP ( );
	if ($mail->Connect ( $smtp, $porta, 5 ))
		if ($mail->Hello ( $smtp )){
			if ($smtp == 'smtp.gmail.com' ||$smtp == 'smtp.live.com')
				$mail->StartTLS ();
			if ($mail->Authenticate ( $usuario, $senha ))
				$sucesso = 1;
		}
	return $sucesso;
}

	/**
	 * verifica se cpf é valido
	 * @param int $cpf
	 * @return valor booleano
	 */
        public function validaCPF($cpf){
            // Verifiva se o número digitado contém todos os digitos
            $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

            // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
            if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
                return false;
            else
            {   // Calcula os números para verificar se o CPF é verdadeiro
                for ($t = 9; $t < 11; $t++)
                {
                    for ($d = 0, $c = 0; $c < $t; $c++)
                    {
                        $d += $cpf{$c} * (($t + 1) - $c);
                    }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d)
                    return false;
            
                }

            return true;
            }

        } //Fim Valida CPF

        /**
         * verifica se a data é valida
         * @param string $data
         * @return valor booleano
         */
        public function validaData($data){
            $dia = substr($data, 8,2);
            $mes = substr($data, 5,2);
            $ano = substr($data, 0,4);

            $resultado = checkdate($mes, $dia, $ano);
            return $resultado;
            
        } //Fim validaData
        
        /**
         * gera uma senha aleatória
         * @param int $tamanho
         * @return string
         */
        public function gerarSenha($tam, $num=true, $upper_case=true, $lower_case=true){
            $chars = array();

            if($num==true){
            array_push($chars, '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');}

            if($upper_case==true){
            array_push($chars, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');}

            if($lower_case==true){
            array_push($chars, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r','s', 't', 'u', 'v', 'x', 'w', 'y', 'z');}

            $keys = array();

            while(count($keys) < $tam) {
            $x = mt_rand(0, count($chars)-1);
            if(!in_array($x, $keys)) {
            $keys[] = $x;}  }

            $random_chars="";

            foreach($keys as $key){
            $random_chars.= $chars[$key];}

            return $random_chars;} //Fim gerarSenha
            
        /**
         * @name montarGrafico - monta um gráfico
         * @author Wester Cardoso
         * @since 06/02/2012
         * @param $categorias, $valores, $titulo, $div
         * @return grafico
         */
        public function montarGrafico($categoria, $valor, $titulo='Grafico', $div)
        {
            $var = "<script type=\"text/javascript\">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: '$div',
						defaultSeriesType: 'column',
						margin: [ 35, 35, 120, 80]
					},
					title: {
						text: '".$titulo."'
					},
					xAxis: {
						categories: [";
            
                                                foreach($categoria as $aux){
                                                    if($cont) $var .= ",'".$aux['nome']."'";
                                                    else {$var .= "'".$aux['nome']."'"; $cont=1;}   }//Fim foreach
                                                $cont = 0;
                    
                                                $var .= "
                                                    
						],
						labels: {
							rotation: -25,
							align: 'right',
							style: {
								 font: 'normal 13px Verdana, sans-serif'
							}
						}
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Pontos'
						}
					},
					legend: {
						enabled: false
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 'Pontuação do auxílio: '+ Highcharts.numberFormat(this.y, 1);
						}
					},
				        series: [{
						name: 'Pontos',
						data: [";
                                                
                                                foreach($valor as $aux){
                                                    
                                                    if(!isset($aux)) //Se não tiver valor no array passa pro proximo
                                                        continue;
                                                    else{
                                                        if($cont) $var .= ",".$aux[0][0];
                                                        else {$var .= $aux[0][0]; $cont=1;}   } }//Fim foreach
                                                    $cont = 0;
                                                        
                                                    
                                                $var .= "],
						dataLabels: {
							enabled: true,
							rotation: -90,
							color: '#FFFFFF',
							align: 'right',
							x: -3,
							y: 10,
							formatter: function() {
								return this.y;
							},
							style: {
								font: 'normal 18px Verdana, sans-serif'
							}
						}			
					}]
				});
				
				
			});
				
		</script>";
            return $var;
            
        }
        
        /**
         * @name verificaAdm - Verifica se o usuário é adiministrador
         * @since 16/02/2012
         * @author Wester Cardoso
         * @param int id_usuario 
         */
        public function verificaAdm($id_usuario){
            $usuarioDAO = new UsuarioDAO;
            $dados = $usuarioDAO->dadosUsuario($id_usuario);
            if($dados[0]['id_tipousuario'] == 2){ // Se for igual a aluno ele exibe o erro
                echo '<script>jAlert("Você não tem permissão para acessar essa página.")</script>';
                echo '<script>pageload(\'questionario-metodo=addQuestionarioAluno&acao=mostrar\');
                        parent.window.location = \'#questionario-metodo=addQuestionarioAluno&acao=mostrar\'; </script>';
                exit(); }   }
                
                
                
                
        /*  Escreve uma mensagem de erro para o usuário na tela */
        public function escreveMsg($msg, $tipo){
            $html = '<div class="msg_'.$tipo.'">'.$msg.'</div>';
            $html .= '<div class="espaco"></div>';
            return $html;
        }
        
        /*  Mensagem de ajuda para o usuário */
        public function escreveDica($texto){
            return '<p class="dica">'.$texto.'<br /></p>';
        }
        
        /*  Deixa a primeira letra de cada palavra maiúscula */
        public function formataTexto($texto, $encoding=NULL){
            $encoding = ($encoding != NULL) ? $encoding : 'UTF-8';
            return mb_convert_case($texto, MB_CASE_TITLE, $encoding);
        }
        
        /*  Converte todas as letras para minúsculo (Padrão UTF-8)  */
        function strtolower($texto, $encoding=NULL) {
            $encoding = ($encoding != NULL) ? $encoding : 'UTF-8';
            return mb_strtolower($texto, $encoding);
        } 
        
        /*  Converte todas as letras para maiúsculo (Padrão UTF-8) */
        function strtoupper($texto, $encoding=NULL) {
            $encoding = ($encoding != NULL) ? $encoding : 'UTF-8';
            return mb_strtoupper($texto, $encoding);
        } 
        
        /*  Converte apenas a primeira letra para maiúsculo */
        function ucfirst($texto, $encoding=NULL) {
            $encoding = ($encoding != NULL) ? $encoding : 'UTF-8';
            $fc = mb_strtoupper(mb_substr($texto, 0, 1, $encoding), $encoding);
            return $fc.mb_substr($texto, 1, mb_strlen($texto, $encoding), $encoding);
        }

        /*  Converte aspas simples (') em ('') para funcionar no postgres */
        function limpaAspasSimples($texto){
            return str_replace("'", "''", $texto);
        }
        
        /*  Essa função não é dinâmica! Depende dos valores das tabelas Campus e Cidade  */
        function retornaCidadeCampus($id_campus) {
            switch($id_campus):
                case '1':
                    return 56;  /*  Bambuí  */
                    break;
                case '2':
                    return 200;  /* Congonhas  */
                    break;
                case '3':
                    return 291;  /*  Formiga  */
                    break;
                case '4':
                    return 540;  /* Ouro Preto  */
                    break;
                case '5':
                    return 737;  /*  São João Evangelista  */
                    break;
                case '6':
                    return 72;  /*  Betim  */
                    break;
                case '7':
                    return 659;  /*  Sabará  */
                    break;
                case '8':
                    return 637;  /*  Ribeirão das Neves  */
                    break;
                case '9':
                    return 538;  /*  Ouro Branco  */
                    break;
                case '10';
                    return 56;  /*  Campus Bambuí – UFS Oliveira  */
                    break;
                case '11':
                    return 56;  /*  Campus Bambuí – UFS Pompéu  */
                    break;
                case '12':
                    return 56;  /*  Campus Bambuí – UFS Piumhi  */
                    break;
                case '13':
                    return 540;  /*  Campus Ouro Preto – UFS João Monlevade  */
                    break;
                case '14':
                    return 315;  /*  Governador Valadares  */
                    break;
                case '15':
                    return 56;  /*  Campus Bambuí - UFS Bom Despacho  */
                    break;
                case '16':
                    return  291;  /*  Campus Formiga - UFS Arcus  */
                    break;
            endswitch;
        }
                
                
                
                
                
        



} //fim da classe


?>