<?php
    $cabecalho = array("title"=>"Cadastro de Cliente","includes"=>"");
    View::Load('view/cliente/cabecalho.tpl.php');
    View::Show($cabecalho);
    
    View::Load('salvar');
    View::Show(array());
    
    $rodape = array ("google_analytics"=>"");        
    View::Load('view/cliente/rodape.tpl.php');
    View::Show($rodape);

    

