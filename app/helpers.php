<?php

use App\Logging\Status;

function activeClass($urls, $segment = 1)
{
    if (is_string($urls)) {
        $urls = [$urls];
    }
    foreach ($urls as $url) {
        if (request()->segment($segment) == $url) {
            return "active";
        }
    }
    return "";
}

function activeClass2(string $url_part, bool $only_part = false)
{
    $current_url = request()->fullUrl();;
    if ($url_part == '/' and url('/') == $current_url) {
        return 'active';
    }
    $host_url = url('/');
    $pos = strpos($current_url, $url_part, strlen($host_url));

    if ($only_part) {
        if (($pos + strlen($url_part)) == strlen($current_url)) {
            return 'active';
        }
        return '';
    }

    if ($pos > 0) return 'active';
    else return '';
}

