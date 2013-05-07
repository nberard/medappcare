<div class="wrapper">
    <h1>Medappcare</h1>
    <div class="links">
        <div class="social">
            <a class="facebook" href="facebook.com" target="_blank">Rejoignez-nous sur Facebook !</a>
            <a class="twitter" href="twitter.com" target="_blank">Toutes les infos sur Twitter</a>
        </div>
        <div class="meta">
            <a href="indexPro.php" class="pro">Espace Pro</a>
            <a data-toggle="modal" href="#connexionModal" class="connexion">Connexion</a>
            
        </div>
    </div>
</div>

<div class="modal hide fade" id="connexionModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"></button>
    <h3>Connexion à Medappcare</h3>
  </div>
  <div class="modal-body">
    <form method="post" action='connect.php' name="login_form">
      <p><input type="text" required placeholder="Email"></p>
      <p><input type="password" required placeholder="Mot de passe"></p>
      <p><button type="submit" class="btn btn-primary">Connexion</button>
        <a href="#lostPassword">Mot de passe oublié ?</a>
      </p>
    </form>
    <div class="registration-call">
    	Nouveau sur Medappcare ?
    	<a href="#" class="btn btn-primary">Inscription</a>
    </div>
  </div>
</div>

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
  
  