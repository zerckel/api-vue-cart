<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Products[]|Collection
     */
    public function index()
    {
        return Products::all();
    }
}
