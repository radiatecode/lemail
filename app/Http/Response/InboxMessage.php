<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/13/2019
 * Time: 11:14 PM
 */

namespace App\Http\Response;


use App\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InboxMessage implements Responsable
{

    /**
     * Create an HTTP response that represents the object.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|mixed
     * @throws \Exception
     */
    public function toResponse($request)
    {
        $columnData = $this->getDataTableColumnsData();
        return $this->renderDataTables($columnData);
    }

    /**
     * create columns for data tables
     * @return array
     */
    private function getDataTableColumnsData(){
        $datas = [];
        $receiver = User::find(Auth::user()->id);
        foreach ($receiver->message_receiver as $value){
            $datas[] = [
                'id'=>$value->pivot->id,
                'subject'=>$value->subject,
                'message_id'=>$value->id,
                'short_message'=>substr(strip_tags(html_entity_decode($value->message)),0,30).".....",
                'created_at'=>''.$value->created_at,
                'read_at'=>$value->pivot->read_at
            ];
        }
        return $datas;
    }

    /**
     * Render The SS Data Tables
     * @param array $datas
     * @return mixed
     * @throws \Exception
     */
    private function renderDataTables(array $datas){
        $datatable = DataTables::of($datas)
            ->addColumn('hash',function ($row){
                $ids = $row['id'];
                return view('user.datatables.checkbox',
                    compact('ids'))
                    ->render();
            })
            ->addColumn('action',function ($row){
                $link = url('read/message/'.$row['message_id']);
                return view('user.datatables.action_button',
                    compact('link'))
                    ->render();
            })
            ->rawColumns(['action','hash'])
            ->toJson();
        return $datatable;
    }
}