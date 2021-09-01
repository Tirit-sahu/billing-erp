<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Purchase::with('party')->get();
        return view('purchase.purchaseView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchase.purchase');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        if(isset($request->purchase_detail_id)){
            
            $purchaseDetails = array(
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'rate' => $request->rate,
                'total' => $request->total
            );
    
            if(PurchaseDetail::where('id',$request->purchase_detail_id)->update($purchaseDetails)){
                return "UPDATE_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }else{

            $purchaseDetails = array(
                'purchase_id' => 0,
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'rate' => $request->rate,
                'total' => $request->total,
                'user_id' => 0,
                'session_id' => 0
            );
            if(PurchaseDetail::create($purchaseDetails)){
                return "ADD_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }

    }


    public function purchaseFinalSubmit(Request $request)
    {
        $party_id = $request->party_id; 
        $date = date('Y-m-d', strtotime($request->date));

        $myArray = array(
            'date' => $date,
            'party_id' => $party_id
        );
        
        if($request->purchase_id == 0){
            $id = DB::table('purchases')->insertGetId($myArray);           
            if(DB::table('purchase_details')->where('purchase_id',0)->update(['purchase_id'=>$id])){
                return "ADD";
            }else{
                return "ADDED_FAIL";
            }

        }else{
            if(
                DB::table('purchases')
                ->where('id', $request->purchase_id)
                ->update($myArray)
            ){
                return "UPDATED";
            }
            else
            {
                return "UPDATED_FAIL";
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Purchase $purchase)
    {
        $purchase = Purchase::with('party')->where('id', $id)->first();
        $purchaseDetails = PurchaseDetail::where('purchase_id', $id)->get();
        return view('purchase.purchase', compact('purchase', 'purchaseDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
