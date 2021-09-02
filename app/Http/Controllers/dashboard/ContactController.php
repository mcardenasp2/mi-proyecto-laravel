<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\CustomUrl;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactContact;
use App\Http\Requests\UpdateContactPut;
use App\Models\Contact;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','rol.admin']);
    }
    public function index()
    {

        // $contacts=Contact::orderBy('created_at','desc')->get();
        $contacts=Contact::orderBy('created_at','desc')->paginate(10);
        // dd($contacts);
        return view('dashboard.contact.index',['contacts'=>$contacts]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        // $contact= Contact::find($id);
        // $contact= Contact::findOrFail($id);
        // dd($contact);
        // if(isset($contact)){
        //     return view('dashboard.contact.show',["contact"=>$contact]);
        // }
        return view('dashboard.contact.show',["contact"=>$contact]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        // echo 'Eliminado';
        $contact->delete();
        return back()->with('status', 'Contact eliminado con exito');
    }
}
