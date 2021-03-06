<div class="wrapper">
    <h1><a href="<?php echo site_url("$access_label/index"); ?>"><span>Medappcare - un site super cool qu'on aime parce qu'il est bien</span></a></h1>
<!--    --><?php //if($this->session->flashdata('error')): ?>
<!--    <span class="alert alert-error">--><?php //echo $this->session->flashdata('error'); ?><!--</span>-->
<!--    --><?php //endif; ?>
<!--    --><?php //if($this->session->flashdata('success')): ?>
<!--        <span class="alert alert-success">--><?php //echo $this->session->flashdata('success'); ?><!--</span>-->
<!--    --><?php //endif; ?>
    <?php if($user): ?>
        <span class="connected-user">Connecté en tant que <?php echo $user->pseudo ?> | <a href="<?php echo site_url('site/deconnect') ?>">Déconnexion</a></span>
    <?php endif; ?>
    <div class="links">
        <div class="social">
            <a class="facebook" href="https://www.facebook.com/Medappcare" target="_blank" title="facebook">Rejoignez-nous sur Facebook !</a>
            <a class="twitter" href="https://twitter.com/Medappcare" target="_blank" title="twitter">Suivez-nous sur Twitter</a>
        </div>
        <div class="meta">
        	<?php if (!$pro && !$user): ?>
                <a data-toggle="modal" href="#connexionModalPro" class="pro">Espace Pro</a>
            <?php endif; ?>
            
            <?php if(!$user): ?>
                <a data-toggle="modal" href="<?php echo $pro ? '#connexionModalPro' : '#connexionModal'?>" class="connexion">Connexion</a>
            <?php else: ?>
	            <a href="<?php echo site_url($access_label.'/espacemembre'); ?>" class="<?php echo $pro ? 'pro' : 'link-particuliers' ?>">Mon espace</a>
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
    	<a href="<?php echo site_url("gp/register") ?>" class="btn btn-primary"><?php echo lang('inscription') ?></a>
    </div>
  </div>
    <div id="login-error" class="alert alert-error hide"></div>
</div>


<div class="modal hide fade" id="connexionModalPro">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Connexion à Medappcare Pro</h3>
  </div>
  <div class="modal-body">
    <form method="post" data-action="<?php echo site_url('rest/connect') ?>" name="login_form" id="login_form_pro">
      <p><input name="email" id="email-pro" type="email" required placeholder="Email"></p>
      <p><input name="password" id="password-pro" type="password" required placeholder="Mot de passe"></p>
      <p><button type="submit" class="btn btn-primary">Connexion</button>
        <a href="#lostPassword">Mot de passe oublié ?</a>
      </p>
    </form>
    <div class="registration-call">
    	Nouveau sur Medappcare Pro ?
    	<a href="<?php echo site_url("pro/register") ?>" class="btn btn-primary">Inscription pro</a>
    </div>
  </div>
    <div id="login-error-pro" class="alert alert-error hide"></div>
</div>


<div class="modal hide fade" id="lostPasswordModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Mot de passe oublié</h3>
  </div>
  <div class="modal-body">
    <form method="post" data-action='<?php echo site_url('membre/password/') ?>' id="lost_password_form">
      <p><input id="lost-password-email" type="text" required placeholder="Email"></p>
      <p><button type="submit" class="btn btn-primary">Récupérer mon mot de passe</button>
      </p>
        <br/>
        <div id="lost-password-error" class="alert alert-error hide"></div>
        <div id="lost-password-success" class="success alert-success hide"></div>
    </form>
  </div>
</div>