<?php

$content = "";

if (isset($state->x->search)) {
    $to = $url . ($path ?? $state->routeBlog);
    $value = \get($_GET, $key = $state->x->search->key ?? 'q');
    $content .= '<form action="' . $to . '" class="form-search" method="get" role="search">';
    $content .= '<p>';
    $content .= '<input name="' . $key . '" type="text"' . ($value ? ' value="' . From::HTML($value) . '"' : "") . '>';
    $content .= ' ';
    $content .= '<button type="submit">' . i('Search') . '</button>';
    $content .= '</p>';
    $content .= '</form>';
} else {
    $content .= '<p>' . i('Missing %s extension.', ['<a href="https://mecha-cms.com/store/extension/search" target="_blank">search</a>']) . '</p>';
}

echo self::widget([
    'title' => $title ?? i('Search'),
    'content' => $content
]);