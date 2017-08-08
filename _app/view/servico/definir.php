<?php
$script='<script type="text/javascript" src="' . $array["url"] . 
        '/js/endereco.js"></script><script type="text/javascript" src="' . 
        $array["url"] . '/js/servico.js"></script>';
$cabecalho = array("title"=>"Agendamento de Serviço","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/servico/definir');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);