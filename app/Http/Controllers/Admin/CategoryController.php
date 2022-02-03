<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function show($id) {
        $category = Category::find($id);
        if(! $category) {
            abort(404);
        }
        return view('admin.categories.show', compact('category'));
    }
}
