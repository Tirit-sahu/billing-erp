<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use DB;


class CommonController extends Controller
{
    
    public function getSelectOption2(Request $request){
       
        $table = $request->table;       
        $id = $request->id;        
        $column = $request->column;
        $type = $request->type;            
        $collection=DB::table($table)->where($type,1)->get();
        $select_option='';
        $select_option.="<option value='' selected>Select</option>";
        foreach ($collection as $row) {
            $select_option.="<option value='".$row->$id."'>".$row->$column."</option>";
        }
        return $select_option;    
    
    }

    public function getValueByAjax(Request $request)
    {
        $table = $request->table;
        $colum = $request->colum;
        $key = $request->key;
        $val = $request->val;

        $res = DB::table($table)->where($key, $val)->value($colum);
        return $res;
    }

    public function editValueByAjax(Request $request)
    {
        $table = $request->table;
        $key = $request->key;
        $value = $request->value;
        $res = DB::table($table)->where($key, $value)->first();
        return json_encode($res);
    }

    public function deleteRecordByAjax(Request $request)
    {
        $table = $request->table;
        $key = $request->key;
        $value = $request->value;
        $res = DB::table($table)->where($key, $value)->delete();
        return "DELETE_SUCESSFULLY";
    }

    public static function getTotalAmount($purchase_id)
    {
        $res = DB::select("SELECT SUM(total) AS total_amount FROM `purchase_details` WHERE purchase_id = $purchase_id");
        return $res[0]->total_amount;
    }

}
