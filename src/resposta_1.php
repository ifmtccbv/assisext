<?php

require_once 'sistema/questionario/QuestionarioDAO.class.php';

calculaPontos(132);



function calculaPontos($id_questionarioResposta){

$questionarioDAO = new QuestionarioDAO;
$questionarioResposta = $questionarioDAO->pegaDadosQuestionarioResposta($id_questionarioResposta); // Pega as respotas do questionario
$pegaBeneficios = $questionarioDAO->pegaBeneficioQuestionarioResposta($id_questionarioResposta); // Pega os beneficios selecionados

$tam = count($pegaBeneficios);

for ($i=0; $i<$tam; $i++){ // Vai iniciar as variaveis referente ao beneficio
    if($pegaBeneficios[$i]['id_beneficio'] == 1){
        $aux_alimentacao = 1;
        continue;}
    if($pegaBeneficios[$i]['id_beneficio'] == 2){
        $aux_moradia = 1;
        continue;}
    if($pegaBeneficios[$i]['id_beneficio'] == 3){
        $aux_transporte_municipal = 1;
        continue;}
    if($pegaBeneficios[$i]['id_beneficio'] == 4){
        $aux_creche = 1;
        continue;}
    if($pegaBeneficios[$i]['id_beneficio'] == 5){
        $aux_atividade = 1;
        continue;}
    if($pegaBeneficios[$i]['id_beneficio'] == 6){
        $aux_transporte_inter = 1;
        continue;}     }
        
        
//beneficios[0]['xxx'] é o array padrão.
        

// Pergunta 9 - Qual o curso está matriculado (Arrumar pontuação questionario)
switch($questionarioResposta[0]['id_curso']){
    case A:
        $beneficios[0]['id_curso'] = 4;
        break;
    case B:
        $beneficios[0]['id_curso'] = 4;
        break;
    case C:
        $beneficios[0]['id_curso'] = 4;
        break;
    case D:
        $beneficios[0]['id_curso'] = 2;
        break;
    case E:
        $beneficios[0]['id_curso'] = 2;
        break;
    default:
        $beneficios[0]['id_curso'] = 1;
        break;}

$resultado .= 'pontuacao Curso '.$beneficios[0]['id_curso'].'<br />';


// Pergunta 17 - Tem filhos
if($questionarioResposta[0]['possuifilhos'] === 'S'){
    if($aux_creche){
        $beneficios[4]['possuifilhos'] = 2; // $beneficios[4] referente ao aux_creche
        $beneficios[0]['possuifilhos'] = 1;} // $beneficios[0] caso tenha outro beneficio alem de creche
    else
        $beneficios[0]['possuifilhos'] = 1; }
else
    $beneficios[0]['possuifilhos'] = 0;

$resultado .= 'pontuacao Filhos '.$beneficios[0]['possuifilhos'].'<br />';
$resultado .= 'pontuacao Filhos 4 '.$beneficios[4]['possuifilhos'].'<br />';


// Pergunta 18 - Quantos filhos
if($questionarioResposta[0]['numerofilhos'] === 1 && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 1;
else if($questionarioResposta[0]['numerofilhos'] === 2 && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 2;
else if($questionarioResposta['numerofilhoes'] === 3 && $questionarioResposta[0]['possuifilhos'] === 'S')
    $beneficios[0]['numerofilhos'] = 3;

$resultado .= 'pontuacao Numero Filhos '.$beneficios[0]['numerofilhos'].'<br />';


// Pergunta 19 - Quantos filhos possuem ate 6 anos
if($questionarioResposta[0]['filhosate6anos'] === 1 && $questionarioResposta[0]['possuifilhos'] === 'S')
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 5; // $beneficios[4] referente ao aux_creche
        $beneficios[0]['filhosate6anos'] = 1;} // $beneficios[0] caso tenha outro beneficio alem de creche
    else
        $beneficios[0]['filhosate6anos'] = 1;
else if($questionarioResposta[0]['filhosate6anos'] === 2 && $questionarioResposta[0]['possuifilhos'] === 'S')
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 6;
        $beneficios[0]['filhosate6anos'] = 2;}
    else
        $beneficios[0]['filhosate6anos'] = 2;
else if($questionarioResposta[0]['filhosate6anos'] === 3 && $questionarioResposta[0]['possuifilhos'] === 'S')
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 8;
        $beneficios[0]['filhosate6anos'] = 3;}
    else
        $beneficios[0]['filhosate6anos'] = 3;
