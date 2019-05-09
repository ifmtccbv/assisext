<?php

require_once 'sistema/questionario/QuestionarioDAO.class.php';

calculaPontos(135);

function calcularPontos($id_questionarioResposta){

$questionarioDAO = new QuestionarioDAO;
$questionarioResposta = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta); // Pega as respotas do questionario
$pegaBeneficios = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta); // Pega os beneficios selecionados

$tam = count($pegaBeneficios);

for ($i=0; $i<$tam; $i++){ // Vai iniciar as variaveis referente ao beneficios existentes
    if($pegaBeneficios[$i]['id_beneficio'] === 1){
        $aux_alimentacao = 1;
        continue;}
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
        
//        
//    $aux_alimentacao = 1;
//    $aux_atividade =1;
//    $aux_creche=1;
//    $aux_moradia=1;
//    $aux_transporte_inter=1;
//    $aux_transporte_municipal=1;
        
        
// Pergunta 9 - Qual o curso que está matriculado
if($questionarioResposta[0]['id_curso'] == '2') // Opção B
    $beneficios[0]['id_curso'] = 4;
else if($questionarioResposta[0]['id_curso'] == '6') // Opção E
    $beneficios[0]['id_curso'] = 1;
else
    $beneficios[0]['id_curso'] = 2;

$resultado .= 'pontuacao Curso : '.$beneficios[0]['id_curso'].'<br />';

// Pergunta 17 - Tem filhos?
if($questionarioResposta[0]['possuifilhos'] === 'S'){
    if($aux_creche){
        $beneficios[4]['possuifilhos'] = 2; // $beneficios[4] referente ao aux_creche
        $beneficios[0]['possuifilhos'] = 1;} // $beneficios[0] caso tenha outro beneficio alem de creche
    else
        $beneficios[0]['possuifilhos'] = 1;}
else
    $beneficios[0]['possuifilhos'] = 0;

$resultado .= 'pontuacao Filhos SEM aux : '.$beneficios[0]['possuifilhos'].'<br />';
$resultado .= 'pontuacao Filhos COM aux : '.$beneficios[4]['possuifilhos'].'<br />';

// Pergunta 18 - Quantos filhos tem:
if($questionarioResposta[0]['numerofilhos'] === '1' && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 1;
else if($questionarioResposta[0]['numerofilhos'] === '2' && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 2;
else if($questionarioResposta[0]['numerofilhos'] === '3' && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 3;

$resultado .= 'pontuacao Numero Filhos : '.$beneficios[0]['numerofilhos'].'<br />';

// Pergunta 19 - Quantos filhos possuem ate 6 anos
if($questionarioResposta[0]['filhosate6anos'] == 1 && $questionarioResposta[0]['possuifilhos'] === 'S'){
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 5; // $beneficios[4] referente ao aux_creche
        $beneficios[0]['filhosate6anos'] = 1;} // $beneficios[0] caso tenha outro beneficio alem de creche
    else
        $beneficios[0]['filhosate6anos'] = 1;}
else if($questionarioResposta[0]['filhosate6anos'] == 2 && $questionarioResposta[0]['possuifilhos'] == 'S'){
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 6;
        $beneficios[0]['filhosate6anos'] = 2;}
    else
        $beneficios[0]['filhosate6anos'] = 2;}
else if($questionarioResposta[0]['filhosate6anos'] == 3 && $questionarioResposta[0]['possuifilhos'] == 'S'){
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 8;
        $beneficios[0]['filhosate6anos'] = 3;}
    else
        $beneficios[0]['filhosate6anos'] = 3;}
else if($questionarioResposta[0]['filhosate6anos'] == 4 && $questionarioResposta[0]['possuifilhos'] == 'S'){
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 10;
        $beneficios[0]['filhosate6anos'] = 4;}
    else
        $beneficios[0]['filhosate6anos'] = 4;}
 
$resultado .= 'Pontuacao Filhos ate 6 anos : '.$beneficios[0]['filhosate6anos'].'<br />';   
$resultado .= 'Pontuacao Filhos ate 6 anos COM aux creche: '.$beneficios[4]['filhosate6anos'].'<br />';  
    
// Pergunta 21 - No ultimo semestre recebeu ajuda?
if($questionarioResposta[0]['recebeuauxiliosemestreanterior'] === 'S')
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 2;
else
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 0;

$resultado .= 'Recebe auxilio semestre anterior : '.$beneficios[0]['recebeuauxiliosemestreanterior'].'<br />';

// Pergunta 30 - Situacao do imovel
if($questionarioResposta[0]['id_situacaoimovel'] === 2){
    if($aux_moradia){
        $beneficios[2]['id_situacaoimovel'] = 10; // $beneficios[2] referente ao aux_moradia
        $beneficios[0]['id_situacaoimovel'] = 5;}
    else
        $beneficios[0]['id_situacaoimovel'] = 5;}
else
    $beneficios[0]['id_situacaoimovel'] = 0;

