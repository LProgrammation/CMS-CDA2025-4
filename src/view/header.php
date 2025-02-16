
<?php
/** @var array $routeMap */
/** @var string $uri */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $routeMap[$uri]['name']?></title>
        <link rel="stylesheet" href="../styles/css/bootstrap.css?v=<?=time()?>" />
        <link rel="stylesheet" href="../styles/css/dataTables.bootstrap5.css?v=<?=time()?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <script src="https://cdn.tiny.cloud/1/fg2643l2js9jwylwdyevizaq0k8wkoo024eihp0fp5r8j14b/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="../styles/css/styles.css?v=<?=time()?>" />

        <!-- Script pour TinyCMS -->
        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: [
                    // Core editing features
                    'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                    // Your account includes a free trial of TinyMCE premium features
                    // Try the most popular premium features until Feb 27, 2025:
                    'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
                ],
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                ],
                ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            });
        </script>
    </head>
    <body>
        <header>
        <div class="border-bottom w-100 p-3">
            <nav class="d-flex justify-content-around container">
                <ul>
                    <a href="/home" class="p-2">Accueil</a>
                    <a href="/logs" class="p-2">logs</a>
                    <a href="/site" class="p-2">site</a>
                    <a href="/page" class="p-2">page</a>
                    <?php
                    if (isset($_SESSION['user'])) {
                        ?>
                        <a href="/logout" class="p-2">Deconnexion</a>
                        <?php
                    }else{
                        ?>
                        <a href="/login" class="p-2">Se Connecter</a>
                        <a href="/register" class="p-2">S'Inscrire</a>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
        </header>
        <main class="container pt-5">