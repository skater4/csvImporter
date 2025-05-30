<?php
use App\Core\Router;

return function(Router $r) {
    $r->get('/products',      'App\Controllers\ProductController@index');
    $r->post('/products/importCsv','App\Controllers\ProductController@importCsv');
};
