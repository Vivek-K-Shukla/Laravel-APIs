<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;


class dummyAPI extends Controller
{
    function getData(){
        return ["name"=>"anil","email"=>"anil@gmail.com","address"=>"Lucknow"];
      
    }

    //If we will pass id then show that particular id's data otherwise wise show the complete data:-
    function list($id=null){
      return $id?Device::find($id):Device::all();
    }

    function add(Request $req){
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

    function update(Request $req){
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


    function delete($id){
      $data=Device::find($id);
      $result=$data->delete();
      if($result){
        return ["result"=>"Data has been Deleted!"];
      }
      else{
        return ["result"=>"Something went Wrong!"];
      }
    }


    function search($name){
      $result= Device::where("name","like","%".$name."%")->get();
      if(count($result)){
        return $result;
      }
      else{
        return ['Result'=>'No Record Found!'];
      }

    }

    function testData(Request $req){
      $validator = Validator::make($req->all(), 
      array(
          'name' =>    'required|max:20|min:3|unique:users',
          'member_id' =>    'required|min:1',  
      ));
      if($validator->fails()){
        return $validator->errors();
      }
      else{
        $item=new Device;
        $item->name=$req->name;
        $item->member_id=$req->member_id;
        $result=$item->save();
      }
      if($result){
        return ["result"=>"Data has been Saved"];
      }
      else{
        return ["result"=>"Something went Wrong!"];
      }
    }


    function upload(Request $req){
      $result=$req->file('file')->store('apiDocs');
      return ["result"=>$result];

    }
}
