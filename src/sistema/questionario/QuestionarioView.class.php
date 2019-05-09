<?php
require_once 'sistema/geral/SiteView.class.php';
require_once 'sistema/campus/CampusDAO.class.php';
require_once 'sistema/beneficios/BeneficioDAO.class.php';
require_once 'sistema/cidade/CidadeView.class.php';
require_once 'sistema/cidade/CidadeDAO.class.php';

class QuestionarioView extends SiteView{

	public function formQuestionario($acao, $questionario){
            if($questionario!=null){
                    $botaoEnviar='Vincular';
                    $titulo='Editar Questionário';
                    $metodo='addQuestionario';
                    $nome = $questionario[0]['descricao'];
                    //pega campus
                    foreach ($questionario as $valor )
                        $id_campus[] = $valor['id_campus'];
                    $readOnly = 1;
                    $editar = 1;
                    $id_questionario = $questionario[0]['id_questionario'];
            }else{
                    $botaoEnviar='Vincular';
                    $titulo='Adicionar Questionário';
                    $metodo='addQuestionario';
                    $id_questionario = NULL;
                    $nome = '';
                    $id_campus = NULL;
                    $readOnly = NULL;
                    $editar = 0;
            }
            $campusDAO = new CampusDAO();

            $conteudo='';

            $conteudo .= $this->montaTitulo($titulo).'<br />';
            $conteudo .= $this->inicioFormulario('frm_adicionarQuestionario', 'formulario2', 'questionario.php?metodo='.$metodo.'&acao=passo1&editar='.$editar.'&ok', 1, 'div_rodaFuncao');
            $conteudo .= $this->inputText('hidden', 'txt_id_questionario', 'txt_id_questionario', '', '', '', $id_questionario);
            $conteudo .= $this->inputText('text', 'txt_nome', 'txt_nome', 'Questionário', 50, 'validate[required] inputQuestionario', $nome, NULL, 1, NULL, $readOnly);
            $conteudo .= $this->montaSelect('multiple', 'cmb_campus', 'cmb_campus[]', 'Campus', 'multiselect', $campusDAO->buscaCampus(), $id_campus);
            $conteudo .= $this->montaBotao($botaoEnviar, 'botao');
            $conteudo .= $this->fechaFormulario();
            if($questionario==NULL)
                $conteudo .= '<div id="div_rodaFuncao"></div>';

            echo $conteudo;

	}

