<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json($category);
    }
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
   
       
       
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return response()->json($category);
    }
    public function destroy($id)
{
    $category = Category::findOrFail($id);
    $count_product = $category->products()->count();

    if ($count_product > 0) {
        return response()->json([
            'message' => 'không thể xoá danh mục.',
            'product_count' => $count_product
        ], 422);
    }

    $category->delete();
    return response()->json(['message' => 'xoá thành công'], 200);
}

    
}
