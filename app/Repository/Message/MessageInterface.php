<?php
/**
 * Created by PhpStorm.
 * User: dark007
 * Date: 2/11/2019
 * Time: 1:37 AM
 */

namespace App\Repository\Message;


use Illuminate\Http\Request;

interface MessageInterface
{
    public function newMessage(Request $request);
    public function sentMessage();
    public function receiverRead($id);
    public function senderRead($id);
    public function inboxMessage();

    public function deleteMessageBySender($id);
    public function deleteMessageByReceiver($id);
    public function deleteReceiverMessages(Request $request,$action);
    public function deleteSenderMessages(Request $request,$action);


}