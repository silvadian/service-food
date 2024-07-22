<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\foods;

class foodsController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'star' => 'required|integer', 
            'popular'=> 'required|integer', 
            'recommended' => 'required|integer', 
            'price' => 'required|integer',
            'picture' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            return response()->json([
                'status' =>'error',
                'message' =>$validator->errors()
            ], 400);
        }

        $foods = foods::create($data);

        return response()->json([
            'status' => 'success',
            'data' => $foods,
        ]);
    }

    public function index(Request $request)
    {
        $key = $request->input('key');
        $foods = foods::query();
        if($key == "recommended" ){
            $foods->orderBy('recommended', 'desc');
        }
        else if($key == "popular"){
            $foods->orderBy('popular', 'desc');
        }
        else{
            $foods->orderBy('star', 'desc');
        }
        return response()->json([
            'status' => 'success',
            'data' => $foods->get()
        ]);
    }

    public function show($id)
    {
        $food = foods::find($id);
        if(!$food){
            return response()->json([
                'status' =>'error',
                'message' => 'food not found'
            ], 404);

        }
        return response()->json([
            'status' => 'success',
            'data' => $food
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            return response()->json([
                'status' =>'error',
                'message' =>$validator->errors()
            ], 400);
        }

        $food = foods::find($id);
        if(!$food){
            return response()->json([
                'status' =>'error',
                'message' => 'food not found'
            ], 404);
        }

        $food->fill($data)->save();
        
        return response()->json([
            'status' => 'success',
            'data' => $food
        ]);


    }

    public function destroy($id)
    {
        $food = foods::find($id);
        if(!$food){
            return response()->json([
                'status' =>'error',
                'message' => 'food not found'
            ], 404);

        }

        $food->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'food deleted'
        ]);
    }

}
