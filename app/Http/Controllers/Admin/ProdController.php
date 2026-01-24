<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdController extends Controller
{
    public function index(Request $request, string $catid = null, string $subcatid = null)
    {
        return view('admin.prods.index', [
            'request'   => $request,
            'catid'     => $catid,
            'subcatid'  => $subcatid,
        ]);
    }
}
