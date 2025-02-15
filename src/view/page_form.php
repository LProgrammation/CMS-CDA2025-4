<form action="/page" method="post" class="d-flex flex-row justify-content-between">
    <div>
        <input type="hidden" name="create_page" id="id_site" value="1">
        <input type="hidden" name="id_site" id="id_site" value="<?=$_GET['id_site']??'1'?>">
        <div>
            <label class="label" for="type_page">Type de votre page:</label>
            <?php
            if($is_there_header==False || $is_there_footer==False){
                ?>
                <select class="form" type="text" name="type_page" id="type_page">
                    <?=($is_there_header)?'':'<option value="header">Header</option>'?>
                    <?=($is_there_footer)?'':'<option value="footer">Footer</option>'?>
                    <option value="main">Contenu</option>
                </select>
                <?php
            }else{
                ?>
                <select disabled class="form" type="text" name="type_page" id="type_page">
                    <option selected value="main">Contenu</option>
                </select>
                <?php
            }
            ?>
        </div>
        <div>
            <label for="title_page">Titre de votre page:</label>
            <input type="text" name="title_page" id="title_page">
        </div>

        <div>
            <label for="title_page">Par par défaut ?</label>
            <input type="checkbox" name="is_default_page" id="is_default_page">
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary" name="name_form" value="create_page">Envoyer</button>
    </div>

</form>