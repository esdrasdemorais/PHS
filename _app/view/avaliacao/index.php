<?php
$script='<script type="text/javascript" src="' . $array["url"] . 
    '/js/servico.js"></script>';
$cabecalho = array("title"=>"Avaliação Serviço","includes"=>$script);
$cabecalho = array_merge($cabecalho, ['url'=>$array['url']]);
View::Load('view/cabecalho');
View::Show($cabecalho);

View::Load('view/menu');
View::Show($cabecalho);
?>
<br><br>
<form method="post" title="Avaliação Servico" id="cad_avaliacao" 
    action="<?php echo($array['url']);?>/index.php/avaliacao/salvar">
    <input type="hidden" name="servico_agendamento_id"
        value="<?php echo $array['servico_agendamento_id']; ?>"/>
    <div class="form-group">
        <label>Nota:</label>
        <select name="nota">
        <?php
        for ($i = 0; $i <= 10; $i++):
        ?>
            <option value="<?php echo $i ?>"><?php echo $i ?></option>
        <?php
        endfor; 
        ?>
        </select>
    </div>
    <div class="form-group">
        <label>Comentário:</label>
	    <textarea placeholder="Informe Críticas e Sugestões" rows="7" cols="37"
            class="form-control" name="comentario"></textarea>
    </div>
    <input type="submit" name="salvar" value="Salvar" 
	class="btn btn-primary" />
</form>
<?php
$rodape = array("google_analytics"=>"");
View::Load('view/rodape');
View::Show($rodape);
