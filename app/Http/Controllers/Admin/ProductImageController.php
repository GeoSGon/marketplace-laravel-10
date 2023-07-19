<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function removeImage(Request $request)
    {
        $id = $request->get('id');
        if(Storage::disk('public')->exists($id)) {
            Storage::disk('public')->delete($id);
        }

        $removeImage = ProductImage::where('id', $id);
        $productId = $removeImage->first()->product_id;
        $removeImage->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
