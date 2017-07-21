<form method="post" title="alterar login #tipo#" id="alt_#tipo#"
    action="#url#/index.php/login/salvarsenha/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    
    <label>Nova Senha:</label>
    <input type="password" name="senha" value="#senha#" required maxlength="37" 
        placeholder="Senha de acesso" title="Informe a senha de acesso" 
        x-moz-errormessage="Informe a senha de acesso" />
    <br>
    
    <label>Confirmar Nova Senha:</label>
    <input type="password" name="confirmacao" value="#senha#" required 
        maxlength="37" placeholder="Senha de acesso" 
        title="Informe a senha de acesso" 
        x-moz-errormessage="Informe a senha de acesso" />
    <br>
    
    <article style="color:red;font-weight:bold;">#msg#<article>
    
    <input type="submit" name="salvar" value="Salvar" />
</form>