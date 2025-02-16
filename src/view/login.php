<div class="auth-container">
    <form id="login_form" action="" method="post">
        <a href="/home" class="text-body-secondary">Retour à l'accueil</a>
        <div class="mb-3">
            <label class="h2">Connexion :</label>
        </div>
        <div class="mb-3">
            <div class="text-danger"><?php echo $message ?></div>
            <label class="form-label">Email :</label>
            <input type="email" class="form-control" name="email_user" value="<?php echo $email ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" name="password_user">
            <div class="text-body-secondary">Vous n'avez pas encore de compte ? <a
                        href="/register">Inscrivez-vous</a></div>
        </div>
        <button type="submit" class="btn btn-secondary">Se Connecter</button>
    </form>
</div>