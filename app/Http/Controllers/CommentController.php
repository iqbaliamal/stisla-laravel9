<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'comment' => 'required|min:3',
        ]);

        Comment::create([
            'name' => $request->name,
            'comment' => $request->comment,
            'article_id' => $id
        ]);

        return redirect()->route('artikel.detail', $id)->with('status', 'success');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            "status" => "success",
            "message" => "Comment deleted successfully",
        ]);
    }
}