else if($questionarioResposta[0]['filhoesate6anos'] === 4 && $questionarioResposta[0]['possuifilhos'] === 'S')
    if($aux_creche){
        $beneficios[4]['filhosate6anos'] = 10;
        $beneficios[0]['filhosate6anos'] = 4;}
    else
        $beneficios[0]['filhosate6anos'] = 4;
 
$resultado .= 'Pontuacao Filhos ate 6 anos '.$beneficios[0]['filhosate6anos'].'<br />';   
    
// Pergunta 21 - No ultimo semestre recebeu ajuda
if($questionarioResposta[0]['recebeuauxiliosemestreanterior'] === 'S')
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 2;
else
    $beneficios[0]['recebeuauxiliosemestreanterior'] = 0;

$resultado .= 'Recebe auxilio semestre anterior '.$beneficios[0]['recebeuauxiliosemestreanterior'].'<br />';

// Pergunta 30 - Situacao do imovel
if($questionarioResposta[0]['id_situacaoimovel'] === B)
    if($aux_moradia){
        $beneficios[2]['id_situacaoimovel'] = 10; // $beneficios[2] referente ao aux_moradia
        $beneficios[0]['id_situacaoimovel'] = 5;}
    else
        $beneficios[0]['id_situacaoimovel'] = 5;
else
    $beneficios[0]['id_situacaoimovel'] = 0;

$resultado .= 'situacao imovel '.$beneficios[0]['id_situacaoimovel'].'<br />'; 


// Pergunta 32 - Distancia do local de estude e residencia
switch($questionarioResposta[0]['id_distanciaresidencia']){
    case 1:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 1; // $beneficios[2] referente ao aux_moradia
            $beneficios[3]['id_distanciaresidencia'] = 1; // $beneficios[3] referente ao aux_transporte(ver qual)
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;
        
    case 2:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 2;
            $beneficios[3]['id_distanciaresidencia'] = 2;
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;
        
    case 3:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 4;
            $beneficios[3]['id_distanciaresidencia'] = 4;
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;
        
    case 4:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 6;
            $beneficios[3]['id_distanciaresidencia'] = 6;
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;
        
    case 5:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 8;
            $beneficios[3]['id_distanciaresidencia'] = 8;
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;
        
    default:
        if($aux_moradia!=NULL || $aux_transporte!=NULL){
            $beneficios[2]['id_distanciaresidencia'] = 10;
            $beneficios[3]['id_distanciaresidencia'] = 10;
            $beneficios[0]['id_distanciaresidencia'] = 0;}
        else
            $beneficios[0]['id_distanciaresidencia'] = 0;
        break;  }
    
$resultado .= 'Distancia residencia '.$beneficios[0]['id_distanciaresidencia'].'<br />';  
    
// Pergunta 40 - Qual sua situacao de Trabalho (Esperando atualizar pontuação)
if($questionarioResposta[0]['id_situacaotrabalho'] === F )
    $beneficios[0]['id_situacaotrabalho'] = 4;
else if ($questionarioResposta[0]['id_situacaotrabalho'] === G)
    $beneficios[0]['id_situacaotrabalho'] = 2;
else
    $beneficios[0]['id_situacaotrabalho'] = 0;

$resultado .= 'Situacao de trabalho '.$beneficios['id_situacaotrabalho'].'<br />';

// Pergunta 41 - Situacao de trabalho do pai (Esperando atualizar pontuação)
if($questionarioResposta[0]['id_situacaotrabalhopai'] === I )
    $beneficios[0]['id_situacaotrabalhopai'] = 2;
else if($questionarioResposta[0]['id_situacaotrabalhopai'] === J || $questionarioResposta[0]['id_situacaotrabalhopai'] === K)
    $beneficios[0]['id_situacaotrabalhopai'] = 4;
else
    $beneficios[0]['id_situacaotrabalhopai'] = 0;

$resultado .= 'Situacao de trabalho_Pai '.$beneficios['id_situacaotrabalhopai'].'<br />';


// Pergunta 42 - Situacao de trabalho da mae (Esperando atualizar pontuação)
if($questionarioResposta[0]['id_situacaotrabalhomae'] === I )
    $beneficios[0]['id_situacaotrabalhomae'] = 2;
else if($questionarioResposta[0]['id_situacaotrabalhomae'] === J || $questionarioResposta[0]['id_situacaotrabalhomae'] === K)
    $beneficios[0]['id_situacaotrabalhomae'] = 4;
else
    $beneficios[0]['id_situacaotrabalhomae'] = 0;

$resultado .= 'Situacao de trabalho Mae '.$beneficios['id_situacaotrabalhomae'].'<br />';


// Renda Per-Capta

