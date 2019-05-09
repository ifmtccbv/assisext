<?php
require_once 'sistema/cliente/ClienteControle.class.php';
	session_start();
	
	if(isset($_SESSION['id_usuario']))
	{
		$clienteControle = new ClienteControle;
		if(isset($_REQUEST['metodo'])){		
			call_user_func(array($clienteControle, $_REQUEST['metodo']));		
		}
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}	
	
?>