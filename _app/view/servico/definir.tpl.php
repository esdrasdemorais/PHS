<form method="post" title="CadastroServico" action="#url#/index.php/servico/salvar" id="cad_servico">
    <input type="hidden" name="id" value="#id#" />
    <label>Data:</label>
    <input type="date" name="ser_data" value="#data#" title="Informe uma data." x-moz-errormessage="Informe uma data." min="2017-07-30" required />
    <br>
    <label>Hora:</label>
    <input type="time" name="ser_hora" value="#hora#" title="Informe um horário." x-moz-errormessage="Informe um horário." required />
    <br>
    <label>Período:</label>
    <input type="number" name="ser_periodo" value="#periodo#" title="Informe um período de horas." x-moz-errormessage="Informe um período de horas" min="1" max="12" required />
    <br>
    <label>Endereço:</label>
    <input type="search" name="ser_endereco" value="#endereco#" placeholder="rua, número, bairro, cidade, sigla estado" required title="Informe o endereço" x-moz-errormessage="Informe o endereço" />
    <input type="hidden" name="endereco_id" value="" />   
    <br>
    <label>Valor:</label>
    <input type="text" name="ser_valor" value="#valor#" readonly />  
    <br>
    <input type="submit" name="salvar" value="Salvar" />    
</form>