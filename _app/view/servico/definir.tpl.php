<form method="post" title="CadastroServico" 
      action="#url#/index.php/servico/salvar/tipo/#tipo#" id="cad_servico">
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

    <div class="form-group">
        <label>Data do Agendamento:</label>
        <input type="date" name="data" value="#data#" title="Informe uma data." 
            x-moz-errormessage="Informe uma data." min="30-07-2017" required 
            placeholder="Informe a data." id="birthday" class="form-control" />
    </div>
    <div class="form-group">
        <label>Hora:</label>
        <input type="time" name="hora" value="#hora#" required
            title="Informe um horário." x-moz-errormessage="Informe um horário."
            placeholder="Informe o horário." class="form-control" />
    </div>
    <div class="form-group">
        <label>Período de Horas:</label>
        <input type="number" name="periodo" value="#periodo#" 
            title="Informe um período de horas." class="form-control"
            x-moz-errormessage="Período de horas" min="1" max="12" required 
            placeholder="Informe um período em horas." />
    </div>
    <div class="form-group">
        <label>Endereço:</label>
        <input type="search" name="endereco" id="endereco" value="#endereco#" 
            placeholder="rua, número, bairro, cidade, uf, cep" required 
            title="Informe o endereço" x-moz-errormessage="Informe o endereço"
            class="form-control" />
        <section id="place" 
            style="min-width:280px;display:none;border:1px solid #000;
            cursor:pointer;text-decoration:underline">
        </section>
    </div>
    <input type="hidden" name="endereco_id" id="endereco_id" value="1" />
    <input type="hidden" name="geolocalizacao" id="geolocalizacao" value="" /> 
    <br>
    <!--<label>Valor:</label>
    <input type="text" name="ser_valor" value="#valor#" readonly />  
    <br>-->
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>