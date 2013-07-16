<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
</head>
<body>
	<div>
		<a href='<?php echo site_url('admin/pages')?>'>Pages</a> |
		<a href='<?php echo site_url('admin/accessoire_fabriquants')?>'>Fabriquants d'accessoires</a> |
		<a href='<?php echo site_url('admin/accessoires')?>'>Accessoires</a> |
		<a href='<?php echo site_url('admin/accessoire_photos')?>'>Photos d'accessoires</a> |
		<a href='<?php echo site_url('admin/articles')?>'>Articles</a> |
<!--		<a href='--><?php //echo site_url('admin/article_commentaires')?><!--'>Commentaires d'articles</a> |-->
<!--		<a href='--><?php //echo site_url('admin/devices')?><!--'>Devices</a> |-->
<!--		<a href='--><?php //echo site_url('admin/editeurs')?><!--'>Editeurs</a> |-->
		<a href='<?php echo site_url('admin/membres')?>'>Membres</a> |
<!--		<a href='--><?php //echo site_url('admin/publicites')?><!--'>Publicités</a> |-->
<!--		<a href='--><?php //echo site_url('admin/plateformes')?><!--'>Plateformes</a> |-->
		<a href='<?php echo site_url('admin/applications')?>'>Applications</a> |
		<a href='<?php echo site_url('admin/categories')?>'>Catégories d'applications</a> |
		<a href='<?php echo site_url('admin/selections')?>'>Sélections d'applications</a> |
        <a href='<?php echo site_url('admin/application_screenshots')?>'>Screenshots d'application</a> |
<!--		<a href='--><?php //echo site_url('admin/application_commentaires_medappcare')?><!--'>Commentaire Medappcare</a> |-->
<!--		<a href='--><?php //echo site_url('admin/application_criteres_medappcare_perso')?><!--'>Critères Medappcare gp</a> |-->
<!--		<a href='--><?php //echo site_url('admin/application_notes_medappcare_gp')?><!--'>Note Medappcare gp</a> |-->
<!--		<a href='--><?php //echo site_url('admin/application_criteres_medappcare_pro')?><!--'>Critères Medappcare pro</a> |-->
<!--		<a href='--><?php //echo site_url('admin/application_notes_medappcare_pro')?><!--'>Note Medappcare pro</a> |-->
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
    <?php if(isset($sup)): ?>
        <a href="<?php echo site_url('admin/applications/edit/'.$sup); ?>">Next</a>
    <?php endif; ?>
</body>
</html>
