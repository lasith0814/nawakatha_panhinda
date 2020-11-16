<?php

namespace App\Http\Controllers\Api\Auth;

use App\Reader;
use App\ReaderAccessRole;
use App\Rules\InactiveReader;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $max = ReaderAccessRole::count();
        $request->validate([
            'first_name' => 'required|min:3|max:25|spaceNotAllow',
            'last_name' => 'nullable|min:3|max:25|spaceNotAllow',
            'reader_access_role_id' => "required|integer|min:1|max:$max",
            'email' => 'required|email|unique:readers|min:7|max:100',
            'mobile' => 'required|digits:10|unique:readers|starts_with:073,074,079,077,076,071,070,075,078,072',
            'password' => 'required|confirmed|digits:6|spaceNotAllow',
            'password_confirmation' => 'required|digits:6|spaceNotAllow'
        ]);
        $credentials = request(['mobile', 'password']);
        $reader = Reader::create(
            Arr::add($request->except('password','password_confirmation'), 'password', Hash::make($request->password))
        );
        $reader->update(['created_by' => 1 , 'updated_by' => 1]);
        $readerOutput = Reader::where('id', $reader->id)->first();
        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'reader' => $readerOutput
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
        'mobile' => ['required','string','min:10','max:12','exists:readers', new InactiveReader()],
        'password' => 'required|digits:6',
        ],
        [
            'mobile.exists' => 'You are not register with us',
        ]);
        $credentials = request(['mobile', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
