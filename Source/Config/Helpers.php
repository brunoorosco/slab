<?php

/**
 * @param string|null $param
 * @return string
 */
function site(string $param = null): string
{
    if ($param && !empty(SITE[$param])) {
        //  return SITE[$param];
        return SITE['root'] . "/{$param}";
    }

    return SITE['root'];
}
function routeImage(string $imageUrl): string
{
    return "https://via.placeholder.com/468x60/0000FF/808080?Text={$imageUrl}";
}

function asset(string $param, $time = true): string
{
    $file = SITE['root'] . "/Source/Views/assets/{$param}"; 
    $fileOnDir = dirname(__DIR__, 1)."/Source/Views/assets/{$param}";

    if($time && file_exists($fileOnDir)){
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}

function flash(string $type = null, string $message = null ) 
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];
        return null;
    }

    if(!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]){
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash['type']}\">{$flash['message']}</div>";
    }
}