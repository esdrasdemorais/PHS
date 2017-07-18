<?php
$cabecalho = array("title"=>"Terceiro Elemento","includes"=>"");
View::Load('view/cliente/cabecalho');
View::Show($cabecalho);

View::Load('view/default/index');
View::Show($array);