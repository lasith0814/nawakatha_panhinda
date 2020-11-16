<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Reader;
use App\Rules\ReaderCurrentPasswordCheckRule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function edit()
    {
        $reader = Reader::where('id', Auth::id())->first();
        return response()->json($reader);
    }

    /**
     * Update the profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'first_name' => 'required|min:3|max:25|spaceNotAllow',
            'last_name' => 'nullable|min:3|max:25|spaceNotAllow',
            'email' => "required|email|unique:readers,email,$id|min:7|max:100",
            'mobile' => "required|digits:10|unique:readers,mobile,$id|starts_with:073,074,079,077,076,071,070,075,078,072",
        ]);

        auth()->user()->update($request->all());
        $reader = Reader::where('id', Auth::id())->first();
        $reader->update(['updated_by' => 1]);
        $readerOutput = Reader::where('id', Auth::id())->first();
        return response()->json($readerOutput);
    }

    /**
     * Change the password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function password(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'digits:6', 'spaceNotAllow', new ReaderCurrentPasswordCheckRule],
            'password' => ['required', 'digits:6', 'confirmed' , 'spaceNotAllow', 'different:old_password'],
            'password_confirmation' => ['required', 'digits:6' , 'spaceNotAllow']
        ]);

       $output = auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        $reader = Reader::where('id', Auth::id())->first();
        $reader->update(['updated_by' => 1]);
        return response()->json($output);
    }
}
