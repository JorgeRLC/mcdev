<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $response = Transaction::all();
        return response()->json($response);
    }

    public function store(Request $request)
    {
        Transaction::create($request->all());
        return response()->json('save',200);
    }

    public function show($id)
    {
        $response = Transaction::find($id);
        return response()->json($response);
    }
    
    public function showUser($userId)
    {
        $response = Transaction::where('user_id', $userId)->gey();
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        Transaction::find($id)->update($request);
        return response::json(
            'update'
            , 200);
    }

    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return response::json(
            'update'
            , 200);
    }
}
