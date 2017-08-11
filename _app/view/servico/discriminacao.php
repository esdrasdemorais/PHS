<?php
$script='<script type="text/javascript" src="' . $array["url"] . 
    '/js/servico.js"></script>';
$cabecalho = array("title"=>"Discriminaçao Serviço","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/servico/discriminacao');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);