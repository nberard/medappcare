<?php echo $inc['header_meta']; ?>

<body class="contact">

<header id="header">

    <?php echo $inc['header'] ; ?>

    <?php echo $inc['menuParticulier'] ; ?> <!-- Menu Particulier -->

</header>



<?php echo $contenu ; ?>

<?php echo $inc['footer'] ; ?>

 <!-- Appels JS & Autres -->
<?php echo $inc['footer_meta'] ; ?>

<?php foreach($js_files as $js_file): ?>
    <script src="<?php echo $js_file; ?>"></script>
<?php endforeach; ?>

<script>
    // Check form validity (fallback pour Safari qui ne gère pas required)
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
    	$("form").submit(function(e){});
    }  
</script>

</body>
</html>