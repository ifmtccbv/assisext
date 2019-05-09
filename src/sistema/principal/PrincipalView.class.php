<?php
require_once ('sistema/geral/SiteView.class.php');
require_once ('sistema/principal/MenuView.php');

class PrincipalView extends SiteView {
	private $html;
	
	public function topo($hora, $permissao){
		$js=array("sistema/geral/js/menu.js",
                        "sistema/geral/js/jquery.js",
                        "sistema/geral/js/jquery_ui.js",
                        "sistema/geral/js/jquery_multiselect.js",
                        "sistema/geral/js/jquery_superbox.js",
                        "sistema/geral/js/jquery.validationEngine.js",
                        "sistema/geral/js/jquery.validationEngine-pt.js",
                        "sistema/geral/js/jquery_alerts.js",
                        "sistema/geral/js/funcoes.js",
                        "sistema/geral/js/jquery_money.js",
                        "sistema/geral/js/jquery_maskedInput.js",
                        "sistema/geral/js/jquery_calendario.js",
                        "sistema/geral/js/jquery_tabs.js",
                        "sistema/geral/js/jquery_autocomplete.js",
                        "sistema/geral/js/micox_upload.js",
                        "sistema/geral/js/jquery_alerts.js",
                        "sistema/geral/js/jquery_lightbox.js",
                        "sistema/geral/js/jquery_history.js",
                        "sistema/geral/js/funcaoToolTip.js",
                        "sistema/geral/js/jquery_dataTables.js",
                        "sistema/geral/js/jquery_timers.js",
                        "sistema/highcharts/js/highcharts.js",
                        "sistema/geral/js/jquery.dataTables.js",
                        "sistema/geral/js/jquery.fancybox.js");
		
		$css=array("sistema/geral/css/jquery.lightbox.css",
                        "sistema/geral/css/estilo.css",
                        "sistema/geral/css/jquery.autocomplete.css",
                        "sistema/geral/css/jquery_superbox.css",
                        "sistema/geral/css/jquery.alerts.css",
                        "sistema/geral/css/validationEngine.jquery.css",
                        "sistema/geral/css/ui-lightness/jquery-ui-1.7.1.custom.css",
                        "sistema/geral/css/jquery.tabs.css",
                        "sistema/geral/css/jquery_tablesorter.css",
                        "sistema/geral/css/demo_table2.css",
                        "sistema/geral/css/jquery.fancybox.css");		
		
		SiteView::setHead('AssisEXT - IFMG | Programa de Assistência Estudantil', true, $js, $css);
		
		$this->html='	
                        <div id="loading"></div>
			<div id="topoFaixa">
				</div>				
			    <div id="topo">
			    	<div id="topoDireitaIcones">
			        	<a title="AssisEXT - IFMG" onclick="$(this).lightbox({start:true,events:false}); return false;" href="sistema/geral/imagens/sobre.jpg"><img src="sistema/geral/imagens/ico_sobre.png" alt="Sobre" title="Sobre" border="0" /></a> <a href="index2.php"><img src="sistema/geral/imagens/ico_home.png" border="0" alt="Principal" title="Principal" /></a> <a href="index2.php?sair"><img border="0" src="sistema/geral/imagens/ico_sair.png" title="Logoff" alt="Sair" /></a>
			        </div>
			        <div id="topoDireita">
			            Usuário <b>'.($permissao[0]["nome"]).'
						</b>
						<br />'.$hora.'
					</div>
                                 <a href="index2.php">       
			         <div id="topoEsquerda">
			        </div> </a>
			    </div>';
		SiteView::setConteudo($this->html);		
	}
	public function menu($permissao){
		$menu=new MenuView();
		$this->html='<div id="menu" class="menu">
   						<ul id="menu_dropdown" class="menubar">
   						'.$menu->montaTodoMenu($permissao).'
				   		</ul>
					</div> 
				    <div id="menuLinks">
				    </div>';
		SiteView::setConteudo($this->html);
	}
	public function corpo(){
		$this->html = '<div id="corpo">		</div>';
		SiteView::setConteudo($this->html);
	}
}

?>