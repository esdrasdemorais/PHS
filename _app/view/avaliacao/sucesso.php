<?php
$script='';
$cabecalho = array("title"=>"Cadastro de Cliente","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/menu');
View::Show($cabecalho);

View::Load('view/avaliacao/sucesso');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);
