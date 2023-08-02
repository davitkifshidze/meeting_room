<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SyncController extends Controller
{

    function sync(Request $request)
    {


        dd($request);

//        $users = $request->input('users');

//        $json_data = json_decode('
//            [
//                {"id":"1","username":"owner","first_name":"Owner","last_name":"Owner","password":"bb85e25f5397ad61e22d5c92765a2982ff37310f"},
//                {"id":"2","username":"\u10d0\u10d9\u10d0\u10d9\u10d8 \u10dc\u10d0\u10d3\u10d0\u10e0\u10d4\u10d8\u10e8\u10d5\u10d8\u10da\u10d8","first_name":"\u10d0\u10d9\u10d0\u10d9\u10d8","last_name":"\u10dc\u10d0\u10d3\u10d0\u10e0\u10d4\u10d8\u10e8\u10d5\u10d8\u10da\u10d8","password":"2c8ab736b2ccab4f50e72d5fd7d21020cbb77ae7"}
//            ]
//        ') ;

        dd($json_data);


        foreach ($users as $key => $user) {
            User::updateOrCreate(['id' => $user['id']], [
                'name' => $user['first_name'] . ' ' . $user['last_name'] ,
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        }

        return response()->json(['message' => 'Users sync']);

    }


}
