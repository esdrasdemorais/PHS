<?php
$script = '<script type="text/javascript" src="' . $array["url"] . 
    '/js/descricao.js"></script>';
$cabecalho = array("title"=>"Cadastro de Descrição de Serviço",
    "includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/descricao/criar');
View::Show($array);

$rodape = array("google_analytics"=>"");
View::Load('view/rodape');
View::Show($rodape);

