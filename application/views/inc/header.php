<div class="wrapper">
    <h1><a href="<?php echo site_url("$access_label/index"); ?>"><span>Medappcare - un site super cool qu'on aime parce qu'il est bien</span></a></h1>
<!--    --><?php //if($this->session->flashdata('error')): ?>
<!--    <span class="alert alert-error">--><?php //echo $this->session->flashdata('error'); ?><!--</span>-->
<!--    --><?php //endif; ?>
<!--    --><?php //if($this->session->flashdata('success')): ?>
<!--        <span class="alert alert-success">--><?php //echo $this->session->flashdata('success'); ?><!--</span>-->
<!--    --><?php //endif; ?>
    <div class="links">
        <div class="social">
            <a class="facebook" href="https://www.facebook.com/Medappcare" target="_blank" title="facebook">Rejoignez-nous sur Facebook !</a>
            <a class="twitter" href="https://twitter.com/Medappcare" target="_blank" title="twitter">Suivez-nous sur Twitter</a>
        </div>
        <div class="meta">
            <a href="<?php echo site_url("$access_label/index") ?>" class="<?php echo $pro ? 'link-particuliers' : 'pro' ?>"><?php echo lang($pro ? 'espace_particulier' : 'espace_pro') ?></a>
            <?php if(!$user): ?>
            <a data-toggle="modal" href="#connexionModal" class="connexion">Connexion</a>
            <?php else: ?>
            <span style="position: absolute; top: 0; right: 0;">Connecté en tant que <?php echo $user->email ?> | <a href="<?php echo site_url('site/deconnect') ?>">Déconnexion</a></span>
            <?php endif; ?>
            
        </div>
    </div>
</div>

<div class="modal hide fade" id="connexionModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Connexion à Medappcare</h3>
  </div>
  <div class="modal-body">
    <form method="post" data-action="<?php echo site_url('rest/connect') ?>" name="login_form" id="login_form">
      <p><input name="email" id="email" type="email" required placeholder="Email"></p>
      <p><input name="password" id="password" type="password" required placeholder="Mot de passe"></p>
      <p><button type="submit" class="btn btn-primary">Connexion</button>
        <a href="#lostPassword">Mot de passe oublié ?</a>
      </p>
    </form>
    <div class="registration-call">
    	Nouveau sur Medappcare ?
    	<a href="<?php echo site_url("$access_label/register") ?>" class="btn btn-primary"><?php echo lang('inscription') ?></a>
    </div>
  </div>
    <div id="login-error" class="alert alert-error hide"></div>
</div>



<div class="modal hide fade" id="lostPasswordModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Mot de passe oublié</h3>
  </div>
  <div class="modal-body">
    <form method="post" action='lostPassword.php' name="lost_password_form">
      <p><input type="text" required placeholder="Email"></p>
      <p><button type="submit" class="btn btn-primary">Récupérer mon mot de passe</button>
      </p>
    </form>
  </div>
</div>
  
  