<a href="/sites/list">Retour</a>

<h1 class="mt-3 mb-5 text-center">Liste de mes sites</h1>
<div class="container">
    <div class="row">
        <?php
        foreach ($mes_sites as $mon_site): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom du site : <?php echo $mon_site['name_site']; ?></h5>
                        <p class="card-text">
                            <strong>Utilisateur : </strong><?php echo $mon_site['name_user']; ?>
                        </p>
                        <form method="POST" action="/sites/see-site">
                            <input type="hidden" name="id_site" value="<?php echo $mon_site['id_site'];
                            ?>">
                            <button type="submit" class="btn btn-primary">Voir détails</button>
                        </form>
                        <form method="POST" action="/page/edit-page">
                            <input type="hidden" name="id_site" value="<?php echo $mon_site['id_site']; ?>">
                            <button type="submit" class="btn btn-primary" >Modifier</button>
                        </form>
                        <?php if($accessModule->isGranted('admin'))  : ?>
                        <form method="POST" action="/sites/mysites">
                            <input type="hidden" name="id_site" value="<?php echo $mon_site['id_site'];
                            ?>">
                            <button type="submit" class="btn btn-primary" name="submit_delete">Supprimer</button>
                        </form>
                        <?php endif ; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



