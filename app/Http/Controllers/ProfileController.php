<?php

namespace App\Http\Controllers;

use App\Repository\Profiles\ProfileInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $profile;

    /**
     * ProfileController constructor.
     * @param ProfileInterface $profile
     */
    public function __construct(ProfileInterface $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function showUserProfile(){
        return $this->profile->showUserProfile();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function userProfileUpdate(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id
        ]);
        return $this->profile->userProfileUpdate($request,$id);
    }

    /**
     * @return mixed
     */
    public function showAdminProfile(){
        return $this->profile->showAdminProfile();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function adminProfileUpdate(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id
        ]);

        return $this->profile->adminProfileUpdate($request,$id);
    }

    /**
     * User List View
     * @return mixed
     */
    public function userList(){
        return $this->profile->userListView();
    }

    /**
     * Render User List Data Table in Json Format
     * @return mixed
     */
    public function getUserList(){

        return $this->profile->userListSSR();
    }

    /**
     * Certain Action Done By Ajax
     * @param Request $request
     * @param $action
     * @return mixed
     */
    public function dataAction(Request $request,$action){
        return $this->profile->doAjaxAction($request,$action);
    }
}
