<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //search by category
    function search_product_byCategory($name)
    {
        $categoryId = DB::table('categories')->select('id')->where('category_name', $name)->get();


        $products = Category::where('id', (string)$categoryId[0]->{'id'})->with('search_product')->get();

        return response()->json($products, 200);
    }
}
