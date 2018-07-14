<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Photo;
use Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = Photo::latest()->get();
        return view('photo_list',  ['datas' => $datas]);
    }

    public function save(Request $req){
        echo $req->input('photoname');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('photo_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $photoname = $request->input('photoname');
        $description = $request->input('description');
        $photo = new Photo();
        if($request->has('id')){
            $photo = Photo::findOrFail($request->input('id'));
        }

        $validator = Validator::make($request->all(), [
            'photoname' => 'required|max:100',
            'description' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            //echo "false"; exit;
            return redirect()->back()
              ->withInput()
              ->withErrors($validator); 
        }

        $photo->photoname = $photoname;
        $photo->description = $description;
        $res = $photo->save();        
        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $photo = Photo::findOrFail($id);
        //var_dump(compact('photo')); exit;
        return view('photo_edit', ['photo' => $photo]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return redirect()->route('photos.index');
    }
}