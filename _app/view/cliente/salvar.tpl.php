<form method="post" title="CadastroCliente" action="#url#/index.php/cliente/salvar" id="cad_cliente">
    <input type="hidden" name="id" value="#id#" />
    <label>Nome:</label>
    <input type="text" name="cli_nome" maxlength="170" value="#nome#" title="Informe o nome completo." x-moz-errormessage="Informe o nome completo." required />
    <br>
    <label>E-mail:</label>
    <input type="email" name="cli_email" maxlength="170" value="#email#" required title="Informe um email válido." x-moz-errormessage="Informe um email válido." />
    <br>
    <label>Endereço:</label>
    <input type="search" name="cli_endereco" value="#endereco#" placeholder="rua, número, bairro, cidade, sigla estado" required title="Informe o endereço" x-moz-errormessage="Informe o endereço" />
    <input type="hidden" name="endereco_id" value="" />
    <input type="hidden" name="geolocalizacao" value="" /> 
    <!--TODO -->
    <br>
    <label>Telefone Celular:</label>
    <input type="tel" name="cli_telefone" maxlength="170" value="#telefone#" placeholder="ddd(11)numero(999999999)" 
           pattern="^\d{11}$" required maxlength="11" requery title="Informe o telefone somente com número" 
           x-moz-errormessage="Informe o telefone somente com número" />
    <br>
    <input type="submit" name="salvar" value="Salvar" />
</form>