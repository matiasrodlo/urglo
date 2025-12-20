<?php
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

$requestPath = ltrim($requestPath, '/');

$staticExtensions = array('css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot');
if ($requestPath) {
    $extension = pathinfo($requestPath, PATHINFO_EXTENSION);
    if (in_array(strtolower($extension), $staticExtensions)) {
        $filePath = __DIR__ . '/' . $requestPath;
        if (file_exists($filePath)) {
            return false;
        }
    }
    $directPath = __DIR__ . '/' . $requestPath;
    if (file_exists($directPath) && is_file($directPath)) {
        return false;
    }
}

if ($requestPath === 'app' || $requestPath === 'app/') {
    $_SERVER['SCRIPT_NAME'] = '/app/index.php';
    $_GET['url'] = '';
    require __DIR__ . '/app/index.php';
    return true;
}
if (preg_match('#^app/(.+)$#', $requestPath, $matches)) {
    $urlParam = $matches[1];
    $urlParam = preg_replace('/\?.*$/', '', $urlParam);
    $_GET['url'] = $urlParam;
    $_SERVER['SCRIPT_NAME'] = '/app/index.php';
    require __DIR__ . '/app/index.php';
    return true;
}

$routes = array(
    'coaching' => 'coaching.php',
    'contacto' => 'contacto.php',
    'empleo' => 'empleo.php',
    'soporte' => 'soporte.php',
    'terminosycondiciones' => 'terminosycondiciones.php',
    'proximamente' => 'proximamente.php',
);

if (isset($routes[$requestPath])) {
    $_SERVER['SCRIPT_NAME'] = '/' . $routes[$requestPath];
    require __DIR__ . '/' . $routes[$requestPath];
    return true;
}

if ($requestPath && !is_dir(__DIR__ . '/' . $requestPath)) {
    $phpFile = __DIR__ . '/' . $requestPath . '.php';
    if (file_exists($phpFile)) {
        $_SERVER['SCRIPT_NAME'] = '/' . $requestPath . '.php';
        require $phpFile;
        return true;
    }
}

if ($requestPath === '' || $requestPath === 'index.php') {
    require __DIR__ . '/index.php';
    return true;
}

return false;

