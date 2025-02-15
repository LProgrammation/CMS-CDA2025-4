<div id="user_management-container">
    <div>
        <h1>Gestion des utilisateurs</h1>
    </div>
    <div class="text-<?= $message[0] ?>"><?= $message[1] ?></div>
    <div>
        <table id="user_management-datatable" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Rôle</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
            $compteur = 0;
            foreach ($users as $user) {

            ?>
            <tr>
                <th><?= $user["id_user"] ?></th>
                <td><?= $user["name_user"] ?></td>
                <td><?= $user["firstname_user"] ?></td>
                <td><?= $user["email_user"] ?></td>
                <td><?= $user["role_user"] ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modification_modal_<?= $compteur ?>">Modifier</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#suppression_modal_<?= $compteur ?>">Supprimer</button>
                    <div class="modal fade" id="modification_modal_<?= $compteur ?>" tabindex="-1" aria-labelledby="Modale de modification" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="" method="post">
                                <input type="hidden" value="<?= $user["id_user"] ?>" name="id_user">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="Modal_modif_label">Modification</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="email_user" class="col-form-label">Email :</label>
                                            <input type="text" class="form-control" id="email_user" name="email_user" value="<?= $user["email_user"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_user" class="col-form-label">Nom :</label>
                                            <input type="text" class="form-control" id="name_user" name="name_user" value="<?= $user["name_user"] ?>" required>
                                        </div>
                                        <div class=" mb-3">
                                            <label for="firstname_user" class="col-form-label">Prénom :</label>
                                            <input type="text" class="form-control" id="firstname_user" name="firstname_user" value="<?= $user["firstname_user"] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_user" class="col-form-label">Rôle :</label>
                                            <select class="form-select" name="role_user" id="role_user" required>
                                                <option value="admin" <?php echo $user["role_user"] == "admin" ? "selected" : '' ?>>Administrateur</option>
                                                <option value="user" <?php echo $user["role_user"] == "user" ? "selected" : '' ?>>Utilisateur</option>
                                            </select>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" name="submit_modif">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="suppression_modal_<?= $compteur ?>" tabindex="-1" aria-labelledby="Modale de suppression" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content" action="" method="post">
                                <input type="hidden" value="<?= $user["id_user"] ?>" name="id_user">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="Modal_modif_label">Modification</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 text-danger">
                                        <label class="col-form-label">Attention, voulez-vous vraiment supprimer l'utilisateur suivant :</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_user" class="col-form-label">Email :</label>
                                        <input type="text" class="form-control" id="email_user" value="<?= $user["email_user"] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name_user" class="col-form-label">Nom :</label>
                                        <input type="text" class="form-control" id="name_user" value="<?= $user["name_user"] ?>" disabled>
                                    </div>
                                    <div class=" mb-3">
                                        <label for="firstname_user" class="col-form-label">Prénom :</label>
                                        <input type="text" class="form-control" id="firstname_user" value="<?= $user["firstname_user"] ?>" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role_user" class="col-form-label">Rôle :</label>
                                        <select class="form-select" id="role_user" disabled>
                                            <option value="admin" <?php echo $user["role_user"] == "admin" ? "selected" : '' ?>>Administrateur</option>
                                            <option value="user" <?php echo $user["role_user"] == "user" ? "selected" : '' ?>>Utilisateur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger" name="submit_suppr">Supprimer</button>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
    </td>

    </tr>
    <?php $compteur++;
    } ?>
    </tbody>
    </table>
</div>
</div>