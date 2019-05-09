<?php 
    require_once 'sistema/principal/PrincipalControle.class.php';
    require_once 'sistema/usuario/UsuarioControle.class.php';
   
    session_start();
	if(isset($_SESSION['id_usuario'])){
            $usuarioControle = new UsuarioControle;
            $principalControle = new PrincipalControle;
            if(isset($_POST['metodo'])){
                    call_user_func(array($principalControle, $_POST['metodo']));
            }else{
                    $resultadoPermissao = $usuarioControle->checkPermissao();
                    $principalControle->montaPrincipal($resultadoPermissao);
            }
            
            ?>
            <script>
		
	$(document).ready(function(){
		// Initialize history plugin.
		// The callback is called at once by present location.hash.
		$.history.init(pageload);		
		// set onlick event for buttons
		$('a.history').click(function(){
			var hash = this.href;
			if(hash=="#"){
			}else{
				hash = hash.replace(/^.*#/, '');
				// moves to a new page. 
				// pageload is called at once. 
				$.history.load(hash);
				return false;
			}
		});
	});


	function pageload(hash) {
            // hash doesn't contain the first # character.
            if(hash) {
                    // restore ajax loaded state
                    mostrarCarregando();
                    str = new String(hash);
                    //SE FOI PASSADO PARAMETRO ENTAO DIVIDI ESSE PARAMETRO
                    if(str.search('-')!=-1){
                            str = str.split('-');
                            $("#corpo").load(str[0] + ".php?" + str[1],aposCarregamento);
                    }else{
                            $("#corpo").load(hash + ".php",aposCarregamento);
                    }

            } else {
                    // start page
                    mostrarCarregando();
                    $("#corpo").load("apresentacao.php",aposCarregamento);

            }
	}

      LoadPage = function(nomePagina){
        mostrarCarregando();
        $("#corpo").load(nomePagina,aposCarregamento);
      }

      function LoadPageEspecifica(nomePagina, divCarregar){
          mostrarCarregando();
          $("#"+divCarregar).load(nomePagina,aposCarregamento);
      }

	

</script>
		<?php
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}
?>