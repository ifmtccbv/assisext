<?php
require_once 'sistema/geral/ConexaoBD.class.php';
require_once 'sistema/questionario/QuestionarioControle.class.php';
require_once 'sistema/questionario/QuestionarioDAO.class.php';

set_time_limit(0);

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    

$con = new ConexaoBD();
$questionarioControle = new QuestionarioControle();
$questionarioDAO = new QuestionarioDAO;

$SQL = "SELECT id_questionarioresposta, QR.id_questionario
FROM tbl_questionario_resposta QR
INNER JOIN tbl_questionario_periodo QP ON QP.id_questionarioperiodo = QR.id_questionario 
WHERE id_status = 2 AND QP.id_questionario = 111";

$resposta = $con->query($SQL);
$i=0;

foreach ($resposta as $id):

$id_questionarioResposta = $id[0];

$questionarioResposta = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta); // Pega as respotas do questionario
$pegaBeneficios = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta); // Pega os beneficios selecionados


$tam = count($pegaBeneficios);

$aux_alimentacao = $aux_atividade = $aux_creche = $aux_moradia = $aux_transporte_inter = $aux_transporte_municipal = 0;
$beneficios = array();


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
        
//$aux_alimentacao = $aux_atividade = $aux_transporte_inter = $aux_transporte_municipal = 1;
        
        
echo "ID questionario {$id[0]} <br /><br />";
        
echo 'Alimentação: '.$aux_alimentacao.'<br />';
echo 'Moradia: '.$aux_moradia.'<br />';
echo 'Creche: '.$aux_creche.'<br />';
echo 'Atividade: '.$aux_atividade.'<br />';
echo 'Municipal: '.$aux_transporte_municipal.'<br />';
echo 'InterMunicipal: '.$aux_transporte_inter.'<br />';
echo '<hr />';


// Pergunta 9 - Qual o curso que está matriculado
if($questionarioResposta[0]['id_curso'] == '6'): // Opção E
    $beneficios[0]['id_curso'] = 0;
else:
    $beneficios[0]['id_curso'] = 2;
endif;

echo 'Curso Global: '.$beneficios[0]['id_curso'].'<br />';

// Pergunta 17 - Tem filhos?
if($questionarioResposta[0]['possuifilhos'] === 'S'){
    if($aux_creche){
        $beneficios[4]['possuifilhos'] = 10; // $beneficios[4] referente ao aux_creche
        $beneficios[0]['possuifilhos'] = 5;} // $beneficios[0] caso tenha outro beneficio alem de creche
    else
        $beneficios[0]['possuifilhos'] = 5;}
else
    $beneficios[0]['possuifilhos'] = 0;

echo 'Tem filhos Global: '.$beneficios[0]['possuifilhos'].'<br />';
echo 'Tem filhos Creche: '.$beneficios[4]['possuifilhos'].'<br />';


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
    
echo 'Numero Filhos Global: '.$beneficios[0]['numerofilhos'].'<br />';
echo 'Numero Filhos Creche: '.$beneficios[4]['numerofilhos'].'<br />';

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
        
echo 'Filhos ate 6 anos Global: '.$beneficios[0]['filhosate6anos'].'<br />';
echo 'Filhos ate 6 anos Creche: '.$beneficios[4]['filhosate6anos'].'<br />';

// Pergunta 21 - No ultimo semestre recebeu ajuda?
if($questionarioResposta[0]['recebeuauxiliosemestreanterior'] === 'S')
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 5;
else
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 0;

echo 'Recebeu auxilio ultimo semestre Global: '.$beneficios[0]['recebeuauxiliosemestreanterior'].'<br />';

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

echo 'Situação imóvel Global: '.$beneficios[0]['id_situacaoimovel'].'<br />';
echo 'Situação imóvel Moradia: '.$beneficios[2]['id_situacaoimovel'].'<br />';

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

echo 'Reside com nucleo familiar Global: '.$beneficios[0]['residenucleofamiliar'].'<br />';
echo 'Reside com nucleo familiar Moradia: '.$beneficios[2]['residenucleofamiliar'].'<br />';

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

echo 'Com quem você reside Global: '.$beneficios[0]['localreside'].'<br />';
echo 'Com quem você reside Moradia: '.$beneficios[2]['localreside'].'<br />';
echo 'Com quem você reside Alimentação: '.$beneficios[1]['localreside'].'<br />';


