<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplates;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmailTemplates::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return EmailTemplates::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return EmailTemplates::all()->where('user_id', $id )->where('favorite', '0');
    }

    public function showFavorite($id)
    {
        return EmailTemplates::all()->where('user_id', $id)->where('favorite', '1');
    }

    // public function showTemplate($id)
    // {
    //     return EmailTemplates::all()->where('id', $id);
    // }

    public function showTemplate($id)
    {
        try {
            $template = EmailTemplates::select("*")->where('id', '=', $id)->get();
           if(count($template)>0){
               return $template[0];
           }else{
               return response("No template found");
           }
        } catch (\Exception $e) {
            return $e;
            //throw $th;
        }
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
        $email = EmailTemplates::find($id);
        $email->update($request->all());
        return $email;
    }

    public function updateFavorites($id)
    {
        $email = EmailTemplates::find($id);
        $email->update(['favorite' =>1]);
        return $email;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return EmailTemplates::destroy($id);
    }
}
