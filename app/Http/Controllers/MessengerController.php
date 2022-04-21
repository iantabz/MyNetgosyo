<?php

namespace App\Http\Controllers;

use App\Http\CustomClass\Messenger;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index()
    {
        return Messenger::retrieveContacts();
    }

    public function retrieveMessages($contactCode, $contactRef)
    {
        return Messenger::retrieveContactConversation($contactCode, $contactRef);
    }

    public function deactivateChat(Request $request)
    {
        return Messenger::changeChatStatus($request->id, $request->status);
    }

    public function createNewChat(Request $request)
    {
        return Messenger::makeTheFirstMove($request);
    }

    public function sendMessage(Request $request)
    {
        return Messenger::send($request);
    }
}
