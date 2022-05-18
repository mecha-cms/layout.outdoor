<?php

if ('POST' === $_SERVER['REQUEST_METHOD'] && empty($_POST['state']['y']['outdoor']['page']['header'])) {
    // Set default value to `false`
    $_POST['state']['y']['outdoor']['page']['header'] = false;
}

Hook::set('_', function($_) use($state, $url) {
    if ('.state' === $_['path']) {
        $banners = [0 => 'None'];
        foreach (g(LOT . D . 'y' . D . 'outdoor' . D . 'banner', 'jpg') as $k => $v) {
            $banners[$n = basename($k, '.jpg')] = To::title($n);
        }
        $time = new Time;
        $formats = [];
        foreach ([
            '%A, %B %d, %Y',
            '%A, %d %B %Y',
            '%F %T',
            '%Y/%m/%d %I:%M %p',
            '%Y/%m/%d %T',
            '%c',
            '%x',
        ] as $format) {
            $formats[$format] = $time($format);
        }
        $lot = [];
        foreach (Pages::from(LOT . D . 'page', 'archive,page')->sort([1, 'title']) as $v) {
            $lot[strtr($v->url, [
                $url . '/' => '/'
            ])] = $v->title;
        }
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields'] = [
            'lot' => [],
            'type' => 'fields'
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['banner'] = [
            'lot' => $banners,
            'name' => 'state[y][outdoor][banner]',
            'stack' => 100,
            'title' => 'Banner',
            'type' => 'item',
            'value' => $state->y->outdoor->banner ?? 0
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['time-format'] = [
            'block' => true,
            'lot' => $formats,
            'name' => 'state[y][outdoor][page][timeFormat]',
            'stack' => 110,
            'title' => 'Date/Time',
            'type' => 'item',
            'value' => $state->y->outdoor->page->timeFormat ?? '%F %T'
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['route-blog'] = [
            'description' => 'Choose default page for the blog route.',
            'lot' => $lot,
            'name' => 'state[route-blog]',
            'stack' => 120,
            'title' => 'Route',
            'type' => 'option',
            'value' => $state->routeBlog
        ];
        $_['lot']['desk']['lot']['form']['lot'][1]['lot']['tabs']['lot']['blog']['lot']['fields']['lot']['states'] = [
            'lot' => [
                'header' => 'Show page header on pages layout.'
            ],
            'name' => 'state[y][outdoor][page]',
            'stack' => 130,
            'title' => 'States',
            'type' => 'items',
            'values' => [
                'header' => !empty($state->y->outdoor->page->header) ? true : null
            ]
        ];
    }
    return $_;
}, 0);