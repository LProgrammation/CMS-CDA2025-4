<form action="/page/edit-page" method="post">
    <input type="hidden" name="id_page" value="<?=$_GET['id_page']?>">
    <input type="hidden" name="id_site" value="<?=$_GET['id_site']?>">
    <div class="d-flex flex-column">
        <div class="text-center pb-4">
            <h3>Souhaitez vous vraiment supprimer la page <?=$page['title_page']?> ?</h3>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary me-4" onclick="event.preventDefault(); history.back();">Retour</button>
            <button class="btn btn-danger" name="name_form" value="delete_page">Confirmer</button>
        </div>
    </div>
</form>