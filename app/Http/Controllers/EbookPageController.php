<?php

namespace App\Http\Controllers;

use App\Ebook;
use App\EbookPage;
use App\ReferredBook;
use Illuminate\Http\Request;

class EbookPageController extends Controller
{
    public function create(Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $this->authorize('create', EbookPage::class);
        $page = new EbookPage();
        return view('pages.create', compact('page', 'book'));
    }

    public function store(Request $request, Ebook $book)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $this->authorize('create', EbookPage::class);

        $this->validate($request, [
            'contents' => 'required|string|max:100000',
        ]);
        EbookPage::create([
            'ebook_id' => $book->id,
            'contents' => $request->contents,
        ]);
        return redirect()->route('books.show' , $book)->with('status' , 'Page Successfully Added');
    }

    public function show(Ebook $book, EbookPage $page)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $page_id_verification = EbookPage::where(['ebook_id' => $book->id, 'id' => $page->id])->count();
        $page_number = EbookPage::where('ebook_id', $book->id)->whereBetween('id' , [1 ,  $page->id])->count();

        if ($page_id_verification){
            return view('pages.show', compact('book', 'page', 'page_number'));
        }
        else{
            abort(404);
        }
    }

    public function edit(Ebook $book, EbookPage $page)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $this->authorize('update', $page);
        return view('pages.edit', compact('page', 'book'));
    }

    public function update(Request $request, Ebook $book, EbookPage $page)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $this->authorize('update', $page);

        $this->validate($request, [
            'contents' => 'required|string|max:100000',
        ]);
        $page->update([
            'contents' => $request->contents,
        ]);
        return redirect()->route('books.show' , $book)->with('status' , 'Page Successfully Updated');
    }

    public function forceDelete(Ebook $book, EbookPage $page)
    {
        $this->authorize('viewAny', Ebook::class);
        $this->authorize('viewAny', EbookPage::class);
        $this->authorize('forceDelete', $page);
        $page->forceDelete();
        return redirect()->route('books.show' , $book)->with('status' , 'Page Successfully Deleted');
    }
}
