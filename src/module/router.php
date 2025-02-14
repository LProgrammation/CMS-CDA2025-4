<?php
/**
 * Router class
 */
class router {

    private $routeMap = array();
    /**
     * Generate route map
     * @param string $method
     * @param string $url
     * @param string $name
     * @return void
     */
    public function routeMap(string $method, string $uri, string $name, $target = null){
        $this->routeMap[$uri]['name'] = $name;
        $this->routeMap[$uri]['method'] = $method;
        $this->routeMap[$uri]['url'] = $uri;
        $this->routeMap[$uri]['target'] = $target;

    }

    /**
     * Check uri match in route map
     * @param mixed $uri
     * @return void
     */
    public function match($uri){
        try{
            // If route exist
            if(isset($this->routeMap[$uri])){
                return $this->pageGeneration($this->routeMap, $uri) ;
            }
            else{
                // redirect to error page
                header("Location:/error?code=404");
                exit();
            }
        }
        catch(Exception $e){
            echo $e ;
        }
    }


    /**
     * generate view container with route map content and uri
     * @param array $routeMap
     * @return void
     */
    public function pageGeneration(array $routeMap, string $uri){

        require "../src/controller/".$routeMap[$uri]['name']."Controller.php" ;
        $controller = $routeMap[$uri]["name"]."Controller";
        $controller = new $controller() ;
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $routeMap[$uri]['name']?></title>
            <link rel="stylesheet" href="../styles/css/bootstrap.css?v=<?=time()?>" />
            <link rel="stylesheet" href="../styles/css/dataTables.bootstrap5.css?v=<?=time()?>" />
            <link rel="stylesheet" href="../styles/css/style.css?v=<?=time()?>" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
            <script src="https://cdn.tiny.cloud/1/fg2643l2js9jwylwdyevizaq0k8wkoo024eihp0fp5r8j14b/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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
        <?php $controller->index($routeMap, $uri); ?>
        </html>
        <?php


    }
};