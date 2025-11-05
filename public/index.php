<?php
/**
 * Banana Powered MVC Framework
 * The most appealing framework you'll ever use! 🍌
 */

// Autoloader for controllers and models
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Simple router
$request = $_SERVER['REQUEST_URI'];
$routes = [
    '/' => function() {
        echo "<html><head><title>Banana MVC</title><style>
                body { 
                    font-family: 'Comic Sans MS', cursive; 
                    background: linear-gradient(45deg, #ffeb3b, #ffc107); 
                    text-align: center; 
                    padding: 50px;
                }
                h1 { 
                    font-size: 4em; 
                    color: #8b4513; 
                    text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
                }
                .banana { font-size: 8em; }
              </style></head><body>";
        echo "<div class='banana'>🍌</div>";
        echo "<h1>Banana Powered MVC is GO!</h1>";
        echo "<p>This framework is absolutely <em>a-peel-ing</em>!</p>";
        echo "<p><strong>Status:</strong> Ripe and Ready! 🎉</p>";
        echo "</body></html>";
    }
];

// Route the request
if (isset($routes[$request])) {
    $routes[$request]();
} else {
    // Check for controller routing
    $parts = explode('/', trim($request, '/'));
    if (!empty($parts[0])) {
        $controllerName = ucfirst($parts[0]) . 'Controller';
        $action = $parts[1] ?? 'index';
        
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                $controller->$action();
            } else {
                echo "404 - Method not found. This banana has split!";
            }
        } else {
            echo "404 - Controller not found. No bananas here!";
        }
    } else {
        $routes['/']();
    }
}
?>
