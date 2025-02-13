<!-- Insert the home page content here -->
<?php include 'includes/header.html'; ?>


<h1>Page d'accueil </h1>


    <!-- Section Voir les sites -->
    <section class="container mt-5">
        <h2 class="mb-3">Voir les sites</h2>

       

        <div class="row">
        <? foreach ($sites as $site): ?>
            <a href=""><div class="col-md-4">
                <div class="p-3 bg-light border rounded"><?= $site->nom ."<br>". $site->utilisateur ?></div>
            </div></a>
        <? endforeach; ?>
        </div>
    </section>

    <?php include 'includes/footer.html'; ?>
