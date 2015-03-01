<?php
/*
Plugin Name: MobiDevices Search URL
Plugin URI: http://mobidevices.ru
Description: SEO-плагин для автоматического преобразования URL страниц поиска с формата <a href="http://mobidevices.ru/?s=iPhone">http://mobidevices.ru/?s=iPhone</a> на <a href="http://mobidevices.ru/search/iPhone">http://mobidevices.ru/search/iPhone</a>, разработанный порталом <a href="http://mobidevices.ru">MobiDevices</a>.
Version: 1.2
Author: MobiDevices Soft
Author URI: http://mobidevices.ru
Author Email: md@mobidevices.ru
*/

function md_redirect(){
    global $post;
    $urls=get_site_url().$_SERVER['REQUEST_URI'];
    if(is_search() && ! empty($_GET['s'])){
        if(get_query_var('paged')){header('Location: '.get_site_url().'/search/'.urlencode(get_query_var('s')).("/page/").get_query_var('paged'),true,301);exit();}
        else{header('Location: '.get_site_url().'/search/'.urlencode(get_query_var('s')),true,301);exit();}
    }
    if(is_search() || is_archive() ){
        if (preg_match('/\/page\/1$/', $urls)) {
            $url = get_site_url().str_replace('/page/1','',$_SERVER['REQUEST_URI']);
            header('Location: '.$url.'',true,301);exit;
        }
    }
}
add_action('template_redirect','md_redirect');