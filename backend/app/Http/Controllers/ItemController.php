<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::all(); 
        return response()->json($item);
    }

    public function show(Request $request)
    {
        //$order = Order::with('item')->where('id', $request->only('order_id'))->first();

        $items = Item::with('product')->with('order')->where('order_id', $request->only('order_id'))->get();

        return response()->json($items);
    }

    public function store(ItemStoreRequest $request)
    {
        $item = Item::create($request->all());

        return response()->json($item);
    }

    public function destroy(Request $request)
    {
        $item = Item::where('id', $request->only('item_id'))->delete();
        
        return response()->json($item);
    }
}
