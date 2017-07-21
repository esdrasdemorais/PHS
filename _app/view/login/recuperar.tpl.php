<form method="post" title="login #tipo#" id="cad_#tipo#"
    action="#url#/index.php/login/enviaremail/tipo/#tipo#">
    
    <input type="hidden" name="id" value="#id#" />
    
    <label>E-mail:</label>
    <input type="email" name="email" maxlength="170" value="#email#" 
        required title="Informe um email válido." 
        x-moz-errormessage="Informe um email válido." />
    <br>
    
    <article style="color:red;font-weight:bold;">#msg#<article>
    
    <input type="submit" name="ok" value="OK" />
</form>
