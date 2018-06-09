<?php

// Store new URL and redirect back to form, with message including new hash.
app()->router->post('tiny/store', [
    'as' => 'tiny.store',
    'uses' => '\Viewflex\Tiny\Controllers\TinyController@store',
    'middleware' => 'web'
]);

// Show the form for adding a URL, displaying message from last URL processed (if any).
app()->router->get('tiny/create', [
    'as' => 'tiny.create',
    'uses' => '\Viewflex\Tiny\Controllers\TinyController@create',
    'middleware' => 'web'
]);

// Redirect to the actual url represented by a hash.
app()->router->get('tiny/{hash}', [
    'as' => 'tiny.view',
    'uses' => '\Viewflex\Tiny\Controllers\TinyController@view',
    'middleware' => 'web'
]);

