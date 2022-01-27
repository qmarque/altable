<?php

if (!empty($_GET['url'])) {

    $controller = "";
    $url = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
    switch ($url[0]) {
        case "plats": $controller = "plats";
            break;
        case "commandes": $controller = "commandes";
            break;
        case "cartes": $controller = "cartes";
            break;
        case "plans": $controller = "plans";
            break;
        case "services": $controller = "services";
            break;
        case "tables": $controller = "tables";
            break;
    }

    $controllerFile = 'api--rest/' . $controller . '/lire.php';
    if (file_exists($controllerFile)){
        require_once('api--rest/' . $controller . '/lire.php');
    }else{
        // On gère l'erreur
        http_response_code(404);
        echo json_encode(["Message" => "La page que vous recherchiez n'exite pas"]);
    }
    die;
} else {
    // On gère l'erreur
    http_response_code(505);
    echo json_encode(["else url" => $url]);
}
