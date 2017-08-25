<?php
$cabecalho = array("title"=>"Terceiro Elemento","includes"=>"");
$cabecalho = array_merge($cabecalho, $array);

View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/default/index');
View::Show($array);

$rodape = array("google_analytics"=>"");
View::Load('view/rodape');
View::Show($rodape);
