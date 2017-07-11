<form method="post" title="CadastroCliente" action="/phs/index.php/cliente/salvar" name="cad_cliente" id="cad_cliente">
    <input type="hidden" name="id" value="#id#" />
    <label>Nome:</label>
    <input type="text" name="cli_nome" maxlength="170" value="#nome#" />
    <br>
    <labe>e-mail:</label>
    <input type="text" name="cli_email" maxlength="170" value="#email#" />
    <br>
    <labe>Endereço:</label>
    <input type="text" name="cli_endereco" maxlength="170" value="#endereco#" />
    <!--TODO -->
    <br>
    <labe>Telefone:</label>
    <input type="text" name="cli_telefone" maxlength="170" value="#telefone#" />
    <br>
    <input type="submit" name="salvar" value="Salvar" />
</form>