<?php 
	require_once 'sistema/cidade/CidadeControle.class.php';
	session_start();
	
	if(isset($_SESSION['id_usuario']))
	{
		$cidadeControle = new CidadeControle();
		if(isset($_REQUEST['metodo'])){		
                    call_user_func(array($cidadeControle, $_REQUEST['metodo']));
		}
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}	
?>	