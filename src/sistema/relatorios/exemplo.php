<?php
require ('../class/class_banco.php');
require ('../class/funcoes_site.php');
$banco = new comunicaBD ( );
session_start ();
//set_time_limit(0);

// pega todas as marcas ativas (situacao = 1)
$sqlMarcas = 'SELECT MC.nome, MC.id_marca 
			  FROM tbl_marcas MC
			  INNER JOIN tbl_clientegestor CG ON CG.id_clienteGestor = MC.id_clienteGestor
			  INNER JOIN tbl_usuario US ON US.id_usuario=' . $_SESSION ['id_usuario'] . '
			  INNER JOIN tbl_usuarioperfilmarca UPM ON UPM.id_usuarioPerfil=US.id_usuarioPerfil AND MC.id_marca=UPM.id_marca
			  WHERE MC.situacao = 1 AND MC.id_clienteGestor ="' . $_SESSION ['id_clienteGestor'] . '" 
			  ORDER BY MC.nome';
$resultadoMarcas = $banco->consultarSQL ( $sqlMarcas );

$id_marca = 0;

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/funcoes.js"></script>
<script type="text/javascript" src="../js/jquery_tabs.js"></script>
<link href="../css/estilo.css" type="text/css" rel="stylesheet" />
<link href="../css/jquery.alerts.css" type="text/css" rel="stylesheet" />
<link href="../css/jquery.tabs.css" type="text/css" rel="stylesheet" />


<script type="text/javascript">		
		$(document).ready(function(){			
			$("#marcasAbas").tabs({fxSlide: true});
		});
</script>
</head>

