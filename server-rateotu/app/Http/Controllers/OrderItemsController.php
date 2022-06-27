<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\ResponseHelper;

class OrderItemsController extends Controller
{
    use ResponseHelper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItems $orderItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_item_id)
    {
        $validator = Validator::make($request->all(), [
            'order_item_id' => 'required|string|max:255',
            'item_id' => 'required|string|max:255',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        try {
            $order_item = OrderItems::where([['id', $request->order_item_id], ['item_id', $request->item_id]])->first();
            $order_item->status=$request->status;
            $order_item->save();
            return $this->successResponse($order_item);
        } catch (\Throwable $e) {

            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItems  $orderItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItems $orderItems)
    {
        //
    }
}
