<?php

namespace App\Http\Controllers;

use App\Location as AppLocation;
use App\Product as AppProduct;

use App\ma_customers;
use DataTables;
use Illuminate\Http\Request;

class MaCustomersController extends Controller
{
    

    public function index(Request $request)
    {

        


        if ($request->ajax()) {
            $data = ma_customers::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('edit', function ($data) {
                    return '<a class="btn btn-warning mr-1" onclick="editMa(' . $data->id . ')"><i class="fas fa-edit"></i> </a> <a class="btn btn-danger" onclick="delMa(' . $data->id . ')" ><i class="fas fa-trash-alt"></i></a>';
                })
                ->addColumn('newdate_ma', function ($data) {
                    return  '<div class="text-success">' . $data->created_at .  '</div>';
                })
                
                ->rawColumns(['edit', 'name', 'newdate_ma'])
                ->make(true);
        }
            // dd(test);
        $product_user = AppProduct::all();
        $item_cus = AppLocation::all();
        return view('macustomers.index', compact('item_cus','product_user'));
        
        


        
    }


    public function store(Request $request)
    {

        
        



        // dd($request->all());
        if ($request->id) {

            $data = ma_customers::find($request->id);
        } else {
            $data = new ma_customers();
        }
        $data->cus_id = $request->cus_id;
        $data->produet_id = $request->produet_id;
        
        $data->outdate_ma = $request->outdate_ma;
        $data->store_name_id = $request->store_name_id;
        $data->cloud = $request->cloud;
        $data->save();

        $json['success'] = true;
        $json['message'] = '';
        
        return $json;
    }


    public function delMa($id)
    {
        $data = ma_customers::find($id);
        $data->delete();

        $json['success'] = true;
        $json['message'] = '';
        return response()->json($json);
    }


    public function editMa($id)
    {
        $data = ma_customers::find($id);

        $json['message'] = '';
        $json['success'] = true;
        $json['cus'] = $data;
        return response()->json($json);
    }
}