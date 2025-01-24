<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function training(){
        $products = Product::where('type', 'training')->where('event_time','>',\Carbon\Carbon::now())
        ->orderBy('event_time','desc')->get();
        return view('product.index', [
            'products' => $products,
            "title" => settings('training_title'),
            "description" => settings('training_description'),
            "meta_title" => settings('training_title') . " - " . env('APP_NAME'),
            "meta_description" => settings('training_description') . " - " . env('APP_NAME'),
            "futured_image" => get_image_url(settings("training_image")),
        ]);
    }

    public function seminar(){
        $products = Product::where('type', 'seminar')->where('event_time','>',\Carbon\Carbon::now())
        ->orderBy('event_time','desc')->get();
        return view('product.index', [
            'products' => $products,
            "title" => settings('seminar_title'),
            "description" => settings('seminar_description'),
            "meta_title" => settings('seminar_title') . " - " . env('APP_NAME'),
            "meta_description" => settings('seminar_description') . " - " . env('APP_NAME'),
            "futured_image" => get_image_url(settings("seminar_image")),
        ]);
    }

    public function congress(){
        $products = Product::where('type', 'congress')->where('event_time','>',\Carbon\Carbon::now())
        ->orderBy('event_time','desc')->get();
        return view('product.index', [
            'products' => $products,
            "title" => settings('congress_title'),
            "description" => settings('congress_description'),
            "meta_title" => settings('congress_title') . " - " . env('APP_NAME'),
            "meta_description" => settings('congress_description') . " - " . env('APP_NAME'),
            "futured_image" => get_image_url(settings("congress_image")),
        ]);
    }

    public function showTraining($slug)
    {
        $product = Product::where('type', 'training')->where('slug', $slug)->firstOrFail();
        return view('product.show', [
            'product' => $product,
            "meta_title" => $product->meta_title,
            "meta_description" => $product->meta_description,
            "futured_image" => get_image_url($product->image_id),
        ]);
    }

    public function showSeminar($slug)
    {
        $product = Product::where('type', 'seminar')->where('slug', $slug)->firstOrFail();
        return view('product.show', [
            'product' => $product,
            "meta_title" => $product->meta_title,
            "meta_description" => $product->meta_description,
            "futured_image" => get_image_url($product->image_id),
        ]);
    }

    public function showCongress($slug)
    {
        $product = Product::where('type', 'congress')->where('slug', $slug)->firstOrFail();
        return view('product.show', [
            'product' => $product,
            "meta_title" => $product->meta_title,
            "meta_description" => $product->meta_description,
            "futured_image" => get_image_url($product->image_id),
        ]);
    }

}
