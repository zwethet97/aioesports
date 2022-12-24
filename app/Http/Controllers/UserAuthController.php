<?php

namespace App\Http\Controllers;

use App\Models\NormalUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NormalUser::all();
    }

    public function generateRandomString($length = 20) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $fields = $request->validate([

            'username' => 'required|string',
            'phone-number' => 'required|string',
            'password' => 'required|string'

        ]);

        $verify = NormalUser::where('phone_no',$fields['phone-number'])->first();

        if ($verify)
        {
            if ($verify['verified'] == 1)
            {
                return response([
                    'success' => false,
                    'message' => 'Phone Number is already registered',
                    'data' => (object)[]
                ],200);
            }
        }

        $otp = rand(100000, 999999);
        $otpstring = strval($otp);
        $str2 = substr($fields['phone-number'], 4);

        $token = "_tGnrDluQo1JOqyLaILa-fTlozduLX5fW-JvtdDT4xW4OE2bDC_67DeBTYAe9fhl";

        // Prepare data for POST request
        $data = [
            "to"        =>      $fields['phone-number'],
            "message"   =>      "AUNG PWAL: Your Sing Up OTP is " . $otpstring ,
            "sender"    =>      "Aung Pwal"
        ];
        
        
        $ch = curl_init("https://smspoh.com/api/v2/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ]);
        
        $result = curl_exec($ch);

        $user = NormalUser::create([

            'username' => $fields['username'],
            'phone_no' => $fields['phone-number'],
            'password' => bcrypt($fields['password']),
            'profile_image' => 'https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_960_720.png',
            'level' => 'free',
            'sheild' => 0,
            'diamond' => 0,
            'verified' => '0',
            'otp' => strval($otp)
         ]);

         $fullresult = [
             'user' => $user,
            'smspoh' => $result
         ];

         return response([
             'result' => $fullresult,
             'statusCode' => 201,
             'message' => 'Success'
         ],201);
    }

    public function verifyOTP(Request $request)
    {   

        $fields = $request->validate([
            'phone-number' => 'required',
            'otp' => 'required'

        ]);
        
        $verifyPhone = NormalUser::where('phone_no', $fields['phone-number'])->first();

        $verifyPhoneOtp = NormalUser::where('phone_no', $fields['phone-number'])->value('otp');

        if ( $verifyPhone )
        {
            if( $verifyPhone->otp = $fields['otp'] )
            {
                $verifyPhone->update([
                    'verified' => '1'
                ]);

                $token = $verifyPhone->createToken('myapptoken')->plainTextToken;

            $Otpuser = [
             'user' => $verifyPhone,
             'token' => $token
            ];

                return response([
                    'result' => $Otpuser,
                    'statusCode' => 200,
                    'message' => 'Phone Number is Verified'
                ], 200);
            }
            else {
                return response([
                    'result' => [],
                    'statusCode' => 409,
                    'message' => 'OTP is incorrect'
                ],409);
                }
            }
            else
            {
                return response([
                    'result' => [],
                    'statusCode' => 404,
                    'message' => 'Phone Number does not exit'
                ],200);
            }
        
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'phone-number' => 'required',
            'password' => 'required'
        ]);

        $verifiedCheck = NormalUser::where('phone_no',$fields['phone-number'])->first();

        if (!$verifiedCheck || $verifiedCheck->verified_otp == '0')
        {
            return response([
                'result' => [],
                'statusCode' => 404,
                'message' => 'Phone Number is not registered. Please register first'
            ], 404);
        }
        elseif ( !Hash::check($fields['password'], $verifiedCheck->password))
        {
            return response([
                'result' => [],
                'statusCode' => 409,
                'message' => 'Your Phone Number and Password do not match'
            ], 409);
        }
        else
        {   
            $token = $verifiedCheck->createToken('myapptoken')->plainTextToken;
            
            $user = [
                'user' => $verifiedCheck,
                'token' => $token
            ];

            return response([
                'result' => $user,
                'statusCode' => 201,
                'message' => 'Success'
            ], 200);
        }
    }

    public function resetPassword(Request $request){

        $fields = $request->validate([
            'phone-number' => 'required'
        ]);

        $resetphone = NormalUser::where('phone-number',$fields['phone-number'])->first();

        if(!$resetphone || $resetphone['verified_otp'] == 0)
        {
            return response([
                'success'=> false,
                'message'=> 'Phone Number does not exit',
                'data' => []
            ],200);
        }

        $otp = rand(100000, 999999);
        $otpstring = strval($otp);

        $token = "_tGnrDluQo1JOqyLaILa-fTlozduLX5fW-JvtdDT4xW4OE2bDC_67DeBTYAe9fhl";

        // Prepare data for POST request
        $data = [
            "to"        =>      $fields['phone-number'],
            "message"   =>      "AUNG PWAL: Your Reset Password OTP is " . $otpstring ,
            "sender"    =>      "Aung Pwal"
        ];
        
        $ch = curl_init("https://smspoh.com/api/v2/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ]);
        
        $result = curl_exec($ch);
        
        $resetphone->update([
            'otp'  => $otpstring
        ]);

        return response([
            'success'=> true,
            'message'=> 'OTP is already sent for Password Reset',
            'data' => []
        ], 201);
    }

    public function verifyOTPreset(Request $request){

        $fields = $request->validate([
            'phone-number' => 'required|string',
            'otp' => 'required|string',
        ]);

        $verifyphone = NormalUser::where('phone-number', $fields['phone-number'])->first();
        
        if (!$verifyphone)
        {
            return response([
                'success'=> false,
                'message'=> 'Phone Number does not exit',
                'data' => []
            ],200); 
        }

        if ($verifyphone->otp != $fields['otp'])
        {
            return response([
                'success'=> false,
                'message'=> 'OTP is not correct',
                'data' => []
            ],200);
        }
        // $verifyphone->update([
        //     'password' => bcrypt($fields['password'])
        // ]);
        return response([
                'success'=> true,
                'message'=> 'OTP Verified. Step 3 still need',
                'data' => []
            ],201);
        
    }
    public function finalpwdreset(Request $request)
    {
        $fields = $request->validate([
            'phone-number' => 'required',
            'password' => 'required|confirmed|max:6'
        ]);

        $userphone = NormalUser::where('phone-number',$fields['phone-number'])->first();

        $userphone->update([
             'password' => bcrypt($fields['password'])
        ]);

        return response([
            'success'=> true,
            'message'=> 'Password resets successfully',
            'data' => []
        ],201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return response([
            'success'=> true,
            'message'=> 'UserId Data',
            'data' => NormalUser::find($id)
        ],200);
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
        $fields = $request->validate([
            'username' => 'string',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date-of-birth' => 'string',
            'gender' => 'string',
            'state' => 'string',
            'city' => 'string'
        ]);
        $imageName = time().'.'.$request['profile_image']->extension();  
     
        $request['profile_image']->move(public_path('profileImages'), $imageName);

        $user = NormalUser::find($id);
        if($request['profile_image'])
        {   
            $user->update([
                'profile_image' => "images/userProfile/".$imageName
            ]);
        }
        if($request['username'])
        {   
            $user->update([
                'username' => $request['username'],
            ]);
        }
        if($request['date-of-birth'])
        {   
            $user->update([
                'dob' => $request['date-of-birth'],
            ]);
        }
        if($request['gender'])
        {   
            $user->update([
                'gender' => $request['gender'],
            ]);
        }
        if($request['state'])
        {   
            $user->update([
                'state' => $request['state'],
            ]);
        }
        if($request['city'])
        {   
            $user->update([
                'city' => $request['city'],
            ]);
        }
        return response([
            'result' => $user,
            'statusCode' => 201,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return NormalUser::destroy($id);
    }

    public function updatePassword(Request $request,$id)
    {
        $fields = $request->validate([
            'old-password' => 'required',
            'new-password' =>'required|string|max:6|confirmed'
        ]);

        $user = NormalUser::where('id',$id)->first();

        if ( !Hash::check($fields['old-password'],$user->password) )
        {
            return response([
                'success' => false,
                'message' => 'Password is incorrect',
                'data' => []
            ], 200);   
        }

        $user->update([
            'password' => bcrypt($fields['new-password'])
        ]);
        
        return response([
            'success' => true,
            'message' => 'Password Changed successfully',
            'data' => []
        ], 201);

    }

    public function updatePhone(Request $request,$id)
    {   
        $fields = $request->validate([
            'new-phone' => 'required'
        ]);

        $user = NormalUser::where('id',$id)->first();

        
        $otp = rand(100000, 999999);
        $otpstring = strval($otp);

        $token = "_tGnrDluQo1JOqyLaILa-fTlozduLX5fW-JvtdDT4xW4OE2bDC_67DeBTYAe9fhl";

        // Prepare data for POST request
        $data = [
            "to"        =>      $fields['new-phone'],
            "message"   =>      "AUNGPWAL: Your Change Phonenumber OTP is " . $otpstring ,
            "sender"    =>      "Aung Pwal"
        ];
        
        
        $ch = curl_init("https://smspoh.com/api/v2/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ]);
        
        $result = curl_exec($ch);
        
        $user->update([
            'otp'  => $otpstring
        ]);

        return response([
            'success' => true,
            'message' => 'OTP is set for Update Phone',
            'data' => []
        ], 201);
    }

    public function updatePhone2(Request $request,$id){
        $fields = $request->validate([
            'phone-number' => 'required',
            'otp' => 'required'
        ]);
        $user = NormalUser::where('id',$id)->first();
        if ($user->otp !== $fields['otp'])
        {
            return response([
                'success' => false,
                'message' => 'OTP is not correct!',
                'data' => []
            ],200);
        }
        $user->update([
            'phone-number' => $fields['phone-number']
        ]);

        Referrals::where('submitted-userId',$fields['phone-number'])->update([
            'submitted-userId' => $fields['phone-number']
        ]);

        return response([
            'success' => true,
            'message' => 'Changing Phone Number Successfully!',
            'data' => $user
        ],200);


    }
    
    public function searchReferral($name)
    {
        if (!NormalUser::where('referral-code', 'like', '%'.$name.'%')->first())
        {
            return response([
            'success' => false,
            'message' => 'No User with this Referral Number',
            'data' => []
            ], 200);
        }
        return response([
            'success' => true,
            'message' => 'Search User with Referral Code',
            'data' => NormalUser::where('referral-code', 'like', '%'.$name.'%')->get()
        ],200);
    }

    public function searchPhone($name)
    {   

        if (!NormalUser::where('phone-number', 'like', '%'.$name.'%')->first())
        {
            return response([
            'success' => false,
            'message' => 'No User with this Phone Number',
            'data' => []
            ], 200);
        }
        return response([
            'success' => true,
            'message' => 'Search User with Phone Number',
            'data' => NormalUser::where('phone-number', 'like', '%'.$name.'%')->get()
        ],200);
    }
    
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];

    }
}