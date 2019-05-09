<?php
require_once 'sistema/geral/ConexaoBD.class.php';

class RelatorioDAO {
    private $con;

    public function __construct() {
            $this->con = new ConexaoBD ( );
    }
    
    public function buscaQuestionario() {
        $SQL = "SELECT id_questionario AS id, descricao AS nome
                FROM tbl_questionario";
        return $this->con->query($SQL);
    }
    
    public function buscaBeneficios() {
        $SQL = "SELECT id_beneficio AS id, beneficio AS nome
                FROM tbl_beneficio";
        return $this->con->query($SQL);
    }
    
    public function tabelaNumCadastros($id_questionario=NULL) {
        $where = ($id_questionario != NULL) ? "AND QP.id_questionario = '$id_questionario'" : NULL;
        
        $SQL = 'SELECT
                ( SELECT count(*) FROM tbl_usuario WHERE id_tipousuario = 2 ) as "Total de Cadastros",
                ( SELECT count(*) FROM tbl_usuario WHERE id_tipousuario = 2 ) as "Total de Cadastros",
                ( SELECT count(*) FROM tbl_questionario_resposta WHERE id_status = 2 ) as "Total de envios",
                ( SELECT count(*) FROM tbl_questionario_resposta QR INNER JOIN tbl_questionario_periodo QP ON QP.id_questionarioperiodo = QR.id_questionario WHERE id_status = 2 ' .$where. ' ) as "Total de envios por Questionário"';
        return $this->con->query($SQL,1);
    }
    
    public function buscaCampus() {
        $SQL = "SELECT id_campus AS id, campus AS nome
                FROM tbl_campus";
        return $this->con->query($SQL);
    }
    
    public function tabelaRelatorio($dados) {
        extract($dados);
        
        $SQL = 'SELECT DISTINCT QR.id_questionarioresposta, QP.id_questionarioperiodo, QP.datafim, GF.nome AS "Solicitante", US.cpf AS "CPF", US.email AS "Email", CA.campus AS "Campus",';
        
        /*  Seleciona os beneficios separados, ou todos de uma vez  */
        if ($slc_beneficio != NULL):
            foreach ($slc_beneficio as $val):
                if ( $val == '1') {
                    $SQL .= ' PO.aux_alimentacao AS "Alimentação",';
                } else if ($val == '2') {
                    $SQL .= ' PO.aux_moradia AS "Moradia",';
                } else if ($val == '3') {
                    $SQL .= ' PO.aux_transportemunicipal AS "TransMunicipal",';
                } else if ($val == '4') {
                    $SQL .= ' PO.aux_creche AS "Creche",';
                } else if ($val == '5') {
                    $SQL .= ' PO.aux_atividade AS "Atividade",';
                } else if ($val == '6') {
                    $SQL .= ' PO.aux_transporteintermunicipal AS "TransInterMunicipal",';
                }
            endforeach;
        else:
            $SQL .= 'PO.aux_alimentacao AS "Alimentação", PO.aux_moradia AS "Moradia", PO.aux_creche AS "Creche", PO.aux_atividade AS "Atividade", PO.aux_transportemunicipal AS "TransMunicipal", PO.aux_transporteintermunicipal AS "TransInterMunicipal",';
        endif;
        
        $SQL = substr($SQL, 0, strlen($SQL)-1);
        
        $SQL .= "FROM tbl_pontuacao_beneficio PO
                INNER JOIN tbl_questionario_resposta QR ON QR.id_questionarioresposta = PO.id_questionarioresposta
                INNER JOIN tbl_usuario US ON US.id_usuario = QR.id_usuario
                INNER JOIN tbl_campus CA ON CA.id_campus = QR.id_campus
                INNER JOIN tbl_questionario_periodo QP ON QP.id_questionarioperiodo = QR.id_questionario
                INNER JOIN tbl_grupo_familiar GF ON GF.id_questionarioresposta = PO.id_questionarioresposta AND GF.id_grauparentesco = 10
                WHERE (1=1) ";
        
        if ($id_campus != NULL):
            $SQL .= "AND QR.id_campus = '$id_campus' ";
        endif;
        
        if ($slc_questionario != NULL):
            $SQLtemp = '';
            foreach ($slc_questionario as $val):
                $SQLtemp .= " QP.id_questionario = '$val' OR";
            endforeach;
            $SQLtemp = substr($SQLtemp, 0, strlen($SQLtemp)-2);
            $SQL .= "AND ($SQLtemp) ";
        endif;
        
        //exit(nl2br($SQL));
        return $this->con->query($SQL,1,3);
    }
    
