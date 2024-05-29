<?php

namespace App\Utils;

class RenderView
{
    public function loadView($view, $args = []) {
        extract($args);
        
        $viewPath = realpath(__DIR__ . "/../../resources/views/$view.php");

        if (!$viewPath || !file_exists($viewPath)) {
            throw new \Exception("View file not found: $viewPath");
        }

        require_once $viewPath;
    }
}
