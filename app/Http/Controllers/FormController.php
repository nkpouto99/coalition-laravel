<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;

class FormController extends Controller
{
    public function products()
    {
        $file = storage_path('/app/data.json');
        $products = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        return response()->json($products);
    }

    public function submit(Request $request)
    {
        $file = storage_path('/app/data.json');
        $products = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        if (empty($products)) {
            $id = 1;
        } else {
            $available_id = array_column($products, 'id');
            $id = max($available_id) + 1;
        };

        $newProduct = [
            'id' => $id,
            'product' => $request->product,
            'quantity' => (int)$request->quantity,
            'price' => (float)$request->price,
            'date' => Carbon::now()->toDateTimeString(),
            'total' => (float)$request->quantity * (float)$request->price,
        ];
        
        $products[] = $newProduct;
        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
        return response()->json(['success' => true]);
    }

    public function edit(Request $request)
    {
        $id = $request->query('id');
        $file = storage_path('/app/data.json');
        $products = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        $product_id = collect($products)->firstWhere('id', $id);

        if ($product_id) {
            return view('edit', compact('product_id'));
        } else {
            return redirect('/');
        }
    }

    public function submit_edit(Request $request)
    {
        $id = $request->query('id');
        $file = storage_path('/app/data.json');

        $products = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

        $search = array_search($id, array_column($products, 'id'));

        if ($search === false) {
            return redirect('/');
        }

        $products[$search]['product'] = $request->product;
        $products[$search]['quantity'] = (int)$request->quantity;
        $products[$search]['price'] = (float)$request->price;
        $products[$search]['total'] = (float)$request->quantity * (float)$request->price;

        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
        return redirect('/');
    }
}
