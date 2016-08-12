<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
	/**
	 * 产品首页
	 */
	public function index()
    {
    	return view('product.product');
    }

    /**
	 * 添加产品
	 */
    public function create()
    {
    	return view('product.product_create', ['act'=>'新建']);
    }
}