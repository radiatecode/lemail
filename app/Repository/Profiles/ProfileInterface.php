<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/14/2019
 * Time: 10:50 PM
 */

namespace App\Repository\Profiles;


use Illuminate\Http\Request;

interface ProfileInterface
{

    public function showUserProfile();
    public function showAdminProfile();

    public function userProfileUpdate(Request $request,$id);
    public function adminProfileUpdate(Request $request,$id);

    public function userListView();
    public function userListSSR();

    public function doAjaxAction(Request $request,$action);
}