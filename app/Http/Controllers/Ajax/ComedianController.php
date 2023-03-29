<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;

class ComedianController extends Controller
{
    public function index()
    {

        return Shop::all();  // ←自動でjsonにしてくれます

    }
}
