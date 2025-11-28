<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;



class AccessTokensController extends Controller
{

    public function store (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'device_name' => 'string',
            'abilities' => 'nullable|array'
        ]);

      $user =  User::where('email',$request->email)->firstOrFail();

      if ( $user && Hash::check($request->password, $user->password)) {
        $deviceName = $request->device_name ?? $request->userAgent();
        $token =  $user->createToken($deviceName , $request->post('abilities'));

        return response()->json([
            'access_token' => $token->plainTextToken,
            'user' => $user,
        ],201);


      } else {
        return response()->json([
            'message' => 'The provided credentials are incorrect.'
        ], 401);
          }
    }


 public function destroy($token = null)
{
    $user = Auth::user();

    if ($token === null || $token === 'current') {
        $current = $user->currentAccessToken();
        if (! $current) {
            return response()->json(['message' => 'No current token found.'], 404);
        }
        $current->delete();
        return response()->json(['message' => 'Current token deleted.'], 200);
    }

    $personalAccessToken = PersonalAccessToken::findToken($token);

    if (! $personalAccessToken) {
        return response()->json(['message' => 'Token not found.'], 404);
    }

    if ($personalAccessToken->tokenable_id !== $user->id
        || $personalAccessToken->tokenable_type !== get_class($user)) {
        return response()->json(['message' => 'This token does not belong to the authenticated user.'], 403);
    }

    $personalAccessToken->delete();

    return response()->json(['message' => 'Token deleted successfully.'], 200);
}


}
