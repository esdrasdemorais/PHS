<form method="post" title="login #tipo#" id="cad_#tipo#"
    action="#url#/index.php/login/enviaremail/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" maxlength="170" value="#email#" 
            required title="Informe um email válido." class="form-control" 
            x-moz-errormessage="Informe um email válido." />
    </div>
    
    <article style="color:red;font-weight:bold;">#msg#<article>
    
    <input type="submit" name="ok" value="OK" class="btn btn-primary" />
</form>
