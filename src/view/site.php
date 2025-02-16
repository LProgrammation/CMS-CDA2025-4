<!-- Rappel : si le user est connecté, lui afficher ses sites dans une rubriques "mes sites", où il pourra supprimer, modifier et ajouter des pages/sites -->

<a href="/monsite">Mon site</a>
   
<h1 class="mt-3 mb-5 text-center">Liste des sites</h1>
<div class="container">
    <div class="row">
        <?php foreach ($liste_sites as $liste_site): ?>
            <div class="col-md-4 mb-4"> 
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom du site : <?= $liste_site['nom_site']; ?></h5>
                        <p class="card-text">
                            <strong>Utilisateur : </strong><?= $liste_site['nom_utilisateur']; ?>
                        </p>
                        <form method="POST" action="/voirsite">
                        <input type="hidden" name="site_id" value="<?= $liste_site['id_site']; 
                        ?>">
                        <button type="submit" class="btn btn-primary">Voir détails</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





