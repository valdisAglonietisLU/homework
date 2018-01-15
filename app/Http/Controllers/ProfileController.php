<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Comments;
use Validator;
use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $view = 'profile.';
    protected $url = '/profile/';
    protected $extensions = ['jpg','jpeg','png'];


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
    public function update($lang)
    {
        $item = Auth::user();

        $rules = [
            'name' => 'required|max:191',
        ];
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('/'.App::getLocale().$this->url.'edit')->withErrors($validator);
        }

        $item->name = Input::get('name');
        if(sizeof($_FILES) > 0 && intval($_FILES['image']['size']) > 0){
            $upload_pathMedia = public_path().'/media/';

            $file = Input::file('image');
            $file_ext = Input::file('image')->getClientOriginalExtension();
            if(in_array($file_ext,$this->extensions)){
                $newFileName = Str::random(32).'.'.$file_ext;
                $upload = Input::file('image')->move($upload_pathMedia, $newFileName);
                $item->image = '/media/'.$newFileName;
            }

        }

        $item->save();

        return redirect('/'.App::getLocale().$this->url);
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
