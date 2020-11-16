<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Author::class);
        return view('authors.index', ['authors' => Author::paginate(15)]);
    }

    public function create()
    {
        $this->authorize('viewAny', Author::class);
        $this->authorize('create', Author::class);
        $author = new Author();
        return view('authors.create', compact('author'));
    }

    public function store(AuthorRequest $request)
    {
        $this->authorize('viewAny', Author::class);
        $this->authorize('create', Author::class);
        Author::create($request->all());
        return redirect()->route('authors.index')->with('status', 'Author Successfully Created');

    }

    public function show(Author $author)
    {
        $this->authorize('viewAny', Author::class);
        return view('authors.show' , compact('author'));
    }

    public function edit(Author $author)
    {
        $this->authorize('viewAny', Author::class);
        $this->authorize('update', $author);
        return view('authors.edit', compact('author')); // use route model binding
    }

    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $this->authorize('viewAny', Author::class);
        $this->authorize('update', $author);
        $author->update($request->all());
        return redirect()->route('authors.index')->with('status' , 'Author Successfully Updated');
    }
}
