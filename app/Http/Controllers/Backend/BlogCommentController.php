<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCommentDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index(BlogCommentDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.blog.blog-comment.index');
    }
    public function destroy($id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
