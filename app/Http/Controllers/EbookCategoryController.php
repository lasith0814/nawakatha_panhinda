<?php

namespace App\Http\Controllers;

use App\EbookCategory;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;

class EbookCategoryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', EbookCategory::class);
        return view('categories.index', ['categories' => EbookCategory::paginate(15)]);
    }

    public function create()
    {
        $this->authorize('viewAny', EbookCategory::class);
        $this->authorize('create', EbookCategory::class);
        $category = new EbookCategory();
        return view('categories.create', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('viewAny', EbookCategory::class);
        $this->authorize('create', EbookCategory::class);
        EbookCategory::create($request->all());
        return redirect()->route('categories.index')->with('status', 'Category Successfully Created');

    }

    public function show(EbookCategory $category)
    {
        $this->authorize('viewAny', EbookCategory::class);
        return view('categories.show' , compact('category'));
    }

    public function edit(EbookCategory $category)
    {
        $this->authorize('viewAny', EbookCategory::class);
        $this->authorize('update', $category);
        return view('categories.edit', compact('category')); // use route model binding
    }

    public function update(CategoryUpdateRequest $request, EbookCategory $category)
    {
        $this->authorize('viewAny', EbookCategory::class);
        $this->authorize('update', $category);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('status' , 'Category Successfully Updated');
    }
}
