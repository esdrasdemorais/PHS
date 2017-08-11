<form method="post" title="Cadastro Servico" id="cad_servico" 
    action="#url#/index.php/servico/salvar/tipo/#tipo#">
    <input type="hidden" name="id" value="#id#" />
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="data" value="#nome#" title="Informe o nome" 
            x-moz-errormessage="Informe o nome" maxlength="177" required 
            placeholder="Informe a data." class="form-control" />
    </div>
    <div class="form-group">
        <label>Status:</label>
        <select class="form-control">
            <option value="1" selected="">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>
    <div class="form-group">
        <label>Observação:</label>
        <textarea placeholder="Informe Possíveis Recomendações"></textarea>
    </div>
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>