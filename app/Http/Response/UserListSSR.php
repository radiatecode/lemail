<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/14/2019
 * Time: 11:03 PM
 */

namespace App\Http\Response;


use App\User;
use Illuminate\Contracts\Support\Responsable;
use Yajra\DataTables\DataTables;

class UserListSSR implements Responsable
{

    /**
     * Create an HTTP response that represents the object.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|mixed
     * @throws \Exception
     */
    public function toResponse($request)
    {
        $data = $this->dataTableColumnsCreate();
        $dtRender = $this->dataTableRender($data);
        return $dtRender;
    }

    /**
     * Create User List Columns For Data Tables
     * @return array
     */
    private function dataTableColumnsCreate(){
        $datas = [];
        $users = User::all();
        foreach ($users as $user){
            $lastLogin = $user->log->last();
            $loginDate = $lastLogin['date'];
            $lastTime = new \DateTime(date($loginDate));
            $today = new \DateTime(date('Y-m-d H:i:s'));
            $difference = $lastTime->diff($today);
            $datas [] =[
                'user_id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                'active'=>$user->active,
                'last_login'=>$difference->d,
                'date'=>$loginDate,
                'photo'=>$user->photo!=null?$user->photo:'male.png',
                'status'=>$difference->d >= 2?'lost':($loginDate!=null?'return':'')
            ];
        }
        return $datas;
    }

    /**
     * Render SS Data tables
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    private function dataTableRender(array $datas){
        $datatable = DataTables::of($datas)
            ->addColumn('hash',function ($row){
                $ids = $row['user_id'];
                return view('admin.datatables.checkbox',
                    compact('ids'))
                    ->render();
            })->editColumn('name', function($row) {
                $name = $row['name'];
                $photo = $row['photo'];
                return view('admin.datatables.name',
                    compact('name','photo'))
                    ->render();
            })
            ->editColumn('active', function($row) {
                $active = $row['active'];
                return view('admin.datatables.active',
                    compact('active'))
                    ->render();
            })
            ->editColumn('status', function($row) {
                $status = $row['status'];
                return view('admin.datatables.status',
                    compact('status'))
                    ->render();
            })
            ->rawColumns(['hash','name','active','status'])
            ->toJson();
        return $datatable;
    }
}