    public function tabelaRelatorioExcel($dados) {
        extract($dados);
        
        $SQL = 'SELECT DISTINCT QR.id_questionarioresposta, QP.id_questionarioperiodo, QP.datafim, US.nome AS "Solicitante", US.sexo AS "Sexo", US.cpf AS "CPF", US.datanascimento AS "Data Nascimento", US.carteiraidentidade AS "Identidade", US.orgaoexpedidor AS "Orgão Expedidor",
		US.email AS "E-mail", US.telefone AS "Telefone", US.celular AS "Celular", CU.nome AS "Curso", CA.campus AS "Campus", QR.numerofilhos AS "Numero de filhos", QR.residecomfamilia AS "Reside com familia",
		QR.nummembrosfamiliar AS "Numero de membros familiar", QR.id_distanciaresidencia AS "Distância da residencia", TUR.turno AS "Turno", QR.anosemestreinicio AS "Ano/Semestre Ingresso", EC.descricao AS "Estado civil", QR.parenteestudacampus AS "Parente que estuda no campus",
		QR.recebeuauxiliosemestreanterior AS "Recebeu auxilio no semestre anterior", QR.cep AS "CEP", UF.nome AS "UF", CI.nome AS "Cidade", QR.bairro AS "Bairro", QR.logradouro AS "Logradouro", QR.numerocomplemento AS "Numero/Complemento",
		SIM.situacao AS "Situação do imovel", QR.deficiencia AS "Portador de deficiencia", QR.familiaassistidabeneficios AS "Compenentes do grupo familiar foram/são assistidos pelo IFMG",
		TE.tipo AS "Tipo de escola do ensino fundamental", FRE.descricao AS "Qantos anos frequentou escola publica", QR.concluiusuperior AS "Concluiu curso superior", STR.descricao AS "Situação de trabalho", ESC.descricao AS "Escolaridade do pai", STRP.descricao AS "Situação de trabalho do pai", VEI.veiculo AS "Quantos veiculos", IMO.imovel AS "Quantos imoveis",';
        
        /*  Seleciona os beneficios separados, ou todos de uma vez  */
        if ($slc_beneficio != NULL):
            foreach ($slc_beneficio as $val):
                if ( $val == '1') {
                    $SQL .= ' PO.aux_alimentacao AS "Alimentação",';
                } else if ($val == '2') {
                    $SQL .= ' PO.aux_moradia AS "Moradia",';
                } else if ($val == '3') {
                    $SQL .= ' PO.aux_transportemunicipal AS "TransMunicipal",';
                } else if ($val == '4') {
                    $SQL .= ' PO.aux_creche AS "Creche",';
                } else if ($val == '5') {
                    $SQL .= ' PO.aux_atividade AS "Atividade",';
                } else if ($val == '6') {
                    $SQL .= ' PO.aux_transporteintermunicipal AS "TransInterMunicipal",';
                }
            endforeach;
        else:
            $SQL .= 'PO.aux_alimentacao AS "Alimentação", PO.aux_moradia AS "Moradia", PO.aux_creche AS "Creche", PO.aux_atividade AS "Atividade", PO.aux_transportemunicipal AS "TransMunicipal", PO.aux_transporteintermunicipal AS "TransInterMunicipal",';
        endif;
        
        $SQL = substr($SQL, 0, strlen($SQL)-1);
        
        $SQL .= "FROM tbl_pontuacao_beneficio PO 
                INNER JOIN tbl_questionario_resposta QR ON QR.id_questionarioresposta = PO.id_questionarioresposta
                INNER JOIN tbl_usuario US ON US.id_usuario = QR.id_usuario
                INNER JOIN tbl_tipousuario TU ON TU.id_tipousuario= US.id_tipousuario
                INNER JOIN tbl_campus CA ON CA.id_campus = QR.id_campus
                INNER JOIN tbl_questionario_periodo QP ON QP.id_questionarioperiodo = QR.id_questionario
                INNER JOIN tbl_grupo_familiar GF ON GF.id_questionarioresposta = PO.id_questionarioresposta AND GF.id_grauparentesco = 10
                INNER JOIN tbl_curso CU ON QR.id_curso = CU.id_curso
                INNER JOIN tbl_questionario_resposta_turno QRT ON QR.id_questionarioresposta = QRT.id_questionarioresposta
                INNER JOIN tbl_turno TUR ON QRT.id_turno = TUR.id_turno
                INNER JOIN tbl_estado_civil EC ON QR.id_estadocivil = EC.id_estadocivil
                INNER JOIN tbl_cidade CI ON QR.id_cidade = CI.id_cidade
                INNER JOIN tbl_uf UF ON CI.id_uf = UF.id_uf
                INNER JOIN tbl_situacao_imovel SIM ON QR.id_situacaoimovel = SIM.id_situacaoimovel
                INNER JOIN tbl_tipo_escola TE ON QR.id_tipoescola = TE.id_tipoescola
                INNER JOIN tbl_frequencia FRE ON QR.id_frequencia = FRE.id_frequencia
                INNER JOIN tbl_situacao_trabalho STR ON QR.id_situacaotrabalho = STR.id_situacaotrabalho
                LEFT JOIN tbl_escolaridade ESC ON QR.id_escolaridadepai = ESC.id_escolaridade
                LEFT JOIN tbl_situacao_trabalho_pai STRP ON QR.id_situacaotrabalhopai = STRP.id_situacaotrabalhopai
                LEFT JOIN (SELECT count(VE.id_questionarioresposta) AS veiculo,
                                    QR.id_questionarioresposta
                            FROM tbl_questionario_resposta QR
                            INNER JOIN tbl_veiculo VE
                            ON QR.id_questionarioresposta = VE.id_questionarioresposta
                            GROUP BY QR.id_questionarioresposta
                          )VEI
                ON QR.id_questionarioresposta = VEI.id_questionarioresposta
                LEFT JOIN (SELECT count(IMO.id_questionarioresposta) AS imovel,
                                QR.id_questionarioresposta
                            FROM tbl_questionario_resposta QR
                            INNER JOIN tbl_imovel IMO
                            ON QR.id_questionarioresposta = IMO.id_questionarioresposta
                            GROUP BY QR.id_questionarioresposta
                            )IMO
                ON QR.id_questionarioresposta = IMO.id_questionarioresposta
                WHERE (1=1) ";
        
        if ($id_campus != NULL):
            $SQL .= "AND QR.id_campus = '$id_campus' ";
        endif;
        
        if ($slc_questionario != NULL):
            $SQLtemp = '';
            foreach ($slc_questionario as $val):
                $SQLtemp .= " QP.id_questionario = '$val' OR";
            endforeach;
            $SQLtemp = substr($SQLtemp, 0, strlen($SQLtemp)-2);
            $SQL .= "AND ($SQLtemp) ";
        endif;
        
        //exit(nl2br($SQL));
        return $this->con->query($SQL,1,3);
    }
    
