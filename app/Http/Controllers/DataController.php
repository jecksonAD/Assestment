<?php

namespace App\Http\Controllers;
use App\Models\DataModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class DataController extends Controller
{
    //
    public function getData(request $request)
    {
        $user=Socialite::driver('google')->userFromToken($request->token);
        $userResult=User::where('google_id','=',$user->id)->get()->first();
        $result=DataModel::where('google_id','=',$userResult->google_id)->whereNull('deleted_at')->get();

        return $result;
    }

    public function addData(request $request)
    {

       
        DB::beginTransaction();
        try{

            $user=Socialite::driver('google')->userFromToken($request->token);
            $userResult=User::where('google_id','=',$user->id)->get()->first();
            
            $newDataEntry = new DataModel([
                'name' => $request->name,
                'google_id' => $userResult->google_id,
                'status' => 0,//initial value
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            $newDataEntry->save();
           
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "code"=>"404",
                "msg"=>$e
              ]);
           
        }
      DB::commit();

      return response()->json([
        "code"=>"200"
      ]);
    }

    public function updateData(request $request)
    {
       
        DB::beginTransaction();
        try{

            $result=DataModel::find($request->id);
           // return $result;
            if($result)
            {
                $result->status=1;
                $result->save();
            } 
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "code"=>"404",
                "msg"=>$e
              ]);
           
        }
      DB::commit();
      return response()->json([
        "code"=>"200"
      ]);
    }
    public function deleteData(request $request)
    {
       
        DB::beginTransaction();
        try{

            $result=DataModel::find($request->id);
           // return $result;
            if($result)
            {
                $result->deleted_at=now();
                $result->save();
            } 
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return response()->json([
                "code"=>"404",
                "msg"=>$e
              ]);
           
        }
      DB::commit();
      return response()->json([
        "code"=>"200"
      ]);
    }
}
