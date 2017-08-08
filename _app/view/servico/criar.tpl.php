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
        <label>Ícone:</label>
        <input type="file" name="icon" value="#icon#" 
            title="Selecione um ícone PNG 200x200 (máximo)" class="form-control"
            x-moz-errormessage="Selecione um ícone PNG 200x200 (máximo)"
            required placeholder="Selecione um ícone PNG 200x200 (máximo)" />
    </div>
    <div class="form-group">
        <label>Valor Hora:</label>
        <input type="tel" value="#valorTotal#" class="form-control" 
            title="99,99 Informe um valor separado por vírgulas" 
            x-moz-errormessage="99,99 Informe um valor separado por vírgulas"
            required placeholder="99,99 Informe um valor separado por vírgulas"
            formnovalidate="formnovalidate" 
            placeholder="99,99 Informe um valor separado por vírgulas" />
    </div>
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>