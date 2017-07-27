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
                if (status === "error") {
                    var msg = "Endereço inválido ou não localizado.";
                    $("#place").html(msg + xhr.status + " " + xhr.statusText);
                } else {
                    var json = jQuery.parseJSON(response);
                    $('#place').html(json.results[0].formatted_address);
                    if(isNaN(json.results[0].address_components[0].long_name)) {
                        $('#place').html("Endereço não localizado. " +
                            "Informe o número do endereço.");
                        $('#endereco').focus();
                    }
                    $("#geolocalizacao").val(
                        json.results[0].geometry.location.lat + ',' +
                        json.results[0].geometry.location.lng
                    );
                }
                $('#place').css('display','inline');
            }
        );
    }
    
    $("#place").click(function() {
        $("#endereco").val($("#place").html());
        $.getJSON(
            '#url#/index.php/endereco/buscar/endereco/' +
            $('#endereco').val().replace(/ /g, '+') + '/geo/' + 
            $("#geolocalizacao").val(),
        function( json ) {
            $("#endereco_id").val(json.results.id);
        });
    });
});

});
</script>