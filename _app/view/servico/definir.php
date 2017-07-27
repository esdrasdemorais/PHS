<?php
$script='<script type="text/javascript" src="#url#/js/endereco.js"></script>';
$cabecalho = array("title"=>"Cadastro de Cliente","includes"=>$script);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/servico/definir');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);

