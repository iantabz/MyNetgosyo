<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('main_page.sample');
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'image|mimes:jpg,jpeg,png,gif,bmp',
            'title' => 'required'
        ]);
        dd('ready to upload');
    }
}
