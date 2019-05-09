<?php 
	require_once 'sistema/motorista/MotoristaControle.class.php';
	session_start();
	
	if(isset($_SESSION['id_usuario']))
	{
		$motoristaControle = new motoristaControle;
		if(isset($_REQUEST['metodo'])){		
			call_user_func(array($motoristaControle, $_REQUEST['metodo']));		
		}
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}	
?>	