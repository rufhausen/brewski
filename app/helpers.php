<?php

use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Request;

/**
 * @param $list
 */
function commaListToArray($list)
{
    $list = trim(rtrim($list, ','));
    $list = explode(',', $list);
    if (!empty($list)) {
        return array_map('trim', $list);
    }
}

/**
 * @param $item
 */
function settings($item)
{
    if (Cache::has('settings')) {
        return Cache::get('settings')[$item];
    }
}

/**
 * @param $arr
 */
function arrayToCommaList($arr)
{
    if (!empty($arr)) {
        return implode(',', $arr);
    }
}

/**
 * @param $route
 * @param null     $segment
 */
function active_route($route = null, $segment = 1)
{
    if (Request::segment($segment) == $route) {
        return 'active';
    }
}

/**
 * @param $post
 */
function showMoreLink($post)
{
    if (
        strpos($post->content, '<!--more-->') ||
        strpos($post->content, '<div style="page-break-after: always"><span style="display: none;">&nbsp;</span></div>')
    ) {
        return html_entity_decode(
            link_to_route(
                'post',
                '<button class="btn btn-primary btn-xs">Continue Reading <i class="fa fa-arrow-circle-right"></i></button>',
                [$post->year, $post->month, $post->slug]
            ));
    }
}

/**
 * @param $message
 */
function formatMailMessage($message)
{
    return nl2br($message);
}