$resultado .= 'situacao imovel : '.$beneficios[0]['id_situacaoimovel'].'<br />';
$resultado .= 'situacao imovel COM aux moradia : '.$beneficios[2]['id_situacaoimovel'].'<br />'; 

// Pergunta 32 - Distancia do local de estudo ate residencia
if($questionarioResposta[0]['id_distanciaresidencia'] === 1 ){
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 1; // $beneficios[2] referente ao aux_moradia
        $beneficios[3]['id_distanciaresidencia'] = 1; // $beneficios[3] referente ao aux_transporte_municipal
        $beneficios[6]['id_distanciaresidencia'] = 1; // $beneficios[6] referente ao aux_transporte_inter
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
else if($questionarioResposta[0]['id_distanciaresidencia'] === 2 ){
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 2;
        $beneficios[3]['id_distanciaresidencia'] = 2;
        $beneficios[6]['id_distanciaresidencia'] = 2;
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
else if($questionarioResposta[0]['id_distanciaresidencia'] === 3 ){
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 4;
        $beneficios[3]['id_distanciaresidencia'] = 4;
        $beneficios[6]['id_distanciaresidencia'] = 4;
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
else if($questionarioResposta[0]['id_distanciaresidencia'] === 4 ){
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 6;
        $beneficios[3]['id_distanciaresidencia'] = 6;
        $beneficios[6]['id_distanciaresidencia'] = 6;
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
else if($questionarioResposta[0]['id_distanciaresidencia'] === 5 ){
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 8;
        $beneficios[3]['id_distanciaresidencia'] = 8;
        $beneficios[6]['id_distanciaresidencia'] = 8;
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
else{
    if($aux_moradia!=NULL || $aux_transporte_municipal!=NULL || $aux_transporte_inter!=NULL){
        $beneficios[2]['id_distanciaresidencia'] = 10;
        $beneficios[3]['id_distanciaresidencia'] = 10;
        $beneficios[6]['id_distanciaresidencia'] = 10;
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    else
        $beneficios[0]['id_distanciaresidencia'] = 0;}
    
$resultado .= 'Distancia residencia SEM aux : '.$beneficios[0]['id_distanciaresidencia'].'<br />';
$resultado .= 'Distancia residencia COM aux Moradia : '.$beneficios[2]['id_distanciaresidencia'].'<br />'; 
$resultado .= 'Distancia residencia COM aux Muni: '.$beneficios[3]['id_distanciaresidencia'].'<br />';
$resultado .= 'Distancia residencia COM aux Inter: '.$beneficios[6]['id_distanciaresidencia'].'<br />'; 
    
// Pergunta 40 - Qual sua situacao de Trabalho
if($questionarioResposta[0]['id_situacaotrabalho'] === 6 || $questionarioResposta[0]['id_situacaotrabalho'] === 11) // Opção G, Opção K
    $beneficios[0]['id_situacaotrabalho'] = 4;
else if ($questionarioResposta[0]['id_situacaotrabalho'] === 7) // Opção H
    $beneficios[0]['id_situacaotrabalho'] = 2;
else if ($questionarioResposta[0]['id_situacaotrabalho'] === 10) // Opção J
    $beneficios[0]['id_situacaotrabalho'] = 1;
else
    $beneficios[0]['id_situacaotrabalho'] = 0;

$resultado .= 'Situacao de trabalho : '.$beneficios[0]['id_situacaotrabalho'].'<br />';

// Pergunta 41 - Situacao de trabalho do pai
if($questionarioResposta[0]['id_situacaotrabalhopai'] === 10 || $questionarioResposta[0]['id_situacaotrabalhopai'] === 11) // Opção K, Opção L
    $beneficios[0]['id_situacaotrabalhopai'] = 4;
else if($questionarioResposta[0]['id_situacaotrabalhopai'] === 9) // Opção J
    $beneficios[0]['id_situacaotrabalhopai'] = 2;
else
    $beneficios[0]['id_situacaotrabalhopai'] = 0;

$resultado .= 'Situacao de trabalho_Pai : '.$beneficios[0]['id_situacaotrabalhopai'].'<br />';

// Pergunta 42 - Situacao de trabalho da mae
if($questionarioResposta[0]['id_situacaotrabalhomae'] === 10 || $questionarioResposta[0]['id_situacaotrabalhomae'] === 11) // Opção K, Opção L
    $beneficios[0]['id_situacaotrabalhomae'] = 4;
else if($questionarioResposta[0]['id_situacaotrabalhomae'] === 9) // Opção J
    $beneficios[0]['id_situacaotrabalhomae'] = 2;
else
    $beneficios[0]['id_situacaotrabalhomae'] = 0;

$resultado .= 'Situacao de trabalho Mae : '.$beneficios[0]['id_situacaotrabalhomae'].'<br />';

// Renda Per-Capta

if($questionarioResposta[0]['rendapercapita'] <= 311.37)
    $beneficios[0]['rendapercapta'] = 10;
else if($questionarioResposta[0]['rendapercapita'] <= 622.74)
    $beneficios[0]['rendapercapta'] = 6;
else if($questionarioResposta[0]['rendapercapita'] <= 934.11)
    $beneficios[0]['rendapercapta'] = 4;
else if($questionarioResposta[0]['rendapercapita'] <= 1245.48)
    $beneficios[0]['rendapercapta'] = 3;
else if($questionarioResposta[0]['rendapercapita'] > 1245.48 )
    $beneficios[0]['rendapercapta'] = 2;

$resultado .= 'Renda PerCapta : '.$beneficios[0]['rendapercapta'].'<br />';

// Pergunta 45 - Algum membro do nucleo familiar recebe bolsa familia?
$grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($id_questionarioResposta);

foreach ($grupoFamiliar as $valor){ // Verifica se algum membro recebe bolsa familia    
    if($valor['recebebolsafamilia'] == 'S'){
        $beneficios[0]['recebebolsa'] = 5;
        break;  }} //Se econtrar sai do foreach sem verificar o resto

$resultado .= 'Membro recebe bolsa : '.$beneficios[0]['recebebolsa'].'<br />';

// Pergunta 46 - Algum membro do nucleo familiar possuiu veiculo?
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
    
$resultado .= 'Membro tem veiculo : '.$beneficios[0]['possuiVeiculo'].'<br />';
$resultado .= 'Membro tem veiculo COM aux muni: '.$beneficios[3]['possuiVeiculo'].'<br />';
$resultado .= 'Membro tem veiculo COM aux inter: '.$beneficios[6]['possuiVeiculo'].'<br />';

// Pergunta 54 - Algum membro do nucleo familiar possui imovel?
$possuiImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
if($possuiImovel[1])
    $beneficios[0]['possuiImovel'] = 0;
else
    $beneficios[0]['possuiImovel'] = 2;

$resultado .= 'Membro tem imovel : '.$beneficios[0]['possuiImovel'].'<br />';

// Pergunta 60 - Escolaridade do provedor
if($questionarioResposta[0]['id_escolaridade_provedor'] === 1)
    $beneficios[0]['id_escolaridade_provedor'] = 10;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 2)
    $beneficios[0]['id_escolaridade_provedor'] = 8;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 3)
    $beneficios[0]['id_escolaridade_provedor'] = 6;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 4)
    $beneficios[0]['id_escolaridade_provedor'] = 4;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 5)
    $beneficios[0]['id_escolaridade_provedor'] = 3;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 6)
    $beneficios[0]['id_escolaridade_provedor'] = 2;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 7)
    $beneficios[0]['id_escolaridade_provedor'] = 1;
