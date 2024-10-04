<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function listAll()
    {
        $products = Product::all();
        return response()->json(
            [
                'status' => '201',
                'data' => $products
            ]
            );
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);
        return response()->json(
            [
                'status' => 'Thêm mới thành công',
                'data' => $product
            ]
            );
    }
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json(
            [
                'status' => '200',
                'data' => $product
            ]
            );
    }
    public function destroy(string $id)
{
    try {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status' => 'Xóa thành công',
            'data' => $product
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'Có lỗi xảy ra khi xóa sản phẩm',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function update(Request $request, string $id)
{
    try {
        $data = $request->all();
        $product = Product::find($id);
        $product->update($data);
        return response()->json([
            'status' => 'Cập nhật thành công',
            'data' => $product
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'Có lỗi xảy ra khi cập nhật sản phẩm',
            'error' => $e->getMessage()
        ], 500);
    }
}
}