<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function index()
    {

        
        $products = Food::latest()->simplePaginate(15);
     
         return view('home',["products"=>$products]);
    }


    public function show($id)
    {

        $products = Food::where('id', $id)->get();
        return view('detail',['products'=>$products]);
    }
}
