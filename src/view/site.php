<!-- Rappel : si le user est connecté, lui afficher ses sites dans une rubriques "mes sites", où il pourra supprimer, modifier et ajouter des pages/sites -->

<a href="/sites/mysites">Mes sites</a>
   
<h1 class="mt-3 mb-5 text-center">Liste des sites</h1>
<a href="/sites/new-site" class="mt-3 mb-5 text-center">Créer un site</a>
<div class="container">
    <div class="row">
        <?php /** @var TYPE_NAME $liste_sites */
        foreach ($liste_sites as $liste_site): ?>
            <div class="col-md-4 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom du site : <?php echo $liste_site['name_site']; ?></h5>
                        <p class="card-text">
                            <strong>Utilisateur : </strong><?php echo $liste_site['name_user']; ?>
                        </p>
                        <form method="POST" action="/sites/see-site">
                        <input type="hidden" name="id_site" value="<?php echo $liste_site['id_site'];
                        ?>">
                        <button type="submit" class="btn btn-primary">Voir détails</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





