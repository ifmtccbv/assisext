<?php
require_once 'sistema/geral/ConexaoBD.class.php';
require_once 'sistema/geral/SystemClass.class.php';
class QuestionarioDAO{
	public $con;
	
	public function __construct(){
		$this->con = new ConexaoBD();
	}
	
	public function adicionarQuestionario($nome, $campus, $periodoInicio, $periodoFim, $beneficios, $id_questionario=NULL){
            $systemClass = new System();
            
            //adiciona/edita questionario
            if($id_questionario==NULL)
                $sql = "INSERT INTO tbl_questionario (descricao) VALUES ('".$nome."');";
            else
                $sql = "UPDATE tbl_questionario SET descricao='".$nome."' WHERE id_questionario=".$id_questionario;
            $this->con->executar($sql);
            if($id_questionario==NULL)
                $id_questionario = $this->con->lastInsertId('tbl_questionario_id_questionario_seq');
            else{
                $id_questionario = $id_questionario;
                //deleta campus e beneficios
                
                //$sql = "DELETE FROM tbl_questionario_beneficio WHERE id_questionario=".$id_questionario;
                //$this->con->executar($sql);
                
                //$sql = "DELETE FROM tbl_questionario_periodo WHERE id_questionario=".$id_questionario;
                //$this->con->executar($sql);
            }
            
            //percorre campus e adiciona beneficio p/ ele
            foreach(unserialize($campus) AS $valorCampus){
                
                /*  Deleta os benefícios apenas dos campos selecionados  */
                $SQL = "DELETE FROM tbl_questionario_beneficio
                        WHERE id_questionario = '$id_questionario' AND id_campus = '$valorCampus'";
                $this->con->executar($SQL);
                
                //percorre beneficios do campus
                foreach($beneficios[$valorCampus] AS $valorBeneficio){
                    $sql = 'INSERT INTO tbl_questionario_beneficio (id_questionario, id_beneficio, id_campus)
                            VALUES ('.$id_questionario.', '.$valorBeneficio.', '.$valorCampus.')';
                    $this->con->executar($sql);
                }
                //inseri o periodo por campus
                if($periodoFim[$valorCampus]!='')
                    $dataFim = "'".$systemClass->converteData ($periodoFim[$valorCampus])."'";
                else
                    $dataFim = 'NULL';
                    
                    /*  Verifica se já existe aquele registro na tabela  */
                    $SQL = "SELECT count(*) FROM tbl_questionario_periodo 
                            WHERE id_questionario = '$id_questionario' AND id_campus = '$valorCampus'";
                    $resultado = $this->con->query($SQL);
                    
                    if ($resultado[0][0] > 0):
                        $SQL = "UPDATE tbl_questionario_periodo 
                                SET dataInicio = '" .$systemClass->converteData($periodoInicio[$valorCampus]). "',
                                    dataFim = " .$dataFim. "    
                                WHERE id_questionario = '$id_questionario' AND id_campus = '$valorCampus'";
                    else:
                        $SQL = "INSERT INTO tbl_questionario_periodo (id_questionario, id_campus, dataInicio, dataFim)
                                VALUES ('$id_questionario', '$valorCampus', '" .$systemClass->converteData($periodoInicio[$valorCampus]). "', $dataFim)";
                    endif;
                    
                    $this->con->executar($SQL);
            }
            
            $SQL = "SELECT id_questionario, id_campus FROM tbl_questionario_periodo WHERE (1=1) AND id_questionario = '$id_questionario' AND ";
            foreach (unserialize($campus) as $novoCampus):
                $sqlTemp .= " id_campus != '$novoCampus' AND";
            endforeach;
            $sqlTemp = substr($sqlTemp, 0, strlen($sqlTemp) -3);
            $SQL .= "( $sqlTemp )";
            
            $deletar = $this->con->query($SQL);
            $erro = '';
            
            foreach ($deletar as $val):
                $SQL = "DELETE FROM tbl_questionario_periodo 
                        WHERE id_questionario = '" .$val['id_questionario']. "' AND id_campus = '" .$val['id_campus']. "'";
                if ($this->con->executar($SQL)):
                    $SQL = "DELETE FROM tbl_questionario_beneficio
                            WHERE id_questionario = '" .$val['id_questionario']. "' AND id_campus = '" .$val['id_campus']. "'";
                            $this->con->executar($SQL);
                else:
                    $erro .= $val['id_campus'].';';
                endif;
            endforeach;
            
            if ($erro):
                return substr($erro, 0, strlen($erro)-1);
            else:
                return 1;
            endif;
	}
        
        public function nomeCampus($id_campus) {
            $SQL = "SELECT campus
                    FROM tbl_campus
                    WHERE id_campus = '$id_campus'";
            return $this->con->query($SQL);
        }

