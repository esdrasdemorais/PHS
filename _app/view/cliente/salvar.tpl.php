<form method="post" title="CadastroCliente" id="cad_cliente"
    action="#url#/index.php/cliente/salvar">
    <input type="hidden" name="id" value="#id#" />
    <label>Nome:</label>
    <input type="text" name="cli_nome" maxlength="170" value="#nome#" 
        title="Informe o nome completo." min="17"
        x-moz-errormessage="Informe o nome completo." required />
    <br>
    <label>E-mail:</label>
    <input type="email" name="cli_email" maxlength="170" value="#email#" 
        required title="Informe um email válido." 
        x-moz-errormessage="Informe um email válido." />
    <br>
    <label>Telefone Celular:</label>
    <input type="tel" name="cli_telefone" maxlength="170" value="#telefone#" 
        placeholder="ddd(11)numero(999999999)" requery 
        pattern="^\d{10,11}$" required maxlength="11" 
        title="Informe o telefone somente com número" 
        x-moz-errormessage="Informe o telefone somente com número" />
    <br>
    <label>Endereço:</label>
    <input type="search" name="cli_endereco" id="endereco" value="#endereco#" 
        placeholder="cep rua, número bairro cidade sigla estado" required 
        title="Informe o endereço" x-moz-errormessage="Informe o endereço" />
    <div id="error_place"></div>
    <input type="hidden" name="endereco_id" value="" />
    <input type="hidden" name="geolocalizacao" value="" />
    <!--TODO -->
    <br>
    <input type="submit" name="salvar" value="Salvar" />
</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#endereco').keyup(function() {
        if (this.value.length >= 8) {
            $(document).load(
                'https://maps.googleapis.com/maps/api/geocode/json?address=' +
                $('#endereco').val().replace(/ /g, '+') + '&language=pt-BR' +
                '&components=country:BR&location_type=ROOFTOP' +
                '&result_type=street_address&sensor=false' +
                '&key=AIzaSyB0SIDPIWaoL9FtcF-STdfy_1WFXKjlTuU',
                function(response, status, xhr) {
                    if (status == "error") {
                        var msg = "CEP inválido ou não localizado.";
                        $("#error_place").html(msg + xhr.status + " " + 
                            xhr.statusText);
                    } else {
                        var json = JSON.parse(response);
                        $('#error_place').html(json.results[0].formatted_address);
                        //$('#endereco').val(json.results[0].formatted_address);
                    }
                }
            );
            /*request = $.getJSON(
                'https://maps.googleapis.com/maps/api/geocode/json?address=' +
                $('#endereco').val().replace(/ /g, '+') + '&language=pt-BR' +
                '&components=country:BR&location_type=ROOFTOP' +
                '&result_type=street_address&sensor=false' +
                '&key=AIzaSyB0SIDPIWaoL9FtcF-STdfy_1WFXKjlTuU');
            alert(eval(request));*/
        }
    });
});
</script>