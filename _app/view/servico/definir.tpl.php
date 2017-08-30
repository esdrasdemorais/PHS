<form method="post" title="Cadastro Agendamento Serviço" 
    action="#url#/index.php/agendamento/salvar" id="cad_servico">
    
    <input type="hidden" name="servico_cliente_id" value="#servico_cliente_id#" />
    
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script type="text/javascript">
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {type: 'date'});
        webshims.setOptions('forms-ext', {type: 'time'});
        webshims.polyfill('forms forms-ext');
    </script>

    <div class="form-group">
        <label>Data do Agendamento:</label>
        <input type="date" name="data" value="#data#" title="Informe uma data." 
            x-moz-errormessage="Informe uma data." min="#minDate#" required 
            placeholder="Informe a data." class="form-control" />
    </div>
    <div class="form-group">
        <label>Hora:</label>
        <input type="time" name="hora" value="#hora#" required
            title="Informe um horário." x-moz-errormessage="Informe um horário."
            placeholder="Informe o horário." class="form-control" />
    </div>
    <div class="form-group">
        <label>#labelPeriodo#</label>
        <input type="number" name="#namePeriodo#" value="#valuePeriodo#" 
            title="Informe um Período." class="form-control" required 
            x-moz-errormessage="Informe um Período" min="1" max="#maxPeriodo#"
            placeholder="Informe um Período" />
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
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>
