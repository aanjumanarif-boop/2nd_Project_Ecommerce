<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\contactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    
    public function getContactMessages ()
    {
        $messages = contactMessage::orderBy('id', 'desc')->get();
        return view('admin.contact.list', compact('messages'));
    }

    public function deleteContactMessage ($id)
    {
        $message = contactMessage::find($id);
        $message->delete();

        toastr()->success('Deleted successfully');
        return redirect()->back();
    }

    
}
