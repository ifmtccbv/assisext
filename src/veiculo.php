<?php

	require_once 'sistema/veiculo/VeiculoControle.class.php';
	session_start();
	
	if(isset($_SESSION['id_usuario']))
	{
		$veiculoControle = new VeiculoControle;
		if(isset($_REQUEST['metodo'])){		
			call_user_func(array($veiculoControle, $_REQUEST['metodo']));		
		}
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}	
?>	