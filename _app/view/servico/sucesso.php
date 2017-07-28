<?php
$script='';
$cabecalho = array("title"=>"Cadastro de Cliente","includes"=>$script);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/servico/sucesso');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);
