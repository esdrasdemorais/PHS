<?php
$cabecalho = array("title"=>"Cadastro de Cliente","includes"=>"");
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/cliente/salvar');
View::Show($arrCliente);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);