/*  Caso não resida com o seu núcleo familiar:  */
if ($questionarioResposta[0]['residecomfamilia'] == 'N') {
    $cidadeCampus = $questionarioControle->retornaCidadeCampus($questionarioResposta[0]['id_campus']);
    
    if ($cidadeCampus == $questionarioResposta[0]['id_cidade2']):
        $beneficios[3]['campusIgualCidade'] = 5;
    else:
        $beneficios[6]['campusIgualCidade'] = 5;
    endif;
}

echo 'Campus igual a cidade Municipal: '.$beneficios[3]['campusIgualCidade'].'<br />';
echo 'Campus igual a cidade InterMunicipal: '.$beneficios[6]['campusIgualCidade'].'<br />';

// Pergunta 33 - Distancia do local de estudo ate residencia
if ($questionarioResposta[0]['residecomfamilia'] == 'S') {
    $beneficios[2]['id_distanciaresidencia'] = 0;
    $beneficios[3]['id_distanciaresidencia'] = 0;
    $beneficios[6]['id_distanciaresidencia'] = 0;
    $beneficios[0]['id_distanciaresidencia'] = 0;
} else if($questionarioResposta[0]['id_distanciaresidencia'] === 1 ){
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
        $beneficios[0]['id_distanciaresidencia'] = 0;}
        
echo 'Distancia Local ate aqui Global: '.$beneficios[0]['id_distanciaresidencia'].'<br />';
echo 'Distancia Local ate aqui Moradia: '.$beneficios[2]['id_distanciaresidencia'].'<br />';
echo 'Distancia Local ate aqui Municipal: '.$beneficios[3]['id_distanciaresidencia'].'<br />';
echo 'Distancia Local ate aqui Intermunicipal: '.$beneficios[6]['id_distanciaresidencia'].'<br />';

/*  Você é portador de alguma deficiência  */
if ($questionarioResposta[0]['id_deficiencia'] != NULL):
    $beneficios[0]['id_deficiencia'] = 5;
else:
    $beneficios[0]['id_deficiencia'] = 0;
endif;

echo 'Possui deficiencia Global: '.$beneficios[0]['id_deficiencia'].'<br />';

/*  Outros componentes do grupo familiar foram ou são assistidos pelo IFMG  */
if ($questionarioResposta[0]['familiaassistidabeneficios'] == 'S'):
    $beneficios[0]['familiaassistidabeneficios'] = 5;
else:
    $beneficios[0]['familiaassistidabeneficios'] = 0;
endif;

echo 'Familia assistidos pelo IFGM Global: '.$beneficios[0]['familiaassistidabeneficios'].'<br />';

/*  Qual é a sua situação de trabalho  */
if ($questionarioResposta[0]['id_situacaotrabalho'] == '11' || $questionarioResposta[0]['id_situacaotrabalho'] == '7' || $questionarioResposta[0]['id_situacaotrabalho'] == '6' ) {
    $beneficios[0]['id_situacaotrabalho'] = 5;
} else if ($questionarioResposta[0]['id_situacaotrabalho'] == '10' || $questionarioResposta[0]['id_situacaotrabalho'] == '5') {
    $beneficios[0]['id_situacaotrabalho'] = 3;
} else {
    $beneficios[0]['id_situacaotrabalho'] = 0;
}

echo 'Sua situação de trabalho Global: '.$beneficios[0]['id_situacaotrabalho'].'<br />';

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

echo 'Escolaridade do Pai Global: '.$beneficios[0]['id_escolaridadepai'].'<br />';

/*  Qual é a situação de trabalho de seu pai/padrasto  */
if ($questionarioResposta[0]['id_situacaotrabalhopai'] == '13' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '11' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '10' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '7' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '6') {
    $beneficios[0]['id_situacaotrabalhopai'] = 5;
} else if ($questionarioResposta[0]['id_situacaotrabalhopai'] == '9' || $questionarioResposta[0]['id_situacaotrabalhopai'] == '5') {
    $beneficios[0]['id_situacaotrabalhopai'] = 3; 
} else {
    $beneficios[0]['id_situacaotrabalhopai'] = 0;
}