// Renda Per-Capta calcula na hora de finalizar o questionario
//$grupoFamiliar = $questionarioDAO->pegaNucleoFamiliar(92);
//$renda = ($beneficios[0]['rendamensal'] + $beneficios[0]['outrasrendas']) / count($grupoFamiliar[1]);

$renda = 500.00; // Valor para teste


if($renda <= 311.37)
    $beneficios[0]['rendapercapta'] = 10;
else if($renda <= 622.74)
    $beneficios[0]['rendapercapta'] = 6;
else if($renda <= 934.11)
    $beneficios[0]['rendapercapta'] = 4;
else if($renda <= 1245.48)
    $beneficios[0]['rendapercapta'] = 3;
else if($renda > 1245.48 )
    $beneficios[0]['rendapercapta'] = 2;

$resultado .= 'Renda PerCapta '.$beneficios[0]['rendapercapta'].'<br />';


// Pergunta 45 - Algum membro nucleo familiar recebe bolsa familia
$grupoFamiliar = $questionarioDAO->pegaGrupoFamiliar2($id_questionarioResposta);

foreach ($grupoFamiliar as $valor){ // Verifica se algum membro recebe bolsa familia    
    if($valor['recebebolsafamilia'] == 'S'){
        $beneficios[0]['recebebolsa'] = 5;
        break;} }

$resultado .= 'Membro recebe bolsa '.$beneficios[0]['recebebolsa'].'<br />';


// Pergunta 46 - Algum membro nucleo familiar possuiu veiculo
$possuiVeiculo = $questionarioDAO->pegaVeiculos($id_questionarioResposta);

if($possuiVeiculo[1]) // Se tiver veiculo
    if($aux_transporte){
        $beneficios[3]['possuiVeiculo'] = 4;
        $beneficios[0]['possuiVeiculo'] = 2;}
    else
        $beneficios[0]['possuiVeiculo'] = 2;
else
    $beneficios[0]['possuiVeiculo'] = 0;

$resultado .= 'Membro tem veiculo '.$beneficios[0]['possuiVeiculo'].'<br />';


// Pergunta 54 - Algum membro nucleo familiar possui imovel
$possuiImovel = $questionarioDAO->pegaImoveis($id_questionarioResposta);
if($possuiImovel[1])
    $beneficios[0]['possuiImovel'] = 2;
else
    $beneficios[0]['possuiImovel'] = 0;

$resultado .= 'Membro tem imovel '.$beneficios[0]['possuiImovel'].'<br />';

// Pergunta 60 - Escolaridade do provedor
switch($questionarioResposta[0]['id_escolaridade_provedor']){
    case 1:
        $beneficios[0]['id_escolaridade_provedor'] = 10;
        break;
    case 2:
        $beneficios[0]['id_escolaridade_provedor'] = 8;
        break;
    case 3:
        $beneficios[0]['id_escolaridade_provedor'] = 6;
        break;
    case 4:
        $beneficios[0]['id_escolaridade_provedor'] = 4;
        break;
    case 5:
        $beneficios[0]['id_escolaridade_provedor'] = 3;
        break;
    case 6:
        $beneficios[0]['id_escolaridade_provedor'] = 2;
        break;
    case 7:
        $beneficios[0]['id_escolaridade_provedor'] = 1;
        break;
    default:
        $beneficios[0]['id_escolaridade_provedor'] = 0;
        break;  }   
    
$resultado .= 'Escolaridade provedor '.$beneficios[0]['id_escolaridade_provedor'].'<br />';

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


if($aux_alimentacao || $aux_atividade){ // Nao existe valores diferentes para os dois
    $aux = $pontuacaoGlobal +    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];
    if($aux_alimentacao)
        $aux_alimentacao = $aux;
    if($aux_atividade)
        $aux_atividade = $aux;  }    

if($aux_moradia)
    $aux_moradia = $pontuacaoGlobal +
    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[2]['id_situacaoimovel'] +
    $beneficios[2]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];

if($aux_transporte_municipal)
    $aux_transporte_municipal = $pontuacaoGlobal +
    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];

if($aux_creche)
    $aux_creche = $pontuacaoGlobal +
    
    $beneficios[4]['possuifilhos'] +
    $beneficios[4]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];

if($aux_transporte_inter)
    $aux_transporte_inter = $pontuacaoGlobal +
    
    $beneficios[0]['possuifilhos'] +
    $beneficios[0]['filhosate6anos'] +
    $beneficios[0]['id_situacaoimovel'] +
    $beneficios[0]['id_distanciaresidencia'] +
    $beneficios[0]['possuiVeiculo'];

echo $resultado;

}
    


?>