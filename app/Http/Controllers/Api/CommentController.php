<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Order;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.'],404);
        $checkComment = Comment::where('id_product','=', $request->id_product)->where('id_user','=', $user->id)->first();
        if($checkComment) return response()->json(['message' => "You commented"],404);

        $checkBuy = Order::where('id_user',$user->id)->join('order_detail','order_detail.id_order','=','order.id_order')->where('id_product',$request->id_product)->get();
        if(sizeof($checkBuy) < 1) return response()->json(['message' => "You have not purchased this product yet"],404);

        if(!isset($request->star_rate) || !isset($request->commentContent)) return response()->json(['message' => "You must enter full field"],404);

        $comment = new Comment();
        $comment->id_user = $user->id;
        $comment->id_product = $request->id_product;
        $comment->star_rate = $request->star_rate;
        $comment->commentContent = $request->commentContent;
        $comment->save();
        
        $commentData = Comment::where('id_comment', $comment->id_comment)->join('users','users.id', 'comment.id_user')
        ->select('comment.*', 'users.lastName')->first();
        return response()->json([
            'message' => 'Success',
            'data' => $commentData
        ]);
    }

    public function show($id) // show comments in the product
    {
        $comments = Comment::where('id_product', $id)->join('users','users.id', 'comment.id_user')
        ->select('comment.*', 'users.lastName')->get();
        if(!isset($comments)) return response()->json(['message' => 'Comment not found']);
        return response()->json(['message' => 'Success', 'data' => $comments], 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
