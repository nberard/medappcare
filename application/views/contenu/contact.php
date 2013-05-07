<form class="form-contact" method="get" >
	<h2 class="form-contact-heading">Contactez-nous</h2>
	
	<input type="email" id="email" class="input-block-level" placeholder="Mon Email" required>
	<input type="text" id="sujet" class="input-block-level" placeholder="Sujet du message" required>
	
	<textarea class="input-block-level" placeholder="Mon message" required></textarea>
	
	<button class="btn btn-primary" type="submit">Envoyer mon message</button>
</form>
<script>
    // Check form validity (fallback pour Safari qui ne gère pas required)
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
        $("form").submit(function(e){});
    }
</script>