<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/11/2019
 * Time: 1:37 AM
 */

namespace App\Repository\Message;


use App\Events\NewMessage;
use App\Http\Response\InboxMessage;
use App\Http\Response\SentMessage;
use App\Message;
use App\Receiver;
use App\Sender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessageEloquent implements MessageInterface
{

    private $model;

    public function __construct(Message $message)
    {
       $this->model = $message;
    }

    /**
     * Create New Message
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newMessage(Request $request)
    {
        $message = new Message();
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        $recipents = $request->recipient;
        $message->recipients()->attach($recipents);

        $sender = new Sender();
        $sender->sender_id = Auth::user()->id;
        $sender->message_id = $message->id;
        $sender->save();

        foreach ($recipents as $id){
            event(new NewMessage(
                $message,
                $id,
                $this->getReceiverPID($message->id,$id)
            ));
        }

        Session::flash('success','Successfully Send Message');
        return redirect()->back();
    }

    /**
     * @param $message
     * @param $id
     * @return mixed
     */
    private function getReceiverPID($message,$id){
        $receiver = Receiver::where('message_id',$message)
            ->where('receiver_id',$id)->first();
        return $receiver->id;
    }

    /**
     * Show All Sent Message
     * @return SentMessage
     */
    public function sentMessage()
    {
        return new SentMessage();
    }

    /**
     * Read The Message By Receiver
     * @param $id
     * @return Message|Message[]|bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|
     * \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function receiverRead($id)
    {
        $user_id = Auth::user()->id;
        $message = Message::with('recipients')
            ->whereHas('recipients',function ($query) use ($user_id,$id){
                $query->where('receiver_id',$user_id)
                    ->where('message_id',$id);
            })
            ->find($id);
        if (isset($message)){
            $receiver = Receiver::where('message_id',$id)
                ->where('receiver_id',$user_id)->first();
            if ($receiver->read_at==null) {
                $receiver->read_at = date('Y-m-d H:i:s');
                $receiver->save();
            }
            return $message;
        }
        return false;
    }

    /**
     * Show All Received Messages
     * @return InboxMessage
     */
    public function inboxMessage()
    {
        return new InboxMessage();
    }


    /**
     * Read Messages By Sender
     * @param $id
     * @return bool
     */
    public function senderRead($id)
    {
        $sender = Sender::where('id',$id)
            ->where('sender_id',Auth::user()->id)
            ->first();
        if (isset($sender)){
            return $sender;
        }
        return false;
    }


    /**
     * Delete Messages From Receiver Side
     * @param Request $request
     * @param $action
     * @return bool
     */
    public function deleteReceiverMessages(Request $request, $action)
    {
        $selected_ids = $request->selected_ids;
        if ($action=="delete"){
            foreach ($selected_ids as $id){
                $receiver = Receiver::findOrFail($id);
                $receiver->deleted_at = date('Y-m-d H:i:s');
                $receiver->save();
            }
        }
        return true;
    }

    /**
     * Delete Messages From Sender Side
     * @param Request $request
     * @param $action
     * @return bool
     */
    public function deleteSenderMessages(Request $request, $action)
    {
        $selected_ids = $request->selected_ids;
        if ($action=="delete"){
            foreach ($selected_ids as $id){
                $sender = Sender::findOrFail($id);
                $sender->deleted_at = date('Y-m-d H:i:s');
                $sender->save();
            }
        }
        return true;
    }

    /**
     * Delete Single Message
     * @param $id
     * @return bool
     */
    public function deleteMessageBySender($id)
    {
        $sender = Sender::findOrFail($id);
        $sender->deleted_at = date('Y-m-d H:i:s');
        $sender->save();
        return true;
    }

    /**
     * Delete Single Message
     * @param $id
     * @return bool
     */
    public function deleteMessageByReceiver($id)
    {
        $receiver = Receiver::where('message_id',$id)
            ->where('receiver_id',Auth::user()->id)
            ->first();
        $receiver->deleted_at = date('Y-m-d H:i:s');
        $receiver->save();
        return true;
    }
}