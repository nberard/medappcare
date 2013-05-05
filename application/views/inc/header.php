<div class="wrapper">
    <h1>Medappcare</h1>
    <?php if($this->session->flashdata('error')): ?>
    <span class="alert alert-error"><?php echo $this->session->flashdata('error'); ?></span>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>
        <span class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></span>
    <?php endif; //var_dump($user); ?>
    <div class="links">
        <div class="social">
            <a class="facebook" href="facebook.com" target="_blank">Rejoignez-nous sur Facebook !</a>
            <a class="twitter" href="twitter.com" target="_blank">Toutes les infos sur Twitter</a>
        </div>
        <div class="meta">
            <a href="<?php echo site_url($pro ? 'perso/index' : 'pro/index') ?>" class="<?php echo $pro ? 'link-particuliers' : 'pro' ?>"><?php echo lang($pro ? 'espace_particulier' : 'espace_pro') ?></a>
            <?php if(!$user): ?>
            <a data-toggle="modal" href="#connexionModal" class="connexion">Connexion</a>
            <?php else: ?>
            Connecté en tant que <?php echo $user->email ?> | <a href="<?php echo site_url('site/deconnect') ?>">Déconnexion</a>
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
    <form method="post" action='<?php echo site_url('site/connect') ?>' name="login_form">
      <p><input name="email" type="text" required placeholder="Email"></p>
      <p><input name="password" type="password" required placeholder="Mot de passe"></p>
      <p><button type="submit" class="btn btn-primary">Connexion</button>
        <a href="#">Mot de passe oublié ?</a>
      </p>
    </form>
    <div class="registration-call">
    	Nouveau sur Medappcare ?
    	<a href="<?php echo site_url($pro ? 'pro/register' : 'perso/register') ?>" class="btn btn-primary"><?php echo lang('inscription') ?></a>
    </div>
  </div>
</div>