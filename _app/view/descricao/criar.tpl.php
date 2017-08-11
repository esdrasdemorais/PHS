<form method="post" title="Cadastro de Descrição de Serviço" id="cad_servico" 
    action="#url#/index.php/descricao/salvar">
    <input type="hidden" name="id" value="#id#" />
    <div class="form-group">
        <label>Descrição:</label>
        <input type="text" name="nome" value="#nome#" title="Informe a descrição" 
            x-moz-errormessage="Informe a descrição" maxlength="177" required 
            placeholder="Informe o  a descrição" class="form-control" />
    </div>
    <div class="form-group">
        <label>Status:</label>
        <select name="status" class="form-control">
            <option value="1" selected="">Ativo</option>
            <option value="0">Inativo</option>
        </select>
    </div>
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>