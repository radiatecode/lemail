<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/13/2019
 * Time: 11:14 PM
 */

namespace App\Http\Response;


use App\Sender;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SentMessage implements Responsable
{

    /**
     * Create an HTTP response that represents the object.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
        $sender = Sender::with('message')
            ->where('sender_id',Auth::user()->id)
            ->orderBy('id','DESC')
            ->get();
        foreach ($sender as $value){
            $datas[] = [
                'id'=>$value->id,
                'subject'=>$value->message->subject,
                'message'=>strip_tags($value->message->message),
                'short_message'=>substr(strip_tags(html_entity_decode($value->message->message)),0,30).".....",
                'created_at'=>''.$value->message->created_at
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
                $link = url('view/sent/message/'.$row['id']);
                return view('user.datatables.action_button',
                    compact('link'))
                    ->render();
            })
            ->rawColumns(['action','hash'])
            ->toJson();
        return $datatable;
    }
}