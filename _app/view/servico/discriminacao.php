<?php
$script='<script type="text/javascript" src="' . $array["url"] . 
    '/js/servico.js"></script>';
$cabecalho = array("title"=>"Discriminaçao Serviço","includes"=>$script);
$cabecalho = array_merge($cabecalho, ['url'=>$array['url']]);
View::Load('view/cabecalho');
View::Show($cabecalho);
?>
<form method="post" title="Cadastro Servico" id="cad_servico" 
    action="<?php echo($array['url']);?>/index.php/discriminacao/salvar">
    <input type="hidden" name="servico_cliente_id"
    	value="<?php echo $array['servico_cliente_id']; ?>"/>
    <?php
    foreach($array['discriminacoes'] as $discriminacao):
	View::Load('view/servico/discriminacao');
	View::Show(['id'=>$discriminacao->getId(),'valor'=>
	    $discriminacao->getNome()]);
    endforeach;
    ?>
    <div class="form-group">
        <label>Observação:</label>
	<textarea placeholder="Informe Possíveis Recomendações" rows="7" 
	    cols="37" class="form-control" 
	    ><?php echo $array['observacao']; ?></textarea>
    </div>
    <input type="submit" name="salvar" value="Salvar" 
	class="btn btn-primary" />
</form>
<?php
$rodape = array("google_analytics"=>"");        
View::Load('view/rodape');
View::Show($rodape);