    public function tabelaResumo($dados) {
        extract($dados);
        
        if ($id_questionario != NULL):
            $where = " AND QP.id_questionario = '$id_questionario'";
        endif;
        
        $SQL = "SELECT CA.campus, CA.campus AS \"Campus\", count(*) AS \"Questionário Enviados\"
                FROM tbl_questionario_resposta QR
                INNER JOIN tbl_campus CA ON CA.id_campus = QR.id_campus
                INNER JOIN tbl_questionario_periodo QP ON QP.id_questionarioperiodo = QR.id_questionario
                WHERE id_status = '2' $where
                GROUP BY CA.campus
                ORDER BY CA.campus";
        //exit(nl2br($SQL));
        return $this->con->query($SQL,1);
    }
    
    /*
    * @name reabrirQuestionarioDAO - Deleta a pontuação na tbl_pontuacao_beneficio e muda o status da tbl_questionarioresposta para 1 (aberto)
    * @author Wester Cardoso
    * @since 15/03/2012
    * @param int $id_questionarioresposta
    * @return valor bolleano
    */
    public function reabrirQuestionario($id_questionarioresposta) {
        $this->con->beginTransaction();
        $sql = "DELETE FROM tbl_pontuacao_beneficio
                WHERE id_questionarioresposta = '$id_questionarioresposta'";
        if ($this->con->executar($sql)):
            $sql = "UPDATE tbl_questionario_resposta
                    SET id_status = 1
                    WHERE id_questionarioresposta = '$id_questionarioresposta'";
            if ($this->con->executar($sql)):
                $this->con->commit();
                return 1;
            else:
                $this->con->rollBack();
                return 0;
            endif;
        endif;
    }
        
	
}

?>