echo 'Situação trabalho do Pai Global: '.$beneficios[0]['id_situacaotrabalhopai'].'<br />';

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

echo 'Escolaridade da Mae Global: '.$beneficios[0]['id_escolaridademae'].'<br />';

/*  Qual é a situação de trabalho da sua mae/madastra  */
if ($questionarioResposta[0]['id_situacaotrabalhomae'] == '13' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '11' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '10' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '7' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '6') {
    $beneficios[0]['id_situacaotrabalhomae'] = 5;
} else if ($questionarioResposta[0]['id_situacaotrabalhomae'] == '9' || $questionarioResposta[0]['id_situacaotrabalhomae'] == '5') {
    $beneficios[0]['id_situacaotrabalhomae'] = 3; 
} else {
    $beneficios[0]['id_situacaotrabalhomae'] = 0;
}

echo 'Situacao trabalho da Mae Global: '.$beneficios[0]['id_situacaotrabalhomae'].'<br />';

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

echo 'RendaPercapita Global: '.$beneficios[0]['rendapercapita'].'<br />';
echo 'RendaPercapita Atividade: '.$beneficios[5]['rendapercapita'].'<br />';

// Pergunta 48 - Algum membro do nucleo familiar recebe bolsa familia?
$grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($id_questionarioResposta);

foreach ($grupoFamiliar as $valor){ // Verifica se algum membro recebe bolsa familia    
    if($valor['recebebolsafamilia'] == 'S'){
        $beneficios[0]['recebebolsa'] = 10;
        break;  }} //Se econtrar sai do foreach sem verificar o resto

echo 'Recebe bolsa Global: '.$beneficios[0]['recebebolsa'].'<br />';

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
        
echo 'Possui Veiculo Global: '.$beneficios[0]['possuiVeiculo'].'<br />';        
echo 'Possui Veiculo Municipal: '.$beneficios[3]['possuiVeiculo'].'<br />';        
echo 'Possui Veiculo InterMunicipal: '.$beneficios[6]['possuiVeiculo'].'<br />';   

// Pergunta 56 - Algum membro do nucleo familiar possui imovel?
$possuiImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
if($possuiImovel[1])
    $beneficios[0]['possuiImovel'] = 0;
else
    $beneficios[0]['possuiImovel'] = 2;

echo 'Possui Imovel Global: '.$beneficios[0]['possuiImovel'].'<br />';   

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

echo 'Imovel serve de residencia Global: '.$beneficios[0]['serveDeResidencia'].'<br />';   
echo 'Imovel serve de residencia Moradia: '.$beneficios[2]['serveDeResidencia'].'<br />';   

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

echo 'Provedor da familia Global: '.$beneficios[0]['id_grupofamiliar_provedor'].'<br />'; 

echo '<hr />';

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
    $beneficios[3]['campusIgualCidade'] +
    $beneficios[3]['id_distanciaresidencia'] + 
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
    $beneficios[6]['campusIgualCidade'] +
    $beneficios[6]['id_distanciaresidencia'] + 
    $beneficios[0]['rendapercapita'] + 
    $beneficios[0]['serveDeResidencia'] +
    $beneficios[6]['possuiVeiculo'];
else:
    $aux_transporte_inter = 0;
endif;

echo 'Global: '.$pontuacaoGlobal.'<br /><br />';

echo 'Alimentação: '.$aux_alimentacao.'<br />';
echo 'Moradia: '.$aux_moradia.'<br />';
echo 'Creche: '.$aux_creche.'<br />';
echo 'Atividade: '.$aux_atividade.'<br />';
echo 'Municipal: '.$aux_transporte_municipal.'<br />';
echo 'InterMunicipal: '.$aux_transporte_inter.'<br /> <br />';

/*
$SQL2 =    "UPDATE tbl_pontuacao_beneficio
            SET aux_alimentacao = $aux_alimentacao, 
                aux_moradia = $aux_moradia, 
                aux_transportemunicipal = $aux_transporte_municipal, 
                aux_creche = $aux_creche, 
                aux_atividade = $aux_atividade, 
                aux_transporteintermunicipal = $aux_transporte_inter
 WHERE id_questionarioresposta = $id_questionarioResposta;";

echo nl2br($SQL2);*/



echo '<hr />';

endforeach;
            









?>
