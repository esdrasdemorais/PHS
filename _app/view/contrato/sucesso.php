<?php
$script='';
$cabecalho = array("title"=>"Contrato Salvo","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/contrato/sucesso');
View::Show($array);

$rodape = array("google_analytics"=>"");
View::Load('view/rodape');
View::Show($rodape);
