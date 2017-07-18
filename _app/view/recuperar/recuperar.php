<?php
$cabecalho = array("title"=>"Recuperar Login " . $array['tipo'], "includes"=>"");
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/login/recuperar');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);