<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/14/2019
 * Time: 10:50 PM
 */

namespace App\Repository\Profiles;


use App\Admin;
use App\Http\Response\UserListSSR;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileEloquent implements ProfileInterface
{

    /**
     * Show User Profile
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function showUserProfile()
    {
        return view('user.profile.profile');
    }

    /**
     * Show Admin Profile
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function showAdminProfile()
    {
        return view('admin.profile.profile');
    }

    /**
     * Update User Profile
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userProfileUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('photo')){
            $image  = $request->file('photo');
            $filename = time().".".$image->getClientOriginalExtension();
            $path = public_path('images/');
            $image->move($path,$filename);
            $user->photo = $filename;
        }
        if ($request->change_pass){
            $user->password=bcrypt($request->new_pass);
        }
        $user->save();
        Session::flash('success','Successfully Updated  Profiles');
        return redirect()->back();
    }

    /**
     * Update Admin Profile
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminProfileUpdate(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->hasFile('photo')){
            $image  = $request->file('photo');
            $filename = time().".".$image->getClientOriginalExtension();
            $path = public_path('images/');
            $image->move($path,$filename);
            $admin->photo = $filename;
        }
        if ($request->change_pass){
            $admin->password=bcrypt($request->new_pass);
        }
        $admin->save();

        Session::flash('success','Successfully Updated  Profiles');
        return redirect()->back();
    }

    /**
     * Show All User
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function userListView()
    {
        return view('admin.users.users');
    }

    /**
     * Render User list Data Tables
     * @return UserListSSR
     */
    public function userListSSR()
    {
        return new UserListSSR();
    }

    /**
     * Certain Action Take Place By Ajax
     * @param Request $request
     * @param $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function doAjaxAction(Request $request,$action)
    {
        $selected_ids = $request->selected_ids;
        foreach ($selected_ids as $id) {
            $user = User::findOrFail($id);
            if ($action=="delete"){
                $user->delete();
            }elseif ($action=="active"){
                $user->active = 1;
                $user->save();
            }elseif ($action=="inactive"){
                $user->active = 0;
                $user->save();
            }
        }
        return response()->json('success',201);
    }
}