        public function adicionarPasso1($txt_id_questionario, $txt_id_questionarioResposta, $cmb_curso, $cmb_campus, $id_usuario, $id_tipousuario, $cmb_situacaoImovel, $cmb_distanciaIFMG, $cmb_deficiencia, $multiselect_cmb_turno, $cmb_situacaoCivil, $cmb_cidade, $cmb_cidadesCurso, $txt_matricula, $txt_logradouro, $txt_numeroComplemento, $cep, $txt_anoSemestreIngresso, $rad_filho, $cmb_numeroFilhos, $cmb_numeroFilhos6Anos, $rad_parente, $rad_recurso, $rad_resideFamilia, $rad_portadorDeficiencia, $rad_outrosComponentesAssistidos, $multiselect_cmb_beneficios, $txt_bairro, $cmb_local_reside, $txt_cep2, $cmb_uf2, $cmb_cidade2, $txt_bairro2, $txt_logradouro2, $txt_numeroComplemento2, $txt_auxilioAnterio, $txt_numMembrosFamiliar){
            $systemClass = new System();
            
            $cmb_uf2 = ($cmb_uf2 == NULL) ? 0 : $cmb_uf2;
            $cmb_cidade2 = ($cmb_cidade2 == NULL) ? 0 : $cmb_cidade2;
            
            //adiciona/edita questionario
            if($txt_id_questionarioResposta==NULL)
                $sql = "INSERT INTO tbl_questionario_resposta (id_questionario, id_curso, id_campus, id_usuario, id_tipousuario, id_situacaoimovel, id_distanciaresidencia, id_deficiencia, id_estadocivil, id_cidade, id_cidadefic, numeromatricula, logradouro, numerocomplemento, cep, anosemestreinicio, possuifilhos, numerofilhos, filhosate6anos, parenteestudacampus, recebeuauxiliosemestreanterior, residecomfamilia, deficiencia, familiaassistidabeneficios, id_status, bairro, localreside, cep2, id_uf2, id_cidade2, bairro2, logradouro2, numerocomplemento2, id_auxilioanterior, nummembrosfamiliar)
                        VALUES (".$txt_id_questionario.", ".$cmb_curso.", ".$cmb_campus.", ".$id_usuario.", ".$id_tipousuario.", ".$cmb_situacaoImovel.", ".$cmb_distanciaIFMG.", ".$cmb_deficiencia.", ".$cmb_situacaoCivil.", ".$cmb_cidade.", ".$cmb_cidadesCurso.", '".$txt_matricula."', '".$txt_logradouro."', '".$txt_numeroComplemento."', '".  System::soNumero($cep)."', '".$txt_anoSemestreIngresso."', '".$rad_filho."', ".$cmb_numeroFilhos.", ".$cmb_numeroFilhos6Anos.", '".$rad_parente."', '".$rad_recurso."', '".$rad_resideFamilia."', '".$rad_portadorDeficiencia."', '".$rad_outrosComponentesAssistidos."', 1, '".$txt_bairro."', '".$cmb_local_reside."', '".System::soNumero($txt_cep2)."', '$cmb_uf2', '$cmb_cidade2', '$txt_bairro2', '$txt_logradouro2', '$txt_numeroComplemento2', '$txt_auxilioAnterio', '$txt_numMembrosFamiliar' );";
            else
                $sql = "UPDATE tbl_questionario_resposta SET id_curso=".$cmb_curso.", id_campus=".$cmb_campus.", id_situacaoimovel=".$cmb_situacaoImovel.", id_distanciaresidencia=".$cmb_distanciaIFMG.", id_deficiencia=".$cmb_deficiencia.", id_estadocivil=".$cmb_situacaoCivil.", id_cidade=".$cmb_cidade.", id_cidadefic=".$cmb_cidadesCurso.", numeromatricula='".$txt_matricula."', logradouro='".$txt_logradouro."', numerocomplemento='".$txt_numeroComplemento."', cep='".  System::soNumero($cep)."', anosemestreinicio='".$txt_anoSemestreIngresso."', possuifilhos='".$rad_filho."', numerofilhos=".$cmb_numeroFilhos.", filhosate6anos=".$cmb_numeroFilhos6Anos.", parenteestudacampus='".$rad_parente."', recebeuauxiliosemestreanterior='".$rad_recurso."', residecomfamilia='".$rad_resideFamilia."', deficiencia='".$rad_portadorDeficiencia."', familiaassistidabeneficios='".$rad_outrosComponentesAssistidos."', bairro='".$txt_bairro."', localreside='".$cmb_local_reside."', cep2='".System::soNumero($txt_cep2)."', bairro2='$txt_bairro2', logradouro2='$txt_logradouro2', numerocomplemento2='$txt_numeroComplemento2', id_uf2='$cmb_uf2', id_cidade2='$cmb_cidade2', id_auxilioanterior='$txt_auxilioAnterio', nummembrosfamiliar = '$txt_numMembrosFamiliar'
                        WHERE id_questionarioresposta=".$txt_id_questionarioResposta;
            //exit(nl2br($sql));
            $this->con->executar($sql);
            if($txt_id_questionarioResposta==NULL)
                $id_questionarioResposta = $this->con->lastInsertId('tbl_questionario_resposta_id_questionarioresposta_seq');
            else{
                $id_questionarioResposta = $txt_id_questionarioResposta;
                //deleta turno e beneficios
                $sql = "DELETE FROM tbl_questionario_resposta_beneficio WHERE id_questionarioresposta=".$txt_id_questionarioResposta;
                $this->con->executar($sql);
                $sql = "DELETE FROM tbl_questionario_resposta_turno WHERE id_questionarioresposta=".$txt_id_questionarioResposta;
                $this->con->executar($sql);
                // Separei os dois deletes para executar individualmente
            }
            //percorre e adiciona beneficio p/ ele
            foreach($multiselect_cmb_beneficios AS $valorBeneficio){
                $sql = 'INSERT INTO tbl_questionario_resposta_beneficio (id_beneficio, id_questionarioresposta)
                        VALUES ('.$valorBeneficio.', '.$id_questionarioResposta.')';
                $this->con->executar($sql);
            }
            //percorre e adiciona turno p/ ele
            foreach($multiselect_cmb_turno AS $valorTurno){
                $sql = 'INSERT INTO tbl_questionario_resposta_turno (id_turno, id_questionarioresposta)
                        VALUES ('.$valorTurno.', '.$id_questionarioResposta.')';
                $this->con->executar($sql);
            }
            return 1;
	}
        
        public function editarQuestionario($nome, $campus, $periodoInicio, $periodoFim, $beneficios){
            $systemClass = new System();

            //adiciona questionario
            $sql = "INSERT INTO tbl_questionario (descricao) VALUES ('".$nome."');";
            $this->con->executar($sql);
            $id_questionario = $this->con->lastInsertId('tbl_questionario_id_questionario_seq');
            //percorre campus e adiciona beneficio p/ ele
            foreach(unserialize($campus) AS $valorCampus){
                //percorre beneficios do campus
                foreach($beneficios[$valorCampus] AS $valorBeneficio){
                    $sql = 'INSERT INTO tbl_questionario_beneficio (id_questionario, id_beneficio, id_campus)
                            VALUES ('.$id_questionario.', '.$valorBeneficio.', '.$valorCampus.')';
                    $this->con->executar($sql);
                }
                //inseri o periodo por campus
                if($periodoFim[$valorCampus]!='')
                    $dataFim = "'".$systemClass->converteData ($periodoFim[$valorCampus])."'";
                else
                    $dataFim = 'NULL';
                $sql = "INSERT INTO tbl_questionario_periodo (id_questionario, id_campus, dataInicio, dataFim)
                        VALUES (".$id_questionario.", ".$valorCampus.", '".$systemClass->converteData($periodoInicio[$valorCampus])."', ".$dataFim.")";
                $this->con->executar($sql);
            }
            return 1;
	}

        public function listaQuestionarios($id_questionario=NULL){
            if($id_questionario!=NULL){
                $where = 'WHERE id_questionario='.$id_questionario;
                $argumentoFuncao = NULL;
            }else{
                $argumentoFuncao = 1;
            }
            $sql = 'SELECT id_questionario, descricao AS "Descrição"
                    FROM tbl_questionario
                    '.$where.'
                    ORDER BY id_questionario';
            $resultado = $this->con->query($sql, $argumentoFuncao);
            return $resultado;
        }

