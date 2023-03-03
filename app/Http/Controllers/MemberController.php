<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Member::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $req){
        $device=new Device;
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result){
        return ["Result"=>"Data has been saved"];
      }
      else{
        return ["Result"=>"Something went Wrong!"];
      }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req){
        $item=Device::find($req->id);
        $item->name=$req->name;
        $item->member_id=$req->member_id;
        $result=$item->save();
        if($result){
        return ["result"=>"Data has been Updated"];
      }
      else{
        return ["result"=>"Something went Wrong!"];
      }
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $data=Device::find($id);
        $result=$data->delete();
        if($result){
          return ["result"=>"Data has been Deleted!"];
        }
        else{
          return ["result"=>"Something went Wrong!"];
        }
      }
}
