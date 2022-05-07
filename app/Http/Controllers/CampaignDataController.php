<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampaignData;

class CampaignDataController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCampaignData()
    {
        return CampaignData::all();
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCampaignData(Request $request)
    {
        return CampaignData::create($request->all());

        echo 'Successfully created campaign data';
    }

    public function showCampaignData($id)
    {
        try {
            return CampaignData::all()->where('user_id', $id);
        } catch (\Exception $e) {
            return $e;
            //throw $th;
        }
    }
}
