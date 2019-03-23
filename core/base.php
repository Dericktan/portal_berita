<?php
    $link = $_SERVER['HTTP_HOST'] .  
    $_SERVER['REQUEST_URI']; 
    $countSlash = substr_count($link, "/");
    $baseUrl = "./";
    if ($countSlash > 2)
    {
        for ($i = 2; $i < $countSlash; $i++)
        {
            $baseUrl .= "../";
        }
    }
?>