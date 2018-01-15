<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Comments;
use Validator;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    protected $view = 'profile.';
    protected $url = '/profile/';


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Auth::user();

        return view($this->view.'index',[
            'item' => $item,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang,$id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang)
    {
        $item = Auth::user();

        return view($this->view.'edit',[
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($lang,$id)
    {
        $item = Auth::user();

        $rules = [
            'name' => 'required|max:191',
            'email' => 'required|unique:users|email',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            redirect($this->url.'edit')->withErrors($validator);
        }

        $item->name = Input::get('name');
        $item->email = Input::get('email');
        $item->save();

        redirect($this->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang,$id)
    {

    }

}
