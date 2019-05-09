<?php
require_once 'Questionario.class.php';
require_once 'QuestionarioDAO.class.php';
require_once 'sistema/usuario/UsuarioDAO.class.php';
require_once 'QuestionarioView.class.php';
require_once 'sistema/geral/SystemClass.class.php';

class QuestionarioControle extends System{

        public function editar(){
            $this->verificaAdm($_SESSION['id_usuario']);
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            switch ($acao){
                case 'editar':
                    echo 'editando...';
                break;
                default :
                    $questionarioDAO = new QuestionarioDAO();
                    $dados = $questionarioDAO->dadosQuestionario($id);
                    $dadosCampos = $questionarioDAO->dadosCampus($id);
                    $questionarioView->formQuestionario('editar', $dados);
                    echo '<div id="div_rodaFuncao">';
                    $questionarioView->formQuestionario2Passo('editar', $dados, $dadosCampos);
                    echo '</div>';

            }
        }

        public function preencherPerguntas(){
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            
            switch($pergunta){
                case 9:
                    if($id_curso==1){
                        $listagemCidades = $questionarioDAO->buscaCidadesCurso();
                        echo $questionarioView->montaSelectQuestionario('', 'cmb_cidadesCurso', 'cmb_cidadesCurso', 'Em qual cidade está cursando', 'validate[required] inputQuestionario', $listagemCidades, NULL, NULL);
                    }
                    break;
                case 12: //Mudar numero depois
                    if ($id_campus != NULL && $chk_filho != 'undefined'):
                        $listagemBeneficios = $questionarioDAO->buscaBeneficios($id_questionario, $id_campus, $chk_filho, $chk_resideNucleoFamiliar);
                    else:
                        $listagemBeneficios = array();
                    endif;
                        
                    echo $questionarioView->montaSelectQuestionario('multiple', 'cmb_beneficios', 'cmb_beneficios', 'Benefícios <span class="show-tooltip" title="Os benefícios só irão aparecer depois de selecionar o campus, responder se tem filhos e se reside com o núcleo familiar!"><span class="textoObs" width="110%">Atenção <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>', 'multiselect', $listagemBeneficios, $beneficio, NULL, NULL, $readOnly, 1);
                    echo '<a class="fancybox" href="#ajudaAuxilio" title="Saiba mais sobre cada auxílio"><img src="sistema/geral/imagens/interrogacao.png" width="28px" height="28px" align="absmiddle" /></a>';
                    break;
                    
                case 'auxilio':
                    if ($recebeuAuxilio == 'S'):
                        $listaAuxilio = $questionarioDAO->buscaTodosBeneficios();
                        echo $questionarioView->montaSelectQuestionario('multiple', 'auxilioAnterior', 'slc_auxilioAnterior', 'Informe o auxílio recebido:', 'validate[required] inputQuestionario multiselect', $listaAuxilio);
                    endif;
                    break;
                    
                case 17:
                    if($temFilhos=='S'){
                        $numeroFilhos[0]['id'] = 1;
                        $numeroFilhos[0]['nome'] = 1;
                        $numeroFilhos[1]['id'] = 2;
                        $numeroFilhos[1]['nome'] = 2;
                        $numeroFilhos[2]['id'] = 3;
                        $numeroFilhos[2]['nome'] = '3 ou mais';
                        $numeroFilhosAte6Anos[0]['id'] = 0;
                        $numeroFilhosAte6Anos[0]['nome'] = 'Nenhum';
                        $numeroFilhosAte6Anos[1]['id'] = 1;
                        $numeroFilhosAte6Anos[1]['nome'] = 1;
                        $numeroFilhosAte6Anos[2]['id'] = 2;
                        $numeroFilhosAte6Anos[2]['nome'] = 2;
                        $numeroFilhosAte6Anos[3]['id'] = 3;
                        $numeroFilhosAte6Anos[3]['nome'] = 3;
                        $numeroFilhosAte6Anos[4]['id'] = 4;
                        $numeroFilhosAte6Anos[4]['nome'] = 'Mais de 3';
                        echo $questionarioView->montaSelectQuestionario('', 'cmb_numeroFilhos', 'cmb_numeroFilhos', 'Quantos filhos', 'validate[required] inputQuestionario', $numeroFilhos, NULL, NULL);
                        echo $questionarioView->montaSelectQuestionario('', 'cmb_numeroFilhos6Anos', 'cmb_numeroFilhos6Anos', 'Quantos dos seus filhos possui até 6 anos', 'validate[required] inputQuestionario', $numeroFilhosAte6Anos, NULL, NULL);
                    }
                    break;
               case 31:
                   if($resideFamilia=='N'){
                       $resideFamilia = array('Sozinho(a)', 'Parentes', 'Pensão/Hotel', 'República', 'Outros'); $i=0; $listagemLocalReside='';
                       foreach($resideFamilia as $valor){
                       $listagemLocalReside[$i]['id'] .= $valor;
                       $listagemLocalReside[$i]['nome'] .= $valor; $i++; }
                       
                       $html = $questionarioView->montaSelectQuestionario('', 'cmb_local_reside', 'cmb_local_reside', 'Com quem você mora', 'validate[required] inputQuestionario', $listagemLocalReside, $questionarioResposta[0]['local_reside']);  
                       $html .= $questionarioView->inputTextQuestionario('text', 'cep2', 'txt_cep2', 'CEP do local onde <strong> <font color="#9B2038">você</font> </strong>reside', 40, 'validate[required] inputQuestionario', System::mostraCEP($questionarioResposta[0]['cep']), 'cep', 1, NULL, $readOnly, NULL, 'onchange="consultaCEP2();"');
                       $html .= '<div id="div_cep2">';
                       $html .= $questionarioView->montaSelectQuestionario('', 'cmb_uf2', 'cmb_uf2', 'Estado', 'validate[required] inputQuestionario', $questionarioDAO->buscaLocal('Estado'), $id_uf, 'onchange="carregaCidades();"', NULL, $readOnly);
                       $html .= '<div id="div_cidade2">'.$questionarioView->montaSelectQuestionario('', 'cmb_cidade2', 'cmb_cidade2', 'Cidade', 'validate[required] inputQuestionario', array(), $id_cidade, NULL, NULL, $readOnly).'</div>';
                       $html .= $questionarioView->inputTextQuestionario('text', 'txt_bairro2', 'txt_bairro2', 'Bairro', 40, 'validate[required] inputQuestionario', utf8_encode($bairro), NULL, 1, $readOnly);
                       $html .= $questionarioView->inputTextQuestionario('text', 'txt_logradouro2', 'txt_logradouro2', 'Logradouro (Avenida, Rua, Travessa, etc)', 40, 'validate[required] inputQuestionario', utf8_encode($logradouro), NULL, 1, $readOnly);
                       $html .= $questionarioView->inputTextQuestionario('text', 'txt_numeroComplemento2', 'txt_numeroComplemento2', 'Número/Complemento', 40, 'validate[required] inputQuestionario', $numeroComplemento, NULL, 1, $readOnly);
                       $html .= '</div>';
                    }
                    
                   echo $html;
                   break;
                   
               case 33:
                   if($temDeficiencia=='S'){
                       $listaDeficiencia = $questionarioDAO->buscaDeficiencia();
                       echo $questionarioView->montaSelectQuestionario('', 'cmb_deficiencia', 'cmb_deficiencia', 'Qual deficiência', 'validate[required] inputQuestionario', $listaDeficiencia);
                   }
                   break;
               case 45:
                   if($rad_bpc=='S')
                       $html = $questionarioView->inputText ('text', 'txt_rendaBPC', 'txt_rendaBPC', 'Informe o valor', '40', 'validate[required,min[0.01]] inputQuestionario', System::converteMoeda($rendaBPC), 'moeda', 1);
                   echo $html; 
                   break;
               case 46:
                   if($temVeiculo=='S'){
                       // VERIFICAR NOME DO ID DO GRUPO FAMILIAR
                       $proprietario = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $_POST['txt_id_grupoFamiliar']);
                       echo $questionarioView->montaSelectQuestionario('', 'cmb_proprietario', 'cmb_proprietario[]', 'Proprietário', 'validate[required] inputQuestionario', $proprietario);
                       echo $questionarioView->inputTextQuestionario('text', 'marca', 'marca', 'Marca', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                       echo $questionarioView->inputTextQuestionario('text', 'modelo', 'modelo', 'Modelo', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                       echo $questionarioView->inputTextQuestionario('text', 'ano', 'ano', 'Ano', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                       echo $questionarioView->inputTextQuestionario('text', 'tipo', 'tipo', 'Tipo', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                       echo $questionarioView->inputTextQuestionario('text', 'utilidade', 'utilidade', 'Utilidade', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                       echo $questionarioView->inputTextQuestionario('text', 'ipva', 'ipva', 'Valor do Ipva', 40, 'validate[required] inputQuestionario', NULL, NULL, 1);
                   }
                   break;
                       
               case 54:
                   if($id_uf==NULL)
                       $id_uf = -1;
                   echo $questionarioView->montaSelect('', 'cmb_cidade', 'cmb_cidade', 'Local(Cidade)', 'validate[required] inputQuestionario', $questionarioDAO->buscaLocal(NULL, $id_uf), NULL);
                   break;

               case 58:
                   echo $questionarioView->montaSelectQuestionario('', 'cmb_cidade', 'cmb_cidade[]', 'Local(Cidade)', 'validate[required] inputQuestionario', $questionarioDAO->buscaLocal(NULL, NULL, $_POST['id_uf']));
                   break;
               case 63:
                   $cmb_escolaridadeProvedor = $questionarioDAO->montaCmb('', '', '', '', '', 'escolaridadeProvedor');
                   if($id_provedor == 'Pai e mãe'){
                       $html = $questionarioView->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor', 'cmb_escolaridadeProvedor', 'Informe a escolaridade do seu pai:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $questionarioResposta[0]['escolaridadeProvedor'], NULL, NULL, $readOnly);
                       $html .= $questionarioView->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor_2', 'cmb_escolaridadeProvedor_2', 'Informe a escolaridade da sua mãe:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $questionarioResposta[0]['escolaridadeProvedor_2'], NULL, NULL, $readOnly);
                   }else{
                       $html = $questionarioView->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor', 'cmb_escolaridadeProvedor', 'Qual a escolaridade do provedor do seu Núcleo Familiar:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $escolaridade_provedor, NULL, NULL, $readOnly);}
                   echo $html;
                   break;
               }
        }

        public function editarQuestionario(){
            $this->verificaAdm($_SESSION['id_usuario']);
            extract($_REQUEST);
            //verifica se tem pelo menos 1 beneficio p/ cada campus
            $erro = 0;
            
            // Verifica se a Data do Inicio é menor que a Data Fim *** Arrumar um FeedBack depois!
            while ($outro = current($txt_dataFim)) { //Percorre o array
                $indice =  key($txt_dataFim); // Armazena o índice em uma variável para acessar o Data_Inicio

                // Converte as datas para comparar
                $inicio = strtotime( System::converteData($txt_dataInicio[$indice]) );
                $fim = strtotime( System::converteData($txt_dataFim[$indice]) );

                if($fim < $inicio) // Se a data do fim for menor que a do incio da erro
                    $erro_data = 1;
                next($txt_dataFim);     }

                if($erro_data==1){
                    echo System::exibeMensagem('A data para o final do edital não pode ser menor que a data de início! \nSe preferir deixe a data em branco.','Atenção');
                    exit();}
            
            // Mesmo problema do Adicionar Questionario
            $cmb_campus = str_replace('\\','',$cmb_campus);
            
            foreach (unserialize($cmb_campus) AS $valor){
                if(!isset($multiselect_cmb_beneficio[$valor])){
                    echo System::exibeMensagem('Favor vincular pelo menos um benefício por campus!', 'Selecionar benefício');
                    $erro = 1;
                    break;
                }
            }
            if(!$erro){
                //faz a edicao
                $questionarioDAO = new QuestionarioDAO();
                 
                $controle = $questionarioDAO->adicionarQuestionario($txt_nome, $cmb_campus, $txt_dataInicio, $txt_dataFim, $multiselect_cmb_beneficio, $txt_id_questionario);
                if ($controle == '1'):
                    echo System::exibeMensagem('Questionário editado com sucesso', 'Questionário Editado!', 'questionario.php?metodo=verQuestionario&acao=visualizar');
                else:  /*  Da um feedback para a pessoa  */
                    $campusErro = explode(';', $controle);
                    foreach ($campusErro as $id_campus):
                        $res = $questionarioDAO->nomeCampus($id_campus);
                        $msg .= $res[0][0].', ';
                    endforeach;
                    
                    echo $this->escreveMsg("Os campus ( <strong>" .  substr($msg, 0, strlen($msg)-2). "</strong> ) não podem ser excluídos pois alguns alunos já responderam esse questionário!<br />Contate os Administradores do Sistema caso precise dessa alteração.", 'warning');
                endif;
            }
        }
        
	public function addQuestionario(){
                $this->verificaAdm($_SESSION['id_usuario']);
		extract($_REQUEST);
                $questionarioView = new QuestionarioView();
                switch($acao){
                    //vai para 2passo
                    case 'passo1':
                        //verifica se tem campus selecionado
                        if(!isset($multiselect_cmb_campus))
                            echo System::exibeMensagem('Favor selecionar pelo menos um Campus!', 'Selecionar Campus');
                        else{
                            if($editar==1){
                                $metodo = 'editar';
                            }else
                                $metodo = 'adicionar';
                            $questionarioView->formQuestionario2Passo ($metodo, NULL, $multiselect_cmb_campus);
                        }break;
                    //adiciona o questionário
                    case 'adicionar':
                        //verifica se tem pelo menos 1 beneficio p/ cada campus
                        $erro = 0;
                       
                        // Verifica se a Data do Inicio é menor que a Data Fim *** Arrumar um FeedBack depois!
                        while ($outro = current($txt_dataFim)) { //Percorre o array
                            $indice =  key($txt_dataFim); // Armazena o índice em uma variável para acessar o Data_Inicio
                            
                            // Converte as datas para comparar
                            $inicio = strtotime( System::converteData($txt_dataInicio[$indice]) );
                            $fim = strtotime( System::converteData($txt_dataFim[$indice]) );
                            
                            if($fim < $inicio) // Se a data do fim for menor que a do incio da erro
                                $erro_data = 1;
                            next($txt_dataFim);     }
                            
                            if($erro_data==1){
                                echo System::exibeMensagem('A data para o final do edital não pode ser menor que a data de início! \nSe preferir deixe a data final em branco.','Atenção');
                                exit();}
                        
                        // Verificar o real problema depois! str_replace para retirar as barras.
                        $cmb_campus = str_replace('\\','',$cmb_campus);
                        
                        foreach (unserialize($cmb_campus) AS $valor){
                            if(!isset($multiselect_cmb_beneficio[$valor])){
                                echo System::exibeMensagem('Favor vincular pelo menos um benefício por campus!', 'Selecionar benefício');
                                $erro = 1;
                                break;
                            }
                        }
                        if(!$erro){
                            //faz a inserção
                            $questionarioDAO = new QuestionarioDAO();
                            if($questionarioDAO->adicionarQuestionario($txt_nome, $cmb_campus, $txt_dataInicio, $txt_dataFim, $multiselect_cmb_beneficio))
                                echo System::exibeMensagem('Questionário adicionado com sucesso', 'Questionário Adicionado!', 'questionario.php?metodo=addQuestionario&acao=mostrar');
                            else
                                echo 'erro';
                        }
                        break;
                    default:
                        $questionarioView->formQuestionario('adicionar', null);
                }
	}

        public function addQuestionarioAluno(){
            $questionarioDAO = new QuestionarioDAO();
            $questionarioView = new QuestionarioView();
            //carrega questionarios disponiveis
            $questionariosDisponiveis = $questionarioDAO->questionariosDisponiveis();
            //carrega questionarios preenchidos
            $questionariosPreenchidos = $questionarioDAO->questionariosPreenchidos($_SESSION['id_usuario']);
            //exibe tabelas
            $questionarioView->mostraQuestionariosAluno($questionariosDisponiveis, $questionariosPreenchidos);
        }

	public function verQuestionario(){
            $this->verificaAdm($_SESSION['id_usuario']);
            $questionarioDAO = new QuestionarioDAO();
            $questionarioView = new QuestionarioView();
            $listaQuestionario = $questionarioDAO->listaQuestionarios();
            $questionarioView->listaQuestionario($listaQuestionario);
	}

        public function preencherQuestionario($id_questionarioResposta=NULL){
            extract($_REQUEST);
            require_once 'sistema/usuario/UsuarioDAO.class.php';
            $questionarioDAO = new QuestionarioDAO();
            $questionarioView = new QuestionarioView();
            
            //pega id_questionario
            $id = $questionarioDAO->pegaIdQuestionario($id_questionarioPeriodo);
            if($id_questionarioResposta==NULL){
                //preenche variaives com null
            }else{
                //preenche variaveis
            }
            //se existir o passo pega o id_questionarioresposta
            if(isset($passo) || isset($id_questionarioResposta)){
                if(isset($id_questionarioResposta))
                    $id_questionarioResposta = $id_questionarioResposta;
                else{
                    $id_questionarioResposta = $questionarioDAO->pegaIdQuestionarioResposta($_SESSION['id_usuario'], $id_questionarioPeriodo);
                    $id_questionarioResposta = $id_questionarioResposta[0]['id_questionarioresposta'];
                }
            }else
                $id_questionarioResposta = NULL;


            $usuarioDAO = new UsuarioDAO();
            $dadosUsuario = $usuarioDAO->dadosUsuario($_SESSION['id_usuario']);
            $questionarioResposta = NULL;
            $questionarioResposta[0]['nome'] = $dadosUsuario[0]['nome'];
            if($dadosUsuario[0]['sexo']=='M'){
                $questionarioResposta[0]['sexo']['masculino'] = 'checked="checked"';
                $questionarioResposta[0]['sexo']['feminino'] = '';
            }else{
                $questionarioResposta[0]['sexo']['feminino'] = 'checked="checked"';
                $questionarioResposta[0]['sexo']['masculino'] = '';
            }
            $questionarioResposta[0]['dataNascimento'] = $dadosUsuario[0]['datanascimento'];
            $questionarioResposta[0]['carteiraDeIdentidade'] = $dadosUsuario[0]['carteiraidentidade'];
            $questionarioResposta[0]['orgaoExpedidor'] = $dadosUsuario[0]['orgaoexpedidor'];
            $questionarioResposta[0]['telefone'] = $dadosUsuario[0]['telefone'];
            $questionarioResposta[0]['celular'] = $dadosUsuario[0]['celular'];
            $questionarioResposta[0]['cpf'] = $dadosUsuario[0]['cpf'];
            $questionarioResposta[0]['email'] = $dadosUsuario[0]['email'];
            $questionarioResposta[0]['id_questionarioResposta'] = $id_questionarioResposta;
            $listagemCursos = $questionarioDAO->buscaCursos();
            
            $listagemTurno = $questionarioDAO->buscaTurno();
            $listagemEstadoCivil = $questionarioDAO->buscaSituacaoCivil();
            $listagemSituacaoImovel = $questionarioDAO->buscaSituacaoImovel();
            $listagemDistancia = $questionarioDAO->buscaDistancia();
            
            switch($passo){
                case 2:
                    //passo2
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'] = $dadosQuestionario[0]['id_questionarioresposta'];
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                        $questionarioResposta[0]['tipoescola'] = $dadosQuestionario[0]['id_tipoescola'];
                        $questionarioResposta[0]['frequencia'] = $dadosQuestionario[0]['id_frequencia'];
                        $questionarioResposta[0]['outroCurso'] = $dadosQuestionario[0]['id_estacursando'];
                        $questionarioResposta[0]['situacaoTrab'] = $dadosQuestionario[0]['id_situacaotrabalho'];
                        $questionarioResposta[0]['situacaoTrab_pai'] = $dadosQuestionario[0]['id_situacaotrabalhopai'];
                        $questionarioResposta[0]['escolaridadePai'] = $dadosQuestionario[0]['id_escolaridadepai'];
                        $questionarioResposta[0]['situacaoTrab_mae'] = $dadosQuestionario[0]['id_situacaotrabalhomae'];
                        $questionarioResposta[0]['escolaridadeMae'] = $dadosQuestionario[0]['id_escolaridademae'];
                        if($dadosQuestionario[0]['concluiusuperior']=='S')
                            $questionarioResposta[0]['cursoSuperior']['s'] = 'checked="checked"';
                        if($dadosQuestionario[0]['concluiusuperior']=='N')
                            $questionarioResposta[0]['cursoSuperior']['n'] = 'checked="checked"';
                    }

                    $cmb_tipoEscola = $questionarioDAO->montaCmb('tipoEscola');
                    $cmb_anosEscola = $questionarioDAO->montaCmb(NULL, 'anosEscola');
                    $cmb_outroCurso = $questionarioDAO->montaCmb(NULL, NULL, 'outroCurso');
                    $cmb_situacaoTrab = $questionarioDAO->montaCmb(NULL, NULL, NULL, 'situacaoTrab');
                    $cmb_situacaoTrab_pai = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, 'situacaoTrab_pai');
                    $cmb_escolaridade = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');

                    $questionarioView->mostraPasso2($id_questionarioPeriodo, $questionarioResposta, $cmb_tipoEscola, $cmb_anosEscola, $cmb_outroCurso, $cmb_situacaoTrab, $cmb_situacaoTrab_pai, $cmb_escolaridade);
                break;

                case 3:
                    if ($id_questionarioResposta):
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'] = $id_questionarioResposta;
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                    endif;
                    
                    $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($id_questionarioResposta);
                    $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                    
                    if ($dadosQuestionario[0]['familiabeneficiocontinuo'] == 'S'):
                        $questionarioResposta[0]['familiabeneficiocontinuo']['s'] = 'checked="checked"';
                    else:
                        $questionarioResposta[0]['familiabeneficiocontinuo']['n'] = 'checked="checked"';
                    endif;
                    
                    $questionarioView->mostraPasso3($id_questionarioPeriodo, $questionarioResposta, $dadosNucleo[1], $dadosNucleo[0]);
                    break;
                case 4:                    
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'];
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];}
                    $dadosVeiculos = $questionarioDAO->pegaVeiculos($id_questionarioResposta);
                    $questionarioView->mostraPasso4($id_questionarioPeriodo, $questionarioResposta, $dadosVeiculos[1], $dadosVeiculos[0]);
                break;

                case 5:                    
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'];
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];}
                    $dadosImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
                    $questionarioView->mostraPasso5($id_questionarioPeriodo, $questionarioResposta, $dadosImovel[1], $dadosImovel[0]);
                break;
            
                case 6:
                    //passo6
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'] = $id_questionarioResposta;
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                        $questionarioResposta[0]['provedor'] = $dadosQuestionario[0]['id_grupofamiliar_provedor'];
                        $questionarioResposta[0]['escolaridadeProvedor'] = $dadosQuestionario[0]['id_escolaridade_provedor'];
                        $questionarioResposta[0]['escolaridadeProvedor_2'] = $dadosQuestionario[0]['id_escolaridade_provedor_2'];
                    }

                    $cmb_provedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, $id_questionarioResposta);
                    $cmb_escolaridadeProvedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');

                    $questionarioView->mostraPasso6($id_questionarioPeriodo, $questionarioResposta, $cmb_provedor, $cmb_escolaridadeProvedor);
                break;

                case 7:
                    //passo7
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'] = $id_questionarioResposta;
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                        $questionarioResposta[0]['agua'] = $dadosQuestionario[0]['despesaagua'];
                        $questionarioResposta[0]['luz'] = $dadosQuestionario[0]['despesaluz'];
                        $questionarioResposta[0]['telefone'] = $dadosQuestionario[0]['despesatelefone'];
                        $questionarioResposta[0]['condominio'] = $dadosQuestionario[0]['despesacondominio'];
                        $questionarioResposta[0]['escola_faculdade'] = $dadosQuestionario[0]['despesaescolafaculdade'];
                        $questionarioResposta[0]['alimentacao'] = $dadosQuestionario[0]['despesaalimentacao'];
                        $questionarioResposta[0]['saude_medicamentos'] = $dadosQuestionario[0]['despesasaudemedicamentos'];
                        $questionarioResposta[0]['transporte'] = $dadosQuestionario[0]['despesatransporte'];
                        $questionarioResposta[0]['aluguel'] = $dadosQuestionario[0]['despesaaluguel'];
                        $questionarioResposta[0]['financiamento_consorcios'] = $dadosQuestionario[0]['despesafinanciamentoconsorcio'];
                        $questionarioResposta[0]['funcionarios'] = $dadosQuestionario[0]['despesafuncionarios'];
                        $questionarioResposta[0]['outros'] = $dadosQuestionario[0]['despesaoutros'];
                    }
                    
                    //$questionarioView->mostraPasso7($id_questionarioPeriodo, $questionarioResposta);
                break;

                case 8:
                    if($id_questionarioResposta){
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $questionarioResposta[0]['id_questionarioResposta'] = $id_questionarioResposta;
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                        if($questionarioResposta[0]['id_status'] == 2)
                            $questionarioResposta[0]['checkbox'] = ' checked="checked" ';}
                    $dadosUsuario = $usuarioDAO->dadosUsuario($_SESSION['id_usuario']);
                    $nome = $dadosUsuario[0]['nome'];
                    $cpf = $dadosUsuario[0]['cpf'];
                    $questionarioView->mostraPasso8($id_questionarioPeriodo, $questionarioResposta, $nome, $cpf);
                break;

                default:
                    //passo 1
                    //pega dados se ja tiver sido preenchido
                    if($id_questionarioResposta!=NULL){
                        //pega dados, turno e beneficio
                        $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
                        $dadosTurno = $questionarioDAO->pegaTurnoQuestionarioResposta($id_questionarioResposta);
                        $dadosBeneficio = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta);
                        //vai preenchendo os campos de respostas para passar por parametro para ja estar preenchido
                        //exit(print_r($dadosQuestionario));
                        $questionarioResposta[0]['id_status'] = $dadosQuestionario[0]['id_status'];
                        $questionarioResposta[0]['id_questionarioresposta'] = $dadosQuestionario[0]['id_questionarioresposta'];
                        $questionarioResposta[0]['id_curso'] = $dadosQuestionario[0]['id_curso'];
                        $questionarioResposta[0]['id_cidadeCursando'] = $dadosQuestionario[0]['id_cidadefic'];
                        $questionarioResposta[0]['id_campus'] = $dadosQuestionario[0]['id_campus'];
                        $questionarioResposta[0]['matricula'] = $dadosQuestionario[0]['numeromatricula'];
                        $questionarioResposta[0]['anoSemestreIngresso'] = $dadosQuestionario[0]['anosemestreinicio'];
                        $questionarioResposta[0]['id_situacaoCivil'] = $dadosQuestionario[0]['id_estadocivil'];
                        $questionarioResposta[0]['id_situacaoImovel'] = $dadosQuestionario[0]['id_situacaoimovel'];
                        $questionarioResposta[0]['id_distanciaIFMG'] = $dadosQuestionario[0]['id_distanciaresidencia'];
                        $questionarioResposta[0]['numMembrosFamiliar'] = $dadosQuestionario[0]['nummembrosfamiliar'];
                        $questionarioResposta[0]['id_deficiencia'] = $dadosQuestionario[0]['id_deficiencia'];
                        $questionarioResposta[0]['numeroFilhos'] = $dadosQuestionario[0]['numerofilhos'];
                        $questionarioResposta[0]['filhosAte6Anos'] = $dadosQuestionario[0]['filhosate6anos'];
                        $questionarioResposta[0]['id_auxilioanterior'] = $dadosQuestionario[0]['id_auxilioanterior'];
                        //cep
                        $questionarioResposta[0]['cep'] = $dadosQuestionario[0]['cep'];
                        $questionarioResposta[0]['id_cidade'] = $dadosQuestionario[0]['id_cidade'];
                        $questionarioResposta[0]['id_uf'] = $dadosQuestionario[0]['id_uf'];
                        $questionarioResposta[0]['logradouro'] = $dadosQuestionario[0]['logradouro'];
                        $questionarioResposta[0]['numerocomplemento'] = $dadosQuestionario[0]['numerocomplemento'];
                        $questionarioResposta[0]['bairro'] = $dadosQuestionario[0]['bairro'];
                        $questionarioResposta[0]['cep2'] = $dadosQuestionario[0]['cep2'];
                        $questionarioResposta[0]['id_cidade2'] = $dadosQuestionario[0]['id_cidade2'];
                        $questionarioResposta[0]['id_uf2'] = $dadosQuestionario[0]['id_uf2'];
                        $questionarioResposta[0]['logradouro2'] = $dadosQuestionario[0]['logradouro2'];
                        $questionarioResposta[0]['numerocomplemento2'] = $dadosQuestionario[0]['numerocomplemento2'];
                        $questionarioResposta[0]['bairro2'] = $dadosQuestionario[0]['bairro2'];
                        if($dadosQuestionario[0]['deficiencia']=='S'){
                            $questionarioResposta[0]['rad_deficiencia']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_deficiencia']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_deficiencia']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_deficiencia']['s'] = '';
                        }
                        if($dadosQuestionario[0]['familiaassistidabeneficios']=='S'){
                            $questionarioResposta[0]['rad_outrosComponentesAssistidos']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_outrosComponentesAssistidos']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_outrosComponentesAssistidos']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_outrosComponentesAssistidos']['s'] = '';
                        }
                        if($dadosQuestionario[0]['residecomfamilia']=='S'){
                            $questionarioResposta[0]['rad_resideFamilia']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_resideFamilia']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_resideFamilia']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_resideFamilia']['s'] = '';
                        }
                        $questionarioResposta[0]['local_reside'] = $dadosQuestionario[0]['localreside'];
                        if($dadosQuestionario[0]['recebeuauxiliosemestreanterior']=='S'){
                            $questionarioResposta[0]['rad_recurso']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_recurso']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_recurso']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_recurso']['s'] = '';
                        }
                        if($dadosQuestionario[0]['parenteestudacampus']=='S'){
                            $questionarioResposta[0]['rad_parente']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_parente']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_parente']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_parente']['s'] = '';
                        }
                        if($dadosQuestionario[0]['possuifilhos']=='S'){
                            $questionarioResposta[0]['rad_filho']['s'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_filho']['n'] = '';
                        }else{
                            $questionarioResposta[0]['rad_filho']['n'] = 'checked="checked"';
                            $questionarioResposta[0]['rad_filho']['s'] = '';
                        }
                        //beneficios
                        foreach($dadosBeneficio AS $valorBeneficio)
                            $beneficio[] = $valorBeneficio['id_beneficio'];
                        //turno
                        foreach($dadosTurno AS $valorTurno)
                            $turno[] = $valorTurno['id_turno'];
                    }else
                        $beneficio = $turno = NULL;

                    $campus = str_replace('_', ' ', $campus);
                    $id_campus = $questionarioDAO->pegaIdCampus($campus);
                    $listagemCampus = $questionarioDAO->buscaCampus(NULL, $id_campus[0][0]);
                    
                    if($id_questionarioResposta==NULL):
                        $questionarioResposta[0]['id_campus'] = $id_campus[0][0];
                    endif;
                    
                    if($beneficio)
                        $listagemBeneficios = $questionarioDAO->buscaBeneficios($id,$dadosQuestionario[0]['id_campus'], $dadosQuestionario[0]['possuifilhos'], $dadosQuestionario[0]['residecomfamilia'] );
                    else
                        $listagemBeneficios = array();
                    
                    $id_questionario = $id; //Armazena o ID questionario para carregar o Campus
                    $questionarioView->mostraPasso1($id_questionarioPeriodo, $questionarioResposta, $listagemCursos, $listagemCampus, $listagemBeneficios, $listagemTurno, $listagemEstadoCivil, $listagemSituacaoImovel, $listagemDistancia, $beneficio, $turno, $id_questionario, $listagemLocalReside);
                break;


            }


        } //fim Mostra Passo

        public function adicionarPasso1(){
            $questionarioDAO = new QuestionarioDAO();
            extract($_REQUEST);
            if(!isset($multiselect_cmb_beneficios)){
                echo System::exibeMensagem('Favor selecionar pelo menos um benefício!', 'Selecionar Benefício');
                $erro = 1;
            }elseif(!isset($multiselect_cmb_turno)){
                echo System::exibeMensagem('Favor selecionar pelo menos um turno!', 'Selecionar Turno');
                $erro = 1;
            }
            
            if ($rad_recurso == 'S' && $multiselect_auxilioAnterior == NULL):
                echo System::exibeMensagem('Informe qual o auxílio foi recebido anteriormente!', 'Informar Auxílio');
                $erro = 1;
            endif;
            
            if($erro)            
            exit();
            
            /*  Verificação por segurança  */
            
            
            
            if ($rad_recurso == 'S' && $multiselect_auxilioAnterior != NULL):
                foreach ($multiselect_auxilioAnterior as $val):
                    $txt_auxilioAnterior .= $val.';';
                endforeach;
            endif;
            
            if($cmb_deficiencia==NULL)
                $cmb_deficiencia = 'NULL';
            if($cmb_cidadesCurso==NULL)
                $cmb_cidadesCurso = 'NULL';
            if($cmb_numeroFilhos6Anos==NULL)
                $cmb_numeroFilhos6Anos = 'NULL';
            if($cmb_numeroFilhos==NULL)
                $cmb_numeroFilhos = 'NULL';
            if($questionarioDAO->adicionarPasso1($txt_id_questionario, $txt_id_questionarioResposta, $cmb_curso, $cmb_campus, $_SESSION['id_usuario'], $_SESSION['id_tipousuario'], $cmb_situacaoImovel, $cmb_distanciaIFMG, $cmb_deficiencia, $multiselect_cmb_turno, $cmb_situacaoCivil, $cmb_cidade, $cmb_cidadesCurso, $txt_matricula, $txt_logradouro, $txt_numeroComplemento, $txt_cep, $txt_anoSemestreIngresso, $rad_filho, $cmb_numeroFilhos, $cmb_numeroFilhos6Anos, $rad_parente, $rad_recurso, $rad_resideFamilia, $rad_portadorDeficiencia, $rad_outrosComponentesAssistidos, $multiselect_cmb_beneficios, $txt_bairro, $cmb_local_reside, $txt_cep2, $cmb_uf2, $cmb_cidade2, $txt_bairro2, $txt_logradouro2, $txt_numeroComplemento2, $txt_auxilioAnterior, $txt_numMembrosFamiliar)){
                //exit;
                //carrega o passo 2
                echo '<script>
                            pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=2&ok.php");
                            parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=2&ok.php";
                    </script>';
            }
            
        }

        /**
         * adicionarPasso
         * Faz o update das respostas no questionario
         */
        public function adicionarPasso(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            
            switch($passo){
                case 2:
                    $passo2 = array('tipoescola'=>$cmb_tipoEscola, 'frequencia'=>$cmb_anosEscola, 'concluiusuperior'=>$cursoSuperior, 'estacursando'=>$cmb_outroCurso,
                                    'situacaoTrab'=>$cmb_situacaoTrab, 'situacaoTrab_pai'=>$cmb_situacaoTrab_pai, 'situacaoTrab_mae'=>$cmb_situacaoTrab_mae, 'escolaridadeMae'=>$cmb_escolaridadeMae, 'escolaridadePai'=>$cmb_escolaridadePai);
                    if($questionarioDAO->adicionarResposta($txt_id_questionarioResposta, $passo2))
                            echo '<script>
                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=3&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=3&ok.php";
                            </script>';
                    break;
                case 3:
                    // CONFIRMAR AS RENDAS A SEREM SOMADAS
                    $grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($txt_id_questionarioResposta);
                    $cont = 0; $rendaTotal = 0;
                    foreach($grupoFamiliar as $valor):
                        if ($valor['id_grauparentesco'] == 10):
                            $cadastra = true;
                            $cont++; /*  Verifica quantos solicitantes de auxílio foram adicionados  */
                        endif;
                        
                        $rendaTotal += $valor['rendamensal'];
                        //$rendaTotal += $valor['rendaaluguel'];
                        $rendaTotal += $valor['rendapensaomorte'];
                        $rendaTotal += $valor['rendapensaoalimenticia'];
                        $rendaTotal += $valor['rendaajudaterceiros'];
                        $rendaTotal += $valor['rendaoutros'];
                    endforeach;
                    
                    if ($cont > 1):
                        echo System::exibeMensagem('Só é possível cadastrar 1 Solicitante de auxílio!', 'Atenção');
                        exit();
                    endif;
                        
                    if ($rendaTotal > 0):
                        $rendaPerCapita = $rendaTotal/count($grupoFamiliar); // Calcula a rendapercapita
                    endif;
                    
                    $numMembrosCadastro = $questionarioDAO->numMembrosCadastrados($txt_id_questionarioResposta);
                    
                    /*  Verifica se o usuário cadastrou o mesmo número de pessoas do seu grupo familiar  */
                    /*if ($numMembrosCadastro[0][0] == 'Mais de 7' && count($grupoFamiliar) < 7):*/
					if ($numMembrosCadastro[0][0] == 'Mais de 7' && count($grupoFamiliar) <= 7):
                        echo '<br />'.$this->escreveMsg("Você informou que mais de 7 pessoas fazem parte do seu núcleo Familia. Você precisa adicionar todos eles para continuar.","error");
                        exit();
                    /*SUBSTITUÍDA PELA SENTAÇA ABAIXO DESTA
					elseif ($numMembrosCadastro[0][0] != count($grupoFamiliar)):
                        echo '<br />'.$this->escreveMsg("Você informou que {$numMembrosCadastro[0][0]} pessoas fazem parte do seu núcleo Familia. Você precisa adicionar exatamente as {$numMembrosCadastro[0][0]} pessoas para continuar.","error");
                        exit();
					*/
					//INÍCIO NOVA SENTENÇA
                    elseif (($numMembrosCadastro[0][0] != 'Mais de 7') && $numMembrosCadastro[0][0] != count($grupoFamiliar)):
                        echo '<br />'.$this->escreveMsg("Você informou que {$numMembrosCadastro[0][0]} pessoas fazem parte do seu núcleo Familia. Você precisa adicionar exatamente as {$numMembrosCadastro[0][0]} pessoas para continuar.","error");
                        exit();

					//FIM NOVA SENTENÇA
                    endif;
                    
                    $passo3 = array("rendapercapita"=>$rendaPerCapita);
                    
                    if($cadastra){ // Se já tiver se cadastrado
                        if ($rendaTotal > 0){ // Se as rendas forem maior que zero
                            if($questionarioDAO->adicionarResposta($txt_id_questionarioResposta, NULL, $passo3)){
                                echo '<script>pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=4&ok.php");
                                        parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=4&ok.php";
                                      </script>';}  }
                        else
                            echo '<script>jAlert("A soma das rendas não pode ser igual a zero!","Atenção")</script>';}
                    else
                        echo '<script>jAlert("Você deve se cadastrar antes de prosseguir.","Atenção")</script>';
                    
                    
                    
                    
//                    if($cadastra){ // Se já estiver cadastrado ele carrega o novo passo
//                        echo '<script>pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=4&ok.php");
//                                      parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=4&ok.php";
//                              </script>';}
//                        else
//                            echo '<script>jAlert("Você deve se cadastrar antes de prosseguir.","Atenção")</script>';
                    break;
                case 4:
                    echo '<script>
                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=5&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=5&ok.php";
                            </script>';
                    break;
                case 5:
                    echo '<script>
                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=6&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=6&ok.php";
                            </script>';
                    break;
                case 6:
                    // PULA PARA O PASSO 8
                    $grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($txt_id_questionarioResposta); $var=false;
                    
                    foreach($grupoFamiliar as $membro){
                        if($cmb_provedor == 'Outros'){
                            if($membro['id_grauparentesco'] != 1 && $membro['id_grauparentesco'] != 2 && $membro['id_grauparentesco'] != 10 && $membro['id_grauparentesco'] != 8 && $membro['id_grauparentesco'] != 9)
                                $var = true;    }
                        else if($cmb_provedor == 'Pai e mãe'){
                            if($membro['id_grauparentesco'] == 1)
                                $mae = true;
                            else if($membro['id_grauparentesco'] == 2)
                                $pai = true;
                            
                            if($pai && $mae){ // Se tiver os dois
                                $var = true; }
                        }
                        else{
                            if($membro['id_grauparentesco'] == $cmb_provedor)
                                $var = true;    }
                        }
                        
                    if($cmb_provedor == 'Pai e mãe' && $var==false)
                        echo '<script>jAlert("Você precisa cadastrar seu pai e sua mãe em seu grupo familiar.","Atenção");</script>';
                    else if($cmb_provedor == 'Outros' && $var==false)
                        echo '<script>jAlert("Para escolher \'Outros\' como provedor, você precisa declará-lo em seu grupo familiar. \nEle não deve fazer parte de nenhuma das categorias acima.","Atenção");</script>';
                    else if ($var==false && $cmb_provedor != 'Pai e mãe' && $cmb_provedor!='Outros')
                        echo '<script>jAlert("Para escolher esse provedor você precisa declará-lo em seu grupo familiar.","Atenção");</script>';
                    
                    if($var==false)
                        exit(); // Para a execução
                    
                    $passo6 = array('id_grupofamiliar_provedor'=>$cmb_provedor,'id_escolaridade_provedor'=>$cmb_escolaridadeProvedor, 'id_escolaridade_provedor_2'=>$cmb_escolaridadeProvedor_2);
                    if($questionarioDAO->adicionarResposta($txt_id_questionarioResposta, NULL, NULL, $passo6))
                            echo '<script>
                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=8&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=8&ok.php";
                            </script>';
                    break;
                case 7:
//                    $passo7 = array('agua'=>System::converteMoeda($agua),'luz'=>System::converteMoeda($luz),'telefone'=>System::converteMoeda($telefone),'condominio'=>System::converteMoeda($condominio),'escola_faculdade'=>System::converteMoeda($escola_faculdade),
//                                    'alimentacao'=>System::converteMoeda($alimentacao),'saude_medicamentos'=>System::converteMoeda($saude_medicamentos),'transporte'=>System::converteMoeda($transporte),'aluguel'=>System::converteMoeda($aluguel),
//                                    'financiamento_consorcios'=>System::converteMoeda($financiamento_consorcios),'funcionarios'=>System::converteMoeda($funcionarios),'outros'=>System::converteMoeda($outros));
//                    if($questionarioDAO->adicionarResposta($txt_id_questionarioResposta, NULL, NULL, NULL, $passo7))
//                            echo '<script>
//                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=8&ok.php");
//                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo=8&ok.php";
//                            </script>';
                    break;
                case 8:
                    $usuarioDAO = new UsuarioDAO;
                    
                    echo '<script>
                        $(document).ready(function(){
                        $.superbox.settings = {
                            boxId: "superbox", // Id attribute of the "superbox" element
                            boxClasses: "", // Class of the "superbox" element
                            overlayOpacity: .8, // Background opaqueness
                            boxWidth: "850", // Default width of the box
                            boxHeight: "600", // Default height of the box
                            closeTxt: "Fechar", // "Close" button text
                        };
                        $.superbox();
                        });</script>';
                    
                    echo '<a href="documentos.php" rel="superbox[iframe][850x600]">
                           <input name="cadastrar" style="display:none" class="botao" id="mostraModal" type="button" />
                             </a>';
                    
                    $passo8 = array('status'=>2);
                    if($questionarioDAO->adicionarResposta($txt_id_questionarioResposta, NULL, NULL, NULL, NULL, $passo8)){
                        $this->calcularPontos($txt_id_questionarioResposta);
                        echo '<script>jAlert("Questionário enviado para análise! <b>Caso você seja pré-selecionado</b>, deverá apresentar a documentação comprobatória. Ao cliciar em \'Sim\' você poderá vizualiza-lá.","Atenção")</script>';
                        echo '<script>$(\'#popup_ok\').click(function(){
                                        document.getElementById(\'mostraModal\').click();
                                        pageload(\'questionario.php?metodo=adicionarPasso&passo=Final&id_questionarioResposta='.$txt_id_questionarioResposta.'&ok.php\');
                                        parent.window.location = \'principal.php#questionario-metodo=addQuestionarioAluno&acao=mostrar&ok.php\';
                                    });
                                </script>';   
                            }
                    break;
                case 'Final':
                        echo '<script>
                                pageload("questionario.php?metodo=addQuestionarioAluno&acao=mostrar&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=addQuestionarioAluno&acao=mostrar&ok.php";
                              </script>';
                    break;
            }
           
        } //Fim adicionar Passo

        /**
         * proximoPasso
         * Mostra o proximo passo sem dar Update na tabela
         */
        public function proximoPasso()
        {
            extract($_REQUEST);
            switch($passo){
                case 'final':
                    echo '<script>
                                pageload("questionario.php?metodo=addQuestionarioAluno&acao=mostrar&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=addQuestionarioAluno&acao=mostrar&ok.php";
                            </script>';
                    break;
                default:
                    echo '<script>
                                pageload("questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo='.$passo.'&ok.php");
                                parent.window.location = "principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$txt_id_questionario.'&passo='.$passo.'&ok.php";
                            </script>';
            }

        }

        public function carregaNovoMembro() {
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            
            if (isset($id)):
                $dadosMembro = $questionarioDAO->pegaMembroNucleoFamiliar($id);
                $id_questionarioResposta = $dadosMembro[0]['id_questionarioresposta'];
                if ($dadosMembro[0]['recebebolsafamilia'] == 'S'):
                    $recebeS = 'checked="checked"';
                    $recebeN = '';
                else:
                    $recebeN = 'checked="checked"';
                    $recebeS = '';
                endif;
            else:
                $dadosMembro = NULL;
                $id = NULL;
            endif;
            
            if ($solicitante == 'abrirSolicitante'): // Abre o cadastro do solicitante
                $listaGrauParentesco[0]['nome'] = 'Solicitante do auxílio';
                $listaGrauParentesco[0]['id'] = $dadosMembro[0]['id_grauparentesco'] = 10;
                $dadosMembro[0]['nome'] = $nome;
            else:
                $listaGrauParentesco = $questionarioDAO->pegaGrauParentesco();
            endif;
            
            echo $questionarioView->cadastraNovoMembro($listaGrauParentesco, $dadosMembro[0]['nome'], $dadosMembro[0]['id_grauparentesco'], $dadosMembro[0]['idade'], $dadosMembro[0]['rendamensal'], $dadosMembro[0]['rendaaluguel'], $dadosMembro[0]['rendapensaomorte'], $dadosMembro[0]['rendapensaoalimenticia'], $dadosMembro[0]['rendaajudaterceiros'], $dadosMembro[0]['rendaoutros'], $dadosMembro[0]['descricaooutro'], $recebeS, $recebeN, $id_questionarioResposta, $id, $dadosMembro[0]['rendabolsafamilia'], $dadosMembro[0]['CPF']);
        }

        public function carregaNovoVeiculo(){
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            if(isset($id)){
                $dadosVeiculo = $questionarioDAO->pegaVeiculos(NULL, $id);
                $id_questionarioResposta = $dadosVeiculo[0]['id_questionarioresposta'];
                }
            else
            $dadosVeiculo = NULL;
            $cmb_proprietario = $questionarioDAO->comboProprietario($id_questionarioResposta);
            $cmb_tipoVeiculo = $questionarioDAO->pegaVeiculos(NULL, NULL, 'tipoVeiculo');
            $utilidade[0]['id'] = 'Trabalho';
            $utilidade[0]['nome'] = 'Trabalho';
            $utilidade[1]['id'] = 'Particular';
            $utilidade[1]['nome'] = 'Particular';
            $i = 0; // Para montar select ano
            $array_ano = array('Ate 1990','Entre 1991 e 1999','Entre 2000 e 2005','Entre 2006 e 2010','A partir de 2011');
            foreach($array_ano as $valor){
                $cmb_ano[$i]['id'] = $valor;
                $cmb_ano[$i]['nome'] = $valor; $i++; }
            echo $questionarioView->cadastraNovoVeiculo($id_questionarioResposta, $cmb_proprietario, $dadosVeiculo, $cmb_tipoVeiculo, $utilidade, $cmb_ano);
        }

        public function carregaNovoImovel(){
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            if(isset($id)){
                $dadosImovel = $questionarioDAO->pegaImoveis(NULL, $id);
                $id_questionarioResposta = $dadosImovel[0]['id_questionarioresposta'];
                $carregaCidade = $dadosImovel[0]['id_uf'];
                if($dadosImovel[0]['servederesidencia']=='Sim'){
                    $serveSim = 'checked="checked"';
                    $serveNao = '';
                }else{
                    $serveNao = 'checked="checked"';
                    $serveSim = '';}
                }
            else{
                $dadosImovel = NULL;
                $carregaCidade = -1;}
            
            $cmb_tipoImovel = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tipoImovel');
            $cmb_proprietario = $questionarioDAO->comboProprietario($id_questionarioResposta);
            //aki
            $cmb_uf = $questionarioDAO->buscaLocal('UF');
            $cmb_cidade = $questionarioDAO->buscaLocal(NULL, $carregaCidade);
            echo $questionarioView->cadastraNovoImovel($id_questionarioResposta, $cmb_proprietario, $cmb_tipoImovel, $cmb_uf, $cmb_cidade, $dadosImovel, $serveNao, $serveSim);
        }

        public function addNovoMembro(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            
            if ($questionarioDAO->adicionaNovoMembro($txt_nome, $cmb_grauParentesco, $txt_idade, System::converteMoeda($txt_rendaMensal), System::converteMoeda($txt_rendaAluguel), System::converteMoeda($txt_rendaPensaoMorte), System::converteMoeda($txt_rendaPensaoAlimenticia), System::converteMoeda($txt_rendaPensaoAjudaTerceiros), System::converteMoeda($txt_rendaOutros), $txt_descricaoOutros, $rad_bolsaFamilia, $txt_id_questionarioResposta, $txt_id_grupoFamiliar, System::converteMoeda($txt_rendaBPC), System::soNumero($txt_cpf))){
                //atualiza tabela e some formulario de cadastro
                $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($txt_id_questionarioResposta);

                echo '<div id="div_tabelaNucleo">
                    '.$siteView->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoMembro', 'divCarregar'=>'div_formularioMembro'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoMembro', 'divCarregar'=>'div_tabelaNucleo', 'msgExcluir'=>'Deseja excluir o membro selecionado?')), NULL, array(2=>array('tipo'=>'cpf'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'),10=>array('tipo'=>'moeda'), 12=>array('tipo'=>'moeda'))).'
                    <div id="div_formularioMembro"></div>
                    </div>';
            }
        }

        public function excluirNovoMembro(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            $dadosMembro = $questionarioDAO->pegaMembroNucleoFamiliar($id);
            $id_questionarioResposta = $dadosMembro[0]['id_questionarioresposta'];
            if($questionarioDAO->excluirMembro($id)){
                //atualiza tabela e some formulario de cadastro
                $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($id_questionarioResposta);
                if($dadosNucleo[1]) // So vai mostrar tabela quando tiver dados
                echo '<div id="div_tabelaNucleo">
                    '.$siteView->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoMembro', 'divCarregar'=>'div_formularioMembro'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoMembro', 'divCarregar'=>'div_tabelaNucleo', 'msgExcluir'=>'Deseja excluir o membro selecionado?')), NULL, array(2=>array('tipo'=>'cpf'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'),10=>array('tipo'=>'moeda'), 12=>array('tipo'=>'moeda'))).'
                    </div>';    
                echo '<div id="div_formularioMembro"></div>';
            }
        }

        public function addNovoVeiculo(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            $dados = array ('id_grupofamiliar'=>$cmb_proprietario, 'marca'=>$marca,'modelo'=>$modelo,'ano'=>$ano,'utilidade'=>$cmb_utilidade,'tipoVeiculo'=>$cmb_tipoVeiculo);
            if($questionarioDAO->adicionaNovoVeiculo($txt_id_questionarioResposta, $dados, $txt_id_veiculo)){
                $dadosVeiculo = $questionarioDAO->pegaVeiculos($txt_id_questionarioResposta);
                echo '<div id="div_tabelaVeiculo">
                '.$siteView->montarTabela('', $dadosVeiculo[1], $dadosVeiculo[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoVeiculo', 'divCarregar'=>'div_formularioVeiculo'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoVeiculo', 'divCarregar'=>'div_tabelaVeiculo', 'msgExcluir'=>'Deseja excluir o veículo selecionado?')), NULL, array(7=>array('tipo'=>'moeda'))).'
                <div id="div_formularioVeiculo"></div>
                </div>';
            }
        }

        public function excluirNovoVeiculo(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            $dadosVeiculo = $questionarioDAO->pegaVeiculos(NULL, $id);
            $id_questionarioResposta = $dadosVeiculo[0]['id_questionarioresposta'];
            if($questionarioDAO->excluirVeiculo($id)){
                //atualiza tabela e some formulario de cadastro
                $dadosVeiculo = $questionarioDAO->pegaVeiculos($id_questionarioResposta);
                if($dadosVeiculo[1]) // So vai mostrar tabela quando tiver dados
                echo '<div id="div_tabelaVeiculo">
                '.$siteView->montarTabela('', $dadosVeiculo[1], $dadosVeiculo[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoVeiculo', 'divCarregar'=>'div_formularioVeiculo'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoVeiculo', 'divCarregar'=>'div_tabelaVeiculo', 'msgExcluir'=>'Deseja excluir o veículo selecionado?'))).'
                </div>';
                echo '<div id="div_formularioVeiculo"></div>';
            }
        }

        public function addNovoImovel(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            $dados = array ('id_tipoimovel'=>$cmb_tipoImovel,'id_grupofamiliar'=>$cmb_proprietario,'id_cidade'=>$cmb_cidade,'servederesidencia'=>$rad_residencia);
            if($questionarioDAO->adicionaNovoImovel($txt_id_questionarioResposta, $dados, $txt_id_imovel)){
                $dadosImovel = $questionarioDAO->pegaImoveis($txt_id_questionarioResposta);
                echo '<div id="div_tabelaImovel">
                '.$siteView->montarTabela('', $dadosImovel[1], $dadosImovel[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoImovel', 'divCarregar'=>'div_formularioImovel'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoImovel', 'divCarregar'=>'div_tabelaImovel', 'msgExcluir'=>'Deseja excluir o imóvel selecionado?'))).'
                <div id="div_formularioImovel"></div>
                </div>';
            }
        }

        public function excluirNovoImovel(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $siteView = new SiteView();
            $dadosImovel = $questionarioDAO->pegaImoveis(NULL, $id);
            $id_questionarioResposta = $dadosImovel[0]['id_questionarioresposta'];
            if($questionarioDAO->excluirImovel($id)){
                //atualiza tabela e some formulario de cadastro
                $dadosImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
                if($dadosImovel[1]) // So vai mostrar tabela quando tiver dados
                echo '<div id="div_tabelaImovel">
                '.$siteView->montarTabela('', $dadosImovel[1], $dadosImovel[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoImovel', 'divCarregar'=>'div_formularioImovel'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoImovel', 'divCarregar'=>'div_tabelaImovel', 'msgExcluir'=>'Deseja excluir o imóvel selecionado?'))).'
                </div>';
                echo '<div id="div_formularioImovel"></div>';
            }
        }

        public function editarGrupoFamiliar(){
            extract($_REQUEST);
            $questionarioDAO = new QuestionarioDAO();
            $dadosGrupo = $questionarioDAO->pegaGrupoFamiliar($id);
            
            $siteView = new SiteView();
            if($questionarioDAO->adicionaNovoMembro($txt_nome, $cmb_grauParentesco, $txt_idade, System::converteMoeda($txt_rendaMensal), System::converteMoeda($txt_rendaAluguel), System::converteMoeda($txt_rendaPensaoMorte), System::converteMoeda($txt_rendaPensaoAlimenticia), System::converteMoeda($txt_rendaPensaoAjudaTerceiros), System::converteMoeda($txt_rendaOutros), $txt_descricaoOutros, $txt_id_questionarioResposta, $txt_id_grupoFamiliar, System::converteMoeda($txt_rendaBPC))){
                //atualiza tabela e some formulario de cadastro
                $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($txt_id_questionarioResposta);
                echo '<div id="div_tabelaNucleo">
                    '.$siteView->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], array('excluir')).'
                    <div id="div_formularioMembro"></div>
                    </div>';
            }
        }
        
        /**
         * @name calcularPontos - Função para calcular a pontuação total de cada beneficio
         * @author Wester Cardoso
         * @since 01/02/12
         * @param int $id_questionarioResposta 
         * @return valor booleano
         */
        public function calcularPontos($id_questionarioResposta){
            $questionarioDAO = new QuestionarioDAO;
            $questionarioResposta = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta); // Pega as respotas do questionario
            $pegaBeneficios = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta); // Pega os beneficios selecionados

            $tam = count($pegaBeneficios);

            for ($i=0; $i<$tam; $i++){ // Vai iniciar as variaveis referente ao beneficios existentes
                if($pegaBeneficios[$i]['id_beneficio'] === 1){
                    $aux_alimentacao = 1;
                    continue;} // Caso encontre o beneficio na posição $i ele incrementa o $i
                else if($pegaBeneficios[$i]['id_beneficio'] === 2){
                    $aux_moradia = 1;
                    continue;}
                else if($pegaBeneficios[$i]['id_beneficio'] === 3){
                    $aux_transporte_municipal = 1;
                    continue;}
                else if($pegaBeneficios[$i]['id_beneficio'] === 4){
                    $aux_creche = 1;
                    continue;}
                else if($pegaBeneficios[$i]['id_beneficio'] === 5){
                    $aux_atividade = 1;
                    continue;}
                else if($pegaBeneficios[$i]['id_beneficio'] === 6){
                    $aux_transporte_inter = 1;
                    continue;}     }

            // Pergunta 9 - Qual o curso que está matriculado
            if($questionarioResposta[0]['id_curso'] == '6'): // Opção E
                $beneficios[0]['id_curso'] = 0;
            else:
                $beneficios[0]['id_curso'] = 2;
            endif;
            
            // Pergunta 17 - Tem filhos?
            if($questionarioResposta[0]['possuifilhos'] === 'S'){
                if($aux_creche){
                    $beneficios[4]['possuifilhos'] = 10; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['possuifilhos'] = 5;} // $beneficios[0] caso tenha outro beneficio alem de creche
                else
                    $beneficios[0]['possuifilhos'] = 5;}
            else
                $beneficios[0]['possuifilhos'] = 0;

            // Pergunta 18 - Quantos filhos tem:
            if($questionarioResposta[0]['numerofilhos'] === '1' && $questionarioResposta[0]['possuifilhos'] === 'S'){
                $beneficios[0]['numerofilhos'] = 1;
                $beneficios[4]['numerofilhos'] = 1;}
            else if($questionarioResposta[0]['numerofilhos'] === '2' && $questionarioResposta[0]['possuifilhos'] === 'S'){
                if($aux_creche):
                    $beneficios[4]['numerofilhos'] = 4; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['numerofilhos'] = 2;
                else:
                    $beneficios[0]['numerofilhos'] = 2;
                endif;}
            else if($questionarioResposta[0]['numerofilhos'] === '3' && $questionarioResposta[0]['possuifilhos'] === 'S'){
                if($aux_creche):
                    $beneficios[4]['numerofilhos'] = 6; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['numerofilhos'] = 3;
                else:
                    $beneficios[0]['numerofilhos'] = 3;
                endif;}

            // Pergunta 19 - Quantos filhos possuem ate 6 anos
            if($questionarioResposta[0]['filhosate6anos'] == 1 && $questionarioResposta[0]['possuifilhos'] === 'S'){
                if($aux_creche){
                    $beneficios[4]['filhosate6anos'] = 8; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['filhosate6anos'] = 0;}
                else
                    $beneficios[0]['filhosate6anos'] = 0;}
            else if($questionarioResposta[0]['filhosate6anos'] == 2 && $questionarioResposta[0]['possuifilhos'] == 'S'){
                if($aux_creche){
                    $beneficios[4]['filhosate6anos'] = 10; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['filhosate6anos'] = 0;}
                else
                    $beneficios[0]['filhosate6anos'] = 0;}
            else if($questionarioResposta[0]['filhosate6anos'] == 3 && $questionarioResposta[0]['possuifilhos'] == 'S'){
                if($aux_creche){
                    $beneficios[4]['filhosate6anos'] = 12; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['filhosate6anos'] = 0;}
                else
                    $beneficios[0]['filhosate6anos'] = 0;}
            else if($questionarioResposta[0]['filhosate6anos'] == 4 && $questionarioResposta[0]['possuifilhos'] == 'S'){
                if($aux_creche){
                    $beneficios[4]['filhosate6anos'] = 15; // $beneficios[4] referente ao aux_creche
                    $beneficios[0]['filhosate6anos'] = 0;}
                else
                    $beneficios[0]['filhosate6anos'] = 0;}

            // Pergunta 21 - No ultimo semestre recebeu ajuda?
            if($questionarioResposta[0]['recebeuauxiliosemestreanterior'] === 'S')
                $beneficios[0]['recebeuauxiliosemestreanterior'] = 5;
            else
                $beneficios[0]['recebeuauxiliosemestreanterior'] = 0;

            // Pergunta 30 - Situacao do imovel
            if($questionarioResposta[0]['id_situacaoimovel'] === 2){
                if($aux_moradia){
                    $beneficios[2]['id_situacaoimovel'] = 10; // $beneficios[2] referente ao aux_moradia
                    $beneficios[0]['id_situacaoimovel'] = 5;}
                else
                    $beneficios[0]['id_situacaoimovel'] = 5;}
            else if($questionarioResposta[0]['id_situacaoimovel'] === 3){
                $beneficios[2]['id_situacaoimovel'] = 3;
                $beneficios[0]['id_situacaoimovel'] = 3;}
            else if($questionarioResposta[0]['id_situacaoimovel'] === 4){
                $beneficios[2]['id_situacaoimovel'] = 5;
                $beneficios[0]['id_situacaoimovel'] = 5;}
            else
                $beneficios[0]['id_situacaoimovel'] = 0;
            
            // Pergunta 31 - Você reside no seu núcleo familiar
            if($questionarioResposta[0]['localreside'] != ''){
                if($aux_moradia):
                    $beneficios[2]['residenucleofamiliar'] = 10; // $beneficios[2] referente ao aux_moradia
                    $beneficios[0]['residenucleofamiliar'] = 5;
                else:
                    $beneficios[0]['residenucleofamiliar'] = 5;
                endif;
            }else
                $beneficios[0]['residenucleofamiliar'] = 0;
            
            // Pergunta 32 - Com quem vc reside?
            if ($questionarioResposta[0]['localreside'] == 'Sozinho(a)') {
                if($aux_moradia != NULL || $aux_alimentacao != NULL):
                    $beneficios[2]['localreside'] = 10;
                    $beneficios[1]['localreside'] = 5;
                    $beneficios[0]['localreside'] = 0;
                else:
                    $beneficios[0]['localreside'] = 0;
                endif;
            } else if ($questionarioResposta[0]['localreside'] == 'Parentes') {
                if ($aux_moradia):
                    $beneficios[2]['localreside'] = 6;
                    $beneficios[0]['localreside'] = 3;
                else:
                    $beneficios[0]['localreside'] = 3;
                endif;
            } else if ($questionarioResposta[0]['localreside'] == 'Pensão/Hotel') {
                if($aux_moradia):
                    $beneficios[2]['localreside'] = 6;
                    $beneficios[0]['localreside'] = 3;
                else:
                    $beneficios[0]['localreside'] = 3;
                endif;
            } else if ($questionarioResposta[0]['localreside'] == 'República') {
                if($aux_moradia):
                    $beneficios[2]['localreside'] = 10;
                    $beneficios[1]['localreside'] = 5;
                    $beneficios[0]['localreside'] = 3;
                else:
                    $beneficios[0]['localreside'] = 3;
                endif;
            }else if ($questionarioResposta[0]['localreside'] == 'Outros'){
                $beneficios[2]['localreside'] = 2;
                $beneficios[0]['localreside'] = 1;
            }
            
            /*  Caso não resida com o seu núcleo familiar:  */
            if ($questionarioResposta[0]['residecomfamilia'] == 'N'):
                $cidadeCampus = $this->retornaCidadeCampus($questionarioResposta[0]['id_campus']);

                if ($cidadeCampus == $questionarioResposta[0]['id_cidade2']):
                    $beneficios[3]['campusIgualCidade'] = 5;
                else:
                    $beneficios[6]['campusIgualCidade'] = 5;
                endif;
            endif;

            // Pergunta 33 - Distancia do local de estudo ate residencia
            if($questionarioResposta[0]['id_distanciaresidencia'] === 1 ){
                if($aux_transporte_municipal!=NULL){
                    $beneficios[3]['id_distanciaresidencia'] = 2; // $beneficios[3] referente ao aux_transporte_municipal
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else if($questionarioResposta[0]['id_distanciaresidencia'] === 2 ){
                if($aux_transporte_municipal!=NULL){
                    $beneficios[3]['id_distanciaresidencia'] = 4;
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else if($questionarioResposta[0]['id_distanciaresidencia'] === 3 ){
                if($aux_transporte_municipal!=NULL){
                    $beneficios[3]['id_distanciaresidencia'] = 10;
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else if($questionarioResposta[0]['id_distanciaresidencia'] === 4 ){
                if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
                    //$beneficios[2]['id_distanciaresidencia'] = 2; // [2] referente ao aux_moradia
                    $beneficios[3]['id_distanciaresidencia'] = 12; // [3] referente ao transporte muni
                    $beneficios[6]['id_distanciaresidencia'] = 8; // [6] referente ao transporte inter
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else if($questionarioResposta[0]['id_distanciaresidencia'] === 5 ){
                if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
                    //$beneficios[2]['id_distanciaresidencia'] = 4;
                    $beneficios[3]['id_distanciaresidencia'] = 15;
                    $beneficios[6]['id_distanciaresidencia'] = 8;
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else if($questionarioResposta[0]['id_distanciaresidencia'] === 6 ){
                if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
                    $beneficios[2]['id_distanciaresidencia'] = 10;
                    $beneficios[3]['id_distanciaresidencia'] = 0;
                    $beneficios[6]['id_distanciaresidencia'] = 12;
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
            else{
                if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
                    $beneficios[2]['id_distanciaresidencia'] = 10;
                    $beneficios[3]['id_distanciaresidencia'] = 0;
                    $beneficios[6]['id_distanciaresidencia'] = 0;
                    $beneficios[0]['id_distanciaresidencia'] = 0;}
                else
                    $beneficios[0]['id_distanciaresidencia'] = 0;
            }
                    
            /*  Você é portador de alguma deficiência  */
            if ($questionarioResposta[0]['id_deficiencia'] != NULL):
                $beneficios[0]['id_deficiencia'] = 5;
            else:
                $beneficios[0]['id_deficiencia'] = 0;
            endif;
            
            /*  Outros componentes do grupo familiar foram ou são assistidos pelo IFMG  */
            if ($questionarioResposta[0]['familiaassistidabeneficios'] == 'S'):
                $beneficios[0]['familiaassistidabeneficios'] = 5;
            else:
                $beneficios[0]['familiaassistidabeneficios'] = 0;
            endif;

            /*  Qual é a sua situação de trabalho  */
            if ($questionarioResposta[0]['id_situacaotrabalho'] == '11' || $questionarioResposta[0]['id_situacaotrabalho'] == '7' || $questionarioResposta[0]['id_situacaotrabalho'] == '6' ) {
                $beneficios[0]['id_situacaotrabalho'] = 5;
            } else if ($questionarioResposta[0]['id_situacaotrabalho'] == '10' || $questionarioResposta[0]['id_situacaotrabalho'] == '5') {
                $beneficios[0]['id_situacaotrabalho'] = 3;
            } else {
                $beneficios[0]['id_situacaotrabalho'] = 0;
            }
            
            /*  Qual a escolaridade do seu pai  */
            if ($questionarioResposta[0]['id_escolaridadepai'] == '1') {
                $beneficios[0]['id_escolaridadepai'] = 10;
            } else if ($questionarioResposta[0]['id_escolaridadepai'] == '2') {
                $beneficios[0]['id_escolaridadepai'] = 8;
            } else if ($questionarioResposta[0]['id_escolaridadepai'] == '3') {
                $beneficios[0]['id_escolaridadepai'] = 6;
            } else if ($questionarioResposta[0]['id_escolaridadepai'] == '4') {
                $beneficios[0]['id_escolaridadepai'] = 4;
            } else if ($questionarioResposta[0]['id_escolaridadepai'] == '5') {
                $beneficios[0]['id_escolaridadepai'] = 2;
            } else {
                $beneficios[0]['id_escolaridadepai'] = 0;
            }
                
            /*  Qual é a situação de trabalho de seu pai/padrasto  */
            if ($questionarioResposta[0]['id_situacaotrabalhopai'] == '13' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '11' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '10' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '7' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '6') {
                $beneficios[0]['id_situacaotrabalhopai'] = 5;
            } else if ($questionarioResposta[0]['id_situacaotrabalhopai'] == '9' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '5') {
                $beneficios[0]['id_situacaotrabalhopai'] = 3; 
            } else {
                $beneficios[0]['id_situacaotrabalhopai'] = 0;
            }
            
            /*  Qual a escolaridade da sua mãe  */
            if ($questionarioResposta[0]['id_escolaridademae'] == '1') {
                $beneficios[0]['id_escolaridademae'] = 10;
            } else if ($questionarioResposta[0]['id_escolaridademae'] == '2') {
                $beneficios[0]['id_escolaridademae'] = 8;
            } else if ($questionarioResposta[0]['id_escolaridademae'] == '3') {
                $beneficios[0]['id_escolaridademae'] = 6;
            } else if ($questionarioResposta[0]['id_escolaridademae'] == '4') {
                $beneficios[0]['id_escolaridademae'] = 4;
            } else if ($questionarioResposta[0]['id_escolaridademae'] == '5') {
                $beneficios[0]['id_escolaridademae'] = 2;
            } else {
                $beneficios[0]['id_escolaridademae'] = 0;
            }
            
            /*  Qual é a situação de trabalho da sua mae/madastra  */
            if ($questionarioResposta[0]['id_situacaotrabalhomae'] == '13' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '11' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '10' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '7' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '6') {
                $beneficios[0]['id_situacaotrabalhomae'] = 5;
            } else if ($questionarioResposta[0]['id_situacaotrabalhomae'] == '9' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '5') {
                $beneficios[0]['id_situacaotrabalhomae'] = 3; 
            } else {
                $beneficios[0]['id_situacaotrabalhomae'] = 0;
            }

            /*  Renda PerCapita  */
            if($questionarioResposta[0]['rendapercapita'] <= 311.37) {
                if ($aux_atividade != NULL):
                    $beneficios[5]['rendapercapita'] = 25;
                    $beneficios[0]['rendapercapita'] = 20;
                else:
                    $beneficios[0]['rendapercapita'] = 20;
                endif;
            } else if ($questionarioResposta[0]['rendapercapita'] <= 622.74) {
                if ($aux_atividade != NULL):
                    $beneficios[5]['rendapercapita'] = 20;
                    $beneficios[0]['rendapercapita'] = 15;
                else:
                    $beneficios[0]['rendapercapita'] = 15;
                endif;
            } else if ($questionarioResposta[0]['rendapercapita'] <= 934.11) {
                if ($aux_atividade != NULL):
                    $beneficios[5]['rendapercapita'] = 15;
                    $beneficios[0]['rendapercapita'] = 10;
                else:
                    $beneficios[0]['rendapercapita'] = 10;
                endif;
            } else if ($questionarioResposta[0]['rendapercapita'] <= 1245.48) {
                if ($aux_atividade != NULL):
                    $beneficios[5]['rendapercapita'] = 4;
                    $beneficios[0]['rendapercapita'] = 2;
                else:
                    $beneficios[0]['rendapercapita'] = 2;
                endif;
            } else {
                if ($aux_atividade != NULL):
                    $beneficios[5]['rendapercapita'] = 2;
                    $beneficios[0]['rendapercapita'] = 0;
                else:
                    $beneficios[0]['rendapercapita'] = 0;
                endif;
            }
            
            // Pergunta 48 - Algum membro do nucleo familiar recebe bolsa familia?
            $grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($id_questionarioResposta);

            foreach ($grupoFamiliar as $valor){ // Verifica se algum membro recebe bolsa familia    
                if($valor['recebebolsafamilia'] == 'S'){
                    $beneficios[0]['recebebolsa'] = 10;
                    break;  }} //Se econtrar sai do foreach sem verificar o resto

            // Pergunta 49 - Algum membro do nucleo familiar possuiu veiculo?
            $possuiVeiculo = $questionarioDAO->pegaVeiculos($id_questionarioResposta);

            if($possuiVeiculo[1]) // Se tiver veiculo
                $beneficios[0]['possuiVeiculo'] = 0;
            else{
                if($aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
                    $beneficios[3]['possuiVeiculo'] = 4; // referente ao $aux_transporte_municipal
                    $beneficios[6]['possuiVeiculo'] = 4; // referente ao $aux_transporte_inter
                    $beneficios[0]['possuiVeiculo'] = 2;}
                else
                    $beneficios[0]['possuiVeiculo'] = 2;}

            // Pergunta 56 - Algum membro do nucleo familiar possui imovel?
            $possuiImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
            if($possuiImovel[1])
                $beneficios[0]['possuiImovel'] = 0;
            else
                $beneficios[0]['possuiImovel'] = 2;
            
            /*  Imóvel cadastrado serve de residência para você e/ou algum membro do núcleo familiar  */
            if ($possuiImovel[1]):
                foreach ($possuiImovel[1] as $val):
                    if ($val[4] == 'Sim'):
                        $beneficios[2]['serveDeResidencia'] = 2;
                        $beneficios[0]['serveDeResidencia'] = 0;
                        break;
                    endif;
                endforeach;
            else:
                $beneficios[0]['serveDeResidencia'] = 0;
            endif;
            
            /*  Quem é o provedor da sua família  */
            if ($questionarioResposta[0]['id_grupofamiliar_provedor'] == '2') {
                $beneficios[0]['id_grupofamiliar_provedor'] = 10;
            } else if ($questionarioResposta[0]['id_grupofamiliar_provedor'] == '1' || $questionarioResposta[0]['id_grupofamiliar_provedor'] == '10') {
                $beneficios[0]['id_grupofamiliar_provedor'] = 8;
            } else if ($questionarioResposta[0]['id_grupofamiliar_provedor'] == 'Outros') {
                $beneficios[0]['id_grupofamiliar_provedor'] = 0;
            } else {
                $beneficios[0]['id_grupofamiliar_provedor'] = 5;
            }
            
            // Faz todos os calculos. Independente do beneficio,a pontuacao Global é igual para todos
            $pontuacaoGlobal = 
            $beneficios[0]['id_curso'] + 
            $beneficios[0]['recebeuauxiliosemestreanterior'] + 
            $beneficios[0]['id_deficiencia'] +
            $beneficios[0]['familiaassistidabeneficios'] +
            $beneficios[0]['id_situacaotrabalho'] +
            $beneficios[0]['id_escolaridadepai'] +
            $beneficios[0]['id_escolaridademae'] +
            $beneficios[0]['id_situacaotrabalhopai'] + 
            $beneficios[0]['id_situacaotrabalhomae'] + 
            $beneficios[0]['recebebolsa'] + 
            $beneficios[0]['possuiImovel'] +
            $beneficios[0]['id_grupofamiliar_provedor'];

            if($aux_alimentacao):
                $aux_alimentacao = $pontuacaoGlobal + 
                $beneficios[0]['possuifilhos'] + 
                $beneficios[0]['numerofilhos'] +
                $beneficios[0]['filhosate6anos'] +
                $beneficios[0]['id_situacaoimovel'] +
                $beneficios[0]['residenucleofamiliar'] +
                $beneficios[1]['localreside'] +
                $beneficios[0]['id_distanciaresidencia'] + 
                $beneficios[0]['rendapercapita'] +
                $beneficios[0]['serveDeResidencia'] +
                $beneficios[0]['possuiVeiculo'];
            else:
                $aux_alimentacao = 0;
            endif;

            if($aux_atividade):
                $aux_atividade = $pontuacaoGlobal + 
                $beneficios[0]['possuifilhos'] + 
                $beneficios[0]['numerofilhos'] +
                $beneficios[0]['filhosate6anos'] +
                $beneficios[0]['id_situacaoimovel'] +
                $beneficios[0]['residenucleofamiliar'] +
                $beneficios[0]['localreside'] +
                $beneficios[0]['id_distanciaresidencia'] + 
                $beneficios[5]['rendapercapita'] +
                $beneficios[0]['serveDeResidencia'] +
                $beneficios[0]['possuiVeiculo'];

            else:
                $aux_atividade = 0;
            endif;

            if($aux_moradia): // Atribui o valor para $aux_moradia
                $aux_moradia = $pontuacaoGlobal + 
                $beneficios[0]['possuifilhos'] + 
                $beneficios[0]['numerofilhos'] +
                $beneficios[0]['filhosate6anos'] +
                $beneficios[2]['id_situacaoimovel'] +
                $beneficios[2]['residenucleofamiliar'] +
                $beneficios[2]['localreside'] +
                $beneficios[2]['id_distanciaresidencia'] + 
                $beneficios[0]['rendapercapita'] + 
                $beneficios[2]['serveDeResidencia'] +
                $beneficios[0]['possuiVeiculo'];
            else:
                $aux_moradia = 0;
            endif;


            if($aux_transporte_municipal): // Atribui o valor para $aux_transporte_municipal
                $aux_transporte_municipal = $pontuacaoGlobal + 
                $beneficios[0]['possuifilhos'] + 
                $beneficios[0]['numerofilhos'] +
                $beneficios[0]['filhosate6anos'] +
                $beneficios[0]['id_situacaoimovel'] +
                $beneficios[0]['residenucleofamiliar'] +
                $beneficios[0]['localreside'] +
                $beneficios[3]['id_distanciaresidencia'] + 
                $beneficios[3]['campusIgualCidade'] + 
                $beneficios[0]['rendapercapita'] + 
                $beneficios[0]['serveDeResidencia'] +
                $beneficios[3]['possuiVeiculo'];
            else:
                $aux_transporte_municipal = 0;
            endif;


            if($aux_creche): // Atribui o valor para $aux_creche
                $aux_creche = $pontuacaoGlobal + 
                $beneficios[4]['possuifilhos'] + 
                $beneficios[4]['numerofilhos'] +
                $beneficios[4]['filhosate6anos'] +
                $beneficios[0]['id_situacaoimovel'] +
                $beneficios[0]['residenucleofamiliar'] +
                $beneficios[0]['localreside'] +
                $beneficios[0]['id_distanciaresidencia'] + 
                $beneficios[0]['rendapercapita'] + 
                $beneficios[0]['serveDeResidencia'] +
                $beneficios[0]['possuiVeiculo'];
            else:
                $aux_creche = 0;
            endif;


            if($aux_transporte_inter): // Atribui o valor para $aux_transporte_inter
                $aux_transporte_inter = $pontuacaoGlobal + 
                $beneficios[0]['possuifilhos'] + 
                $beneficios[0]['numerofilhos'] +
                $beneficios[0]['filhosate6anos'] +
                $beneficios[0]['id_situacaoimovel'] +
                $beneficios[0]['residenucleofamiliar'] +
                $beneficios[0]['localreside'] +
                $beneficios[6]['id_distanciaresidencia'] + 
                $beneficios[6]['campusIgualCidade'] + 
                $beneficios[0]['rendapercapita'] + 
                $beneficios[0]['serveDeResidencia'] +
                $beneficios[6]['possuiVeiculo'];
            else:
                $aux_transporte_inter = 0;
            endif;

            // Adiciona a pontuação no banco
            $pontuacaoExiste = $questionarioDAO->verificaPontuacaoExiste($id_questionarioResposta);
            $pontuacaoExiste = count($pontuacaoExiste);
            $questionarioDAO->salvarPontuacao($id_questionarioResposta, $aux_alimentacao, $aux_moradia, $aux_transporte_municipal, $aux_creche, $aux_atividade, $aux_transporte_inter, $pontuacaoExiste);
            
            
            /*$existe_2 = $questionarioDAO->pontuacaoIdExiste_2($id_questionarioResposta);
            $existe_2 = count($existe);
            $questionarioDAO->gravarPontuacao_2();
            
            $existe = $questionarioDAO->pontuacaoIdExiste($id_questionarioResposta);
            $existe = count($existe);
            if(!$questionarioDAO->gravarPontuacao($id_questionarioResposta, $aux_alimentacao, $aux_moradia, $aux_transporte_municipal, $aux_creche, $aux_atividade, $aux_transporte_inter, $existe))
                    System::exibeMensagem('Ocorreu um erro.', 'Erro');
             * */
            }
            
        /**
         * @name mostraRelatorio - Função para mostrar relatorios
         * @author Wester Cardoso 
         * @since 01/02/12
         */
            
            /*
        public function montaRelatorio(){
            $this->verificaAdm($_SESSION['id_usuario']);
            extract($_REQUEST);
            $questionarioView = new QuestionarioView;
            $questionarioDAO = new QuestionarioDAO;
            
            switch($acao){
                case 'mostrar':
                    $dadosRelatorio = $questionarioDAO->dadosRelatorio($multiselect_cmb_beneficios, $multiselect_cmb_questionario, $cmb_ordem, $cmb_campus);
                    
                    if($dadosRelatorio[1]){ // Verifica se tem algum dado com as configurações escolhidas
                        echo $questionarioView->montarGrid('Tabela de Pontuação', $dadosRelatorio[1], $dadosRelatorio[0], array(array('imprimir'),array('abrirQuestionario', 'existe'=>$dadosRelatorio[1])), 2, NULL, 'tbl_pontuacao');
                        
                        if($grafico){ // Verifica se a opção de gráfico está selecionada
                            if(!isset($multiselect_cmb_beneficios)) //Se não tiver nenhum aux selecionado, passa o array manualmente
                                $multiselect_cmb_beneficios = array('1','2','3','4','5','6');
                            
                            $opcoes = $questionarioDAO->SelectBeneficios($multiselect_cmb_beneficios); //busca os auxilios selecionados
                            $valor = $questionarioDAO->pegarPontuacao($multiselect_cmb_beneficios); //busca a pontuação de cada auxílio   
                            
                            echo $questionarioView->montarGrafico($opcoes, $valor, 'Pontuação', 'div_grafico');}
                        else //div_grafico recebe VAZIO
                            echo '<script>$(document).ready(function() {
                                    $("#div_grafico").html("");
                                 });</script>'; //Fim If/Else
                    }else{
                        echo '<p><strong>Não existem dados com essas configurações!</strong></p>';
                        echo '<script>$(document).ready(function() {
                                    $("#div_grafico").html("");
                                 });</script>';} //Fim If/Else
                    break;
                
                default:
                    $cmb_questionario = $questionarioDAO->SelectQuestionarios();
                    $cmb_beneficios = $questionarioDAO->SelectBeneficios();
                    $cmb_campus = $questionarioDAO->buscaCampus_();
                    
                    $ordem[0]['id'] = ' ORDER BY aux_alimentacao DESC';
                    $ordem[0]['nome'] = 'Auxílio Alimentação';
                    $ordem[1]['id'] = ' ORDER BY aux_moradia DESC';
                    $ordem[1]['nome'] = 'Auxílio Moradia';
                    $ordem[2]['id'] = ' ORDER BY aux_creche DESC';
                    $ordem[2]['nome'] = 'Auxílio Creche';                    
                    $ordem[3]['id'] = ' ORDER BY aux_atividade DESC';
                    $ordem[3]['nome'] = 'Auxílio Atividade';
                    $ordem[4]['id'] = ' ORDER BY aux_transportemunicipal DESC';
                    $ordem[4]['nome'] = 'Auxílio Transporte Municipal';
                    $ordem[5]['id'] = ' ORDER BY aux_transporteintermunicipal DESC';
                    $ordem[5]['nome'] = 'Auxílio Transporte Intermunicipal';

                    $questionarioView->mostraRelatorio($cmb_questionario, $cmb_beneficios, $ordem, $cmb_campus);
                    break;
            }
            
            
        }*/
    /*
        public function relatorioResumo(){
            $this->verificaAdm($_SESSION['id_usuario']);
            extract($_REQUEST);
            $questionarioView = new QuestionarioView;
            $questionarioDAO = new QuestionarioDAO;
            $dadosRelatorio = $questionarioDAO->dadosRelatorioResumo();
            foreach($dadosRelatorio[0] as $cat):
                $categoria[] .= $cat;
            endforeach;
            for($i=1;$i<(count($dadosRelatorio[1][0]));$i++):
                $dados[] .= $dadosRelatorio[1][0][$i];
            endfor;
            switch($acao):
                case 'mostrar':
                    echo $questionarioView->montarGrafico($categoria, $dados, 'Pontuação', 'div_grafico', 1);
                    break;
                default:
                    $questionarioView->mostraRelatorioResumo($categoria, $dados);
                    break;
            endswitch;
        }*/
        /*
        public function imprimeRelatorio(){
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            $usuarioDAO = new UsuarioDAO();
            $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta);
            $dadosUsuario = $usuarioDAO->dadosUsuario($dadosQuestionario[0]['id_usuario']);
            $dadosTurno = $questionarioDAO->pegaTurnoQuestionarioResposta($id_questionarioResposta);
            $dadosBeneficio = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta);
            // Passo 1
            $questionarioResposta[0]['nome'] = $dadosUsuario[0]['nome'];
            if($dadosUsuario[0]['sexo']=='M'):
                $questionarioResposta[0]['sexo']['masculino'] = 'checked="checked"';
                $questionarioResposta[0]['sexo']['feminino'] = '';
            else:
                $questionarioResposta[0]['sexo']['feminino'] = 'checked="checked"';
                $questionarioResposta[0]['sexo']['masculino'] = '';
            endif;
            $questionarioResposta[0]['dataNascimento'] = $dadosUsuario[0]['datanascimento'];
            $questionarioResposta[0]['carteiraDeIdentidade'] = $dadosUsuario[0]['carteiraidentidade'];
            $questionarioResposta[0]['orgaoExpedidor'] = $dadosUsuario[0]['orgaoexpedidor'];
            $questionarioResposta[0]['telefone'] = $dadosUsuario[0]['telefone'];
            $questionarioResposta[0]['celular'] = $dadosUsuario[0]['celular'];
            $questionarioResposta[0]['cpf'] = $dadosUsuario[0]['cpf'];
            $questionarioResposta[0]['email'] = $dadosUsuario[0]['email'];
            
            $questionarioResposta[0]['id_questionarioresposta'] = $dadosQuestionario[0]['id_questionarioresposta'];
            $questionarioResposta[0]['id_curso'] = $dadosQuestionario[0]['id_curso'];
            $questionarioResposta[0]['id_cidadeCursando'] = $dadosQuestionario[0]['id_cidadefic'];
            $questionarioResposta[0]['id_campus'] = $dadosQuestionario[0]['id_campus'];
            $questionarioResposta[0]['matricula'] = $dadosQuestionario[0]['numeromatricula'];
            $questionarioResposta[0]['anoSemestreIngresso'] = $dadosQuestionario[0]['anosemestreinicio'];
            $questionarioResposta[0]['id_situacaoCivil'] = $dadosQuestionario[0]['id_estadocivil'];
            $questionarioResposta[0]['id_situacaoImovel'] = $dadosQuestionario[0]['id_situacaoimovel'];
            $questionarioResposta[0]['id_distanciaIFMG'] = $dadosQuestionario[0]['id_distanciaresidencia'];
            $questionarioResposta[0]['id_deficiencia'] = $dadosQuestionario[0]['id_deficiencia'];
            $questionarioResposta[0]['numeroFilhos'] = $dadosQuestionario[0]['numerofilhos'];
            $questionarioResposta[0]['filhosAte6Anos'] = $dadosQuestionario[0]['filhosate6anos'];
            $questionarioResposta[0]['cep'] = $dadosQuestionario[0]['cep'];
            $questionarioResposta[0]['id_cidade'] = $dadosQuestionario[0]['id_cidade'];
            $questionarioResposta[0]['id_uf'] = $dadosQuestionario[0]['id_uf'];
            $questionarioResposta[0]['logradouro'] = $dadosQuestionario[0]['logradouro'];
            $questionarioResposta[0]['numerocomplemento'] = $dadosQuestionario[0]['numerocomplemento'];
            $questionarioResposta[0]['bairro'] = $dadosQuestionario[0]['bairro'];
            if($dadosQuestionario[0]['deficiencia']=='S'):
                $questionarioResposta[0]['rad_deficiencia']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_deficiencia']['n'] = '';
            else:
                $questionarioResposta[0]['rad_deficiencia']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_deficiencia']['s'] = '';
            endif;
            if($dadosQuestionario[0]['familiaassistidabeneficios']=='S'):
                $questionarioResposta[0]['rad_outrosComponentesAssistidos']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_outrosComponentesAssistidos']['n'] = '';
            else:
                $questionarioResposta[0]['rad_outrosComponentesAssistidos']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_outrosComponentesAssistidos']['s'] = '';
            endif;
            if($dadosQuestionario[0]['residecomfamilia']=='S'):
                $questionarioResposta[0]['rad_resideFamilia']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_resideFamilia']['n'] = '';
            else:
                $questionarioResposta[0]['rad_resideFamilia']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_resideFamilia']['s'] = '';
            endif;
            $questionarioResposta[0]['local_reside'] = $dadosQuestionario[0]['localreside'];
            if($dadosQuestionario[0]['recebeuauxiliosemestreanterior']=='S'):
                $questionarioResposta[0]['rad_recurso']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_recurso']['n'] = '';
            else:
                $questionarioResposta[0]['rad_recurso']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_recurso']['s'] = '';
            endif;
            if($dadosQuestionario[0]['parenteestudacampus']=='S'):
                $questionarioResposta[0]['rad_parente']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_parente']['n'] = '';
            else:
                $questionarioResposta[0]['rad_parente']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_parente']['s'] = '';
            endif;
            if($dadosQuestionario[0]['possuifilhos']=='S'):
                $questionarioResposta[0]['rad_filho']['s'] = 'checked="checked"';
                $questionarioResposta[0]['rad_filho']['n'] = '';
            else:
                $questionarioResposta[0]['rad_filho']['n'] = 'checked="checked"';
                $questionarioResposta[0]['rad_filho']['s'] = '';
            endif;
            
            foreach($dadosBeneficio AS $valorBeneficio):
                if($valorBeneficio['id_beneficio'] == 1)
                    $beneficio .= 'Alimentação| ';
                else if($valorBeneficio['id_beneficio'] == 2)
                    $beneficio .= 'Moradia| ';
                else if($valorBeneficio['id_beneficio'] == 3)
                    $beneficio .= 'Municipal| ';
                else if($valorBeneficio['id_beneficio'] == 4)
                    $beneficio .= 'Creche| ';
                else if($valorBeneficio['id_beneficio'] == 5)
                    $beneficio .= 'Atividade| ';
                else if($valorBeneficio['id_beneficio'] == 6)
                    $beneficio .= 'Intermunicipal| ';
            endforeach;
            
            foreach($dadosTurno AS $valorTurno):
                if($valorTurno['id_turno'] == 1)
                    $turno .= 'Manhã | ';
                else if($valorTurno['id_turno'] == 2)
                    $turno .= 'Tarde | ';
                else if($valorTurno['id_turno'] == 3)
                    $turno .= 'Noite | ';
            endforeach;
            
            $listagemCursos = $questionarioDAO->buscaCursos();
            $listagemCampus = $questionarioDAO->buscaCampus($id);
            $listagemTurno = $questionarioDAO->buscaTurno();
            $listagemEstadoCivil = $questionarioDAO->buscaSituacaoCivil();
            $listagemSituacaoImovel = $questionarioDAO->buscaSituacaoImovel();
            $listagemDistancia = $questionarioDAO->buscaDistancia();
            
            // Passo 2
            $questionarioResposta[0]['tipoescola'] = $dadosQuestionario[0]['id_tipoescola'];
            $questionarioResposta[0]['frequencia'] = $dadosQuestionario[0]['id_frequencia'];
            $questionarioResposta[0]['outroCurso'] = $dadosQuestionario[0]['id_estacursando'];
            $questionarioResposta[0]['situacaoTrab'] = $dadosQuestionario[0]['id_situacaotrabalho'];
            $questionarioResposta[0]['situacaoTrab_pai'] = $dadosQuestionario[0]['id_situacaotrabalhopai'];
            $questionarioResposta[0]['escolaridadePai'] = $dadosQuestionario[0]['id_escolaridadepai'];
            $questionarioResposta[0]['situacaoTrab_mae'] = $dadosQuestionario[0]['id_situacaotrabalhomae'];
            $questionarioResposta[0]['escolaridadeMae'] = $dadosQuestionario[0]['id_escolaridademae'];
            if($dadosQuestionario[0]['concluiusuperior']=='S')
                $questionarioResposta[0]['cursoSuperior']['s'] = 'checked="checked"';
            if($dadosQuestionario[0]['concluiusuperior']=='N')
                $questionarioResposta[0]['cursoSuperior']['n'] = 'checked="checked"';

            $cmb_tipoEscola = $questionarioDAO->montaCmb('tipoEscola');
            $cmb_anosEscola = $questionarioDAO->montaCmb(NULL, 'anosEscola');
            $cmb_outroCurso = $questionarioDAO->montaCmb(NULL, NULL, 'outroCurso');
            $cmb_situacaoTrab = $questionarioDAO->montaCmb(NULL, NULL, NULL, 'situacaoTrab');
            $cmb_situacaoTrab_pai = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, 'situacaoTrab_pai');
            $cmb_escolaridade = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');
            
            foreach($cmb_situacaoTrab as $valor):
                if($valor['id'] == $questionarioResposta[0]['situacaoTrab']):
                    $questionarioResposta[0]['situacaoTrab'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach($cmb_situacaoTrab_pai as $valor):
                if($valor['id'] == $questionarioResposta[0]['situacaoTrab_pai']):
                    $questionarioResposta[0]['situacaoTrab_pai'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach($cmb_situacaoTrab_pai as $valor):
                if($valor['id'] == $questionarioResposta[0]['situacaoTrab_mae']):
                    $questionarioResposta[0]['situacaoTrab_mae'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            // Passo 3
            $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($id_questionarioResposta);
            $passo3 = '<span class="tituloQuebra">Questionário | Dados Acadêmicos e Familiares (3/7)</span>';
            $passo3 .= $questionarioView->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], $arrayOpcoes, NULL, array(4=>array('tipo'=>'moeda'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'), 11=>array('tipo'=>'moeda')));
            
            // Passo 4
            $dadosVeiculos = $questionarioDAO->pegaVeiculos($id_questionarioResposta);
            $passo4 = $questionarioView->montaTitulo('Veículos (4/7)');
            if($dadosVeiculos[1]):
                $passo4 .= $questionarioView->montarTabela('', $dadosVeiculos[1], $dadosVeiculos[0], $arrayOpcoes, NULL, array(7=>array('tipo'=>'moeda')));
            else:
                $passo4 .= '<div><strong>Não possui veículos cadastrados.</strong></div><br>';
            endif;
            
            // Passo 5
            $dadosImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
            $passo5 = $questionarioView->montaTitulo('Imóveis (5/7)');
            if($dadosImovel[1]):
                $passo5 .= $questionarioView->montarTabela('', $dadosImovel[1], $dadosImovel[0], $arrayOpcoes);
            else:
                $passo5 .= '<div><strong>Não possui imóveis cadastrados.</strong></div><br>';
            endif;
            
            
            // Passo 6
            $questionarioResposta[0]['provedor'] = $dadosQuestionario[0]['id_grupofamiliar_provedor'];
            $questionarioResposta[0]['escolaridadeProvedor'] = $dadosQuestionario[0]['id_escolaridade_provedor'];
            $questionarioResposta[0]['escolaridadeProvedor_2'] = $dadosQuestionario[0]['id_escolaridade_provedor_2'];

            $cmb_provedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, $id_questionarioResposta);
            $cmb_escolaridadeProvedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');

            // Passo 7
            $questionarioResposta[0]['checkbox'] = ' checked="checked" ';
            $nome = $dadosUsuario[0]['nome'];
            $cpf = $dadosUsuario[0]['cpf'];
                    
            $questionarioView->mostraPasso1($id_questionarioPeriodo, $questionarioResposta, $listagemCursos, $listagemCampus, $listagemBeneficios, $listagemTurno, $listagemEstadoCivil, $listagemSituacaoImovel, $listagemDistancia, $beneficio, $turno, $id_questionario, $listagemLocalReside, 'Imprimir');
            echo '<hr>';$questionarioView->mostraPasso2($id_questionarioPeriodo, $questionarioResposta, $cmb_tipoEscola, $cmb_anosEscola, $cmb_outroCurso, $cmb_situacaoTrab, $cmb_situacaoTrab_pai, $cmb_escolaridade, 'Imprimir');
            echo '<hr>';echo $passo3.'<br><hr>'.$passo4.'<br><hr>'.$passo5;
            echo '<br><hr>';$questionarioView->mostraPasso6($id_questionarioPeriodo, $questionarioResposta, $cmb_provedor, $cmb_escolaridadeProvedor, 'Imprimir');
            echo '<br><hr>';$questionarioView->mostraPasso8($id_questionarioPeriodo, $questionarioResposta, $nome, $cpf, 'Imprimir');
            
            echo '<script>print();</script>';
        }
*/
        
        
        /*
        public function reabrirQuestionario(){
            extract($_REQUEST);
            
            $questionarioDAO = new QuestionarioDAO();
            if($questionarioDAO->reabrirQuestionarioDAO($id_questionarioresposta)):
                echo System::exibeMensagem('Questionário aberto para edição com sucesso!','Sucesso!','questionario.php?metodo=montaRelatorio&ok');
            else:
                echo System::exibeMensagem('Ocorreu algum erro! Avise aos programadores.','Erro!','questionario.php?metodo=montaRelatorio&ok');
            endif;
            
            
            
        }*/
        
        
        
        public function imprimirQuestionario() {
            extract($_REQUEST);
            $questionarioView = new QuestionarioView();
            $questionarioDAO = new QuestionarioDAO();
            $usuarioDAO = new UsuarioDAO();
            
            $dadosQuestionario = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionario);
            $dadosUsuario = $usuarioDAO->dadosUsuario($dadosQuestionario[0]['id_usuario']);
            $dadosTurno = $questionarioDAO->pegaTurnoQuestionarioResposta($id_questionario);
            $dadosBeneficio = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionario);
            
            foreach ($dadosBeneficio AS $valorBeneficio):
                if($valorBeneficio['id_beneficio'] == 1)
                    $beneficio .= 'Alimentação| ';
                else if($valorBeneficio['id_beneficio'] == 2)
                    $beneficio .= 'Moradia| ';
                else if($valorBeneficio['id_beneficio'] == 3)
                    $beneficio .= 'Municipal| ';
                else if($valorBeneficio['id_beneficio'] == 4)
                    $beneficio .= 'Creche| ';
                else if($valorBeneficio['id_beneficio'] == 5)
                    $beneficio .= 'Atividade| ';
                else if($valorBeneficio['id_beneficio'] == 6)
                    $beneficio .= 'Intermunicipal| ';
            endforeach;
            
            foreach ($dadosTurno AS $valorTurno):
                if($valorTurno['id_turno'] == 1)
                    $turno .= 'Manhã | ';
                else if($valorTurno['id_turno'] == 2)
                    $turno .= 'Tarde | ';
                else if($valorTurno['id_turno'] == 3)
                    $turno .= 'Noite | ';
            endforeach;
            
            foreach (explode(';', $dadosQuestionario[0]['id_auxilioanterior']) AS $valorBeneficio):
                if ($valorBeneficio['id_beneficio'] == 1)
                    $beneficioAnterior .= 'Alimentação| ';
                else if($valorBeneficio['id_beneficio'] == 2)
                    $beneficioAnterior .= 'Moradia| ';
                else if($valorBeneficio['id_beneficio'] == 3)
                    $beneficioAnterior .= 'Municipal| ';
                else if($valorBeneficio['id_beneficio'] == 4)
                    $beneficioAnterior .= 'Creche| ';
                else if($valorBeneficio['id_beneficio'] == 5)
                    $beneficioAnterior .= 'Atividade| ';
                else if($valorBeneficio['id_beneficio'] == 6)
                    $beneficioAnterior .= 'Intermunicipal| ';
            endforeach;
            
            $dadosQuestionario[0]['nome'] = $dadosUsuario[0]['nome'];
            $dadosQuestionario[0]['dataNascimento'] = $dadosUsuario[0]['datanascimento'];
            $dadosQuestionario[0]['carteiraDeIdentidade'] = $dadosUsuario[0]['carteiraidentidade'];
            $dadosQuestionario[0]['orgaoExpedidor'] = $dadosUsuario[0]['orgaoexpedidor'];
            $dadosQuestionario[0]['telefone'] = $dadosUsuario[0]['telefone'];
            $dadosQuestionario[0]['celular'] = $dadosUsuario[0]['celular'];
            $dadosQuestionario[0]['cpf'] = $dadosUsuario[0]['cpf'];
            $dadosQuestionario[0]['email'] = $dadosUsuario[0]['email'];
            $dadosQuestionario[0]['local_reside'] = $dadosQuestionario[0]['localreside'];
            $dadosQuestionario[0]['id_distanciaIFMG'] = $dadosQuestionario[0]['id_distanciaresidencia'];
            $dadosQuestionario[0]['anoSemestreIngresso'] = $dadosQuestionario[0]['anosemestreinicio'];
            $dadosQuestionario[0]['id_situacaoCivil'] = $dadosQuestionario[0]['id_estadocivil'];
            $dadosQuestionario[0]['numeroFilhos'] = $dadosQuestionario[0]['numerofilhos'];
            $dadosQuestionario[0]['filhosAte6Anos'] = $dadosQuestionario[0]['filhosate6anos'];
            $dadosQuestionario[0]['id_situacaoImovel'] = $dadosQuestionario[0]['id_situacaoimovel'];
            $dadosQuestionario[0]['id_auxilioanterior'] = $beneficioAnterior;
            
            if ($dadosUsuario[0]['sexo'] == 'M'): $dadosQuestionario[0]['sexo']['masculino'] = 'checked="checked"'; else: $dadosQuestionario[0]['sexo']['feminino'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['deficiencia'] == 'S'): $dadosQuestionario[0]['rad_deficiencia']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_deficiencia']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['familiaassistidabeneficios'] == 'S'): $dadosQuestionario[0]['rad_outrosComponentesAssistidos']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_outrosComponentesAssistidos']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['residecomfamilia'] == 'S'): $dadosQuestionario[0]['rad_resideFamilia']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_resideFamilia']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['recebeuauxiliosemestreanterior'] == 'S'): $dadosQuestionario[0]['rad_recurso']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_recurso']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['parenteestudacampus'] == 'S'): $dadosQuestionario[0]['rad_parente']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_parente']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['possuifilhos'] == 'S'): $dadosQuestionario[0]['rad_filho']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_filho']['n'] = 'checked="checked"'; endif;
            
            $listagemCursos = $questionarioDAO->buscaCursos();
            $listagemCampus = $questionarioDAO->buscaCampus(NULL, $dadosQuestionario[0]['id_campus']);
            $listagemTurno = $questionarioDAO->buscaTurno();
            $listagemEstadoCivil = $questionarioDAO->buscaSituacaoCivil();
            $listagemSituacaoImovel = $questionarioDAO->buscaSituacaoImovel();
            $listagemDistancia = $questionarioDAO->buscaDistancia();
            
            
            /*  Passo 2  */
            $dadosQuestionario[0]['tipoescola'] = $dadosQuestionario[0]['id_tipoescola'];
            $dadosQuestionario[0]['frequencia'] = $dadosQuestionario[0]['id_frequencia'];
            $dadosQuestionario[0]['outroCurso'] = $dadosQuestionario[0]['id_estacursando'];
            $dadosQuestionario[0]['situacaoTrab'] = $dadosQuestionario[0]['id_situacaotrabalho'];
            $dadosQuestionario[0]['situacaoTrab_pai'] = $dadosQuestionario[0]['id_situacaotrabalhopai'];
            $dadosQuestionario[0]['escolaridadePai'] = $dadosQuestionario[0]['id_escolaridadepai'];
            $dadosQuestionario[0]['situacaoTrab_mae'] = $dadosQuestionario[0]['id_situacaotrabalhomae'];
            $dadosQuestionario[0]['escolaridadeMae'] = $dadosQuestionario[0]['id_escolaridademae'];
            
            if ($dadosQuestionario[0]['concluiusuperior'] == 'S'): $dadosQuestionario[0]['cursoSuperior']['s'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['concluiusuperior'] == 'N'): $dadosQuestionario[0]['cursoSuperior']['n'] = 'checked="checked"'; endif;
            
            $cmb_tipoEscola = $questionarioDAO->montaCmb('tipoEscola');
            $cmb_anosEscola = $questionarioDAO->montaCmb(NULL, 'anosEscola');
            $cmb_outroCurso = $questionarioDAO->montaCmb(NULL, NULL, 'outroCurso');
            $cmb_situacaoTrab = $questionarioDAO->montaCmb(NULL, NULL, NULL, 'situacaoTrab');
            $cmb_situacaoTrab_pai = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, 'situacaoTrab_pai');
            $cmb_escolaridade = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');
            
            foreach ($cmb_situacaoTrab as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab']):
                    $dadosQuestionario[0]['situacaoTrab'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach ($cmb_situacaoTrab_pai as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab_pai']):
                    $dadosQuestionario[0]['situacaoTrab_pai'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach ($cmb_situacaoTrab_pai as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab_mae']):
                    $dadosQuestionario[0]['situacaoTrab_mae'] = $valor['nome'];
                    break;
                endif;
            endforeach;  
            
            /*  Passo 3  */
            $dadosNucleo = $questionarioDAO->pegaNucleoFamiliar($id_questionario);
            $passo3 = '<span class="tituloQuebra"> Questionário | Dados Acadêmicos e Familiares (3/7) </span>';
            $passo3 .= $questionarioView->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], NULL, NULL, array(2=>array('tipo'=>'cpf'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'), 10=>array('tipo'=>'moeda'), 12=>array('tipo'=>'moeda')));
            $passo3 .= '<br /> <strong>Renda PerCapita:</strong> '. $this->converteMoeda($dadosQuestionario[0]['rendapercapita']);
            
            /*  Passo 4  */
            $dadosVeiculos = $questionarioDAO->pegaVeiculos($id_questionario);
            $passo4 = $questionarioView->montaTitulo('Veículos (4/7)');
            if ($dadosVeiculos[1]):
                $passo4 .= $questionarioView->montarTabela('', $dadosVeiculos[1], $dadosVeiculos[0], NULL, NULL, array(7=>array('tipo'=>'moeda')));
            else:
                $passo4 .= '<div> <strong>Não possui veículos cadastrados.</strong> </div> <br />';
            endif;
            
            
            /*  Passo 5  */
            $dadosImovel = $questionarioDAO->pegaImoveis($id_questionario);
            $passo5 = $questionarioView->montaTitulo('Imóveis (5/7)');
            if ($dadosImovel[1]):
                $passo5 .= $questionarioView->montarTabela('', $dadosImovel[1], $dadosImovel[0], NULL);
            else:
                $passo5 .= '<div><strong>Não possui imóveis cadastrados.</strong></div><br>';
            endif;
            
            
            /*  Passo 6  */
            $dadosQuestionario[0]['provedor'] = $dadosQuestionario[0]['id_grupofamiliar_provedor'];
            $dadosQuestionario[0]['escolaridadeProvedor'] = $dadosQuestionario[0]['id_escolaridade_provedor'];
            $dadosQuestionario[0]['escolaridadeProvedor_2'] = $dadosQuestionario[0]['id_escolaridade_provedor_2'];
            
            $cmb_provedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, $id_questionario);
            $cmb_escolaridadeProvedor = $questionarioDAO->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');
            
            /*  Passo 7  */
            $dadosQuestionario[0]['checkbox'] = ' checked="checked" ';
            $nome = $dadosUsuario[0]['nome'];
            $cpf = $dadosUsuario[0]['cpf'];
            
            
            /*  Mostra o resultado na tela  */
            $questionarioView->mostraPasso1($id_questionarioPeriodo, $dadosQuestionario, $listagemCursos, $listagemCampus, $listagemBeneficios, $listagemTurno, $listagemEstadoCivil, $listagemSituacaoImovel, $listagemDistancia, $beneficio, $turno, $id_questionario, $listagemLocalReside, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            $questionarioView->mostraPasso2($id_questionarioPeriodo, $dadosQuestionario, $cmb_tipoEscola, $cmb_anosEscola, $cmb_outroCurso, $cmb_situacaoTrab, $cmb_situacaoTrab_pai, $cmb_escolaridade, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            echo $passo3;
            echo '<hr class="hrImprimir" />';
            echo $passo4;
            echo '<hr class="hrImprimir" />';
            echo $passo5;
            echo '<hr class="hrImprimir" />';
            $questionarioView->mostraPasso6($id_questionarioPeriodo, $dadosQuestionario, $cmb_provedor, $cmb_escolaridadeProvedor, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            $questionarioView->mostraPasso8($id_questionarioPeriodo, $dadosQuestionario, $nome, $cpf, 'Imprimir');
            
            //echo '<script>print();</script>';
        }
        
        public function imprimirQuestionarioArray() {  
            extract($_REQUEST);
            $stri = substr($_REQUEST['linha'],0,-1);
            $tamanho = $_REQUEST['tamanho'];
            $strArray = explode("|", $stri);            
            $i = 0;
            $j = 0;
            $linhas = array();
            for($i ; $i < $tamanho ; $i++){
                $linhas[$i][0] = $strArray[$j];
                $j++;
                $linhas[$i][1] = $strArray[$j];
                $j++;
            }            
            
            foreach ($linhas as $key => $value) {                  
            $questionarioView[$key] = new QuestionarioView();
            $questionarioDAO[$key] = new QuestionarioDAO();
            $usuarioDAO[$key] = new UsuarioDAO();
            
            $id_questionario = NULL;
            $id_questionarioPeriodo = NULL;
                $id_questionario = $value[0];
                $id_questionarioPeriodo = $value[1]; 
                
            $dadosQuestionario = $questionarioDAO[$key]->pegaDadosQuestionarioResposta($id_questionario);
            $dadosUsuario = $usuarioDAO[$key]->dadosUsuario($dadosQuestionario[0]['id_usuario']);
            $dadosTurno = $questionarioDAO[$key]->pegaTurnoQuestionarioResposta($id_questionario);
            $dadosBeneficio = $questionarioDAO[$key]->pegaBeneficioQuestionarioResposta($id_questionario);
            
            foreach ($dadosBeneficio AS $valorBeneficio):
                if($valorBeneficio['id_beneficio'] == 1)
                    $beneficio .= 'Alimentação| ';
                else if($valorBeneficio['id_beneficio'] == 2)
                    $beneficio .= 'Moradia| ';
                else if($valorBeneficio['id_beneficio'] == 3)
                    $beneficio .= 'Municipal| ';
                else if($valorBeneficio['id_beneficio'] == 4)
                    $beneficio .= 'Creche| ';
                else if($valorBeneficio['id_beneficio'] == 5)
                    $beneficio .= 'Atividade| ';
                else if($valorBeneficio['id_beneficio'] == 6)
                    $beneficio .= 'Intermunicipal| ';
            endforeach;
            
            foreach ($dadosTurno AS $valorTurno):
                if($valorTurno['id_turno'] == 1)
                    $turno .= 'Manhã | ';
                else if($valorTurno['id_turno'] == 2)
                    $turno .= 'Tarde | ';
                else if($valorTurno['id_turno'] == 3)
                    $turno .= 'Noite | ';
            endforeach;
            
            foreach (explode(';', $dadosQuestionario[0]['id_auxilioanterior']) AS $valorBeneficio):
                if ($valorBeneficio['id_beneficio'] == 1)
                    $beneficioAnterior .= 'Alimentação| ';
                else if($valorBeneficio['id_beneficio'] == 2)
                    $beneficioAnterior .= 'Moradia| ';
                else if($valorBeneficio['id_beneficio'] == 3)
                    $beneficioAnterior .= 'Municipal| ';
                else if($valorBeneficio['id_beneficio'] == 4)
                    $beneficioAnterior .= 'Creche| ';
                else if($valorBeneficio['id_beneficio'] == 5)
                    $beneficioAnterior .= 'Atividade| ';
                else if($valorBeneficio['id_beneficio'] == 6)
                    $beneficioAnterior .= 'Intermunicipal| ';
            endforeach;
            
            $dadosQuestionario[0]['nome'] = $dadosUsuario[0]['nome'];
            $dadosQuestionario[0]['dataNascimento'] = $dadosUsuario[0]['datanascimento'];
            $dadosQuestionario[0]['carteiraDeIdentidade'] = $dadosUsuario[0]['carteiraidentidade'];
            $dadosQuestionario[0]['orgaoExpedidor'] = $dadosUsuario[0]['orgaoexpedidor'];
            $dadosQuestionario[0]['telefone'] = $dadosUsuario[0]['telefone'];
            $dadosQuestionario[0]['celular'] = $dadosUsuario[0]['celular'];
            $dadosQuestionario[0]['cpf'] = $dadosUsuario[0]['cpf'];
            $dadosQuestionario[0]['email'] = $dadosUsuario[0]['email'];
            $dadosQuestionario[0]['local_reside'] = $dadosQuestionario[0]['localreside'];
            $dadosQuestionario[0]['id_distanciaIFMG'] = $dadosQuestionario[0]['id_distanciaresidencia'];
            $dadosQuestionario[0]['anoSemestreIngresso'] = $dadosQuestionario[0]['anosemestreinicio'];
            $dadosQuestionario[0]['id_situacaoCivil'] = $dadosQuestionario[0]['id_estadocivil'];
            $dadosQuestionario[0]['numeroFilhos'] = $dadosQuestionario[0]['numerofilhos'];
            $dadosQuestionario[0]['filhosAte6Anos'] = $dadosQuestionario[0]['filhosate6anos'];
            $dadosQuestionario[0]['id_situacaoImovel'] = $dadosQuestionario[0]['id_situacaoimovel'];
            $dadosQuestionario[0]['id_auxilioanterior'] = $beneficioAnterior;
            
            if ($dadosUsuario[0]['sexo'] == 'M'): $dadosQuestionario[0]['sexo']['masculino'] = 'checked="checked"'; else: $dadosQuestionario[0]['sexo']['feminino'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['deficiencia'] == 'S'): $dadosQuestionario[0]['rad_deficiencia']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_deficiencia']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['familiaassistidabeneficios'] == 'S'): $dadosQuestionario[0]['rad_outrosComponentesAssistidos']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_outrosComponentesAssistidos']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['residecomfamilia'] == 'S'): $dadosQuestionario[0]['rad_resideFamilia']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_resideFamilia']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['recebeuauxiliosemestreanterior'] == 'S'): $dadosQuestionario[0]['rad_recurso']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_recurso']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['parenteestudacampus'] == 'S'): $dadosQuestionario[0]['rad_parente']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_parente']['n'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['possuifilhos'] == 'S'): $dadosQuestionario[0]['rad_filho']['s'] = 'checked="checked"'; else: $dadosQuestionario[0]['rad_filho']['n'] = 'checked="checked"'; endif;
            
            $listagemCursos = $questionarioDAO[$key]->buscaCursos();
            $listagemCampus = $questionarioDAO[$key]->buscaCampus(NULL, $dadosQuestionario[0]['id_campus']);
            $listagemTurno = $questionarioDAO[$key]->buscaTurno();
            $listagemEstadoCivil = $questionarioDAO[$key]->buscaSituacaoCivil();
            $listagemSituacaoImovel = $questionarioDAO[$key]->buscaSituacaoImovel();
            $listagemDistancia = $questionarioDAO[$key]->buscaDistancia();
            
            
            /*  Passo 2  */
            $dadosQuestionario[0]['tipoescola'] = $dadosQuestionario[0]['id_tipoescola'];
            $dadosQuestionario[0]['frequencia'] = $dadosQuestionario[0]['id_frequencia'];
            $dadosQuestionario[0]['outroCurso'] = $dadosQuestionario[0]['id_estacursando'];
            $dadosQuestionario[0]['situacaoTrab'] = $dadosQuestionario[0]['id_situacaotrabalho'];
            $dadosQuestionario[0]['situacaoTrab_pai'] = $dadosQuestionario[0]['id_situacaotrabalhopai'];
            $dadosQuestionario[0]['escolaridadePai'] = $dadosQuestionario[0]['id_escolaridadepai'];
            $dadosQuestionario[0]['situacaoTrab_mae'] = $dadosQuestionario[0]['id_situacaotrabalhomae'];
            $dadosQuestionario[0]['escolaridadeMae'] = $dadosQuestionario[0]['id_escolaridademae'];
            
            if ($dadosQuestionario[0]['concluiusuperior'] == 'S'): $dadosQuestionario[0]['cursoSuperior']['s'] = 'checked="checked"'; endif;
            if ($dadosQuestionario[0]['concluiusuperior'] == 'N'): $dadosQuestionario[0]['cursoSuperior']['n'] = 'checked="checked"'; endif;
            
            $cmb_tipoEscola = $questionarioDAO[$key]->montaCmb('tipoEscola');
            $cmb_anosEscola = $questionarioDAO[$key]->montaCmb(NULL, 'anosEscola');
            $cmb_outroCurso = $questionarioDAO[$key]->montaCmb(NULL, NULL, 'outroCurso');
            $cmb_situacaoTrab = $questionarioDAO[$key]->montaCmb(NULL, NULL, NULL, 'situacaoTrab');
            $cmb_situacaoTrab_pai = $questionarioDAO[$key]->montaCmb(NULL, NULL, NULL, NULL, 'situacaoTrab_pai');
            $cmb_escolaridade = $questionarioDAO[$key]->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');
            
            foreach ($cmb_situacaoTrab as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab']):
                    $dadosQuestionario[0]['situacaoTrab'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach ($cmb_situacaoTrab_pai as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab_pai']):
                    $dadosQuestionario[0]['situacaoTrab_pai'] = $valor['nome'];
                    break;
                endif;
            endforeach;
            
            foreach ($cmb_situacaoTrab_pai as $valor):
                if ($valor['id'] == $dadosQuestionario[0]['situacaoTrab_mae']):
                    $dadosQuestionario[0]['situacaoTrab_mae'] = $valor['nome'];
                    break;
                endif;
            endforeach;  
            
            /*  Passo 3  */
            $dadosNucleo = $questionarioDAO[$key]->pegaNucleoFamiliar($id_questionario);
            $passo3 = '<span class="tituloQuebra"> Questionário | Dados Acadêmicos e Familiares (3/7) </span>';
            $passo3 .= $questionarioView[$key]->montarTabela('', $dadosNucleo[1], $dadosNucleo[0], NULL, NULL, array(2=>array('tipo'=>'cpf'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'), 10=>array('tipo'=>'moeda'), 12=>array('tipo'=>'moeda')));
            $passo3 .= '<br /> <strong>Renda PerCapita:</strong> '. $this->converteMoeda($dadosQuestionario[0]['rendapercapita']);
            
            /*  Passo 4  */
            $dadosVeiculos = $questionarioDAO[$key]->pegaVeiculos($id_questionario);
            $passo4 = $questionarioView[$key]->montaTitulo('Veículos (4/7)');
            if ($dadosVeiculos[1]):
                $passo4 .= $questionarioView[$key]->montarTabela('', $dadosVeiculos[1], $dadosVeiculos[0], NULL, NULL, array(7=>array('tipo'=>'moeda')));
            else:
                $passo4 .= '<div> <strong>Não possui veículos cadastrados.</strong> </div> <br />';
            endif;
            
            
            /*  Passo 5  */
            $dadosImovel = $questionarioDAO[$key]->pegaImoveis($id_questionario);
            $passo5 = $questionarioView[$key]->montaTitulo('Imóveis (5/7)');
            if ($dadosImovel[1]):
                $passo5 .= $questionarioView[$key]->montarTabela('', $dadosImovel[1], $dadosImovel[0], NULL);
            else:
                $passo5 .= '<div><strong>Não possui imóveis cadastrados.</strong></div><br>';
            endif;
            
            
            /*  Passo 6  */
            $dadosQuestionario[0]['provedor'] = $dadosQuestionario[0]['id_grupofamiliar_provedor'];
            $dadosQuestionario[0]['escolaridadeProvedor'] = $dadosQuestionario[0]['id_escolaridade_provedor'];
            $dadosQuestionario[0]['escolaridadeProvedor_2'] = $dadosQuestionario[0]['id_escolaridade_provedor_2'];
            
            $cmb_provedor = $questionarioDAO[$key]->montaCmb(NULL, NULL, NULL, NULL, NULL, NULL, $id_questionario);
            $cmb_escolaridadeProvedor = $questionarioDAO[$key]->montaCmb(NULL, NULL, NULL, NULL, NULL, 'escolaridadeProvedor');
            
            /*  Passo 7  */
            $dadosQuestionario[0]['checkbox'] = ' checked="checked" ';
            $nome = $dadosUsuario[0]['nome'];
            $cpf = $dadosUsuario[0]['cpf'];
            
            
            /*  Mostra o resultado na tela  */
            
            $questionarioView[$key]->mostraPasso1($id_questionarioPeriodo, $dadosQuestionario, $listagemCursos, $listagemCampus, $listagemBeneficios, $listagemTurno, $listagemEstadoCivil, $listagemSituacaoImovel, $listagemDistancia, $beneficio, $turno, $id_questionario, $listagemLocalReside, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            $questionarioView[$key]->mostraPasso2($id_questionarioPeriodo, $dadosQuestionario, $cmb_tipoEscola, $cmb_anosEscola, $cmb_outroCurso, $cmb_situacaoTrab, $cmb_situacaoTrab_pai, $cmb_escolaridade, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            echo $passo3;
            echo '<hr class="hrImprimir" />';
            echo $passo4;
            echo '<hr class="hrImprimir" />';
            echo $passo5;
            echo '<hr class="hrImprimir" />';
            $questionarioView[$key]->mostraPasso6($id_questionarioPeriodo, $dadosQuestionario, $cmb_provedor, $cmb_escolaridadeProvedor, 'Imprimir');
            echo '<hr class="hrImprimir" />';
            $questionarioView[$key]->mostraPasso8($id_questionarioPeriodo, $dadosQuestionario, $nome, $cpf, 'Imprimir');
            
            //echo '<script>print();</script>';
            }
            
            echo '<script type="text/javascript" charset="utf-8">
                if(document.readyState=="complete"){
                alert("Pressione Ctrl + P para imprimir esta pagina");
                }
                </script>';
            
        }
        

}

?>