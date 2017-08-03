<form method="post" title="alterar login #tipo#" id="alt_#tipo#"
    action="#url#/index.php/login/salvarsenha/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    
    <div class="form-group">
        <label>Nova Senha:</label>
        <input type="password" name="senha" value="" required maxlength="37" 
            placeholder="Senha de acesso" title="Informe a senha de acesso" 
            x-moz-errormessage="Informe a senha de acesso" class="form-control" />
    </div>
    <div class="form-group">
        <label>Confirmar Nova Senha:</label>
        <input type="password" name="confirmacao" value="" required 
            maxlength="37" placeholder="Senha de acesso" 
            title="Informe a senha de acesso" class="form-control" 
            x-moz-errormessage="Informe a senha de acesso" />
    </div>
    
    <article style="color:red;font-weight:bold;">#msg#<article>
    
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />
</form>