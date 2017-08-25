<style>
    .init { margin-bottom: 37px }
    #logo { max-width: 177px }
    #loading {
	border: 17px solid #f3f3f3;
	border-radius: 50%;
	border-top: 17px solid #3498db;
	width: 77px;
	height: 77px;
	-webkit-animation: spin 2s linear infinite;
	animation: spin 2s linear infinite;
    }
    @-webkit-keyframes spin {
	0% { -webkit-transform: rotate(0deg); }
	100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
    }
    h1 { font-size: 27px; }
</style>
<header class="init" style="margin:17px auto; margin-top: 37px; max-width:177px">
    <img src="/images/logo.png" id="logo" />
</header>
<main class="init" style="max-width:277px; margin:0 auto; text-align: center">
    <article><h1>Terceiro <span style="color:darkblue">Elemento</span></h1></article>
    <section style="font-weight: bold; font-style: italic; color: #337ab7; text-align: right">
	Excel&ecirc;ncia em Servi&ccedil;os
    </section>
</main>
<footer style="max-width:77px;margin: 0 auto;margin-top:77px;">
    <div id="loading"></div>
</footer>
<script type="text/javascript">
    $(document).ready(function() {
	window.setTimeout(function() {
	    //window.location.href = '/index.php/login';
	    $(location).attr('href', '/index.php/login');
	}, 7700);
    });
</script>
