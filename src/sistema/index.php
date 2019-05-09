<?php
//session_start();
require_once 'principal/PrincipalControle.class.php';
require_once 'usuario/UsuarioControle.class.php';

$usuarioControle = new UsuarioControle();
$resultadoPermissao = $usuarioControle->verificaLogin();
$principalControle = new PrincipalControle();

if (isset ( $_POST ['metodo'] )) {
	call_user_func ( array ($principalControle, $_POST ['metodo'] ) );
} else {
	$principalControle->montaPrincipal ( $resultadoPermissao );
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
Titulo
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div id="carregando"></div>
	<?php
	include ('principal/topo.php');
	include ('principal/menu.php');
	echo '<div id="corpo"></div>';
	include ('principal/rodape.php');
	?>
</body>
</html>