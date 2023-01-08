<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Models\ProductReply;
use Illuminate\Http\Request;

class ProductRepliesController extends Controller
{
    public function create(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $userName = auth()->user()->name;

        $productReply =  ProductReply::create([
            'product_questions_id' => $id,
            'user_id' => $userId,
            'user_name' => $userName,
            'content' => $request->post('content'),
        ]);
        $formatDate = date('Y-m-d H:i:s', strtotime($productReply->created_at));

        return response()->json([
            "message" => 'Reply successfully created',
            'user_name' => $productReply->user_name,
            'content' => $productReply->content,
            'created_at' => $formatDate,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $productReply = ProductReply::findOrFail($id);

        $productReply->delete($request->post());

        return response()->json([
            "message" => 'Reply successfully deleted',
        ]);
    }
}
