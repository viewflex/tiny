<?php

return [

    'caching'       => [
        'active'            =>  true,
        'minutes'           =>  1440
    ],
    
    'query'         => '\Viewflex\Tiny\Queries\TinyQuery',

    'tables'        => [
        'urls'              => 'tiny_urls'
    ]
    
];
