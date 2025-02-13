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
    public function match($uri, $BDD){
        try{
            // If route exist
            if(isset($this->routeMap[$uri])){
                return $this->pageGeneration($this->routeMap, $uri, $BDD) ;  
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
    public function pageGeneration(array $routeMap, string $uri, $BDD){
        
        require "../src/controller/".$routeMap[$uri]['name']."Controller.php" ;  
        $controller = $routeMap[$uri]["name"]."Controller";
        $controller = new $controller() ; 
        $controller->setBDD($BDD)
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $routeMap[$uri]['name']?></title>
            <link rel="stylesheet" href="../styles/css/styles.css">
        </head>
        <?php $controller->index($routeMap, $uri); ?>
        </html>
        <?php
       
        
    }
};