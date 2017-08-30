<?php
$script='<script type="text/javascript" src="#url#/js/endereco.js"></script>';
$cabecalho = array("title"=>"Cadastro de Serviço","includes"=>$script);
$cabecalho = array_merge($cabecalho, $array);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/menu_admin');
View::Show($cabecalho);

View::Load('view/profissional/criar');
View::Show($array);

$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);
