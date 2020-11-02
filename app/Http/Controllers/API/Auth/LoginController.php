<?php

namespace App\Http\Controllers\APi\Auth;

use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
   public function __invoke(Request $request)
   {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
    {
        // return redirect()->intended('dashboard');
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
         return response()->json(compact('token'));
    }else {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

   
    //  $user = User::where('email', $request->email)->first();
    //  if ($user != null) {
     
    //  }
   
   }
}
