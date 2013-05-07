<?php echo $inc['header_meta']; ?>

<!--<body class="homepage particuliers">-->
<body class="<?php echo $body_class; ?>">

<header id="header">

    <?php echo $inc['header'] ; ?>

    <?php echo $inc['menu'] ; ?> <!-- Menu Particulier -->

</header>

<?php echo $contenu ; ?>

<?php echo $inc['footer'] ; ?>

<?php echo $inc['footer_meta'] ; ?> <!-- Appels JS & Autres -->

</body>
</html>