        public function formQuestionario2Passo($acao, $questionario=NULL, $campus=NULL){
            if($questionario!=null and $questionario!=NULL){
                    $botaoEnviar='Editar';
                    $titulo='Editar Questionário';
                    $metodo='editarQuestionario';
                    $questionarioDAO = new QuestionarioDAO();
                    $listaQuestionario = $questionarioDAO->listaQuestionarios($questionario[0]['id_questionario']);
                    $nome = $listaQuestionario[0]['Descrição'];
                    $id_questionario = $questionario[0]['id_questionario'];
                    $campus = $questionarioDAO->dadosCampus($questionario[0]['id_questionario']);
                    foreach($campus AS $valorCampus)
                        $id_campus[] = $valorCampus['id_campus'];
            }elseif($acao=='editar'){
                $botaoEnviar='Inserir';
                $titulo='Adicionar Questionário';
                $metodo='editarQuestionario';
                $id_questionario = $_POST['txt_id_questionario'];
                $nome = $_POST['txt_nome'];
                $id_campus = $_POST['multiselect_cmb_campus'];
                $dataInicio = NULL;
                $dataFim = NULL;
            }else{
                $botaoEnviar='Inserir';
                $titulo='Adicionar Questionário';
                $metodo='addQuestionario';
                $id_questionario = NULL;
                $nome = $_POST['txt_nome'];
                $id_campus = $_POST['multiselect_cmb_campus'];
                $dataInicio = NULL;
                $dataFim = NULL;
            }

            //pegaCampus e escreve a data e beneficios p/ eles
            $campusDAO = new CampusDAO();
            $beneficioDAO = new BeneficioDAO();

            $itensBeneficio = $beneficioDAO->buscaBeneficio();
            $conteudo = $this->inicioFormulario('frm_adicionarQuestionario2', 'formulario2', 'questionario.php?metodo='.$metodo.'&acao=adicionar', 1, 'div_rodaFuncao2');
            //se for editar
            //if($questionario!=NULL)
            $conteudo .= $conteudo .= $this->inputText('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id_questionario);
            //pega dados do 1passo
            $conteudo .= $this->inputText('hidden', 'txt_nome', 'txt_nome', '', NULL, NULL, $nome);
            $conteudo .= $this->inputText('hidden', 'cmb_campus', 'cmb_campus', '', NULL, NULL, htmlentities(serialize($id_campus)));
            foreach ($campus AS $valor){
                if($questionario==NULL){
                    $nomeCampus = $campusDAO->buscaCampus($valor);
                    $dadosBeneficio = NULL;
                    $id_campus = $valor;
                }else{
                    $dadosBeneficio = NULL;
                    $nomeCampus = $campusDAO->buscaCampus($valor['id_campus']);
                    $id_campus = $valor['id_campus'];
                    $dadosDoCampus = $questionarioDAO->dadosDoCampus($questionario[0]['id_questionario'], $valor['id_campus']);
                    $dataInicio = System::converteData($dadosDoCampus[0]['datainicio']);
                    $dataFim = System::converteData($dadosDoCampus[0]['datafim']);
                    foreach($dadosDoCampus AS $valorCampus)
                        $dadosBeneficio[] = $valorCampus['id_beneficio'];
                }
                $conteudo .= '<strong>Vincular Benefícios - '.$nomeCampus[0]['nome'].'</strong><br />';
                //escreve periodo
                $conteudo .= $this->inputText('text', 'txt_dataInicio['.$id_campus.']', 'txt_dataInicio['.$id_campus.']', 'Período', '10', 'validate[required] formularioSemEspaco datePicker', $dataInicio, 'datePicker', 0);
                $conteudo .= ' até '.$this->inputText('text', 'txt_dataFim['.$id_campus.']', 'txt_dataFim['.$id_campus.']', '', '10', 'formularioSemEspaco datePicker', $dataFim, 'datePicker', 1);
                //escreve beneficios
                $conteudo .= $this->montaSelect('multiple', 'cmb_beneficio['.$id_campus.']', 'cmb_beneficio['.$id_campus.']', 'Benefícios', 'multiselect', $itensBeneficio, $dadosBeneficio).'<br />';
            }
            $conteudo .= $this->montaBotao($botaoEnviar, 'botao');
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_rodaFuncao2"></div>';
            echo $conteudo;

        }
	
        public function listaQuestionario($dados){
            echo $this->montarTabela('Visualizar questionários', $dados[1], $dados[0], array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=editar', 'divCarregar'=>'corpo'), 'excluir'));
        }

        public function mostraQuestionariosAluno($questionariosDisponiveis, $questionariosPreenchidos){
            if($questionariosDisponiveis[1]) // So vai mostrar os questionarios quando tiver algum disponivel
                echo $this->montarTabela('Editais Disponíveis', $questionariosDisponiveis[1], $questionariosDisponiveis[0], array(array('preencher')), 2);
            else
                echo $this->montaTitulo('Editais Disponíveis').'<p>Não existem editais disponíveis no momento.</p><hr>';
                
            if($questionariosPreenchidos && count($questionariosPreenchidos[1])>0)
                echo $this->montarTabela('Questionários Preenchidos', $questionariosPreenchidos[1], $questionariosPreenchidos[0], array(array('preencher')), 2);
            
        }

        public function mostraPasso1($id, $questionarioResposta, $listagemCursos, $listagemCampus, $listagemBeneficios, $listagemTurno, $listagemSituacaoCivil, $listagemSituacaoImovel, $listagemDistancia, $beneficio, $turno, $id_questionario, $listagemLocalReside, $imprimir=NULL){
            $questionarioDAO = new QuestionarioDAO();
            $cidadeView = new CidadeView();
            $cidadeDAO = new CidadeDAO();
            
            /*  Atribui apenas o campus referente ao questionario selecionado  */
            $listagemCampus = $questionarioDAO->pegaCampusQuestionario($id);
            $questionarioResposta[0]['id_campus'] = $listagemCampus[0][0];
            
            if($questionarioResposta[0]['id_status']==2){ //Caso seja apenas Visualizar
            $readOnly = 1;
            $metodo = 'proximoPasso';
            $passo = 2;
            }else{
                $metodo = 'adicionarPasso1';
                $passo = 2;}
                
            /*  FancyBox e a descrição dos auxílios  */
            echo '<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox();
                });
                </script> ';
                
            echo '<div id="ajudaAuxilio" style="width:600px; display: none;">
                    <p><font color="#9B2038"><strong>Auxílio Moradia</strong></font>  -  Compreende a concessão de  auxílio financeiro para moradia aos estudantes cuja residência do  núcleo familiar não esteja  localizado no município onde o aluno está estudando eque atendam a critérios socioeconômicos.</p>
                    <p><font color="#9B2038"><strong>Auxílio Alimentação</strong></font>   -  Refere-se à concessão de auxílio financeiro para alimentação aos estudantes que comprovem carência socioeconômica.</p>
                    <p><font color="#9B2038"><strong>Auxílio Transporte Municipal</strong></font>  -     Destinado aos estudantes que atendem a critérios socioeconômicos, trata-se da concessão de auxílio financeiro para que os mesmos se locomovam para o campus. Destinado para aqueles alunos que estão morando no mesmo município em que está estudando.</p>
                    <p><font color="#9B2038"><strong>Auxílio Transporte Intermunicipal</strong></font>  -     Destinado aos estudantes que atendem a critérios socioeconômicos, trata-se da concessão de auxílio financeiro para que os mesmos se locomovam para o campus. Destinado para aqueles alunos que estão morando em município diferente daquele em que está estudando.</p>
                    <p><font color="#9B2038"><strong>Auxílio Creche</strong></font>    É um apoio financeiro não reembolsável, concedido mensalmente aos estudantes regularmente matriculados que têm filhos até 6 (seis) anos e que atendam a critérios socioeconômicos.</p>
                    <p><font color="#9B2038"><strong>Auxílio Atividade</strong></font>   -  Refere-se à concessão de auxílio para realização de atividades do interesse do estudante e em consonância com as necessidades da instituição, que estejam preferencialmente relacionados à formação do estudante.</p>
                </div>';

            //seta tool tip
            $conteudo = '<script>
                    $(document).ready(function(){
                        SetupTooltips();
                    });
                    </script>';
            if($imprimir!=NULL):
                $conteudo .= '<span class="tituloInicio">Questionário | Dados pessoais(1/7)</span>';
            else:
                $conteudo .= $this->montaTitulo('Questionário | Dados pessoais(1/7)');
            endif;
            $conteudo .= $this->inicioFormulario('frm_passo1', 'formulario2', 'questionario.php?metodo='.$metodo.'&acao=adicionar&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioresposta']);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario_campus', 'txt_id_questionario_campus', '', NULL, NULL, $id_questionario);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_nome', 'txt_nome', 'Nome', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['nome'], NULL, 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('radio', 'sexo', 'sexo', 'Sexo', '30', 'validate[required]', 'M', NULL, 0, 1, NULL, $questionarioResposta[0]['sexo']['masculino']).'Masculino  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'sexo', 'sexo', NULL,'30', 'validate[required]', 'F', NULL, 0, 1, NULL, $questionarioResposta[0]['sexo']['feminino']).'Feminino'.'<br />';
            $conteudo .= $this->inputTextQuestionario('text', 'txt_dataNascimento', 'txt_dataNascimento', 'Data Nascimento', 40, 'validate[required] inputQuestionario', System::converteData($questionarioResposta[0]['dataNascimento']), NULL, 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_carteiraIdentidade', 'txt_carteiraIdentidade', 'Identidade', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['carteiraDeIdentidade'], NULL, 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_orgaoExpedidor', 'txt_orgaoExpedidor', 'Orgão expedidor', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['orgaoExpedidor'], NULL, 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_cpf', 'txt_cpf', 'CPF', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['cpf'], 'cpf', 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_email', 'txt_email', 'E-mail', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['email'], NULL, 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_telefone', 'txt_telefone', 'Telefone', 40, 'inputQuestionario', $questionarioResposta[0]['telefone'], 'cel', 1, NULL, 1);
            $conteudo .= $this->inputTextQuestionario('text', 'txt_celular', 'txt_celular', 'Celular', 40, 'inputQuestionario', $questionarioResposta[0]['celular'], 'cel', 1, NULL, 1);
            //lista cursos
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_curso', 'cmb_curso', 'Curso', 'validate[required] inputQuestionario', $listagemCursos, $questionarioResposta[0]['id_curso'], NULL, NULL, $readOnly);
            //cidade do curso se marcar opção id
            $conteudo .= '<div id="div_complemento9">';
            if($questionarioResposta[0]['id_curso']=='1'){
                $listagemCidades = $questionarioDAO->buscaCidadesCurso();
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_cidadesCurso', 'cmb_cidadesCurso', 'Em qual cidade está cursando', 'validate[required] inputQuestionario', $listagemCidades, $questionarioResposta[0]['id_cidadeCursando'], NULL, NULL, $readOnly);
            }
            $conteudo .= '</div>';
            //campus matriculado
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_campus', 'cmb_campus', 'Campus', 'validate[required] inputQuestionario', $listagemCampus, $questionarioResposta[0]['id_campus'], 'onchange="carregaBeneficios();"', NULL, $readOnly);
            
            /*  Tem Filhos  */
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_filho', 'rad_filho', 'Tem filhos', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_filho']['s'], 'onclick="carregaFilhos(); carregaBeneficios();"').'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_filho', 'rad_filho', NULL,'30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_filho']['n'], 'onclick="carregaFilhos(); carregaBeneficios();"').'Não'.'<br />';
            $conteudo .= '<div id="div_temFilhos">';
            if($questionarioResposta[0]['rad_filho']['s']=='checked="checked"'){
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
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_numeroFilhos', 'cmb_numeroFilhos', 'Quantos filhos', 'validate[required] inputQuestionario', $numeroFilhos, $questionarioResposta[0]['numeroFilhos'], NULL, NULL, $readOnly);
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_numeroFilhos6Anos', 'cmb_numeroFilhos6Anos', 'Quantos dos seus filhos possui até 6 anos', 'validate[required] inputQuestionario', $numeroFilhosAte6Anos, $questionarioResposta[0]['filhosAte6Anos'], NULL, NULL, $readOnly);
            }
            $conteudo .= '</div>';
            
            /*  Núcleo Familiar  */
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_resideFamilia', 'rad_resideFamilia', 'Reside com <span class="show-tooltip" title="Núcleo Familiar é o grupo de pessoas que vivem da mesma renda!"><span class="textoObs" width="110%">núcleo familiar <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>?', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_resideFamilia']['s'], 'onchange="carregaLocalReside();"').'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_resideFamilia', 'rad_resideFamilia', '', '30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_resideFamilia']['n'],  'onchange="carregaLocalReside();"').'Não'.' <br />';
            $conteudo .= '<div id="div_localReside">';
            if($questionarioResposta[0]['rad_resideFamilia']['n']=='checked="checked"'):
                $resideFamilia = array('Sozinho(a)', 'Parentes', 'Pensão/Hotel', 'República', 'Outros'); $i=0; $listagemLocalReside='';
                foreach ($resideFamilia as $valor):
                    $listagemLocalReside[$i]['id'] .= $valor;
                    $listagemLocalReside[$i]['nome'] .= $valor; $i++; 
                endforeach;
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_local_reside', 'cmb_local_reside', 'Com quem você mora', 'validate[required] inputQuestionario', $listagemLocalReside, $questionarioResposta[0]['local_reside'], NULL, NULL, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'cep2', 'txt_cep2', 'CEP do local onde seu <strong> <font color="#9B2038">você</font></strong> reside', 40, 'validate[required] inputQuestionario', System::mostraCEP($questionarioResposta[0]['cep2']), 'cep', 1, NULL, $readOnly, NULL, 'onchange="consultaCEP2();"');
                $conteudo .= '<div id="div_cep2">';
                $conteudo .= $cidadeView->montaEnderecoCEP2($questionarioResposta[0]['id_uf2'], $questionarioResposta[0]['id_cidade2'], utf8_decode($questionarioResposta[0]['bairro2']), utf8_decode($questionarioResposta[0]['logradouro2']), $cidadeDAO->listaUF(), $cidadeDAO->listaCidades($questionarioResposta[0]['id_uf2']), utf8_decode($questionarioResposta[0]['numerocomplemento2']), $readOnly);
                $conteudo .= '</div>';
            endif;
            $conteudo .= '</div>';
            
            foreach (array(1,2,3,4,5,6,7,'Mais de 7') as $aux):
                $cmb_numMembrosFamiliar[] = array('id' => $aux, 'nome' => $aux);
            endforeach;            
            
            $conteudo .= $this->montaSelectQuestionario(NULL, 'numMembrosFamiliar', 'txt_numMembrosFamiliar', 'Quantas pessoas, incluindo você, fazem parte do seu núcleo familiar', 'validate[required] inputQuestionario', $cmb_numMembrosFamiliar, $questionarioResposta[0]['numMembrosFamiliar'], NULL, NULL, $readOnly);
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_distanciaIFMG', 'cmb_distanciaIFMG', 'Qual a distância da residência do seu núcleo familiar até o local que está cursando o curso no IFMG', 'validate[required] inputQuestionario', $listagemDistancia, $questionarioResposta[0]['id_distanciaIFMG'], NULL, NULL, $readOnly);
            
            if($imprimir!=NULL):
                $conteudo .= $this->inputTextQuestionario('text', 'txt_beneficio', 'txt_celular', 'Benefícios <span class="show-tooltip" title="Os benefícios só irão aparecer depois de selecionar o campus e responder se tem filhos e se reside com o núcleo familiar!"><span class="textoObs" width="110%">Atenção <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>', 55, 'inputQuestionario', $beneficio, NULL, 1, NULL, $readOnly);
            else:
                $conteudo .= '<div id="div_beneficios">'.
                //beneficios pleiteados
                $this->montaSelectQuestionario('multiple', 'cmb_beneficios', 'cmb_beneficios', 'Benefícios <span class="show-tooltip" title="Os benefícios só irão aparecer depois de selecionar o campus, responder se tem filhos e se reside com o núcleo familiar!"><span class="textoObs" width="110%">Atenção <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>', 'multiselect', $listagemBeneficios, $beneficio, NULL, NULL, $readOnly, 1)
                .'<a class="fancybox" href="#ajudaAuxilio" title="Saiba mais sobre cada auxílio"><img src="sistema/geral/imagens/interrogacao.png" width="28px" height="28px" align="absmiddle" /></a> </div>';
            endif;
            

            //$conteudo .= $this->inputTextQuestionario('text', 'txt_matricula', 'txt_matricula', 'Matricula', 40, 'inputQuestionario', $questionarioResposta[0]['matricula'], NULL, 1, NULL, $readOnly);
            //turnos
            if($imprimir!=NULL):
               $conteudo .= $this->inputTextQuestionario('text', 'txt_turno', 'txt_turno', 'Turno', 40, 'inputQuestionario', $turno, NULL, 1, NULL, $readOnly);
            else:
              $conteudo .= $this->montaSelectQuestionario('multiple', 'cmb_turno', 'cmb_turno', 'Turno', 'multiselect', $listagemTurno, $turno, NULL, NULL, $readOnly);
            endif;
            
            $conteudo .= $this->inputTextQuestionario('text', 'txt_anoSemestreIngresso', 'txt_anoSemestreIngresso', 'Ano/semestre ingresso IFMG', 40, 'validate[required] inputQuestionario', $questionarioResposta[0]['anoSemestreIngresso'], 'anoSemestre', 1, NULL, $readOnly);
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_situacaoCivil', 'cmb_situacaoCivil', 'Situação civil', 'validate[required] inputQuestionario', $listagemSituacaoCivil, $questionarioResposta[0]['id_situacaoCivil'], NULL, NULL, $readOnly);
            
            //parente que estuda no campus
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_parente', 'rad_parente', 'Tem parente que estuda no campus que está matriculado', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_parente']['s']).'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_parente', 'rad_parente', '', '30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_parente']['n']).'Não  <br />';
            
            /*  Recebeu auxílio do semestre anterior  */
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_recurso', 'rad_recurso', 'Recebeu auxilio socioeconomico do IFMG no semestre passado', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_recurso']['s'], 'onclick="carregaRecebeuAuxilio()";').'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_recurso', 'rad_recurso', '', '30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_recurso']['n'], 'onclick="carregaRecebeuAuxilio()";').'Não'.'<br />';
            $conteudo .= '<div id="div_recebeuAuxilio">';
            $auxAnterior = $questionarioResposta[0]['id_auxilioanterior'];
            if ($auxAnterior != NULL):
                for ($i=0; $i<strlen($auxAnterior); $i++):
                    if ($auxAnterior[$i] != ';'):
                        $slc_auxilioAnterior[] = $auxAnterior[$i];
                    endif;
                endfor;
                if ($imprimir != NULL):
                    $conteudo .= $this->inputTextQuestionario('text', NULL, NULL, 'Informe o auxílio recebido', '54', 'inputQuestionario', $questionarioResposta[0]['id_auxilioanterior'], NULL, 1, 1);
                else:
                    $conteudo .= $this->montaSelectQuestionario('multiple', 'auxilioAnterior', 'slc_auxilioAnterior', 'Informe o auxílio recebido:', 'validate[required] inputQuestionario multiselect', $questionarioDAO->buscaTodosBeneficios(), $slc_auxilioAnterior, NULL, NULL, $readOnly);
                endif;
            endif;
            $conteudo .= '</div>';
            
            //endereco da familia
            $conteudo .= $this->inputTextQuestionario('text', 'cep', 'txt_cep', 'CEP do local onde seu <strong><font color="#9B2038">núcleo Familiar</font></strong> reside', 40, 'validate[required] inputQuestionario', System::mostraCEP($questionarioResposta[0]['cep']), 'cep', 1, NULL, $readOnly, NULL, 'onchange="consultaCEP();"');
            $conteudo .= '<div id="div_cep">';
            
            if($questionarioResposta[0]['cep']!=''){
                $conteudo .= $cidadeView->montaEnderecoCEP($questionarioResposta[0]['id_uf'], $questionarioResposta[0]['id_cidade'], utf8_decode($questionarioResposta[0]['bairro']), utf8_decode($questionarioResposta[0]['logradouro']), $cidadeDAO->listaUF(), $cidadeDAO->listaCidades($questionarioResposta[0]['id_uf']), utf8_decode($questionarioResposta[0]['numerocomplemento']), $readOnly);
            }else{
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_uf', 'cmb_uf', 'Estado', 'validate[required] inputQuestionario', $questionarioDAO->buscaLocal('Estado'), $id_uf, 'onchange="carregaCidades();"', NULL, $readOnly);
                $conteudo .= '<div id="div_cidade">'.$this->montaSelectQuestionario('', 'cmb_cidade', 'cmb_cidade', 'Cidade', 'validate[required] inputQuestionario', array(), $id_cidade, NULL, NULL, $readOnly).'</div>';
                $conteudo .= $this->inputTextQuestionario('text', 'txt_bairro', 'txt_bairro', 'Bairro', 40, 'validate[required] inputQuestionario', utf8_encode($bairro), NULL, 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'txt_logradouro', 'txt_logradouro', 'Logradouro (Avenida, Rua, Travessa, etc)', 40, 'validate[required] inputQuestionario', utf8_encode($logradouro), NULL, 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'txt_numeroComplemento', 'txt_numeroComplemento', 'Número/Complemento', 40, 'validate[required] inputQuestionario', $numeroComplemento, NULL, 1, $readOnly);
            }
            $conteudo .= '</div>';
            //situacao imovel
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_situacaoImovel', 'cmb_situacaoImovel', 'Situação imóvel da familia', 'validate[required] inputQuestionario', $listagemSituacaoImovel, $questionarioResposta[0]['id_situacaoImovel'], NULL, NULL, $readOnly);
            
            //deficiencia
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_portadorDeficiencia', 'rad_portadorDeficiencia', 'Você é portador de alguma deficiência?', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_deficiencia']['s'], 'onclick="carregaDeficiencia();"').'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_portadorDeficiencia', 'rad_portadorDeficiencia', '', '30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_deficiencia']['n'], 'onclick="carregaDeficiencia();"').'Não'.' <br />';
            $conteudo .= '<div id="div_deficienciaComplemento">';
            if($questionarioResposta[0]['rad_deficiencia']['s']=='checked="checked"'){
                $listaDeficiencia = $questionarioDAO->buscaDeficiencia();
                $conteudo .= $this->montaSelectQuestionario('', 'cmb_deficiencia', 'cmb_deficiencia', 'Qual deficiência', 'validate[required] inputQuestionario', $listaDeficiencia, $questionarioResposta[0]['id_deficiencia'], NULL, NULL, $readOnly);
            }
            $conteudo .= '</div>';
            //outros componentes familiares asssistidos pela ifmg
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_outrosComponentesAssistidos', 'rad_outrosComponentesAssistidos', 'Outros componentes do grupo familiar foram ou são assistidos pelo IFMG?', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_outrosComponentesAssistidos']['s']).'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'rad_outrosComponentesAssistidos', 'rad_outrosComponentesAssistidos', '', '30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['rad_outrosComponentesAssistidos']['n']).'Não  <br /><br />';
            //complemento deficiencia
            //botão avancar validando tudo e granvando no BD
            if($imprimir==NULL)
                $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
        
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            echo $conteudo;

       }

        public function mostraPasso2($id, $questionarioResposta, $cmb_tipoEscola, $cmb_anosEscola, $cmb_outroCurso, $cmb_situacaoTrab, $cmb_situacaoTrab_pai, $cmb_escolaridade, $imprimir=NULL){
            if($questionarioResposta[0]['id_status']==2){ //Caso seja apenas Visualizar
                $readOnly = 1;
                $passo = 3;
                $metodo = proximoPasso;
            }else{
                $metodo = 'adicionarPasso';
                $passo = 2;}

            $conteudo = $this->montaTitulo('Questionário | Dados Acadêmicos e Familiares (2/7)');
            $conteudo .= $this->inicioFormulario('frm_passo2', 'formulario2', 'questionario.php?metodo='.$metodo.'&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
            // Tipo de escola que frequentou
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_tipoEscola', 'cmb_tipoEscola', 'Em que tipo de escola você concluiu a maior parte (50% ou mais) do ensino médio:', 'validate[required] inputQuestionario', $cmb_tipoEscola, $questionarioResposta[0]['tipoescola'], NULL, NULL, $readOnly);
            // Quanto tempo frequentou a escola
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_anosEscola', 'cmb_anosEscola', 'Quantos anos aproximadamente você freqüentou a escola pública:', 'validate[required] inputQuestionario', $cmb_anosEscola, $questionarioResposta[0]['frequencia'], NULL, NULL, $readOnly);
            // Possui curso Superior?
            $conteudo .= $this->inputTextQuestionario('radio', 'cursoSuperior', 'cursoSuperior', 'Você já concluiu um curso de nível superior:', '30', 'validate[required]', 'S', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['cursoSuperior']['s']).'Sim  ';
            $conteudo .= $this->inputTextQuestionario('radio', 'cursoSuperior', 'cursoSuperior', NULL,'30', 'validate[required]', 'N', NULL, 0, $readOnly, NULL, $questionarioResposta[0]['cursoSuperior']['n']).'Não'.'<br />';
            // Faz outro curso alem desse?
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_outroCurso', 'cmb_outroCurso', 'Você está cursando outro curso (nível médio ou superior) além deste que está fazendo no IFMG:', 'validate[required] inputQuestionario', $cmb_outroCurso, $questionarioResposta[0]['outroCurso'], NULL, NULL, $readOnly);
            // Situação de trabalho
            if($imprimir!=NULL):
                $conteudo .= $this->inputTextQuestionario('text', 'txt_beneficio', 'txt_celular', 'Qual é a sua situação de trabalho', 175, 'inputQuestionario', $questionarioResposta[0]['situacaoTrab'], NULL, 1, NULL, $readOnly);
            else:
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_situacaoTrab', 'cmb_situacaoTrab', 'Qual é a sua situação de trabalho:', 'validate[required] inputQuestionario', $cmb_situacaoTrab, $questionarioResposta[0]['situacaoTrab'], NULL, NULL, $readOnly);
            endif;
            // Situação trabalho pai
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_escolaridadePai', 'cmb_escolaridadePai', 'Qual a escolaridade do seu pai:', 'validate[required] inputQuestionario', $cmb_escolaridade, $questionarioResposta[0]['escolaridadePai'], NULL, NULL, $readOnly);
            if($imprimir!=NULL):
                $conteudo .= $this->inputTextQuestionario('text', 'txt_beneficio', 'txt_celular', 'Qual é a situação de trabalho de seu pai/padrasto', 175, 'inputQuestionario', $questionarioResposta[0]['situacaoTrab_pai'], NULL, 1, NULL, $readOnly);
            else:
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_situacaoTrab_pai', 'cmb_situacaoTrab_pai', 'Qual é a situação de trabalho de seu pai/padrasto:', 'validate[required] inputQuestionario', $cmb_situacaoTrab_pai, $questionarioResposta[0]['situacaoTrab_pai'], NULL, NULL, $readOnly);
            endif;
            //// Situação trabalho mae
            if($imprimir!=NULL):
                $conteudo .= $this->inputTextQuestionario('text', 'txt_beneficio', 'txt_celular', 'Qual é a situação de trabalho da sua mãe/madrasta', 175, 'inputQuestionario', $questionarioResposta[0]['situacaoTrab_mae'], NULL, 1, NULL, $readOnly);
            else:
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_situacaoTrab_mae', 'cmb_situacaoTrab_mae', 'Qual é a situação de trabalho da sua mãe/madrasta:', 'validate[required] inputQuestionario', $cmb_situacaoTrab_pai, $questionarioResposta[0]['situacaoTrab_mae'], NULL, NULL, $readOnly);
            endif;
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_escolaridadeMae', 'cmb_escolaridadeMae', 'Qual a escolaridade da sua mãe:', 'validate[required] inputQuestionario', $cmb_escolaridade, $questionarioResposta[0]['escolaridadeMae'], NULL, NULL, $readOnly).'<br />';
            if($imprimir==NULL):
                $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                          parent.window.location = \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\';
                                          jQuery(\'#frm_passo2\').validationEngine(\'hide\');"');
                $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
            endif;
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            
            echo $conteudo;
        }

        public function mostraPasso3($id, $questionarioResposta, $tbl_nucleoFamiliar, $cabecalhoNucleoFamiliar) {
            if ($questionarioResposta[0]['id_status'] != 1):
                $arrayOpcoes = NULL;
                $readOnly = 1;
                $passo = 4;
                $metodo = proximoPasso;
            else:
                $metodo = 'adicionarPasso';
                $passo = 3;
                $arrayOpcoes = array(
                    array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoMembro', 'divCarregar'=>'div_formularioMembro'), 
                    array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoMembro', 'divCarregar'=>'div_tabelaNucleo', 'msgExcluir'=>'Deseja excluir o membro selecionado?'));
            endif;
                
            if (!$tbl_nucleoFamiliar): // Chama o carregaNovoMembro passando o Nome e ação abrirSolicitante
                echo '<script> carregaNovoMembro("abrirSolicitante", "'.$questionarioResposta[0]['nome'].'");  </script>';
            endif;
                
            $conteudo = $this->montaTitulo('Questionário | Dados Acadêmicos e Familiares (3/7)');
            $conteudo .= $this->inicioFormulario('frm_passo3', 'formulario2', 'questionario.php?metodo='.$metodo.'&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
            $conteudo .= 'Cadastramento do Núcleo Familiar (Núcleo Familiar é o grupo de pessoas que vivem da mesma renda, <b>inclusive você</b>):';
            //monta tabela do nucleo
            $conteudo .= '<div id="div_tabelaNucleo">';
            if($tbl_nucleoFamiliar) //Só vai mostrar a tabela quando tiver dados
            $conteudo .= $this->montarTabela('', $tbl_nucleoFamiliar, $cabecalhoNucleoFamiliar, $arrayOpcoes, NULL, array(2=>array('tipo'=>'cpf'), 5=>array('tipo'=>'moeda'), 6=>array('tipo'=>'moeda'), 7=>array('tipo'=>'moeda'), 8=>array('tipo'=>'moeda'), 9=>array('tipo'=>'moeda'),10=>array('tipo'=>'moeda'), 12=>array('tipo'=>'moeda')));
            $conteudo .= '<div id="div_formularioMembro"></div>';
            $conteudo .= '</div>';
            
            //botao novo membro nucleo familiar
            if($questionarioResposta[0]['id_status']==1){
            $conteudo .= '<div style="padding-top: 5px"><hr>Clique em <b>Novo Membro</b> caso queira adicionar alguma pessoa em seu grupo familiar.</div>';
            $conteudo .= $this->montaBotao('Novo Membro', 'formulario', 'onclick="carregaNovoMembro();";').'<br />';}
            $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&passo=2&ok\');
                                            parent.window.location = \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&passo=2&ok\';
                                            jQuery(\'#frm_passo7\').validationEngine(\'hide\');"');
            $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            echo $conteudo;
            
        }
        
        public function mostraPasso4($id, $questionarioResposta, $tbl_veiculos, $cabecalhoVeiculos){
            if($questionarioResposta[0]['id_status']!=1){ // Caso seja apenas Visualizar
                $arrayOpcoes = NULL;
                $readOnly = 1;
                $passo = 5;
                $metodo = proximoPasso;
            }else{
                $metodo = 'adicionarPasso';
                $passo = 4;
                $arrayOpcoes = array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoVeiculo', 'divCarregar'=>'div_formularioVeiculo'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoVeiculo', 'divCarregar'=>'div_tabelaVeiculo', 'msgExcluir'=>'Deseja excluir o veículo selecionado?'));}

            $conteudo = $this->montaTitulo('Veículos (4/7)');
            $conteudo .= $this->inicioFormulario('frm_passo4', 'formulario4', 'questionario.php?metodo='.$metodo.'&acao=adicionar&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', 'inputQ', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
            $conteudo .= 'Cadastramento de veículo(s) - caso você e/ou algum membro do seu Núcleo Familiar possua(m) veículo(s) (carro, motocicleta, caminhão, caminhonete, trator, etc.)';
            $conteudo .= '<div id="div_tabelaVeiculo">';
            if($tbl_veiculos) //Só vai mostrar a tabela quando tiver dados
            $conteudo .= $this->montarTabela('', $tbl_veiculos, $cabecalhoVeiculos, $arrayOpcoes, NULL, array(7=>array('tipo'=>'moeda')));
            $conteudo .= '<div id="div_formularioVeiculo"></div>';
            $conteudo .= '</div>';
            if($questionarioResposta[0]['id_status']==1){
            $conteudo .= '<div style="padding-top: 5px"><hr>Clique em <b>Novo Veículo</b> para adicionar um novo veículo.</div>';
            $conteudo .= $this->montaBotao('Novo Veículo', 'formulario', 'onclick="carregaNovoVeiculo();";').'<br />';}
            $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=3&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                            parent.window.location = \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=3&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\'
                                            jQuery(\'#frm_passo7\').validationEngine(\'hide\');"');
            $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            echo $conteudo;

       }

        public function mostraPasso5($id, $questionarioResposta, $tbl_imovel, $cabecalhoImoveis){
            if($questionarioResposta[0]['id_status']!=1){
                $arrayOpcoes = NULL;
                $readOnly = 1;
                $passo = 6;
                $metodo = proximoPasso;
            }else{
                $metodo = 'adicionarPasso';
                $passo = 5;
                $arrayOpcoes = array(array('editar', 'acaoJS'=>'1', 'metodoJS'=>'questionario.php?metodo=carregaNovoImovel', 'divCarregar'=>'div_formularioImovel'), array('excluir', 'metodoExcluir'=>'questionario.php?metodo=excluirNovoImovel', 'divCarregar'=>'div_tabelaImovel', 'msgExcluir'=>'Deseja excluir o imóvel selecionado?'));}

            $conteudo = $this->montaTitulo('Imóveis (5/7)');
            $conteudo .= $this->inicioFormulario('frm_pass5', 'formulario5', 'questionario.php?metodo='.$metodo.'&acao=adicionar&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
            $conteudo .= 'Cadastramento de imóvel(is) - caso você e/ou algum membro do seu núcleo familiar possua(m) imóvel(is) (casa, lote, sítio, etc.) além do que reside! ';
            $conteudo .= '<div id="div_tabelaImovel">';
            if($tbl_imovel) //Só vai mostrar a tabela quando tiver dados
            $conteudo .= $this->montarTabela('', $tbl_imovel, $cabecalhoImoveis, $arrayOpcoes);
            $conteudo .= '<div id="div_formularioImovel"></div>';
            $conteudo .= '</div>';
            if($questionarioResposta[0]['id_status']==1){
            $conteudo .= '<div style="padding-top: 5px"><hr>Clique em <b>Novo Imóvel</b> para adicionar um novo imóvel.</div>';
            $conteudo .= $this->montaBotao('Novo Imóvel', 'formulario', 'onclick="carregaNovoImovel();";').'<br />';}
            $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=4&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                            parent.window.location = \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=4&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\'
                                            jQuery(\'#frm_passo7\').validationEngine(\'hide\');"');
            $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            echo $conteudo;

       }

        public function mostraPasso6($id, $questionarioResposta, $cmb_provedor, $cmb_escolaridadeProvedor, $imprimir=NULL){
//                if($questionarioResposta){ // Caso: Editar
//                $metodo = 'adicionarPasso';
//                $acao = 'editar';
//                $passo = '6';}
//
//            else{ // Para preencher o questionário
//                $metodo = 'adicionarPasso';
//                $acao = 'adicionar';
//                $passo = '6';}

            if($questionarioResposta[0]['id_status']==2){ // Caso seja só visualizar
                $readOnly = 1;
                $passo = 8; // Pula o passo 7
                $metodo = proximoPasso;
            }else{
                $metodo = 'adicionarPasso';
                $passo = 6;}

                //seta tool tip
            $conteudo = '<script>
                    $(document).ready(function(){
                        SetupTooltips();
                    });
                    </script>';
            $conteudo .= $this->montaTitulo('Questionário | Provedor (6/7)');
            $conteudo .= $this->inicioFormulario('frm_passo6', 'formulario6', 'questionario.php?metodo='.$metodo.'&passo='.$passo, 1, 'div_respostaFuncao');
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
            $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
            
            $cmb_provedor = ''; // Limpa o cmb_provedor;
            $cmb_provedor[0]['id'] = 1;
            $cmb_provedor[0]['nome'] = 'Somente o pai';
            $cmb_provedor[1]['id'] = 2;
            $cmb_provedor[1]['nome'] = 'Somente a mãe';
            $cmb_provedor[2]['id'] = 'Pai e mãe';
            $cmb_provedor[2]['nome'] = 'Pai e mãe';
            $cmb_provedor[3]['id'] = 10;
            $cmb_provedor[3]['nome'] = 'O próprio solicitante do auxílio';
            $cmb_provedor[4]['id'] = 8;
            $cmb_provedor[4]['nome'] = 'Cônjuge/companheiro';
            $cmb_provedor[5]['id'] = 9;
            $cmb_provedor[5]['nome'] = 'Avô/Avó';
            $cmb_provedor[6]['id'] = 'Outros';
            $cmb_provedor[6]['nome'] = 'Outros';
                            
            $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_provedor', 'cmb_provedor', 'Quem é o <span class="show-tooltip" title="Membro familiar com maior contribuição na renda!"><span class="textoObs" width="110%">provedor <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span> do seu Núcleo Familiar:', 'validate[required] inputQuestionario', $cmb_provedor, $questionarioResposta[0]['provedor'], 'onchange="carregaEscolaridadeProvedor()"', NULL, $readOnly);
            $conteudo .= '<div id="div_escolaridadeProvedor">';
            if($questionarioResposta[0]['provedor'] == 'Pai e mãe'){
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor', 'cmb_escolaridadeProvedor', 'Informe a escolaridade do seu pai:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $questionarioResposta[0]['escolaridadeProvedor'], NULL, NULL, $readOnly);
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor_2', 'cmb_escolaridadeProvedor_2', 'Informe a escolaridade da sua mãe:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $questionarioResposta[0]['escolaridadeProvedor_2'], NULL, NULL, $readOnly);
            }
            else
                $conteudo .= $this->montaSelectQuestionario(NULL, 'cmb_escolaridadeProvedor', 'cmb_escolaridadeProvedor', 'Qual a escolaridade do provedor do seu Núcleo Familiar:', 'validate[required] inputQuestionario', $cmb_escolaridadeProvedor, $questionarioResposta[0]['escolaridadeProvedor'], NULL, NULL, $readOnly);
            $conteudo .= '</div>';
            
            if($imprimir==NULL):
                $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=5&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                            parent.window.location= \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=5&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\'
                                            jQuery(\'#frm_passo6\').validationEngine(\'hide\');"');
                $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
            endif;
            $conteudo .= $this->fechaFormulario();
            $conteudo .= '<div id="div_respostaFuncao"></div>';
            echo $conteudo;
            }

        public function mostraPasso7($id, $questionarioResposta){
            
//
//           if($questionarioResposta){ // Caso: Editar
//               $metodo = 'adicionarPasso';
//               $acao = 'editar';
//               $passo = '7';
//
//                // DEPOIS ARRUMAR - CONFIRMAR OS CAMPOS
//                $slc_escolaridadeProvedor = $questionarioResposta[0]['id_escolaridade_provedor'];}
//            else{ // Para preencher o questionário
//                $metodo = 'adicionarPasso';
//                $acao = 'adicionar';
//                $passo = '7';}

           if($questionarioResposta[0]['id_status']==2){ // Caso seja só visualizar
                $readOnly = 1;
                $passo = 8;
                $metodo = proximoPasso;
           }else{
                $metodo = 'adicionarPasso';
                $passo = 7;}


                $conteudo = $this->montaTitulo('Questionário | Despesas do núcleo Familiar (7/7)');
                $conteudo .= $this->inicioFormulario('frm_passo7', 'formulario7', 'questionario.php?metodo='.$metodo.'&passo='.$passo, 1, 'div_respostaFuncao');
                $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
                $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
                $conteudo .= '<div>Preencha, abaixo, as despesas do seu Núcleo Familiar:</div>';
                $conteudo .= $this->inputTextQuestionario('text', 'agua', 'agua', 'Água', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['agua']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'luz', 'luz', 'Luz', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['luz']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'telefone', 'telefone', 'Telefone', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['telefone']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'condominio', 'condominio', 'Condomínio', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['condominio']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'escola_faculdade', 'escola_faculdade', 'Mensalidades escolares / faculdade', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['escola_faculdade']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'alimentacao', 'alimentacao', 'Alimentação', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['alimentacao']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'saude_medicamentos', 'saude_medicamentos', 'Saúde / Medicamentos', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['saude_medicamentos']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'transporte', 'transporte', 'Transporte', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['transporte']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'aluguel', 'aluguel', 'Aluguel', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['aluguel']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'financiamento_consorcios', 'financiamento_consorcios', 'Financiamentos / Consórcios', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['financiamento_consorcios']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'funcionarios', 'funcionarios', 'Funcionários', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['funcionarios']), 'moeda', 1, $readOnly);
                $conteudo .= $this->inputTextQuestionario('text', 'outros', 'outros', 'Outros', 40, 'inputQuestionario', System::converteMoeda($questionarioResposta[0]['outros']), 'moeda', 1, $readOnly);
                $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=6&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                                parent.window.location= \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=6&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\'
                                                jQuery(\'#frm_passo2\').validationEngine(\'hide\');"');
                $conteudo .= $this->montaBotao('Próximo', 'formulario', NULL).'<br />';
                $conteudo .= $this->fechaFormulario();
                $conteudo .= '<div id="div_respostaFuncao"></div>';
                echo $conteudo;
                }

        public function mostraPasso8($id, $questionarioResposta, $nome, $cpf, $imprimir=NULL){
//           $metodo = 'AdicionarPasso';
//           $passo = '8';

           if($questionarioResposta[0]['id_status']==2){ // Caso seja só visualizar
                $readOnly = 1;
                //$passo = 'final';
                $metodo = proximoPasso;
                $botao = $this->montaBotao('Fechar', 'formulario', 'onclick="pageload(\'questionario.php?metodo=addQuestionarioAluno&acao=mostrar&ok\');
                                           parent.window.location = \'principal.php#questionario-metodo=addQuestionarioAluno&acao=mostrar&ok\';"');
           }else{
                $metodo = 'adicionarPasso';
                $passo = 8;}
           
           $conteudo = $this->montaTitulo('Termo de reponsabilidade (7/7)');
           $conteudo .= $this->inicioFormulario('frm_passo8', 'formulario7', 'questionario.php?metodo='.$metodo.'&passo='.$passo, 1, 'div_respostaFuncao');
           $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionario', 'txt_id_questionario', '', NULL, NULL, $id);
           $conteudo .= $this->inputTextQuestionario('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', NULL, NULL, $questionarioResposta[0]['id_questionarioResposta']);
           $conteudo .= '<div><p>Eu, <b>'.$nome.'</b>, portador(a) do CPF nº <b>'.System::mostraCPF($cpf).'</b>, responsabilizo-me, sob as penas do Art. 299 e do Art. 171 do Código Penal, pela veracidade da documentação apresentada para a solicitação da análise socioeconômica aplicada pelo Instituto Federal de Educação, Ciência e Tecnologia de Minas Gerais (IFMG).</p>
                         <p>Responsabilizo-me também em comunicar caso ocorra qualquer alteração no meu contexto socioeconômico, através de informações documentadas e que poderei responder civil e criminalmente em caso de omissão.</p>
                         <p>Estou ciente sobre os instrumentais técnicos utilizados pelo IFMG (solicitação de novos documentos, entrevista individual, visita domiciliar, entre outros) para averiguação das informações prestadas e documentadas por mim.</p> </div>';
           $conteudo .= $this->inputTextQuestionario('checkbox', 'aceita', 'aceita', NULL, 30, 'validate[required]',NULL, NULL, NULL, $readOnly, NULL, $questionarioResposta[0]['checkbox']).' Concordo com o termo acima apresentado<br />';
           if($imprimir==NULL):
           $conteudo .= $this->montaBotao('Anterior', 'formulario', 'onclick="pageload(\'questionario.php?metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=6&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\');
                                           parent.window.location = \'principal.php#questionario-metodo=preencherQuestionario&id_questionarioPeriodo='.$id.'&passo=6&id_questionarioResposta='.$questionarioResposta[0]['id_questionarioResposta'].'&ok\'
                                           jQuery(\'#frm_passo8\').validationEngine(\'hide\');"');
           
           if($botao) // Se for apenas visualizar, mostra botão para retornar aos questionarios
               $conteudo .= $botao;
           else{
               $conteudo .= $this->montaBotao('Confirmar', 'formulario', 'onclick="jConfirm(\'O formulário será enviado para análise e não será possível edita-lo posteriormente.<br /> Deseja confirmar o envio?\', \'Confirmação de Envio!\',
					function(r) {
                                        if(r==true){
                                            document.getElementById(\'btn_enviarFormulario\').click();
                                        }else {
                                            alert(\'Questionário Salvo. Para enviá-lo para análise é necessário confirmar o termo de responsabilidade.\');
                                            pageload(\'questionario.php?metodo=addQuestionarioAluno&acao=mostrar\');
                                        }
                                            });"').'<br />'; }

           $conteudo .= $this->montaBotao('foi', NULL, NULL, 'btn_enviarFormulario', 1);
           endif;
           $conteudo .= $this->fechaFormulario();
           $conteudo .= '<div id="div_respostaFuncao"></div>';
           echo $conteudo;

       }

        public function cadastraNovoMembro($listaGrauParentesco, $nome, $grauParentesco, $idade, $rendaMensal, $rendaAluguel, $rendaPensaoMorte, $rendaPensaoAlimenticia, $rendaAjudaTereceiros, $rendaOutros, $descricaoOutros, $recebeBolsaFamiliaS, $recebeBolsaFamiliaN, $id_questionarioResposta, $id_grupoFamiliar=NULL, $rendaBPC, $cpf){
           if ($id_grupoFamiliar==NULL):
                $valueBotao = 'Adicionar Membro';
                $titulo = 'Membro do núcleo familiar';
                $botaoCancelar = 'Cancelar Cadastro';
            else:
                $valueBotao = 'Editar Membro';
                $titulo = 'Editar membro Familiar';
                $botaoCancelar = 'Cancelar Edição';
            endif;
            
            $html = '<script>
                    $(document).ready(function(){
                        SetupTooltips();
                    });
                    </script>';
            $html .= $this->montaTitulo($titulo);
            $html .= $this->inicioFormulario('frm_passo7', 'formulario7', 'questionario.php?metodo=addNovoMembro', 1, 'div_tabelaNucleo');
            $html .= $this->inputText('hidden', 'txt_id_grupoFamiliar', 'txt_id_grupoFamiliar', '', '', '', $id_grupoFamiliar);
            $html .= $this->inputText('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', '', '', $id_questionarioResposta);
            $html .= $this->inputText('hidden', 'txt_hidden_rendaBPC', 'txt_hidden_rendaBPC', '', '', '', $rendaBPC);
            $html .= $this->inputText('text', 'txt_nome', 'txt_nome', 'Nome', 40, 'validate[required] inputQuestionario', $nome, NULL, 1);
            $html .= $this->montaSelect('', 'cmb_grauParentesco', 'cmb_grauParentesco', 'Grau parentesco', 'validate[required] inputQuestionario', $listaGrauParentesco, $grauParentesco);
            $html .= $this->inputText('text', 'txt_idade', 'txt_idade', 'Idade', 40, 'validate[required,custom[onlyNumberSp],maxSize[3]] inputQuestionario', $idade, NULL, 1);
            $html .= $this->inputText('text', 'txt_rendaMensal', 'txt_rendaMensal', '<span class="show-tooltip" title="Renda proveniente de serviço!"><span class="textoObs" width="110%">Renda Mensal <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>', 40, 'inputQuestionario', System::converteMoeda($rendaMensal), 'moeda', 1);
            $html .= $this->inputText('text', 'cpf', 'txt_cpf', 'CPF', '40', 'inputQuestionario', $cpf, 'cpf', 1);
            // $html .= $this->inputText('text', 'txt_rendaAluguel', 'txt_rendaAluguel', '<span class="show-tooltip" title="Renda recebida como aluguel!"><span class="textoObs" width="110%">Renda Aluguel <img class="icone_tooltip" src="sistema/geral/imagens/ico_toolTip.png" /></span></span>', 40, 'inputQuestionario', System::converteMoeda($rendaAluguel), 'moeda', 1);
            $html .= $this->inputText('text', 'txt_rendaPensaoMorte', 'txt_rendaPensaoMorte', 'Renda Pensão Morte', 40, 'inputQuestionario', System::converteMoeda($rendaPensaoMorte), 'moeda', 1);
            $html .= $this->inputText('text', 'txt_rendaPensaoAlimenticia', 'txt_rendaPensaoAlimenticia', 'Renda Pensão Alimentícia', 40, 'inputQuestionario', System::converteMoeda($rendaPensaoAlimenticia), 'moeda', 1);
            $html .= $this->inputText('text', 'txt_rendaPensaoAjudaTerceiros', 'txt_rendaPensaoAjudaTerceiros', 'Renda Ajuda Terceiros', 40, 'inputQuestionario', System::converteMoeda($rendaAjudaTereceiros), 'moeda', 1);
            $html .= $this->inputText('text', 'txt_rendaOutros', 'txt_rendaOutros', 'Outras rendas', 40, 'inputQuestionario', System::converteMoeda($rendaOutros), 'moeda', 1);
            $html .= $this->inputText('text', 'txt_descricaoOutros', 'txt_descricaoOutros', 'Descrever outras rendas', 40, 'inputQuestionario', $descricaoOutros, NULL, 1);
            
            $html .= $this->inputTextQuestionario('radio', 'rad_bolsaFamilia', 'rad_bolsaFamilia', 'Esse membro recebe Bolsa Família ou BPC (Benefício de Prestação Continuada)?', '30', 'validate[required]', 'S', NULL, 0, NULL, NULL, $recebeBolsaFamiliaS, 'onchange="carregaBPC()"').'Sim  ';
            $html .= $this->inputTextQuestionario('radio', 'rad_bolsaFamilia', 'rad_bolsaFamilia', NULL,'30', 'validate[required]', 'N', NULL, 0, NULL, NULL, $recebeBolsaFamiliaN, 'onchange="carregaBPC()"').'Não'.'<br />';
            $html .= '<div id="div_bolsaFamilia">';
            if($recebeBolsaFamiliaS){
                $html .= $this->inputText ('text', 'txt_rendaBPC', 'txt_rendaBPC', 'Informe o valor', '40', 'validate[required,min[0.01]] inputQuestionario', System::converteMoeda($rendaBPC), 'moeda', 1);
            }
            $html .= '</div>';
            $html .= $this->montaBotao($valueBotao, 'formulario', '');
            $html .= $this->montaBotao($botaoCancelar, 'formulario', 'onclick="$(\'body\').validationEngine(\'hideAll\');
                                                                                    $(\'#div_formularioMembro\').html(\'\');"').'<br />';
            $html .= $this->fechaFormulario();
            return $html;
       }

        public function cadastraNovoVeiculo($id_questionarioResposta, $cmb_proprietario, $dadosVeiculos, $cmb_tipoVeiculo, $utilidade, $cmb_ano){
           if($dadosVeiculos){
               $titulo = 'Editar Veículo';
               $botao = 'Editar Veículo';}
           else{
               $titulo = 'Cadastrar novo veículo';
               $botao = 'Adicionar Veículo';}

           $html = $this->montaTitulo($titulo);
           $html .= $this->inicioFormulario('frm_passo7', 'formulario7', 'questionario.php?metodo=addNovoVeiculo', 1, 'div_tabelaVeiculo');
           $html .= $this->inputText('hidden', 'txt_id_veiculo', 'txt_id_veiculo', '', '', '', $dadosVeiculos[0]['id_veiculo']);
           $html .= $this->inputText('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', '', '', $id_questionarioResposta);
           $html .= $this->montaSelect('', 'cmb_proprietario', 'cmb_proprietario', 'Proprietário', 'validate[required] inputQuestionario', $cmb_proprietario, $dadosVeiculos[0]['id_grupofamiliar']);
           $html .= $this->montaSelect('', 'cmb_tipoVeiculo', 'cmb_tipoVeiculo', 'Tipo veículo', 'validate[required] inputQuestionario', $cmb_tipoVeiculo, $dadosVeiculos[0]['id_tipoveiculo']);
           $html .= $this->inputText('text', 'marca', 'marca', 'Marca', 40, 'validate[required] inputQuestionario', $dadosVeiculos[0]['marca'], NULL, 1);
           $html .= $this->inputText('text', 'modelo', 'modelo', 'Modelo', 40, 'validate[required] inputQuestionario', $dadosVeiculos[0]['modelo'], NULL, 1);
           $html .= $this->montaSelect('', 'ano', 'ano', 'Ano', 'validate[required] inputQuestionario', $cmb_ano, $dadosVeiculos[0]['ano']);
           
           //$html .= $this->inputText('text', 'ano', 'ano', 'Ano', 40, 'validate[required,custom[onlyNumberSp]] inputQuestionario', $dadosVeiculos[0]['ano'], NULL, 1);
           $html .= $this->montaSelect('', 'cmb_utilidade', 'cmb_utilidade', 'Utilidade', 'validate[required] inputQuestionario', $utilidade, $dadosVeiculos[0]['utilidade']);
           //$html .= $this->inputText('text', 'ipva', 'ipva', 'Valor IPVA', 40, 'validate[required] inputQuestionario', System::converteMoeda($dadosVeiculos[0]['valoripva']), 'moeda', 1);
           $html .= $this->montaBotao($botao, 'formulario', '');
           $html .= $this->montaBotao('Cancelar Cadastro', 'formulario', 'onclick="$(\'body\').validationEngine(\'hideAll\');
                                                                                    $(\'#div_formularioVeiculo\').html(\'\');"').'<br />';
           $html .= $this->fechaFormulario();
           return $html;
       }

        public function cadastraNovoImovel($id_questionarioResposta, $cmb_proprietario, $cmb_tipoImovel, $cmb_uf, $cmb_cidade, $dadosImovel, $serveNao, $serveSim){
           if($dadosImovel){
               $titulo = 'Editar Imóvel';
               $botao = 'Editar Imóvel';}
           else{
               $titulo = 'Cadastrar novo imóvel';
               $botao = 'Adicionar Imóvel';}

           $html = $this->montaTitulo($titulo);
           $html .= $this->inicioFormulario('frm_passo7', 'formulario7', 'questionario.php?metodo=addNovoImovel', 1, 'div_tabelaImovel');
           $html .= $this->inputText('hidden', 'txt_id_imovel', 'txt_id_imovel', '', '', '', $dadosImovel[0]['id_imovel']);
           $html .= $this->inputText('hidden', 'txt_id_questionarioResposta', 'txt_id_questionarioResposta', '', '', '', $id_questionarioResposta);
           $html .= $this->montaSelect('', 'cmb_proprietario', 'cmb_proprietario', 'Proprietário', 'validate[required] inputQuestionario', $cmb_proprietario, $dadosImovel[0]['id_grupofamiliar']);
           $html .= $this->montaSelect('', 'cmb_tipoImovel', 'cmb_tipoImovel', 'Tipo do imóvel', 'validate[required] inputQuestionario', $cmb_tipoImovel, $dadosImovel[0]['id_tipoimovel']);
           $html .= $this->montaSelect('', 'cmb_uf', 'cmb_uf', 'Local(Estado)', 'validate[required] inputQuestionario', $cmb_uf, $dadosImovel[0]['id_uf'], 'onchange="preencheCidade();"');
           $html .= '<div id="div_cidade">'.$this->montaSelect('', 'cmb_cidade', 'cmb_cidade', 'Local(Cidade)', 'validate[required] inputQuestionario', $cmb_cidade, $dadosImovel[0]['id_cidade']).'</div>';
           $html .= $this->inputTextQuestionario('radio', 'rad_residencia', 'rad_residencia', 'Este imóvel serve como residência para você e/ou algum membro do seu núcleo familiar', '30', 'validate[required]', 'Sim', NULL, 0, NULL, NULL, $serveSim).'Sim  ';
           $html .= $this->inputTextQuestionario('radio', 'rad_residencia', 'rad_residencia', NULL, '30', 'validate[required]', 'Não', NULL, 0, NULL, NULL, $serveNao).'Não'.'<br />';
           $html .= $this->montaBotao($botao, 'formulario', '');
           $html .= $this->montaBotao('Cancelar Cadastro', 'formulario', 'onclick="$(\'body\').validationEngine(\'hideAll\');
                                                                                   $(\'#div_formularioImovel\').html(\'\');"').'<br />';
           $html .= $this->fechaFormulario();
           return $html;
       }
	
        public function mostraRelatorio($cmb_questionario, $cmb_beneficios, $ordem, $cmb_campus){
            
            $html = '';
            $html .= $this->montaTitulo('Relatórios');
            $html .= $this->inicioFormulario('frmRelatorio', $class, 'questionario.php?metodo=montaRelatorio&acao=mostrar&ok', 1, 'div_relatorio');
            $html .= $this->montaSelect('multiple', 'cmb_questionario', 'cmb_Questionario', 'Questionário:', 'multiselect', $cmb_questionario);
            $html .= $this->montaSelect('multiple', 'cmb_beneficios', 'cmb_beneficios', 'Benefícios:', 'multiselect', $cmb_beneficios);
            $html .= $this->montaSelect('select', 'cmb_campus', 'cmb_campus', 'Campus:', 'inputQuestionario', $cmb_campus, NULL, 'onchange="carregaRelatorio()"');
            $html .= $this->montaSelect('select', 'cmb_ordem', 'cmb_ordem', 'Pontuação:', 'inputQuestionario', $ordem, NULL, 'onchange="carregaRelatorio()"');
            $html .= '<br />'.$this->inputText('checkbox', 'grafico', 'grafico', '', $size, $class, 'S', NULL, NULL, NULL, NULL, NULL, 'onchange="carregaRelatorio()"').' Selecione o Checkbox para visualizar o gráfico <br />';
            $html .= $this->montaBotao('Mostrar', 'formulario');
            $html .= $this->fechaFormulario();
            $html .= '<br /> <br /> <div id="div_relatorio"></div>';
            $html .= '<div id="div_grafico" style="width: 800px; height: 380px; margin: 12px"></div>';
            
            // Script para atualizar o MultiSelect
            $html .= '<script>
                        $(".multiselect").multiselect({
                        click: function(event, ui){jQuery("#frmRelatorio").submit();
                        },
                        beforeopen: function(){
                        },
                        open: function(){
                        },
                        beforeclose: function(){
                        },
                        close: function(){
                        },
                        checkAll: function(){jQuery("#frmRelatorio").submit();
                        },
                        uncheckAll: function(){jQuery("#frmRelatorio").submit();
                        }
                        });
                      </script>';
            
            echo $html;
            
        }      
        
        public function mostraRelatorioResumo($campus, $dados){
            $html = $this->montaTitulo('Resumo');
            $html .= $this->inicioFormulario('frmRelatorioResumo', $class, 'questionario.php?metodo=relatorioResumo&acao=nada&ok', 1, 'div_relatorio');
            $html .= '<table border=0 cellpadding="2px">';
            for($i=0; $i<count($campus);$i++):
                $html .= '<tr>
                            <td> <strong>'.$campus[$i].':</strong> </td>
                            <td> <font color=#990033>&nbsp;&nbsp;'.$dados[$i].'</font></td>
                         </tr>';
            endfor;
            $html .= '</table>';
            $html .= $this->montaBotao('Enviar', NULL, NULL, 'clique', 1);
            $html .= $this->fechaFormulario();
            $html .= '<div id="div_relatorio"></div>';
//            $html .= '<div id="div_grafico" style="width: 950px; height: 450px; margin: 12px"></div>';
//            $html .= '<script>$(document).ready(function(){
//                $(\'#clique\').click();});</script>';
            
            echo $html;
        }
       
}

?>