<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReaderRequest;
use App\Http\Requests\ReaderUpdateRequest;
use App\Reader;
use App\ReaderAccessRole;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReaderController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('viewAny' , Reader::class);
        if ($request->search){
            $request->validate([
                'search' => 'nullable|string|max:25'
            ]);
            $readers = Reader::where('email' , 'like', "$request->search")
                ->OrWhere('mobile' , 'like', "$request->search")
                ->OrWhere(DB::raw("CONCAT(first_name, ' ', last_name)") , 'like', "%$request->search%")
                ->paginate(15);
            return view('readers.index', compact('readers'));
        }
        return view('readers.index', ['readers' => Reader::paginate(15)]);
    }

    public function indexInactive(Request $request)
    {
        $this->authorize('viewAny' , Reader::class);
        if ($request->search){
            $request->validate([
                'search' => 'nullable|string|max:25'
            ]);
            $readers = Reader::where('email' , 'like', "$request->search")
                ->OrWhere('mobile' , 'like', "$request->search")
                ->OrWhere(DB::raw("CONCAT(first_name, ' ', last_name)") , 'like', "%$request->search%")
                ->onlyTrashed()
                ->paginate(15);
            return view('readers.inactive', compact('readers'));
        }
        return view('readers.inactive', ['readers' => Reader::onlyTrashed()->paginate(15)]);
    }
    public function create()
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('create', Reader::class);
        $types = ReaderAccessRole::all();
        $reader = new Reader();
        return view('readers.create', compact('types', 'reader'));
    }

    public function store(ReaderRequest $request)
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('create', Reader::class);
        Reader::create(
            Arr::add($request->except('password','password_confirmation'), 'password', Hash::make($request->password))
        );
        return redirect()->route('readers.index')->with('status', 'Reader Successfully Created');
    }

    public function deactivate(Reader $reader)
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('delete', $reader);
        $reader->delete();
        return redirect()->route('readers.index')->with('status', 'Reader Successfully Deactivated. See on Inactive reader list');
    }

    public function activate(Reader $reader)
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('delete', $reader);
        $reader->restore();
        return redirect()->route('readers.inactive')->with('status', 'Reader Successfully Activated. See on Active reader list');
    }

    public function show(Reader $reader)
    {
        $this->authorize('viewAny', Reader::class);
        return view('readers.show', compact('reader'));
    }

    public function edit(Reader $reader)
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('update', $reader);
        $types = ReaderAccessRole::all();
        return view('readers.edit', compact('types', 'reader'));
    }

    public function update(ReaderUpdateRequest $request, Reader $reader)
    {
        $this->authorize('viewAny', Reader::class);
        $this->authorize('update', $reader);
        $reader->update($request->all());
        if ($reader->trashed()){
            return redirect()->route('readers.inactive')->with('status' , 'Reader Successfully Updated');
        }
        return redirect()->route('readers.index')->with('status' , 'Reader Successfully Updated');
    }

    public function password(Reader $reader, Request $request)
    {
        $request->validate([
            'password' => ['required', 'digits:6', 'confirmed' , 'spaceNotAllow'],
            'password_confirmation' => ['required', 'digits:6' , 'spaceNotAllow'],
        ]);
        $reader->update(['password' => Hash::make($request->get('password'))]);

        return redirect()->route('readers.edit' ,$reader)->with('status_password' , 'Password successfully updated');
    }
}
