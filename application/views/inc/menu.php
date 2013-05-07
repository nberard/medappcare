<nav>
    <ul>
        <li class="home">
            <a href="<?php echo index_page(); ?>">Home</a>
        </li>
        <?php foreach($categories_principales as $categorie_principale): ?>
            <li class="nav<?php echo $categorie_principale->class; ?> megamenu">
                <a dropdowndestination="<?php echo $categorie_principale->class; ?>" href="<?php echo $categorie_principale->link; ?>">
                    <span class="picto"></span>
                    <span class="text"><?php echo $categorie_principale->{"nom_".config_item('language_short')}; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="search">
            <a href="#">Rechercher</a>
        </li>
        
        <form action="search.php" method="post" class="search-form">
			<input type="text" id="search-query" placeholder="Trouvez l'appli qui vous plaît...">
		</form>
    </ul>
</nav>

<div id = "dropdown">
    <div class="whiteLine"></div>
    <nav class = "masante">
        <div class="wrapper">

            <!-- Each <ul> has to contain 10 <li> -->
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>

            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>
            <div class="bigpicto"></div>
        </div> <!-- end wrapper -->
    </nav> <!-- end masante -->

    <nav class = "monquotidien">
        <div class="wrapper">

            <!-- Each <ul> has to contain 10 <li> -->
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>

            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>

            <div class="bigpicto"></div>
        </div> <!-- end wrapper -->
    </nav>

    <nav class = "minformer">
        <div class="wrapper">

            <!-- Each <ul> has to contain 10 <li> -->
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>

            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>
            <div class="bigpicto"></div>
        </div> <!-- end wrapper -->
    </nav>

    <nav class = "medeplacer">
        <div class="wrapper">

            <!-- Each <ul> has to contain 10 <li> -->
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>
            <ul>
                <li><a href="">Activité physique</a></li>
                <li><a href="">Alertes et rappels</a></li>
                <li><a href="">Calculettes et convertisseurs</a></li>
                <li><a href="">Carnets de santé</a></li>
                <li><a href="">Diététique et suivi du poids</a></li>
                <li><a href="">Grossesse et maternité</a></li>
                <li><a href="">Menstruations et féminité</a></li>
                <li><a href="">Pour les aidants</a></li>
                <li><a href="">Sommeil</a></li>
                <li><a href="">Urgences et secours</a></li>
            </ul>

            <div class="sponsored-selection">
                <span class="title">Nos sélections</span>
                <ul>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                    <li><a href=""><img src="<?php echo img_url('tmp/app-icon-57.png'); ?>" alt="[app-title] icon"/>Ma super app</a></li>
                </ul>
                <span class="sponsored-indicator">Sponsorisées</span>
            </div>
            <div class="bigpicto"></div>
        </div> <!-- end wrapper -->
    </nav>
</div>