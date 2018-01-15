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

class NewsController extends Controller
{
    protected $view = 'news.';
    protected $url = '/news/';


    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->admin){
            $items = News::where('active',1)->orderBy('created_at','desc')->get();
        }else{
            $items = News::where('active',1)->where('deleted',0)->orderBy('created_at','desc')->get();
        }

        return view($this->view.'index',[
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->admin){
            return View($this->view.'create');
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(Auth::user()->admin){

        $rules = [
            'name' => 'required|max:255',
            'content' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return redirect('/'.App::getLocale().$this->url.'create')->withErrors($validator);
        }

        $item = new News();
        $item->name = Input::get('name');
        $item->content = Input::get('content');
        $item->save();

        return redirect('/'.App::getLocale().$this->url.'edit/'.$item->id);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang,$id)
    {
        $item = News::findOrFail($id);
        if($item->deleted == 0){
            return view($this->view.'show',[
                'item' => $item,
            ]);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang,$id)
    {
        $item = News::findOrFail($id);

        if(Auth::user()->admin && $item->deleted == 0){
            return view($this->view.'edit',[
                'item' => $item
            ]);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
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
        $item = News::findOrFail($id);

        if(Auth::user()->admin && $item->deleted == 0){
            $rules = [
                'name' => 'required|max:191',
                'content' => 'required',
                'active' => 'sometimes'
            ];
            $validator = Validator::make(Input::all(), $rules);

            if($validator->fails()){
                return redirect('/'.App::getLocale().$this->url.'edit/'.$item->id)->withErrors($validator);
            }

            $item->name = Input::get('name');
            $item->content = Input::get('content');
            (Input::has('active'))?$item->active = 1: $item->active = 0;
            $item->save();

            return redirect('/'.App::getLocale().$this->url.'edit/'.$item->id);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang,$id)
    {
        if(Auth::user()->admin){
            $item = News::findOrFail($id);
            $item->deleted = 1;
            $item->save();
        }
        return redirect('/'.App::getLocale().$this->url);
    }

    public function renew($lang,$id)
    {
        $item = News::findOrFail($id);

        if(Auth::user()->admin){
            $item->deleted = 0;
            $item->active = 0;
            $item->save();

            return redirect('/'.App::getLocale().$this->url.'edit/'.$item->id);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }

    public function comment($lang,$id){
        $item = News::findOrFail($id);
        if($item->deleted == 0)
        {
            $rules = [
                'comment' => 'required',
            ];
            $validator = Validator::make(Input::all(), $rules);

            if($validator->fails()){
                return redirect('/'.App::getLocale().$this->url.'show/'.$item->id)->withErrors($validator);
            }

            $comment =  new Comments();
            $comment->content = Input::get('comment');
            $comment->user_id = Auth::user()->id;
            $comment->news_id = $item->id;
            $comment->save();

            return redirect('/'.App::getLocale().$this->url.'show/'.$item->id);
        }else{
            return redirect('/'.App::getLocale().$this->url);
        }
    }
}
