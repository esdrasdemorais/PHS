<style type="text/css">
    .form-group { color:#337ab7 !important; }
</style>
<form method="post" title="CadastroCliente" id="cad_cliente"
    action="#url#/index.php/cliente/salvar">
    <input type="hidden" name="id" value="#id#" />
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="cli_nome" maxlength="170" value="#nome#" 
            title="Informe o nome completo." min="17" class="form-control"
	    x-moz-errormessage="Informe o nome completo." required
	    placeholder="Nome Completo" />
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="cli_email" maxlength="170" value="#email#" 
            required title="Informe um email válido." class="form-control"
	    x-moz-errormessage="Informe um email válido."
	    placeholder="Email Válido" />
    </div>
    <div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cli_cpf" maxlength="11" value="#cpf#" 
            required title="Informe um cpf válido." class="form-control"
	    x-moz-errormessage="Informe um cpf válido." min="11" max="11"
	    placeholder="(11111111111)Somente números" />
    </div>
    <div class="form-group">
        <label>Telefone Celular:</label>
        <input type="tel" name="cli_telefone" maxlength="170" value="#telefone#" 
            placeholder="ddd(11)numero(999999999)" requery 
            pattern="^\d{10,11}$" required maxlength="11" 
            title="Informe o telefone somente com número" class="form-control" 
            x-moz-errormessage="Informe o telefone somente com número" />
    </div>
    <div class="form-group">
        <label>Endereço:</label>
        <input type="search" name="cli_endereco" id="endereco" value="#endereco#" 
            placeholder="rua, número, bairro, cidade, sigla estado, cep" required 
            title="Informe o endereço" x-moz-errormessage="Informe o endereço"
            class="form-control" />
        <section id="place" 
            style="min-width:280px;display:none;border:1px solid #000;cursor:pointer;
            text-decoration:underline">
        </section>
    </div>
    <input type="hidden" name="endereco_id" id="endereco_id" value="" />
    <input type="hidden" name="geolocalizacao" id="geolocalizacao" value="" />
    <br>
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />
</form>
