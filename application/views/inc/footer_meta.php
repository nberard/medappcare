<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo js_url('jquery-2.0.0.min'); ?>"><\/script>')</script>
<?php foreach($js_files as $js_file): ?>
    <script src="<?php echo $js_file; ?>"></script>
<?php endforeach; ?>
<!-- Google Analytics -->
<script>
/*
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src='//www.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
*/
</script>