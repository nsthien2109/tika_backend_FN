<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $id_store = \Session::get('storeID');
        $comments = Comment::join('users', 'users.id', '=', 'comment.id_user')->join('products', 'products.id_product', '=', 'comment.id_product')
        ->where('id_store', $id_store)
        ->select('comment.*', 'users.firstName', 'users.lastName', 'products.productImage', 'products.productName')
        ->get();

        return view('seller.comment.comments',[
            'comments'=>$comments
        ]);
    }


    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(isset($comment)){
            $comment->delete();
            \Session::put('message','Delete comment success.');
            return Redirect::to('seller/comments');   
        }else{
            \Session::put('message','Comment not found.');
            return Redirect::to('seller/comments');
        }
    }
}
