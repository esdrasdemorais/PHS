<form method="post" title="login #tipo#" id="cad_#tipo#"
    action="#url#/index.php/login/logar/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    
    <label>Login:</label>
    <input type="search" name="login" value="#login#" required maxlength="37"
        placeholder="Login de Acesso" title="Informe o login" 
        x-moz-errormessage="Informe o login" />
    <br>
    
    <label>Senha:</label>
    <input type="password" name="senha" value="#senha#" required maxlength="37" 
        placeholder="Senha de acesso" title="Informe a senha de acesso" 
        x-moz-errormessage="Informe a senha de acesso" />
    <br>
    
    <div style="color:red;font-weight:bold;">#msg#</div>
    
    <a href="#url#/index.php/login/recuperar/tipo/#tipo#/">Esqueci Minha Senha</a>
    <br>
    
    <input type="submit" name="ok" value="OK" />
    <br>
    
    <h5>Não tem cadastro? <a href="#url#/index.php/#tipo#">Cadastre-se</a></h5>
</form>