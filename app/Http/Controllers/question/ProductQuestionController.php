<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;

class ProductQuestionController extends Controller
{
    public function index($id)
    {
        $questionsAll = ProductQuestion::where('product_id', $id)->latest()->get();
        $questions = ProductQuestion::with('replies')->where('product_id', $id)->latest()->paginate(10);
        $productId = $id;

        return view('admin/product/product-question', compact(
            'questionsAll',
            'questions',
            'productId',
        ));
    }

    public function create(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $userName = auth()->user()->name;

        $productQuestion = ProductQuestion::create([
            'user_id' => $userId,
            'product_id' => $id,
            'user_name' => $userName,
            'content' => $request->post('content'),
        ]);
        $questionAll = ProductQuestion::where('product_id', $id)->count();

        $formatDate = date('Y-m-d H:i:s', strtotime($productQuestion->created_at));

        return response()->json([
            "message" => 'Question successfully created',
            "questionAll" => $questionAll,
            'user_name' => $productQuestion->user_name,
            'content' => $productQuestion->content,
            'created_at' => $formatDate,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $productQuestion = ProductQuestion::findOrFail($id);

        $productQuestion->delete($request->post());

        $productId = $request->post('productId');

        $questionAll = ProductQuestion::where('product_id', $productId)->count();

        return response()->json([
            "message" => 'Question successfully deleted',
            "questionAll" => $questionAll,
        ]);
    }
}
