<div id="user_management-container">
    <div>
        <h1>Gestion des utilisateurs</h1>
    </div>
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
            <?php foreach ($users as $user) {
            ?>
            <tr>
                <th><?= $user["id_user"] ?></th>
                <td><?= $user["name_user"] ?></td>
                <td><?= $user["firstname_user"] ?></td>
                <td><?= $user["email_user"] ?></td>
                <td><?= $user["role_user"] ?></td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modification_modal">Modifier
                    </button>
                    <div class="modal fade" id="modification_modal" tabindex="-1"
                         aria-labelledby="Modale de modification" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <form class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="Modal_modif_label">Modification</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label for="email_user" class="col-form-label">Email :</label>
                                            <input type="text" class="form-control" id="email_user" name="email_user">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name_user" class="col-form-label">Nom :</label>
                                            <input type="text" class="form-control" id="name_user" name="name_user">
                                        </div>
                                        <div class="mb-3">
                                            <label for="firstname_user" class="col-form-label">Prénom :</label>
                                            <input type="text" class="form-control" id="firstname_user"
                                                   name="firstname_user">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role_user" class="col-form-label">Rôle :</label>
                                            <input type="text" class="form-control" id="role_user" name="role_user">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
                                    </button>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
    </td>

    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
</div>