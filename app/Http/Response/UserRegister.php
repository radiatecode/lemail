<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/10/2019
 * Time: 10:12 PM
 */

namespace App\Http\Response;


use App\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Session;

class UserRegister implements Responsable
{

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $filename = time().".".$image->getClientOriginalExtension();
            $path = public_path('images');
            $image->move($path,$filename);
            $user->photo = $filename;
        }else{
            $user->photo = "male.png";
        }
        $user->active = 1;
        $user->save();
        Session::flash('success','You Have Successfully Complete Registration');
        return redirect()->back();
    }
}