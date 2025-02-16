<div class="auth-container">
    <form id="register_form" action="" method="post">
        <a href="/home" class="text-body-secondary">Retour à l'accueil</a>
        <div class="mb-3">
            <label class="h2">Inscription :</label>
        </div>
        <div class="mb-3">
            <div class="text-danger"><?php echo $message ?></div>
            <label class="form-label">Email :</label>
            <input type="email" class="form-control" name="email_user" value="<?php echo $email_user ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Nom :</label>
            <input type="text" class="form-control" name="name_user" value="<?php echo $name_user ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom :</label>
            <input type="text" class="form-control" name="firstname_user" value="<?php echo $firstname_user ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" name="password_user">
            <div class="text-body-secondary">Vous avez déjà un compte ? <a
                        href="/login">Connectez-vous</a></div>
        </div>
        <button type="submit" class="btn btn-secondary">S'Inscrire</button>
    </form>
</div>