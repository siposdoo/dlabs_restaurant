<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ResponseHelper;
use App\Traits\OrderHelper;

class OrderController extends Controller
{
    use ResponseHelper,OrderHelper;
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
        $validator = Validator::make($request->all(), [
            'table_id' => 'required|string|max:255',
            'items' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->validationFailed($validator->errors());
        }

        try {
            $orderTotal=0;
            foreach($request->items as $item){
                $item = (object) $item;
                $orderTotal += $this->getPriceFromItem($item->item_id) * $item->quantity;
            }
             $input = [
                'table_id' => $request->table_id,
                'total' => $orderTotal
             ];
             $order = new Order($input);
             $order->save();

                foreach($request->items as $item){
                    $item = (object) $item;
                    $order_item = new OrderItems();
                    $order_item->status="ordered";
                    $order_item->price=$this->getPriceFromItem($item->item_id);
                    $order_item->order_id=$order->id;
                    $order_item->item_id=$item->item_id;
                    $order_item->quantity=$item->quantity;
                    $order_item->save();
                    
                
            }
          

            return $this->successResponse($order);
        } catch (\Throwable $e) {

            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
