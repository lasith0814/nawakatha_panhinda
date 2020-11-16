<?php

namespace App\Http\Controllers;

use App\Author;
use App\Ebook;
use App\EbookCategory;
use App\EbookPage;
use App\Http\Requests\EbookRequest;
use App\Http\Requests\EbookUpdateRequest;
use App\ReferredBook;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EbookController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny' , Ebook::class);
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
            return view('books.index', compact('books'));
        }
        return view('books.index', ['books' => Ebook::paginate(15)]);
    }

    public function indexInactive(Request $request)
    {
        $this->authorize('viewAny' , Ebook::class);
        if ($request->search){
            $request->validate([
                'search' => 'nullable|string|max:25'
            ]);
            $books = Ebook::onlyTrashed()
                ->join('authors', 'authors.id', '=', 'ebooks.author_id')
                ->join('ebook_categories', 'ebook_categories.id', '=', 'ebooks.ebook_category_id')
                ->where('ebooks.book_id' , 'like', "$request->search")
                ->OrWhere('ebooks.name' , 'like', "%$request->search%")
                ->OrWhere('ebook_categories.name' , 'like', "%$request->search%")
                ->OrWhere('authors.name' , 'like', "%$request->search%")
                ->select('ebooks.*')
                ->paginate(15);
            return view('books.inactive', compact('books'));
        }
        return view('books.inactive', ['books' => Ebook::onlyTrashed()->paginate(15)]);
    }

    public function create()
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('create', Ebook::class);
        $categories = EbookCategory::all();
        $authors = Author::all();
        $book = new Ebook();
        return view('books.create', compact('categories', 'authors', 'book'));
    }

    public function store(EbookRequest $request)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('create', Ebook::class);

        $coverImageName = Carbon::now()->format('Y-m-d-H-i-s') . '-' . random_int(0, 99999) . '.' . request()->thumbnail_img->getClientOriginalExtension();
        $array = Arr::add($request->except('thumbnail_img', 'back_thumbnail_img'), 'thumbnail_img', "$coverImageName");

            if (request()->back_thumbnail_img == null) {
                $ebook = Ebook::create($array);
            }
            else{
                $backImageName = Carbon::now()->format('Y-m-d-H-i-s') . '-' . random_int(0, 99999) . '.' . request()->back_thumbnail_img->getClientOriginalExtension();
                $arrayWithBackImage = Arr::add($array, 'back_thumbnail_img', "$backImageName");
                $ebook = Ebook::create($arrayWithBackImage);
                if(is_dir(public_path("books/$ebook->id"))){
                    request()->back_thumbnail_img->move(public_path("books/$ebook->id"), $backImageName);
                }
                else{
                    mkdir(public_path("books/$ebook->id"));
                    request()->back_thumbnail_img->move(public_path("books/$ebook->id"), $backImageName);
                }
            }

        if(is_dir(public_path("books/$ebook->id"))){
            request()->thumbnail_img->move(public_path("books/$ebook->id"), $coverImageName);
        }
        else{
            mkdir(public_path("books/$ebook->id"));
            request()->thumbnail_img->move(public_path("books/$ebook->id"), $coverImageName);
        }

        return redirect()->route('books.index')->with('status', 'Book Successfully Created');
    }

    public function deactivate(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('delete', $book);
        $book->delete();
        $book->ebookPages()->delete();
        $book->ebookPages()->update(['deleted_by' => Auth::id()]);
        $book->referredBooks()->delete();
        return redirect()->route('books.index')->with('status', 'Book Successfully Deactivated. See on Inactive book list');
    }

    public function activate(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('delete', $book);
        $book->restore();
        $book->ebookPages()->restore();
        $book->ebookPages()->update(['deleted_by' => null]);
        $book->referredBooks()->restore();
        return redirect()->route('books.inactive')->with('status', 'Book Successfully Activated. See on Active book list');
    }

    public function show(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
//        $data = $this->authorize('viewAny', EbookPage::class);
        $permission = Auth::user()->can('viewAny', EbookPage::class);
        $likes = ReferredBook::where(['ebook_id' => $book->id , 'is_like' => 1 ])->count();
        if ($permission){
            $pages = EbookPage::where('ebook_id' , $book->id)->withTrashed()->paginate(15);
        }
        else {
            $pages = new EbookPage();
        }

        return view('books.show', compact('book', 'pages', 'likes'));
    }

    public function edit(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('update', $book);
        $categories = EbookCategory::all();
        $authors = Author::all();
        return view('books.edit', compact('categories', 'authors', 'book'));
    }

    public function update(EbookUpdateRequest $request, Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('update', $book);

            $coverImageName = $book->thumbnail_img;
            if ($request->backImageDelete != null){
                if (file_exists("books/$book->id/$book->back_thumbnail_img") and !is_dir("books/$book->id/$book->back_thumbnail_img")) {
                    unlink("books/$book->id/$book->back_thumbnail_img");
                }
                $backImageName = null;
            }
            else{
                $backImageName = $book->back_thumbnail_img;
            }

        if (request()->thumbnail_img != null){
            if (file_exists("books/$book->id/$coverImageName") and !is_dir("books/$book->id/$coverImageName")) {
                unlink("books/$book->id/$coverImageName");
            }
            $coverImageName = Carbon::now()->format('Y-m-d-H-i-s') . '-' . random_int(0, 99999) . '.' . request()->thumbnail_img->getClientOriginalExtension();
            request()->thumbnail_img->move(public_path("books/$book->id"), $coverImageName);
        }

        if (request()->back_thumbnail_img != null) {
            if (file_exists("books/$book->id/$backImageName") and !is_dir("books/$book->id/$backImageName")) {
                unlink("books/$book->id/$backImageName");
            }
            $backImageName = Carbon::now()->format('Y-m-d-H-i-s') . '-' . random_int(0, 99999) . '.' . request()->back_thumbnail_img->getClientOriginalExtension();
            request()->back_thumbnail_img->move(public_path("books/$book->id"), $backImageName);
        }
        $array = Arr::add($request->except('thumbnail_img', 'back_thumbnail_img'), 'thumbnail_img', "$coverImageName");
        $arrayWithBackImage = Arr::add($array, 'back_thumbnail_img', "$backImageName");

        $book->update($arrayWithBackImage);

        if ($book->trashed()){
            return redirect()->route('books.inactive')->with('status' , 'Book Successfully Updated');
        }
        return redirect()->route('books.index')->with('status' , 'Book Successfully Updated');
    }

    public function forceDelete(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('forceDelete', $book);
        $book->forceDelete();
        $book->ebookPages()->forceDelete();
        $book->referredBooks()->forceDelete();
        File::deleteDirectory(public_path("books/$book->id"));
        return redirect()->route('books.inactive' , $book)->with('status' , 'Book Successfully Deleted');
    }
}