<div id="corpo">
<div id="marcasAbas" >

				<?php
				
				echo '<ul>';
				
				for($i = 0; $i < $resultadoMarcas ['numRows']; $i ++) {
					
					$id_marca = $resultadoMarcas ['dados'] [$i] ['id_marca'];
					
					$sqlColecoes = 'SELECT MC.id_marcasColecao, MC.id_marca, MC.id_colecao, MC.metaValor, CO.nomeColecao
									FROM tbl_marcascolecao MC
									INNER JOIN tbl_colecao CO ON CO.id_colecao = MC.id_colecao
									INNER JOIN tbl_marcas MA ON MA.id_marca = MC.id_marca
									INNER JOIN tbl_clientegestor CG ON MA.id_clienteGestor = CG.id_clienteGestor
									WHERE MA.situacao = 1 
									AND MA.id_clienteGestor = "' . $_SESSION ['id_clienteGestor'] . '" 
									AND MC.id_marca="' . $id_marca . '" 
									ORDER BY MC.id_colecao DESC LIMIT 4';
					$resultadoColecoes = $banco->consultarSQL ( $sqlColecoes );
					
					if ($resultadoColecoes ['numRows'] > 0) {
						
						echo '<li>
							  <a href="#marca' . $resultadoMarcas ['dados'] [$i] ['id_marca'] . '">
								<span>' . utf8_encode ( $resultadoMarcas ['dados'] [$i] ['nome'] ) . '</span>
							  </a>
						 </li>';
					
					}
				
				}
				
				echo '</ul>';
				
				for($i = 0; $i < $resultadoMarcas ['numRows']; $i ++) {
					
					$arrayColecoesJS = '[';
					$arrayMetasJS = '[';
					$arrayVendasJS = '[';
					
					$arrayColecoes = '';
					$arrayMetas = '';
					$arrayVendas = '';
					
					$id_marca = $resultadoMarcas ['dados'] [$i] ['id_marca'];
					
					//pega as coleções das marcas ativas
					$sqlColecoes = 'SELECT MC.id_marcasColecao, MC.id_marca, MC.id_colecao, MC.metaValor, CO.nomeColecao
									FROM tbl_marcascolecao MC
									INNER JOIN tbl_colecao CO ON CO.id_colecao = MC.id_colecao
									INNER JOIN tbl_marcas MA ON MA.id_marca = MC.id_marca
									INNER JOIN tbl_clientegestor CG ON MA.id_clienteGestor = CG.id_clienteGestor
									WHERE MA.situacao = 1 
									AND MA.id_clienteGestor = "' . $_SESSION ['id_clienteGestor'] . '" 
									AND MC.id_marca="' . $id_marca . '" 
									ORDER BY MC.id_colecao DESC LIMIT 4';
					$resultadoColecoes = $banco->consultarSQL ( $sqlColecoes );
					//Só vai mostrar as marcas COM COLEÇÕES CADASTRADAS!

					if ($resultadoColecoes ['numRows'] > 0) {
						
						echo '<div id = "marca' . $id_marca . '">';
						
						for($j = 0; $j < $resultadoColecoes ['numRows']; $j ++) {
							
							$sqlVendas = 'SELECT SUM(valorDaCompra) AS totalVendas
									  FROM tbl_clientescompra
									  WHERE id_marca ="' . $id_marca . '" 
									  AND id_colecao ="' . $resultadoColecoes ['dados'] [$j] ['id_colecao'] . '" ';
							$resultadoVendas = $banco->consultarSQL ( $sqlVendas );
							
							$arrayColecoes .= 'colecao[]=' . utf8_encode ( $resultadoColecoes ['dados'] [$j] ['nomeColecao'] ) . '&';
							$arrayColecoesJS .= '"' . utf8_encode ( $resultadoColecoes ['dados'] [$j] ['nomeColecao'] ) . '", ';
							if ($resultadoColecoes ['dados'] [$j] ['metaValor'] == NULL)
								$resultadoColecoes ['dados'] [$j] ['metaValor'] = 0;
							$arrayMetas .= 'meta[]=' . $resultadoColecoes ['dados'] [$j] ['metaValor'] . '&';
							$arrayMetasJS .= '' . $resultadoColecoes ['dados'] [$j] ['metaValor'] . ', ';
							if ($resultadoVendas ['dados'] [0] ['totalVendas'] == NULL)
								$resultadoVendas ['dados'] [0] ['totalVendas'] = 0;
							$arrayVendas .= 'venda[]=' . $resultadoVendas ['dados'] [0] ['totalVendas'] . '&';
							$arrayVendasJS .= '' . ($resultadoVendas ['dados'] [0] ['totalVendas']) . ', ';
						
						}
						
						$arrayColecoes = substr ( $arrayColecoes, 0, - 1 );
						$arrayMetas = substr ( $arrayMetas, 0, - 1 );
						$arrayVendas = substr ( $arrayVendas, 0, - 1 );
						
						$arrayColecoesJS = substr ( $arrayColecoesJS, 0, - 2 ) . ']';
						$arrayMetasJS = substr ( $arrayMetasJS, 0, - 2 ) . ']';
						$arrayVendasJS = substr ( $arrayVendasJS, 0, - 2 ) . ']';
						
						/*echo $arrayColecoes.'<br/>'.$arrayMetas.'<br/>'.$arrayVendas;
					exit();*/
						
						echo '<script type="text/javascript" src="../highcharts/js/highcharts.js"></script>
						<script type="text/javascript">
		
		$(document).ready(function(){
			
			
			var chart' . $id_marca . ';
			chart' . $id_marca . ' = new Highcharts.Chart({
				chart: {
					renderTo: "divAlcanceDeMetas' . $id_marca . '",
					defaultSeriesType: "column",
					plotShadow: true
				},
	 			title: {
					text: "Alcance de Metas"
				},
				xAxis: {
				        categories: ' . $arrayColecoesJS . '
				},
				yAxis: {
				        min: 0,
				        title: {
				           text: "Valor"
				        }
		        },
				//legend: {
			      //  	labelFormatter : function() {
					//	return "Produto"
						//},
					//	shadow: true
				       
				//},					    
				tooltip: {
				        formatter: function() {
				           return "<b>"+ this.x +"</b>: R$ "+ float2moeda(this.y);
				        }
			    },
				plotOptions: {
			    	series: {
		            allowPointSelect: false
		        }
				},
		  		series: [{
						
			
			name: "Meta",
			data: 
			       			' . $arrayMetasJS . '
			},{
			name: "Venda",
			data: 
			       			' . $arrayVendasJS . '
			
						
			}]
				});

				});
</script>
						<div id = "divAlcanceDeMetas' . $id_marca . '" style="width: 950px; height: 445px"></div>';
						echo '</div>';
					
					}
				}
				
				?>
</div>
</div>