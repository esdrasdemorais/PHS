<?php
$script='';
$cabecalho = array("title"=>"Descricao Salva","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/menu_admin');
View::Show($cabecalho);

View::Load('view/descricao/sucesso');
View::Show($array);

$rodape = array("google_analytics"=>"");
View::Load('view/rodape');
View::Show($rodape);
