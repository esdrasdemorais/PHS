<?php
$cabecalho = array("title"=>"Escolha o Serviço","includes"=>"");
$cabecalho = array_merge($cabecalho, array('url'=>$array['url']));
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/menu');
View::Show($cabecalho);
?>
<div id="selecionar">
<?php
foreach($array['servicos'] as $servico){
    View::Load('view/servico/escolher');
    View::Show(array_merge($servico, array('url'=>$array['url'])));
}
?>
</div>
<?php
$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);


