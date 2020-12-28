<?php

namespace App\Http\Controllers;

use App\Models\Magic;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        return view("pages.home");
    }
    public function getMagics()
    {
        $magics = Magic::query()->get()->groupBy(Magic::COL_CIRCLE);
            return view("pages.magics", ['magics' => $magics]);
    }
}
