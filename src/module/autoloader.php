<?php
namespace Src\Module;

class Autoloader {
    private $baseDir;
    public function __construct($baseDir) {
        $this->baseDir = $baseDir;
        spl_autoload_register([$this, 'autoload']);
    }

    private function autoload($class): void {
        $cheminFichier = $this->baseDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if (file_exists($cheminFichier)) {
            require_once $cheminFichier;
        }
    }
}
new \Src\Module\Autoloader(__DIR__ . '/../../');
