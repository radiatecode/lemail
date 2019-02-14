<?php

namespace App\Http\Controllers;

use App\Message;
use App\Receiver;
use App\Repository\Message\MessageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    private $message;
    /**
     * MessageController constructor.
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    /**
     * Show Create Message Form
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function messageForm(){
        return view('user.message.message');
    }

    /**
     * Create New Message
     * @param Request $request
     * @return mixed
     */
    public function sendMessage(Request $request){
        $this->validate($request,[
            'recipient'=>'required|array|min:1',
            'subject'=>'required|min:10',
            'message'=>'required|min:20'
        ]);
        return $this->message->newMessage($request);
    }

    /**
     * Sent Message View
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function sentMessages(){
       return view('user.sent.sent');
    }

    /**
     * Render Sent Messages Data Table Json Response
     * @return mixed
     */
    public function getSentMessages(){
        return $this->message->sentMessage();
    }

    /**
     * Inbox Message View
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function inbox(){
        return view('user.inbox.inbox');
    }

    /**
     * Render Inbox Messages Data Table Json Response
     * @return mixed
     */
    public function getInbox(){
        return $this->message->inboxMessage();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function readMessageByReceiver($id){
        $message = $this->message->receiverRead($id);
        if ($message){
            return view('user.message.read')
                ->with('message',$message);
        }
        return view('user.error.404');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|
     * \Illuminate\View\View
     */
    public function readMessageBySender($id){
        $message = $this->message->senderRead($id);
        if ($message){
            return view('user.message.view')
                ->with('message',$message);
        }
        return view('user.error.404');
    }

    /**
     * Generate Notification, Call Via AXIOS
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifications(){
        $notification = [];
        $receiver = Receiver::whereNull('read_at')
            ->whereNull('deleted_at')
            ->where('receiver_id',Auth::user()->id)
            ->get();
        foreach($receiver as $value){
             $message = Message::find($value->message_id);
             $notification[] = [
                 'message_id'=>$message->id,
                 'subject'=>$message->subject,
                 'created_at'=>''.$message->created_at,
                 'sent_by'=>$message->sender->user->name
             ];
        };

        return response()->json($notification);
    }

    /**
     * @param Request $request
     * @param $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteReceiverMessages(Request $request, $action)
    {
        $delete = $this->message->deleteReceiverMessages($request,$action);
        if ($delete)
        return response()->json('success',201);
    }

    /**
     * @param Request $request
     * @param $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSenderMessages(Request $request, $action)
    {
        $delete = $this->message->deleteSenderMessages($request,$action);
        if ($delete)
            return response()->json('success',201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMessageBySender($id)
    {
        $delete = $this->message->deleteMessageBySender($id);
        if ($delete)
            return response()->json('success',201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMessageByReceiver($id)
    {
        $delete = $this->message->deleteMessageByReceiver($id);
        if ($delete)
            return response()->json('success',201);
    }
}
