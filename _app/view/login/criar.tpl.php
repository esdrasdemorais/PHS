<form method="post" title="criar login #tipo#" id="login_#tipo#"
    action="#url#/index.php/login/salvar/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    <input type="hidden" name="email" value="#email#" />
    
    <div class="form-group">
        <label>Login:</label>
        <input type="search" name="login" value="#login#" required maxlength="37"
            placeholder="Login de Acesso" title="Informe o login" 
            x-moz-errormessage="Informe o login" class="form-control" />
    </div>
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