<form method="post" title="CadastroServico" id="cad_servico" 
    action="#url#/index.php/servico/salvar">
    <input type="hidden" name="id" value="#id#" />
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
      webshims.setOptions('waitReady', false);
      webshims.setOptions('forms-ext', {type: 'date'});
      webshims.setOptions('forms-ext', {type: 'time'});
      webshims.polyfill('forms forms-ext');
    </script>

    <label>Data do Agendamento:</label>
    <input type="date" name="ser_data" value="#data#" title="Informe uma data." 
        x-moz-errormessage="Informe uma data." min="30-07-2017" required 
        placeholder="Informe a data." id="birthday" />
    <br>
    <label>Hora:</label>
    <input type="time" name="ser_hora" value="#hora#" required
        title="Informe um horário." x-moz-errormessage="Informe um horário."
        placeholder="Informe o horário."/>
    <br>
    <label>Período de Horas:</label>
    <input type="number" name="ser_periodo" value="#periodo#" 
        title="Informe um período de horas." 
        x-moz-errormessage="Período de horas" min="1" max="12" required 
        placeholder="Informe um período em horas." />
    <br>
    <label>Endereço:</label>
    <input type="search" name="ser_endereco" id="endereco" value="#endereco#" 
        placeholder="rua, número, bairro, cidade, sigla estado, cep" required 
        title="Informe o endereço" x-moz-errormessage="Informe o endereço" />
    <section id="place" 
        style="min-width:280px;display:none;border:1px solid #000;cursor:pointer;
        text-decoration:underline">
    </section>
    <input type="hidden" name="endereco_id" id="endereco_id" value="" />
    <input type="hidden" name="geolocalizacao" id="geolocalizacao" value="" /> 
    <br>
    <!--<label>Valor:</label>
    <input type="text" name="ser_valor" value="#valor#" readonly />  
    <br>-->
    <input type="submit" name="salvar" value="Salvar" />    
</form>