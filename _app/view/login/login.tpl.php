<style type="text/css">
    h5, a, .form-group { color:#337ab7 !important; }
</style>
<form method="post" title="login #tipo#" id="cad_#tipo#"
    action="#url#/index.php/login/logar/tipo/#tipo#" 
    style="max-width:377px; margin:1.7em auto">
    
    <input type="hidden" name="id" value="#id#" />    
    
    <div class="form-group">
        <label>Login:</label>
        <input type="search" name="login" value="#login#" required maxlength="37"
            placeholder="Login de Acesso" title="Informe o login" 
            x-moz-errormessage="Informe o login" class="form-control" />
    </div>
    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="senha" value="#senha#" required maxlength="37" 
            placeholder="Senha de acesso" title="Informe a senha de acesso" 
            x-moz-errormessage="Informe a senha de acesso" class="form-control" />
    </div>
    
    <div style="color:red;font-weight:bold;">#msg#</div>
    
    <a href="#url#/index.php/login/recuperar/tipo/#tipo#/">Esqueci Minha Senha</a>
    <br>
    
    <input type="submit" name="ok" value="OK" class="btn btn-primary" />
    <br>
    
    <h5>
        Não tem cadastro?
        <a href="#url#/index.php/#tipo#">
            <strong>Cadastre-se</strong>
        </a>
    </h5>
</form>