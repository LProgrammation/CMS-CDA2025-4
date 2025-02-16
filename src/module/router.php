<?php
/**
 * Router class
 */
class router {

    private array $routeMap ;
    /**
     * Generate route map
     * @param string $method
     * @param string $uri
     * @param string $name
     * @param null $target
     * @return void
     */
    public function routeMap(string $method, string $uri, string $name, $target = null): void
    {
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
    public function match(mixed $uri): void
    {
        try{
            // If route exist
            if(isset($this->routeMap[$uri])) $this->pageGeneration($this->routeMap, $uri) ;
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
     * @param string $uri
     * @return void
     */
    public function pageGeneration(array $routeMap, string $uri){

        require "../src/controller/".$routeMap[$uri]['name']."Controller.php" ;
        $controller = $routeMap[$uri]["name"]."Controller";
        $controller = new $controller() ;
        require_once "../src/view/header.php";
        ?>
        <?php $controller->index($routeMap, $uri); ?>
        <?php
        require_once "../src/view/footer.php";
    }
};