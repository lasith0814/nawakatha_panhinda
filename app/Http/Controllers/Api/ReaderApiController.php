<?php

namespace App\Http\Controllers\Api;

use App\Ebook;
use App\EbookPage;
use App\Http\Controllers\Controller;
use App\ReferredBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReaderApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bookIndex(Request $request)
    {
        if ($request->search){
            $request->validate([
                'search' => 'nullable|string|max:25'
            ]);
            $books = Ebook::join('authors', 'authors.id', '=', 'ebooks.author_id')
                ->join('ebook_categories', 'ebook_categories.id', '=', 'ebooks.ebook_category_id')
                ->where('ebooks.book_id' , 'like', "$request->search")
                ->OrWhere('ebooks.name' , 'like', "%$request->search%")
                ->OrWhere('ebook_categories.name' , 'like', "%$request->search%")
                ->OrWhere('authors.name' , 'like', "%$request->search%")
                ->select('ebooks.*')
                ->paginate(15);
            return response()->json([
                'books' => $books
            ]);
        }
        $books = Ebook::paginate(15);
        return response()->json([
            'books' => $books
        ]);
    }

    public function bookShowPages(Ebook $book)
    {
        $count = ReferredBook::where(['ebook_id' => $book->id , 'reader_id' => Auth::id() ])->count();
        if (!$count){
            ReferredBook::create(['ebook_id' => $book->id , 'reader_id' => Auth::id() ]);
        }
        $pages = EbookPage::where('ebook_id' , $book->id)->paginate(15);
        return response()->json([
            'books' => $pages
        ]);
    }

    public function bookPage(Ebook $book, EbookPage $page)
    {
        $page_number = EbookPage::where('ebook_id', $book->id)->whereBetween('id' , [1 ,  $page->id])->count();
        $page_id_verification = EbookPage::where(['ebook_id' => $book->id, 'id' => $page->id])->count();

        if ($page_id_verification){
            return response()->json([
                'book' => $book,
                'page' => $page,
                'page_number' => $page_number
            ]);
        }
        else{
            abort(404);
        }
    }

    public function bookmark(Ebook $book, EbookPage $page)
    {
        $page_id_verification = EbookPage::where(['ebook_id' => $book->id, 'id' => $page->id])->count();

        if ($page_id_verification){
            $count = ReferredBook::where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])->count();
            if (!$count) {
                ReferredBook::create(['ebook_id' => $book->id, 'reader_id' => Auth::id() , 'bookmark_page_no' => $page->id]);
            }
            else{
                $bookmark_page_no = (ReferredBook::where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])->first())->bookmark_page_no;
                if ($bookmark_page_no == $page->id){
                    DB::table('referred_books')
                        ->where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])
                        ->update(['bookmark_page_no' => 0]);
                }
                else{
                    DB::table('referred_books')
                        ->where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])
                        ->update(['bookmark_page_no' => $page->id]);
                }
            }
            return response()->json([
                'done' => true
            ]);
        }
        else{
            abort(404);
        }
    }

    public function likeDislikeBook(Ebook $book)
    {
        $count = ReferredBook::where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])->count();
        if (!$count) {
            ReferredBook::create(['ebook_id' => $book->id, 'reader_id' => Auth::id() , 'is_like' => 1]);
        }
        else{
            $referredBook = (ReferredBook::where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])->first())->is_like;
            if ($referredBook){
                DB::table('referred_books')
                    ->where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])
                    ->update(['is_like' => 0]);
            }
            else{
                DB::table('referred_books')
                    ->where(['ebook_id' => $book->id, 'reader_id' => Auth::id()])
                    ->update(['is_like' => 1]);
            }
        }
        return response()->json([
            'done' => true
        ]);
    }

}
