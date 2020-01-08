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

function assest(string $param):string
{
    return SITE['root']."/Source/Views/assests/{$param}";
}

function flash(string $type = null, string $message = null ): ?string 
{

}