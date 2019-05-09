<?php
require_once 'sistema/usuario/UsuarioControle.class.php';
session_start ();

echo "<script>
            $(document).ready(function(){
                $('body').validationEngine('hideAll');
    });</script>";

if (isset ( $_SESSION ['id_usuario'] ) || (isset($_GET['acao']) and $_GET['acao']=='Adicionar')) {
	$usuarioControle = new UsuarioControle ( );
	if (isset ( $_REQUEST ['metodo'] )) {
		call_user_func ( array ($usuarioControle, $_REQUEST ['metodo'] ) );
	} else {
		$resultadoPermissao = $usuarioControle->checkPermissao ();
	}
} else {
	echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
}
?>	