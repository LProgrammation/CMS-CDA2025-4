<body>
<form id="login_form" action="" method="post">
    <div class="mb-3">
        <label class="h2">Connexion :</label>
    </div>
    <div class="mb-3">
        <div class="text-danger"><?= $message ?></div>
        <label for="exampleInputEmail1" class="form-label">Email :</label>
        <input type="email" class="form-control" name="email_user" value="<?= $email ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" name="password_user">
        <div class="text-body-secondary">Vous n'avez pas encore de compte ? <a
                    href="cms-cda/register">Inscrivez-vous</a></div>
    </div>
    <button type="submit" class="btn btn-secondary">Se Connecter</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
