<a href="/site">Retour</a>

<h1 class="mt-3 mb-5 text-center">Liste de mes sites</h1>
<div class="container">
    <div class="row">
        <?php
        foreach ($mon_sites as $mon_site): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom du site : <?= $mon_site['nom_site']; ?></h5>
                        <p class="card-text">
                            <strong>Utilisateur : </strong><?= $mon_site['nom_utilisateur']; ?>
                        </p>
                        <form method="POST" action="/voirsite">
                            <input type="hidden" name="site_id" value="<?= $mon_site['id_site'];
                            ?>">
                            <button type="submit" class="btn btn-primary">Voir détails</button>
                        </form>
                        <form method="POST" action="/page">
                            <input type="hidden" name="site_id" value="<?= $mon_site['id_site'];
                            ?>">
                            <button type="submit" class="btn btn-primary" >Modifier</button>
                        </form>
                        <form method="POST" action="/monsite">
                            <input type="hidden" name="site_id" value="<?= $mon_site['id_site'];
                            ?>">
                            <button type="submit" class="btn btn-primary" name="submit_delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



