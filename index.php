<?php


require_once('models/DBHelper.php');


$requestUri = explode('/', stristr($_SERVER['REQUEST_URI'] . '?', '?', true));
array_shift($requestUri);
$router = array();
$router['GET'] = [
    '/\/auth/' => ['getAuthPage'],
    '/\//' => ['getMainPage']
];
$router['POST'] = [
    '/\/post\/test/' => ['test']

];
$router['PUT'] = [];
$router['DELETE'] = [];

getRouter("/" . implode('/', $requestUri));
function getRouter($url)
{
    global $router;
    $keys = array_keys($router[$_SERVER['REQUEST_METHOD']]);

    for ($i = 0; $i < count($keys); ++$i) {

        if (preg_match($keys[$i], $url)) {
            $funcs = $router[$_SERVER['REQUEST_METHOD']][$keys[$i]];

            for ($j = 0; $j < count($funcs); ++$j)
                $funcs[$j]();

            break;
        }
    }
}