<?php
$cabecalho = array("title"=>"Escolha o Serviço","includes"=>"");
View::Load('view/cabecalho');
View::Show($cabecalho);

foreach($array['servicos'] as $servico){
    View::Load('view/servico/escolher');
    View::Show(array_merge($servico, array('url'=>$array['url'])));
}

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);


