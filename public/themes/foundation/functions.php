<?php

function createMenu($menu)
{
    $menu = json_decode($menu, true);

    echo '<ul class="left">';
    foreach ($menu as $key => $subs)
    {
    if (is_array($subs))
    {
    echo '<li class="has-dropdown">';
    echo '<a href="#">'.$key.'</a>';
    echo '<ul class="dropdown">';
    foreach ($subs as $subkey => $subvalue)
    {
    echo '<li><a href="'.$subvalue.'">'. $subkey . '</a></li>';
    }
    echo '</ul>';
    echo '</li>';
    } else {
    echo '<li><a href="'.$subs.'">'.$key.'</a></li>';
    }
    }
    echo '</ul>';
}