        public function dadosQuestionario($id_questionario){
            $sql = 'SELECT QU.id_questionario, QU.descricao, QB.id_campus
                    FROM tbl_questionario QU
                    INNER JOIN tbl_questionario_beneficio QB ON QB.id_questionario=QU.id_questionario
                    WHERE QU.id_questionario='.$id_questionario.'
                    GROUP BY QU.id_questionario, QU.descricao, QB.id_campus';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function dadosCampus($id_questionario){
            $sql = 'SELECT QP.id_campus
                    FROM tbl_questionario_periodo QP
                    WHERE QP.id_questionario='.$id_questionario.'
                    GROUP BY QP.id_campus';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function dadosDoCampus($id_questionario, $id_campus){
            $sql = 'SELECT QP.datainicio, QP.datafim, QB.id_beneficio
                    FROM tbl_questionario_periodo QP
                    INNER JOIN tbl_questionario_beneficio QB ON QB.id_questionario=QP.id_questionario AND QP.id_campus=QB.id_campus
                    WHERE QP.id_questionario='.$id_questionario.' AND QP.id_campus='.$id_campus.'
                    GROUP BY QB.id_questionario_beneficio, QP.datainicio, QP.datafim, QB.id_beneficio';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function questionariosPreenchidos($id_usuario){
            $sql = "SELECT QP.id_questionarioperiodo AS id, QR.id_questionarioresposta AS id2, QU.descricao AS \"Questionário\", CA.campus AS \"Campus\", case ST.status
                    WHEN 'Salvo' THEN 'Salvo' WHEN 'Enviado para análise' THEN 'Enviado para análise' WHEN 'Análise Concluída' THEN 'Análise Concluída' ELSE 'Preencher' END AS \"Status\"
                    FROM tbl_questionario QU
                    INNER JOIN tbl_questionario_periodo QP ON QP.id_questionario=QU.id_questionario
                    INNER JOIN tbl_campus CA ON CA.id_campus=QP.id_campus
                    INNER JOIN tbl_questionario_resposta QR ON QR.id_questionario = QP.id_questionarioperiodo AND QR.id_usuario=".$_SESSION['id_usuario']."
                    INNER JOIN tbl_status ST ON ST.id_status = QR.id_status
                    WHERE QR.id_usuario=".$id_usuario.' AND (QR.id_status=2 OR QP.datafim >= CURRENT_DATE)';
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql,1,2);
            return $resultado;
        }
        
        public function questionariosDisponiveis(){
            $sql = "SELECT QP.id_questionarioperiodo AS id, QR.id_questionarioresposta AS id2, QU.descricao AS \"Questionário\", CA.campus AS \"Campus\", case ST.status
                    WHEN 'Salvo' THEN 'Salvo' WHEN 'Enviado para análise' THEN 'Enviado para análise' WHEN 'Análise Concluída' THEN 'Análise Concluída' ELSE 'Preencher' END AS \"Status\"
                    FROM tbl_questionario QU
                    INNER JOIN tbl_questionario_periodo QP ON QP.id_questionario=QU.id_questionario
                    INNER JOIN tbl_campus CA ON CA.id_campus=QP.id_campus
                    LEFT JOIN tbl_questionario_resposta QR ON QR.id_questionario = QP.id_questionarioperiodo AND QR.id_usuario=".$_SESSION['id_usuario']."
                    LEFT JOIN tbl_status ST ON ST.id_status = QR.id_status
                    WHERE ((QP.datafim IS NULL AND datainicio <= CURRENT_DATE) OR ('".date('Y-m-d')."' BETWEEN datainicio AND datafim)) AND (QR.id_status IS NULL)";
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql, 1, 2);
            return $resultado;

        }
        
        /**
         * @name abrirQuestionario - Verifica se é possível abrir o questionário para correção
         * @since 14-03-2012
         * @author Wester Cardoso
         * @param int $id_questionarioresposta
         * @return Array
         */
        public function abrirQuestionario($id_questionarioresposta){
            $sql = 'SELECT id_questionarioresposta 
                    FROM tbl_questionario_resposta QR
                    INNER JOIN tbl_questionario_periodo QP ON QP.id_campus = QR.id_campus
                    where id_questionarioresposta=2941 AND QP.datafim >= CURRENT_DATE';
            //exit(nl2br($sql));
            return $this->con->query($sql);
        }
        //pega id_questionario a partir de id_questionario periodo
        public function pegaIdQuestionario($id_questionarioPeriodo){
            $sql = "SELECT QP.id_questionario
                    FROM tbl_questionario_periodo QP
                    WHERE id_questionarioPeriodo=".$id_questionarioPeriodo;
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado[0]['id_questionario'];

        }
        /**
         * @name buscaCursos - Listagem dos cursos tbl_curso
         * @author André de Mello
         * @since 11/01/2012
         * @param int $id_curso
         * @return array
         */
        public function buscaCursos($id_curso=NULL){
            if($id_curso!=NULL)
                $where = 'WHERE id_curso='.$id_curso;
            else
                $where = NULL;
            $sql = 'SELECT id_curso AS id, nome AS Nome
                    FROM tbl_curso
                    '.$where.'
                    ORDER BY nome';
            $resultado = $this->con->query($sql);
            return $resultado;
        }
        
        /**
         * @name buscaCampus - Listagem dos campus tbl_campus
         * @author André de Mello
         * @since 11/01/2012
         * @param int $id_campus
         * @return array
         */
        public function buscaCampus($id_questionario=NULL, $id_campus=NULL){
            if($id_questionario)
                $where = "WHERE QP.id_questionario=".$id_questionario." AND ((QP.datafim IS NULL AND datainicio <= CURRENT_DATE) OR ('".date('Y-m-d')."' BETWEEN datainicio AND datafim))";
            else if($id_campus)
                $where = 'WHERE CA.id_campus='.$id_campus;
            else
                $where = NULL;
            $sql = 'SELECT DISTINCT CA.id_campus AS id, CA.campus AS Nome
                    FROM tbl_campus CA
                    INNER JOIN tbl_questionario_periodo QP ON QP.id_campus = CA.id_campus
                    '.$where;
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        /**
         * @name buscaBeneficio - Listagem dos beneficios de acordo com questionario/campus
         * @author André de Mello
         * @since 11/01/2012
         * @param int $id_questionarioPeriodo
         * @return array
         */
        public function buscaBeneficios($id_questionario, $id_campus, $temFilhos = NULL, $resideNucleo = NULL){
            $where = '';
            $where .= ($temFilhos != NULL && $temFilhos == 'N') ? ' AND BE.id_beneficio != 4' : NULL;
            //$where .= ($resideNucleo != NULL && $resideNucleo == 'S') ? ' AND BE.id_beneficio != 2' : NULL;
            
            $sql = 'SELECT BE.id_beneficio AS id, BE.beneficio AS nome
                    FROM tbl_questionario_periodo QP
                    INNER JOIN tbl_questionario_beneficio QB ON QB.id_questionario=QP.id_questionario AND QP.id_campus=QB.id_campus
                    INNER JOIN tbl_beneficio BE ON BE.id_beneficio=QB.id_beneficio
                    WHERE QP.id_questionario='.$id_questionario.' AND QB.id_campus='.$id_campus.' '.$where;
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        /**
         * @name buscaTurno - Listagens dos turnos - tbl_turno
         * @author André de Mello
         * @since 11/01/2012
         * @return array
         */
        public function buscaTurno(){
            $sql = 'SELECT id_turno AS id, turno AS nome
                    FROM tbl_turno
                    ORDER BY nome';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

         /**
         * @name buscaSituacaoCivil - Listagens dos estados civis - tbl_turno
         * @author André de Mello
         * @since 11/01/2012
         * @return array
         */
        public function buscaSituacaoCivil(){
            $sql = 'SELECT id_estadocivil AS id, descricao AS nome
                    FROM tbl_estado_civil
                    ORDER BY descricao';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        /**
         * @name buscaSituacaoImovel - Listagens das situações dos imoveis - tbl_situacao_imovel
         * @author André de Mello
         * @since 11/01/2012
         * @return array
         */
        public function buscaSituacaoImovel(){
             $sql = 'SELECT id_situacaoimovel AS id, situacao AS nome
                    FROM tbl_situacao_imovel
                    ORDER BY situacao';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        /**
         * @name buscaDistancia - Listagens das distancias - tbl_distancia_residencia
         * @author André de Mello
         * @since 11/01/2012
         * @return array
         */
        public function buscaDistancia(){
             $sql = 'SELECT id_distanciaresidencia AS id, descricao AS nome
                    FROM tbl_distancia_residencia
                    ORDER BY id_distanciaresidencia';
            $resultado = $this->con->query($sql);
            return $resultado;
        }
        
        /**
         * @name buscaCidadesCurso - Listagens das cidades que são oferecidos cursos
         * @author André de Mello
         * @since 12/01/2012
         * @return array
         */
        public function buscaCidadesCurso(){
             $sql = 'SELECT id_cidade AS id, nome
                    FROM tbl_cidade
                    WHERE id_cidade=540 OR id_cidade=664 OR id_cidade=200
                    OR id_cidade=145 OR id_cidade=608 OR id_cidade=583
                    OR id_cidade=737 OR id_cidade=344 OR id_cidade=56
                    OR id_cidade=659
                    ORDER BY nome';
            $resultado = $this->con->query($sql);
            return $resultado;
        }


        /**
         * @name montaCmb - Monta o select
         * @author Wester Cardoso
         * @since 13/01/2012
         * @return array
         */
        public function montaCmb($tipoEscola=NULL, $anosEscola=NULL, $outroCurso=NULL, $situacaoTrab=NULL, $situacaoTrab_pai=NULL, $escolaridadeProvedor=NULL, $provedor=NULL, $tipoImovel=NULL, $proprietario=NULL){
            if($tipoEscola){
                $sql = 'SELECT id_tipoescola AS id, tipo AS nome
                        FROM tbl_tipo_escola ORDER BY tipo';}
            if($anosEscola){
                $sql = 'SELECT id_frequencia AS id, descricao AS nome
                        FROM tbl_frequencia ORDER BY descricao';}
            if($outroCurso){
                $sql = 'SELECT id_estacursando AS id, descricao AS nome
                        FROM tbl_esta_cursando ORDER BY descricao';}
            if($situacaoTrab){
                $sql = 'SELECT id_situacaotrabalho AS id, descricao AS nome
                        FROM tbl_situacao_trabalho ORDER BY descricao';}
            if($situacaoTrab_pai){
                $sql = 'SELECT id_situacaotrabalhopai AS id, descricao AS nome
                        FROM tbl_situacao_trabalho_pai ORDER BY descricao';}
            if($escolaridadeProvedor){
                $sql = 'SELECT id_escolaridade AS id, descricao AS nome
                        FROM tbl_escolaridade ORDER BY descricao';}
            if($provedor){
                $sql = 'SELECT id_grupofamiliar AS id, nome AS nome
                        FROM tbl_grupo_familiar
                        WHERE id_questionarioresposta='.$provedor;}
            if($tipoImovel){
                $sql = 'SELECT id_tipoimovel AS id, tipo AS nome
                        FROM tbl_tipo_imovel ORDER BY tipo';}
            if($proprietario){
                $sql = 'SELECT id_grupofamiliar AS id, nome AS nome
                        FROM tbl_grupo_familiar
                        WHERE id_grupofamiliar= '.$proprietario;}

            $resultado = $this->con->query($sql);
            return $resultado;

        }

        public function buscaLocal ($estado=NULL, $cidade=NULL)
        {
            if($cidade){
                $sql = 'SELECT id_cidade AS id, nome AS nome
                        FROM tbl_cidade
                        WHERE id_uf= '.$cidade;}
            if($estado){
                $sql = 'SELECT id_uf AS id, nome AS nome
                        FROM tbl_uf';}

            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;

        }

         /**
         * @name buscaDeficiencia - Listagens das deficiencias - tbl_deficiencia
         * @author André de Mello
         * @since 16/01/2012
         * @return array
         */
        public function buscaDeficiencia(){
           $sql = 'SELECT id_deficiencia AS id, descricao AS nome
                    FROM tbl_deficiencia
                    ORDER BY descricao';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaIdQuestionarioResposta($id_usuario, $id_questionario){
            $sql = 'SELECT id_questionarioresposta
                    FROM tbl_questionario_resposta
                    WHERE id_usuario='.$id_usuario.' AND id_questionario='.$id_questionario;
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function adicionaNovoMembro($nome, $id_grauparentesco, $idade, $rendamensal, $rendaaluguel, $rendapensaomorte, $rendapensaoalimenticia, $rendaajudaterceiros, $rendaoutros, $descricaooutro, $recebeBolsaFamilia, $id_questionarioResposta, $id_grupoFamiliar, $rendaBPC, $txt_cpf){
            if($id_grupoFamiliar==NULL)
                $sql = "INSERT INTO tbl_grupo_familiar (id_questionarioresposta, id_grauparentesco, nome, idade, rendamensal, rendaaluguel, rendapensaomorte, rendapensaoalimenticia, rendaajudaterceiros, rendaoutros, descricaooutro, recebebolsafamilia, rendabolsafamilia, cpf)
                        VALUES (".$id_questionarioResposta.", ".$id_grauparentesco.", '".$nome."', '".$idade."', '".$rendamensal."', '".$rendaaluguel."', '".$rendapensaomorte."', '".$rendapensaoalimenticia."', '".$rendaajudaterceiros."', '".$rendaoutros."', '".$descricaooutro."', '".$recebeBolsaFamilia."', '".$rendaBPC."', '$txt_cpf')";
            else
                $sql = "UPDATE tbl_grupo_familiar SET id_grauparentesco=".$id_grauparentesco.", nome='".$nome."', idade='".$idade."', rendamensal='".$rendamensal."', rendaaluguel='".$rendaaluguel."', rendapensaomorte='".$rendapensaomorte."', rendapensaoalimenticia='".$rendapensaoalimenticia."', rendaajudaterceiros='".$rendaajudaterceiros."', rendaoutros='".$rendaoutros."', descricaooutro='".$descricaooutro."', recebebolsafamilia='".$recebeBolsaFamilia."', rendabolsafamilia='".$rendaBPC."', cpf='$txt_cpf'
                        WHERE id_grupofamiliar=".$id_grupoFamiliar;
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $resultado;
        }

        public function excluirMembro($id){
           $sql = "DELETE FROM tbl_grupo_familiar WHERE id_grupofamiliar=".$id;
            $resultado = $this->con->executar($sql);
            return $sql;
        }

        public function excluirVeiculo($id){
            $sql = 'DELETE FROM tbl_veiculo WHERE id_veiculo='.$id;
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $sql;
        }

        public function excluirImovel($id){
            $sql = 'DELETE FROM tbl_imovel WHERE id_imovel='.$id;
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $sql;
        }

        public function adicionaNovoVeiculo($id_questionarioResposta, $dados, $id_veiculo=NULL){
            if($id_veiculo!=NULL){
                $sql = "UPDATE tbl_veiculo SET
                        id_grupofamiliar=".$dados['id_grupofamiliar']."
                        ,marca='".$dados['marca']."'
                        ,modelo='".$dados['modelo']."'
                        ,ano='".$dados['ano']."'
                        ,utilidade='".$dados['utilidade']."'
                        ,id_tipoveiculo=".$dados['tipoVeiculo']."
                        WHERE id_veiculo=".$id_veiculo;
            }
            else
                $sql = "INSERT INTO tbl_veiculo(id_questionarioresposta, id_grupofamiliar, marca, modelo, ano, utilidade, id_tipoveiculo)
                        VALUES ($id_questionarioResposta,'".$dados['id_grupofamiliar']."','".$dados['marca']."','".$dados['modelo']."','".$dados['ano']."','".$dados['utilidade']."',".$dados['tipoVeiculo'].")";
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $sql;
        }

        public function adicionaNovoImovel($id_questionarioResposta, $dados, $id_imovel=NULL){
            if($id_imovel!=NULL){
                $sql = "UPDATE tbl_imovel SET
                         id_tipoimovel=".$dados['id_tipoimovel']."
                        ,id_grupofamiliar=".$dados['id_grupofamiliar']."
                        ,id_cidade=".$dados['id_cidade']."
                        ,servederesidencia='".$dados['servederesidencia']."'
                        WHERE id_imovel=".$id_imovel;
            }
            else
                $sql = "INSERT INTO tbl_imovel(id_questionarioresposta, id_tipoimovel, id_grupofamiliar, id_cidade, servederesidencia)
                        VALUES ($id_questionarioResposta,".$dados['id_tipoimovel'].",".$dados['id_grupofamiliar'].",".$dados['id_cidade'].",'".$dados['servederesidencia']."')";
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $sql;
        }
        
        public function adicionarResposta($txt_id_questionarioResposta, $passo2=NULL, $passo3=NULL, $passo6=NULL, $passo7=NULL, $passo8=NULL)
        {
            $sql = 'UPDATE tbl_questionario_resposta SET ';
            if($passo2){
                $sql .= 'id_tipoescola='.$passo2['tipoescola'].
                        ",concluiusuperior='".$passo2['concluiusuperior']."'".
                        ',id_estacursando='.$passo2['estacursando'].
                        ',id_frequencia='.$passo2['frequencia'].
                        ',id_situacaotrabalho='.$passo2['situacaoTrab'].
                        ',id_situacaotrabalhopai='.$passo2['situacaoTrab_pai'].
                        ',id_situacaotrabalhomae='.$passo2['situacaoTrab_mae'].
                        ',id_escolaridadepai='.$passo2['escolaridadePai'].
                        ',id_escolaridademae='.$passo2['escolaridadeMae'];}
            if($passo3){
                $sql .= 'rendapercapita='.$passo3['rendapercapita'];
            }
            if($passo4){

            }
            if($passo5){

            }
            if($passo6){
                $sql .='id_grupofamiliar_provedor=\''.$passo6['id_grupofamiliar_provedor'].
                       '\',id_escolaridade_provedor='.$passo6['id_escolaridade_provedor'];
                if($passo6['id_escolaridade_provedor_2'])
                    $sql .= ',id_escolaridade_provedor_2='.$passo6['id_escolaridade_provedor_2'];}

            if($passo7){
                $sql .= 'despesaagua='.$passo7['agua'].
                        ',despesaluz='.$passo7['luz'].
                        ',despesatelefone='.$passo7['telefone'].
                        ',despesacondominio='.$passo7['condominio'].
                        ',despesaescolafaculdade='.$passo7['escola_faculdade'].
                        ',despesaalimentacao='.$passo7['alimentacao'].
                        ',despesasaudemedicamentos='.$passo7['saude_medicamentos'].
                        ',despesatransporte='.$passo7['transporte'].
                        ',despesaaluguel='.$passo7['aluguel'].
                        ',despesafinanciamentoconsorcio='.$passo7['financiamento_consorcios'].
                        ',despesafuncionarios='.$passo7['funcionarios'].
                        ',despesaoutros='.$passo7['outros'];}
                        
            if($passo8){
                $sql .= 'id_status='.$passo8['status'];}
                
            $sql .= " WHERE id_questionarioresposta='".$txt_id_questionarioResposta."'";
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $resultado;
        }

        public function pegaDadosQuestionarioResposta($id_questionarioResposta){
            $sql = 'SELECT QR.*, CI.id_uf
                    FROM tbl_questionario_resposta QR
                    INNER JOIN tbl_cidade CI ON CI.id_cidade=QR.id_cidade
                    WHERE QR.id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaTurnoQuestionarioResposta($id_questionarioResposta){
            $sql = 'SELECT id_turno
                    FROM tbl_questionario_resposta_turno
                    WHERE id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaBeneficioQuestionarioResposta($id_questionarioResposta){
            $sql = 'SELECT id_beneficio
                    FROM tbl_questionario_resposta_beneficio
                    WHERE id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaNucleoFamiliar($id_questionarioResposta){
            $sql = 'SELECT GF.id_grupofamiliar AS id, GF.nome AS "Nome", GF.cpf AS "CPF", GP.descricao AS "Grau Parentesco", GF.idade AS "Idade", GF.rendamensal AS "Renda Mensal", GF.rendapensaomorte AS "Pensao Morte", GF.rendapensaoalimenticia AS "Pensão Alimentícia", GF.rendaajudaterceiros AS "Ajuda Terceiros", GF.rendaoutros AS "Renda Outros", GF.descricaooutro AS "Descrição Outro", '."case GF.rendabolsafamilia WHEN '0.00' THEN 'Não Possui' ELSE GF.rendabolsafamilia END AS". '"Bolsa familia ou BPC"
                    FROM tbl_grupo_familiar GF
                    INNER JOIN tbl_grau_parentesco GP ON GF.id_grauparentesco=GP.id_grauparentesco
                    WHERE id_questionarioresposta='.$id_questionarioResposta.'
                    ORDER BY GF.nome';
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql, 1);
            return $resultado;
        }

        public function pegaGrauParentesco(){
            $sql = 'SELECT id_grauparentesco AS id, descricao AS nome
                    FROM tbl_grau_parentesco
                    ORDER BY descricao';
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaMembroNucleoFamiliar($id_grupoFamiliar){
            $sql = 'SELECT GF.id_grupofamiliar AS id, CPF AS "CPF", GF.nome, GP.descricao AS "Grau Parentesco", GF.idade, GF.rendamensal, GF.rendaaluguel, GF.rendapensaomorte, GF.rendapensaoalimenticia, GF.rendaajudaterceiros, GF.rendaoutros, GF.descricaooutro, GF.id_grauparentesco, GF.id_questionarioresposta, GF.recebebolsafamilia, GF.rendabolsafamilia
                    FROM tbl_grupo_familiar GF
                    INNER JOIN tbl_grau_parentesco GP ON GF.id_grauparentesco=GP.id_grauparentesco
                    WHERE id_grupofamiliar='.$id_grupoFamiliar;
            
            $resultado = $this->con->query($sql);
            return $resultado;
        }

        public function pegaVeiculos($id_questionarioResposta=NULL, $id_veiculo=NULL, $tipoVeiculo=NULL){
            if($id_questionarioResposta){
                $sql = 'SELECT VE.id_veiculo, GF.nome as "Proprietário", TV.tipo as "Tipo", VE.marca AS "Marca", VE.modelo AS "Modelo", VE.ano AS "Ano", VE.utilidade AS "Utilidade"
                        FROM tbl_veiculo VE
                        INNER JOIN tbl_grupo_familiar GF ON VE.id_questionarioresposta=GF.id_questionarioresposta AND VE.id_grupofamiliar=GF.id_grupofamiliar
                        INNER JOIN tbl_tipo_veiculo TV ON VE.id_tipoveiculo = TV.id_tipoveiculo
                        WHERE VE.id_questionarioresposta='.$id_questionarioResposta;
                $resultado = $this->con->query($sql,1);}
            if($id_veiculo){
                    $sql = 'SELECT *
                            FROM tbl_veiculo
                            WHERE id_veiculo='.$id_veiculo;
                    $resultado = $this->con->query($sql);
                            }
            if($tipoVeiculo){
                $sql = 'SELECT id_tipoveiculo AS id, tipo AS nome
                        FROM tbl_tipo_veiculo';
                $resultado = $this->con->query($sql);}
            //exit(nl2br($sql));
            return $resultado;
        }

        public function pegaImoveis($id_questionarioResposta=NULL, $id_imovel=NULL){
            if($id_questionarioResposta){
            $sql = 'SELECT IM.id_imovel, GF.nome as "Proprietário", TI.tipo as "Tipo imóvel", CI.nome as "Cidade", IM.servederesidencia AS "Serve de residência"
                    FROM tbl_imovel IM
                    INNER JOIN tbl_grupo_familiar GF ON IM.id_questionarioresposta=GF.id_questionarioresposta AND IM.id_grupofamiliar=GF.id_grupofamiliar
                    INNER JOIN tbl_tipo_imovel TI ON IM.id_tipoimovel = TI.id_tipoimovel
                    INNER JOIN tbl_cidade CI ON IM.id_cidade = CI.id_cidade
                    WHERE IM.id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql,1);}
            if($id_imovel){
                $sql = 'SELECT IM.id_imovel, IM.id_questionarioresposta, IM.id_tipoimovel, IM.id_grupofamiliar, IM.id_cidade, CI.id_uf, IM.servederesidencia
                        FROM tbl_imovel IM
                        INNER JOIN tbl_cidade CI ON IM.id_cidade = CI.id_cidade
                        WHERE id_imovel='.$id_imovel;
                $resultado = $this->con->query($sql);}
            //exit(nl2br($sql));
            return $resultado;
        }

        public function comboProprietario($id_questionarioResposta){
            $sql = 'SELECT id_grupofamiliar AS id, nome AS nome
                    FROM tbl_grupo_familiar
                    WHERE id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql);
            //exit(nl2br($sql));
            return $resultado;
        }

        public function pegaGrupoFamiliar($id_grupoFamiliar){
            $sql = 'SELECT *
                    FROM tbl_grupo_familiar
                    WHERE id_grupofamiliar='.$id_grupoFamiliar;
            $resultado = $this->con->query($sql);
            //exit(nl2br($sql));
            return $resultado;
        }
        
        
        /**
         * Obs: Trocar o nome e deletar a função antiga.
         * @name pegaGrupoFamiliar2 - Pega o grupo familiar de acordo com o $id_questionarioResposta
         * @author André de Mello
         * @since 30/01/12 (Modificado)
         * @param int $id_questionarioResposta
         * @return Array com os dados do grupoFamiliar
         */
        public function pegaGrupoFamiliar2($id_questionarioResposta){
            $sql = 'SELECT *
                    FROM tbl_grupo_familiar
                    WHERE id_questionarioresposta='.$id_questionarioResposta;
            $resultado = $this->con->query($sql);
            //exit(nl2br($sql));
            return $resultado;
        }

        /**
         * @name gravarPontuacao - Grava pontuacao de cada beneficio - tbl_pontuacao
         * @author Wester Cardoso
         * @since 30/01/12
         * @param int $id_questionarioResposta, int $pontuacaoBeneficios
         * @return valor booleano
         */
        public function gravarPontuacao($id_questionarioResposta, $alimentacao=NULL, $moradia=NULL, $transMuni=NULL, $creche=NULL, $atividade=NULL, $transInter=NULL, $existe=NULL){
            if($existe!=0):
                $sql = 'UPDATE tbl_pontuacao SET 
                        aux_alimentacao='.$alimentacao.', 
                        aux_moradia='.$moradia.', 
                        aux_transportemunicipal='.$transMuni.', 
                        aux_creche='.$creche.', 
                        aux_atividade='.$atividade.', 
                        aux_transporteintermunicipal='.$transInter.' 
                        WHERE id_questionarioResposta='.$id_questionarioResposta;
            else:
                $sql = 'INSERT INTO tbl_pontuacao(id_questionarioresposta, aux_alimentacao, aux_moradia, 
                        aux_transportemunicipal, aux_creche, aux_atividade, aux_transporteintermunicipal)
                        VALUES ('.$id_questionarioResposta.','.$alimentacao.','.$moradia.','.$transMuni.','.$creche.','.$atividade.','.$transInter.')';
            endif;
            
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $resultado;}
            
            
        /**
         * @name pontuacaoIdExiste - Verifica se já existe ID na tabela
         * @author Wester Cardoso
         * @since 05/03/2012 
         * @param int id_questionarioResposta
         * @return valor bolleano
         */
        public function pontuacaoIdExiste($id_questionarioRespota){
            $sql = 'SELECT id_questionarioresposta
                    FROM tbl_pontuacao
                    WHERE id_questionarioresposta='.$id_questionarioRespota;
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;
        }
        
        public function pontuacaoIdExiste_2($id_questionarioRespota){
            $sql = 'SELECT id_questionarioresposta
                    FROM tbl_pontuacao_beneficio
                    WHERE id_questionarioresposta='.$id_questionarioRespota;
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;
        }
            
        /**
         * @name pegaBeneficios - Retorna todos os beneficios disponíveis - tbl_beneficio
         * @author Wester Cardoso
         * @since 01/02/12
         * @return Array com os beneficios 
         */
        public function SelectBeneficios($id=NULL){
            $sql = 'SELECT id_beneficio AS id, beneficio AS nome
                    FROM tbl_beneficio';
            if($id){ //Se passar algum ID de array
                $sql .= ' WHERE';
                foreach($id as $id){
                    if($cont) $sql .= ' OR id_beneficio='.$id;
                    else{ $sql .= ' id_beneficio='.$id; $cont=1;}   }   }
                    
            $resultado = $this->con->query($sql);
            return $resultado;}
        
        /**
         * @name pegaQuestionarios - Retorna todos os questionarios disponiveis - tbl-questionario
         * @author Wester Cardoso
         * @since 01/02/12
         * @return Array com os questionarios
         */
        public function SelectQuestionarios(){
            $sql = 'SELECT id_questionario AS id, descricao AS nome
                    FROM tbl_questionario';
            $resultado = $this->con->query($sql);
            return $resultado;}
            
        /**
         * @name dadosRelatorio - Retorna os dados para tabela relatorio
         * @author Wester Cardoso
         * @since 01/02/12
         * @param $beneficios=NULL, $turno=NULL
         * @return Array com os dados da tabela
         */
        public function dadosRelatorio($beneficios=NULL, $questionario=NULL, $cmb_ordem=NULL, $cmb_campus=NULL){
            $sql = 'SELECT QR.id_questionarioresposta AS id, QP.datafim as "datafim", GF.nome AS "Solicitante", US.email AS "Email", CA.campus AS "Campus"';
            if(!$beneficios) // Se não tiver selecionado nenhum beneficio, seleciona todos os campos
                $sql .= ', PO.aux_alimentacao AS "Alimentação", PO.aux_moradia AS "Moradia", PO.aux_creche AS "Creche", PO.aux_atividade AS "Atividade", PO.aux_transportemunicipal AS "TransMunicipal", PO.aux_transporteintermunicipal AS "TransInterMunicipal"';
            else{ // Se tiver beneficio selecionado:
                foreach ($beneficios as $beneficios) {
                if($beneficios === '1'){
                    $sql .= ', PO.aux_alimentacao AS "Alimentação"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_alimentacao DESC';
                    continue;}
                else if($beneficios === '2'){
                    $sql .= ', PO.aux_moradia AS "Moradia"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_moradia DESC';
                    continue;}
                else if($beneficios === '3'){
                    $sql .= ', PO.aux_transportemunicipal AS "TransMunicipal"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_transportemunicipal DESC';
                    continue;}
                else if($beneficios === '4'){
                    $sql .= ', PO.aux_creche AS "Creche"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_creche DESC';
                    continue;}
                else if($beneficios === '5'){
                    $sql .= ', PO.aux_atividade AS "Atividade"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_atividade DESC';
                    continue;}
                else if($beneficios === '6'){
                    $sql .= ', PO.aux_transporteintermunicipal AS "TransInterMunicipal"';
                    if(!$cmb_ordem) $cmb_ordem = ' ORDER BY aux_transporteintermunicipal DESC';
                    continue;}  }   } // Fim If/Else
                    
            if($questionario){ //Se tiver questionarios selecionados
                $where = ' WHERE (';
                foreach($questionario as $questionario){
                    if($cont) // Se já existir uma condição adiciona o OR na frente
                        $where .= ' OR QP.id_questionario ='.$questionario;
                    else $cont = $where .= 'QP.id_questionario='.$questionario; }
                $where .= ')';} //Fecha WHERE
            
            if($cmb_campus) // Se tiver algum campus selecionado
                if($questionario)
                    $where .= ' AND QR.id_campus='.$cmb_campus;
                else
                    $where = ' WHERE QR.id_campus='.$cmb_campus;
                    
            $sql .= ' FROM tbl_pontuacao_beneficio PO
                      INNER JOIN tbl_questionario_resposta QR ON PO.id_questionarioresposta = QR.id_questionarioresposta
                      INNER JOIN tbl_grupo_familiar GF ON PO.id_questionarioresposta = GF.id_questionarioresposta AND id_grauparentesco=10
                      LEFT JOIN tbl_questionario_periodo QP ON QR.id_campus = QP.id_campus
                      INNER JOIN tbl_campus CA ON CA.id_campus = QR.id_campus
                      INNER JOIN tbl_usuario US ON QR.id_usuario = US.id_usuario '.
                      $where.$cmb_ordem;
            
            $resultado = $this->con->query($sql,1,2);
            return $resultado;
            
        }
        
        /**
         * @name buscaCampus_ - Busca campus no banco - tbl_campus
         * @author Wester Cardoso
         * @since 02/02/2012
         * @param $id_campus=NULL
         * @return Array com Campus
         */
        public function buscaCampus_($id_campus=NULL){
            $sql = 'SELECT id_campus AS id, campus AS nome
                    FROM tbl_campus';
            $resultado = $this->con->query($sql);
            return $resultado;
            
        }
        
        /**
         * @name pegarPontuacao - Pega as maiores pontuações de cada beneficio - tbl_pontuacao
         * @author Wester Cardoso
         * @since 06/02/2012
         * @param $auxilio
         * @return Array com dados 
         */
        public function pegarPontuacao($auxilio){
            foreach ($auxilio as $aux){
                if($aux === '1'){
                    $sql = 'SELECT aux_alimentacao FROM tbl_pontuacao ORDER BY aux_alimentacao DESC LIMIT 1';
                    $alimentacao = $this->con->query($sql); continue;}
                else if($aux === '2'){
                    $sql = 'SELECT aux_moradia FROM tbl_pontuacao ORDER BY aux_moradia DESC LIMIT 1';
                    $moradia = $this->con->query($sql); continue;}
                else if($aux === '3'){
                    $sql = 'SELECT aux_transportemunicipal FROM tbl_pontuacao ORDER BY aux_transportemunicipal DESC LIMIT 1';
                    $municipal = $this->con->query($sql); continue;}
                else if($aux === '4'){
                    $sql = 'SELECT aux_creche FROM tbl_pontuacao ORDER BY aux_creche DESC LIMIT 1';
                    $creche = $this->con->query($sql); continue;}
                else if($aux === '5'){
                    $sql = 'SELECT aux_atividade FROM tbl_pontuacao ORDER BY aux_atividade DESC LIMIT 1';
                    $atividade = $this->con->query($sql); continue;}
                else if($aux === '6'){
                    $sql = 'SELECT aux_transporteintermunicipal FROM tbl_pontuacao ORDER BY aux_transporteintermunicipal DESC LIMIT 1';
                    $inter = $this->con->query($sql); continue;}   } 
                    
                $array = array($alimentacao, $moradia, $creche, $atividade, $municipal, $inter);
                    
            return $array;}
        
        /*
         * @name dadosRelatorioResumo - Pega as estatisticas do questionario
         * @author Wester Cardoso
         * @since 02/03/2012
         * @return Array
         */
        public function dadosRelatorioResumo(){
            $sql = 'SELECT count(id_questionarioresposta) as "Número de cadastros", count(id_questionarioresposta) as "Número de cadastros", 
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_status=2 ) as "Questionários postados",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=1 AND id_status = 2) as "Bambuí",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=2 AND id_status = 2) as "Congonhas",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=3 AND id_status = 2) as "Formiga",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=4 AND id_status = 2) as "Ouro Preto",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=5 AND id_status = 2) as "São João Evangelista",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=6 AND id_status = 2) as "Betim",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=7 AND id_status = 2) as "Sabará",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=8 AND id_status = 2) as "Ribeirão das Neves",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=9 AND id_status = 2) as "Ouro Branco",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=10 AND id_status = 2) as "Campus Bambuí – UFS Oliveira",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=11 AND id_status = 2) as "Campus Bambuí – UFS Pompéu",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=12 AND id_status = 2) as "Campus Bambuí – UFS Piumhi",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=13 AND id_status = 2) as "Campus Ouro Preto – UFS João Monlevade",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=14 AND id_status = 2) as "Governador Valadares",
                    (SELECT count(id_questionarioresposta) FROM tbl_questionario_resposta WHERE id_campus=15 AND id_status = 2) as "Campus Bambuí - UFS Bom Despacho"
                    FROM tbl_questionario_resposta';
            
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql,1);
            return $resultado;}
            
            
        public function buscaIDquestionario(){
            $sql = 'Select id_questionarioresposta FROM tbl_questionario_resposta WHERE id_status=2';
            //exit(nl2br($sql));
            $resultado = $this->con->query($sql);
            return $resultado;
        }
                
        public function gravarPontuacao_2($id_questionarioResposta, $alimentacao=NULL, $moradia=NULL, $transMuni=NULL, $creche=NULL, $atividade=NULL, $transInter=NULL, $existe=NULL){
            if($existe!=0):
                $sql = 'UPDATE tbl_pontuacao_beneficio SET 
                        aux_alimentacao='.$alimentacao.', 
                        aux_moradia='.$moradia.', 
                        aux_transportemunicipal='.$transMuni.', 
                        aux_creche='.$creche.', 
                        aux_atividade='.$atividade.', 
                        aux_transporteintermunicipal='.$transInter.' 
                        WHERE id_questionarioResposta='.$id_questionarioResposta;
            else:
                $sql = 'INSERT INTO tbl_pontuacao_beneficio(id_questionarioresposta, aux_alimentacao, aux_moradia, 
                        aux_transportemunicipal, aux_creche, aux_atividade, aux_transporteintermunicipal)
                        VALUES ('.$id_questionarioResposta.','.$alimentacao.','.$moradia.','.$transMuni.','.$creche.','.$atividade.','.$transInter.')';
            endif;
            
            //exit(nl2br($sql));
            $resultado = $this->con->executar($sql);
            return $resultado;}
            
        /*
         * @name pegaIdCampus - Pega o ID do campus apartir do nome do mesmo
         * @author Wester Cardoso
         * @since 12/03/2012
         * @return int
         */
        public function pegaIdCampus($campus){
            $sql = 'SELECT id_campus
                    FROM tbl_campus
                    WHERE campus=\''.$campus.'\'';
            //exit(nl2br($sql));
            return $this->con->query($sql);
        }
        
        
        
        /*  Pega o campus disponível de um determinado questionário  */
        public function pegaCampusQuestionario($id_questionarioPeriodo) {
            $sql = "SELECT CA.id_campus AS id, CA.campus AS nome
                    FROM tbl_questionario_periodo QP
                    INNER JOIN tbl_campus CA ON CA.id_campus = QP.id_campus
                    WHERE id_questionarioperiodo = $id_questionarioPeriodo";
            //exit($sql);
            return $this->con->query($sql);
        }
        
        /*  Retorna todos os benefícios existentes  */
        public function buscaTodosBeneficios() {
            $sql = "SELECT id_beneficio AS id, beneficio as nome
                    FROM tbl_beneficio";
            //exit($sql);
            return $this->con->query($sql);
        }
        
        public function verificaPontuacaoExiste($id_questionarioResposta) {
            $SQL = "SELECT id_questionarioresposta
                    FROM tbl_pontuacao_beneficio
                    WHERE id_questionarioresposta = '$id_questionarioResposta'";
            return $this->con->query($SQL);
        }
        
        public function salvarPontuacao($id_questionarioResposta, $alimentacao=NULL, $moradia=NULL, $transMuni=NULL, $creche=NULL, $atividade=NULL, $transInter=NULL, $existe=NULL) {
            if ($existe != NULL):
                $SQL = "UPDATE tbl_pontuacao_beneficio SET
                        aux_alimentacao = '$alimentacao', 
                        aux_moradia = '$moradia', 
                        aux_transportemunicipal = '$transMuni', 
                        aux_creche = '$creche', 
                        aux_atividade = '$atividade', 
                        aux_transporteintermunicipal = '$transInter' 
                        WHERE id_questionarioResposta = '$id_questionarioResposta'";
            else:
                $SQL = "INSERT INTO tbl_pontuacao_beneficio(id_questionarioresposta, aux_alimentacao, aux_moradia, aux_transportemunicipal, aux_creche, aux_atividade, aux_transporteintermunicipal)
                        VALUES ('$id_questionarioResposta', '$alimentacao', '$moradia', '$transMuni', '$creche', '$atividade', '$transInter')";
            endif;
            
            //echo nl2br($SQL);
            return $this->con->executar($SQL);
        }
        
        
    public function numMembrosCadastrados($id_questionarioResposta) {
        $sql = "SELECT nummembrosfamiliar
                FROM tbl_questionario_resposta
                WHERE id_questionarioresposta = '$id_questionarioResposta'";
        
        return $this->con->query($sql);
    }
        
        
}

?>