<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrederStoreRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::whereStatus(0)->whereDraft(0)->get(); 
        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrederStoreRequest $request)
    {
        $order = Order::create($request->all());

        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $order = Order::with('item')->where('id', $request->only('order_id'))->first();

        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = Order::where('id', $request->only('order_id'))->first();
        $order->draft = false;
        $order->save();
        return response()->json($order);
    }

    public function finish(Request $request)
    {
        $order = Order::where('id', $request->only('order_id'))->first();
        $order->status = true;
        $order->save();
        return response()->json($order);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order = Order::where('id', $request->only('order_id'))->delete();
        
        return response()->json($order);
    }
}
