<?php 
    
require_once 'sistema/relatorio/RelatorioControle.class.php';
session_start();
        
echo "<script>
        $(document).ready(function(){
            $('body').validationEngine('hideAll');
        });
    </script>";
        
if (isset($_SESSION['id_usuario'])):
    $relatorioControle = new RelatorioControle();
    if (isset($_REQUEST['metodo'])):
        call_user_func(array($relatorioControle, $_REQUEST['metodo']));
    endif;
else:
    echo '<script language= "JavaScript">
                location.href="index.php"
            </script>';
endif;

?>	