else if($questionarioResposta[0]['id_escolaridade_provedor'] === 8)
    $beneficios[0]['id_escolaridade_provedor'] = 0;
    
$resultado .= 'Escolaridade provedor : '.$beneficios[0]['id_escolaridade_provedor'].'<br />';


// Faz todos os calculos. Independente do beneficio,a pontuacao Global é igual para todos
$pontuacaoGlobal = 

$beneficios[0]['id_curso'] + 
$beneficios[0]['numerofilhos'] +
$beneficios[0]['recebeuauxiliosemestreanterior'] +
$beneficios[0]['id_situacaotrabalho'] +
$beneficios[0]['id_situacaotrabalhopai'] +
$beneficios[0]['id_situacaotrabalhomae'] +
$beneficios[0]['rendapercapta'] +
$beneficios[0]['recebebolsa'] +
$beneficios[0]['possuiImovel'] +
$beneficios[0]['id_escolaridade_provedor'];


if($aux_alimentacao!=NULL || $aux_atividade!=NULL){ // Nao existe valores diferentes para os dois
    $aux = $pontuacaoGlobal +    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];
    if($aux_alimentacao)
        $aux_alimentacao = $aux;
    else
        $aux_alimentacao = 0; // Para inserir no banco como 0
    if($aux_atividade)
        $aux_atividade = $aux;
    else
        $aux_atividade = 0;}
else
    $aux_alimentacao = $aux_atividade = 0;


if($aux_moradia)
    $aux_moradia = $pontuacaoGlobal +    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[2]['id_situacaoimovel'] +
    $beneficios[2]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];
else
    $aux_moradia = 0;


if($aux_transporte_municipal)
    $aux_transporte_municipal = $pontuacaoGlobal +    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[3]['id_distanciaresidencia'] +
    $beneficios[3]['possuiVeiculo'];
else
    $aux_transporte_municipal = 0;


if($aux_creche)
    $aux_creche = $pontuacaoGlobal +    
    $beneficios[4]['possuifilhos'] +
    $beneficios[4]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];
else
    $aux_creche = 0;


if($aux_transporte_inter)
    $aux_transporte_inter = $pontuacaoGlobal +    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[6]['id_distanciaresidencia'] +
    $beneficios[6]['possuiVeiculo'];
else
    $aux_transporte_inter = 0;


echo $resultado;

if($questionarioDAO->gravarPontuacao($id_questionarioResposta, $aux_alimentacao, $aux_moradia, $aux_transporte_municipal, $aux_creche, $aux_atividade, $aux_transporte_inter))
{
    // Comando aki
}

}
    


?>