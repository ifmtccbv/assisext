<?php 
	require_once 'sistema/questionario/QuestionarioControle.class.php';
	session_start();
        
        echo "<script>
            $(document).ready(function(){
                $('body').validationEngine('hideAll');
            });</script>";
        
	if(isset($_SESSION['id_usuario']))
	{
		$questionarioControle = new QuestionarioControle;
		if(isset($_REQUEST['metodo'])){
			call_user_func(array($questionarioControle, $_REQUEST['metodo']));
		}
	}else{
		echo '<script language= "JavaScript">
				location.href="index.php"
			  </script>';
	}
?>	