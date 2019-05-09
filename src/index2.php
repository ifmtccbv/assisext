<?php
require_once 'sistema/usuario/UsuarioControle.class.php';
$usuarioControle = new UsuarioControle ();

if (isset ( $_POST ['metodo'] )) {
	call_user_func ( array ($usuarioControle, $_POST ['metodo'] ) );
} else if (isset ( $_GET ['sair'] )) {
	$usuarioControle->logout ();
} else {
	$usuarioControle->checkLogin ();
}

?>