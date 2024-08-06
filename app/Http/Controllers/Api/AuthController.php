<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\RouteDiscovery\Attributes\DoNotDiscover;
use Spatie\RouteDiscovery\Attributes\Route;

class AuthController extends BaseController
{
    protected $class = User::class;

    #[Route(method: 'POST')]
    #[DoNotDiscover]
    public function register(Request $request)
    {
        try {
            $validate = $this->validateRequest($request);
            if ($validate) {
                return $validate;
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['user'] = $user;

            return $this->sendResponse($success, 'User register successfully.', 201);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if ($e->getCode() == '23505') {
                $message = 'Email already exists';
            }

            return $this->sendError('Error register user', ['error' => $message], 500);
        }
    }

    #[Route(method: 'POST')]
    #[DoNotDiscover]
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], );
        }

        $success = $this->respondWithToken($token);

        return $this->sendResponse($success, 'User login successfully.');
    }

    public function profile()
    {
        $success = auth()->user();

        return $this->sendResponse($success, 'Profile data return successfully.');
    }


    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Successfully logged out.');
    }

    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
