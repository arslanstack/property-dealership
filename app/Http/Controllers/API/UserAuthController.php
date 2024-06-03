<?php

namespace App\Http\Controllers\API;

use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Carbon\Carbon;


class UserAuthController extends Controller
{
    protected $guard = 'api';

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => $validator->errors(), 422));
        }

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if ($token = auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->is_blocked == 1) {
                auth()->logout();
                session()->flush();
                return response()->json(['msg' => 'error', 'response' => 'Your account has been blocked by admin due to violation. Please contact support team.'], 401);
            } else if ($user->status == 0) {
                auth()->logout();
                session()->flush();
                return response()->json(['msg' => 'error', 'response' => 'You have inactivated your account. Please contact support team to get it reactivated.'], 401);
            }
            $response = 'User Logged In Successfully';
            return response()->json([
                'msg' => 'success',
                'response' => $response,
                'token' => $this->respondWithToken(JWTAuth::fromUser(auth()->user())),
                'user' => auth()->user(),
            ]);
        }

        return response()->json(['msg' => 'error', 'response' => 'Invalid email or password!'], 401);
    }

    public function user_profile()
    {
        $user = auth()->user();
        return response()->json(['msg' => 'success', 'response' => 'success', 'data' => $user]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['msg' => 'success', 'response' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addDays(5)->timestamp,
            // 'expires_in' => JWTAuth::factory()->getTTL() * 2880,
        ]);
    }
}
