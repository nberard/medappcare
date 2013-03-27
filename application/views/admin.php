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
		<a href='<?php echo site_url('admin/articles')?>'>Articles</a> |
		<a href='<?php echo site_url('admin/article_commentaires')?>'>Commentaires d'articles</a> |
		<a href='<?php echo site_url('admin/devices')?>'>Devices</a> |
		<a href='<?php echo site_url('admin/editeurs')?>'>Editeurs</a> |
		<a href='<?php echo site_url('admin/membres')?>'>Membres</a> |
		<a href='<?php echo site_url('admin/publicites')?>'>Publicité</a> |
		<a href='<?php echo site_url('admin/applications')?>'>Applications</a> |
		<a href='<?php echo site_url('admin/selections')?>'>Sélection d'applications</a> |
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
