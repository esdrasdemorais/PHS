<?php
$script='<script type="text/javascript" src="#url#/js/endereco.js"></script>';
$cabecalho = array("title"=>"Cadastro de Cliente","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/cliente/salvar');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);