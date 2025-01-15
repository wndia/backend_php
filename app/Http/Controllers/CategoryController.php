<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Category; 
use Illuminate\Validation\Rule;
use Hash;
class CategoryController extends Controller
{

    public function category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }

        $data = [
            'category_name' => $request->get('category_name'),
            
        ];

        try {
            $insert = Category::create($data);
            return Response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e,
            ]);
        }
    }

    
    public function getCategory()
    {
        try {
            $category = Category::get();
            return Response()->json([
                'status' => true,
                'message' => 'berhasil load data category',
                'data' => $category,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data category.'.$e,
            ]);
        }
    }


    function getDetailCategory($id){
        try{
            $category = Category::where('id',$id)->first();  
            return response()->json([
            'status'=>true,
            'message'=>'berhasil load data detail user',
            'data'=>$category,
            ]);      
        }
        catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail user.'.$e,
            ]);
        }
    }

    function update_category($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'category_name'=>'required',
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $data = [
            'category_name'=>$request->get('category_name'),
        ];
        try {
            $update = Category::where('id',$id)->update($data);
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil diupdate'
            ]);


        } catch (Exception $e) {
            return Response()->json([
                "status"=>false,
                'message'=>$e
            ]);
        }
    }
    function hapus_category($id) {
        try{
            category::where('id',$id)->delete();
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil dihapus'
            ]);
        } catch(Exception $e){
            return Response()->json([
                "status"=>false,
                'message'=>'gagal hapus user. '.$e,
            ]);
        }
    }

}
