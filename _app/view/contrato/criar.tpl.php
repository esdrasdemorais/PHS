<form method="post" title="Cadastro Contrato" 
    action="#url#/index.php/contrato/salvar" id="cad_contrato">
    
    <input type="hidden" name="id" value="#id#" />
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script type="text/javascript">
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {type: 'date'});
        webshims.setOptions('forms-ext', {type: 'time'});
        webshims.polyfill('forms forms-ext');
    </script>

    <div class="form-group">
        <label>Número:</label>
        <input type="text" name="numero" value="#numero#" required 
            title="Informe o número do contrato" 
            x-moz-errormessage="Informe o número do contrato." 
            placeholder="Informe o número do contrato." class="form-control" />
    </div>
    <div class="form-group">
        <label>Data:</label>
        <input type="date" name="data" value="#data#" title="Informe uma data." 
            x-moz-errormessage="Informe uma data." min="#minDate#" required 
            placeholder="Informe a data." class="form-control" />
    </div>
    <div class="form-group">
        <label>QTD Diárias:</label>
        <input type="number" name="qtdDiarias" value="#qtdDiarias#" 
            title="Informe um período de horas." class="form-control"
            x-moz-errormessage="Período de horas" min="1" required 
            placeholder="Informe um período em horas." />
    </div>
    <div class="form-group">
        <label>Valor:</label>
        <input type="tel" name="valor" value="#valor#" class="form-control" 
            title="99,99 Informe um valor separado por vírgulas" 
            x-moz-errormessage="99,99 Informe um valor separado por vírgulas"
            required placeholder="99,99 Informe um valor separado por vírgulas"
            formnovalidate="formnovalidate" 
            placeholder="99,99 Informe um valor separado por vírgulas" />
    </div>
    <br>
    <input type="submit" name="salvar" value="Salvar" class="btn btn-primary" />    
</form>