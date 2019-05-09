<?php
require_once("sistema/usuario/UsuarioControle.class.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>  <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/menu.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_ui.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_multiselect.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_superbox.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery.validationEngine.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery.validationEngine-pt.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_alerts.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/funcoes.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_maskedInput.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_calendario.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_tabs.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_autocomplete.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/micox_upload.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_alerts.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_lightbox.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_history.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/funcaoToolTip.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_dataTables.js'></script>
        <script type="text/javascript" charset="UTF-8" src='sistema/geral/js/jquery_timers.js'></script>
            <link rel="stylesheet" href='sistema/geral/css/jquery.lightbox.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/estilo.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/jquery.autocomplete.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/jquery_superbox.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/jquery.alerts.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/validationEngine.jquery.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/ui-lightness/jquery-ui-1.7.1.custom.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/jquery.tabs.css' type="text/css" />
            <link rel="stylesheet" href='sistema/geral/css/jquery_tablesorter.css' type="text/css"/> </head>

    <body>

        <div id="corpo">
   
        <?php
        $usuarioControle = new UsuarioControle();
        $usuarioControle->addUsuario();
        ?>
        </div>
    </body>
</html>
<script>

    $(document).ready(function(){

        $("#cpf").mask("999.999.999-99");
        $("#telefone").mask("(99)9999-9999");
        $("#celular").mask("(99)9999-9999");
        $("#dataNascimento").mask("99/99/9999");

    });

</script>








