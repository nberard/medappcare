<?php if(!empty($message)): ?>
    <br/><div class="alert alert-<?php echo $label; ?>"><?php echo $message; ?></div><br/>
<?php endif; ?>
<form class="form-contact" method="POST" >
	<h2 class="form-contact-heading">Contactez-nous</h2>
	
	<input type="email" name="email" id="email" class="input-block-level" placeholder="Mon Email" required>
	<input type="text" id="sujet" name="sujet" class="input-block-level" placeholder="Sujet du message" required>
	
	<textarea name="message" class="input-block-level" placeholder="Mon message" required></textarea>
	
	<button class="btn btn-primary" type="submit">Envoyer mon message</button>
</form>
<script>
    // Check form validity (fallback pour Safari qui ne gère pas required)
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
        $("form").submit(function(e){});
    }
</script>