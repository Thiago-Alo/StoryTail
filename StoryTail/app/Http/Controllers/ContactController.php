<?php

namespace App\Http\Controllers;

use App\Notifications\NewContact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{

    public function __construct()
    {

        /*$this->middleware(['auth','verified','can:admin']);*/

        /*$this->middleware(['auth','verified']);

        /* $this->middleware(['auth', 'verified','can:manage-tasks'], ['except' => [
             'index',
         ]]);*/
    }

    public function index(){

        return view('pages.contact');
    }




    public function sendContactMail(Request $request){



        $this->validate($request,[
           'name'=>'required',
           'email'=> 'required|email',
           'message' => 'required'

        ]);

        $contact = [
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=>$request->message
        ];

        try {
            Notification::route('mail',config('mail.from.address'))->notify(new NewContact($contact));
            toastr()->success('Your message was sent successfully!');
            return back();
        } catch (\Exception $exception){
            toastr()->error('An error has occurred please try again later.');
            return back();
        }






    }
}
