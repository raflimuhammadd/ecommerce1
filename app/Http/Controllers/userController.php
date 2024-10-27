<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index(){
        // $produk = Produk::all();
        return view('pages.home');
    }
    public function shop(){
        $produk = Produk::all();
        return view('pages.shop', compact('produk'));
    }
    public function dataTable(){
        return view('pages.dataTables');
    }
}
