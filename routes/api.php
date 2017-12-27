<?php

use Illuminate\Http\Request;

use App\Models\Block;

$router->get('/ip2geo', function (Request $request) {
    $this->validate($request, [
        'ip' => 'required|ipv4'
    ]);

    return Block::get($request->get('ip'));
});
