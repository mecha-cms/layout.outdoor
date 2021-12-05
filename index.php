<?php

$z = defined('TEST') && TEST ? '.' : '.min.';
Asset::set(__DIR__ . D . 'asset' . D . 'css' . D . 'index' . $z . 'css', 20);

$GLOBALS['links'] = new Anemone((static function($links, $state, $url) {
    $index = LOT . D . 'page' . D . trim(strtr($state->route, '/', D), D) . '.page';
    $path = $url->path . '/';
    foreach (g(LOT . D . 'page', 'page') as $k => $v) {
        // Exclude home page
        if ($k === $index) {
            continue;
        }
        $v = new Page($k);
        // Add current state
        $v->current = 0 === strpos($path, '/' . $v->name . '/');
        $links[$k] = $v;
    }
    ksort($links);
    return $links;
})([], $state, $url));

$defaults = ['route-blog' => '/article'];

foreach ($defaults as $k => $v) {
    !State::get($k) && State::set($k, $v);
}

// Info message(s)
if ($site->is('tags')) {
    Alert::info('Showing %s tagged in %s.', ['posts', '<em>' . $tag->title . '</em>']);
}

// Hook::set('route', function() {
//     extract($GLOBALS);
//     if (false !== strpos($url->path, '/::')) {
//         return; // Maybe in Panel?
//     }
//     if ($site->is('error')) {
//         return;
//     }
//     if ($site->is('archives')) {
//         $chops = explode('/', $url->path);
//         $v = explode('-', array_pop($chops));
//         $v = $archive->i((1 === count($v) ? "" : '%B ') . '%Y');
//         Alert::info('Showing %s published in %s.', ['posts', '<em>' . $v . '</em>']);
//     }
//     if ($site->is('search') && $v = Get::get($state->x->search->key ?? 'q')) {
//         Alert::info('Showing %s matched with query %s.', ['posts', '<em>' . $v . '</em>']);
//     }
//     if ($site->is('tags')) {
//     }
// });