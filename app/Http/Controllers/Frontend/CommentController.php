<?php

namespace App\Http\Controllers\Frontend;

use App\ContentPage;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class CommentController extends Controller
{
    public function save(Request $request)
    {	

        $comment = new Comment;

        $comment->content = $request->content;

		$comment->author_name = $request->author;
		
		$comment->author_email = $request->email;
		
		$comment->author_url  = $request->website;
		
		$comment->author_ip = $request->ip();

		$comment->author_id = (!Auth::guest() ? Auth::id() : 0);

        $page = ContentPage::find($request->post_id);

        $page->pageComments()->save($comment);

        return back()->with('message', 'Thank u for submit a comment. Your comment is awaiting approval.');;
    }

    public function replyStore(Request $request)
    {	
        $reply = new Comment();

         $reply->content = $request->content;

		$reply->author_name = $request->author;
		
		$reply->author_email = $request->email;

        $reply->parent_id = $request->get('comment_id');
		
		$comment->author_url  = $request->website;
		
		$comment->author_ip = $request->ip();

		$comment->author_id = (!Auth::guest() ? Auth::id() : 0);

        $page = ContentPage::find($request->get('post_id'));

        $page->pageComments()->save($reply);

        return back()->with('message', 'Thank u for submit a comment. Your comment is awaiting approval.');;

    }
}
