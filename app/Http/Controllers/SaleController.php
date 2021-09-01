<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\sale;
use App\Models\saleDetails;
use App\Models\subCategory;
use App\Models\unit;
use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = sale::with('party')->get();
        return view('sales.salesView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = categories::where('status',1)->get();
        $subCategory = subCategory::where('status',1)->get();
        $units = unit::where('status',1)->get();
        return view('sales.sales',compact('category','subCategory','units'));
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
        if(isset($request->sale_detail_id)){
            
            $saleDetails = array(
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'rate' => $request->rate,
                'total' => $request->total
            );
    
            if(saleDetails::where('id',$request->sale_detail_id)->update($saleDetails)){
                return "UPDATE_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }else{

            $saleDetails = array(
                'sale_id' => 0,
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'rate' => $request->rate,
                'total' => $request->total,
                'user_id' => 0,
                'session_id' => 0
            );
            if(saleDetails::create($saleDetails)){
                return "ADD_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }
    }


    public function saleFinalSubmit(Request $request)
    {
        $party_id = $request->party_id; 
        $date = date('Y-m-d', strtotime($request->date));

        $myArray = array(
            'date' => $date,
            'party_id' => $party_id
        );
        if($request->sale_id == 0){
            $id = DB::table('sales')->insertGetId($myArray);           
            if(DB::table('sale_details')->where('sale_id',0)->update(['sale_id'=>$id])){
                return "ADD";
            }else{
                return "ADDED_FAIL";
            }

        }else{
            if(
                DB::table('sales')
                ->where('id', $request->sale_id)
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
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id, sale $sale)
    {
        $sale = sale::with('party')->where('id', $id)->first();
        $saleDetails = saleDetails::where('sale_id', $id)->get();
        return view('sales.sales', compact('sale', 'saleDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(sale $sale)
    {
        //
    }
}
