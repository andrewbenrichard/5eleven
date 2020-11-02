<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Seller;
use App\User;
use Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function UsersStore(Request $request)
    {
        //generate unique usernames and referral codes
        $usercode = str_random(6);

        $fullname = $request['full_name'];
    
        $username = $fullname[5] . $usercode;
    
        $i = 2;
        while(User::whereUsername($username)->exists())
        {
            $i++;
            $username = $fullname[5] . $usercode . $i;
        }
    
        $user_name = $username;

        // end username generate
        // start check if email and number already exists
        $email_is_registered = User::whereEmail($request['email'])->exists(); 
        if ($email_is_registered) {
           return response()->json([
               'msg' => 'Sorry this email already exists',
                'status'=> 0], 401);
        }
        $number_is_registered = User::whereNumber($request['number'])->exists(); 
        if ($number_is_registered) {
           return response()->json([
               'msg' => 'Sorry this number already exists',
                'status'=> 0], 401);
        }
       $user_stored =  User::create([
            'full_name' => $request['full_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'number' => $request['number'],
            'username' => $user_name,
            'uuid_code' => $user_name,
            'account_type' => $request['account_type'],
            'referral_by' => $request['referral_by'],
            'accept_terms' => $request['accept_terms'],
            'password' => Hash::make($request['password']),
        ]);

        /*TODO:: send welcome email and confirmation email */
       
          return response()->json([
            'msg' => 'Welcome to 5Eleven',
            'user_id' => $user_stored->id,
             'status'=> 2], 200);
    }
    /* stores section */
    public function sellersStore(Request $request)
    {
        //generate unique usernames and referral codes
        $usercode = str_random(2);

        $slug = str_slug($request->shop_name, '-');
        $validator = Validator::make(['store_slug' => $slug], [
            'store_slug' => 'required|unique:sellers,shop_name,store_slug|max:191'
        ]);
    
        $i = 1;
        while(Seller::whereStoreSlug($slug)->exists())
        {
            $i++;
            $slug = $slug . $usercode . $i;
        }
    
        // $user_name = $username;

        // end username generate
        // start check if email and number already exists
        $store_email_is_registered = Seller::whereStoreEmail($request['email'])->exists(); 
        if ($store_email_is_registered) {
           return response()->json([
               'msg' => 'Sorry you can only have one store',
                'status'=> 0], 401);
        }
        $user_email_is_registered = User::whereEmail($request['email'])->exists(); 
        if ($user_email_is_registered) {
            $user = User::where('email','=', $request['email'] )->first();
            $user_stored =  Seller::create([
                        'user_id' => $user->id,
                        'shop_name' => $request['shop_name'],
                        'store_email' => $request['email'],
                        'store_slug' => $slug,
                        'about_store' => $request['about_store'],
                    ]);
            // TODO:: send the user a welcome email to stores.
           return response()->json([
               'msg' => 'Store created, Please login to continue',
               'redirect'=> 'login',
                'status'=> 2], 401);
        }
   
        /* here we store the user store and redirect them to signup */
        $user_stored =  Seller::create([
            'shop_name' => $request['shop_name'],
            'store_email' => $request['email'],
            'store_slug' => $slug,
            'about_store' => $request['about_store'],
        ]);
            // TODO:: send the user a welcome email to stores.
            return response()->json([
            'msg' => 'Store created, Please create an account to continue',
            'redirect'=> 'seller_register',
            'params' =>$request['email'],
                'status'=> 2], 200);

       
       
          return response()->json([
            'msg' => 'Store created',
            // 'user_id' => $user_stored->id,
             'status'=> 2], 200);
    }
    public function UsersConfirmEmail($uuid)
    {
    //TODO:: work on confirmation email
    }
    public function userForgotpass(Request $request)
    {
    $user_email = $request['email'];
    $email_is_registered = User::whereEmail($user_email)->exists(); 
    if ($email_is_registered) {
       return response()->json([
           'msg' => "We've sent a magic link to your email",
            'status'=> 2], 200);
            //TODO:; SEND PASSWORD RESET EMAIL
    }else{
        return response()->json([
            'msg' => "Sorry, that email address is not registered on 5eleven",
             'status'=> 0], 401);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
