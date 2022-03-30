<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminUserController extends Controller
{
    public function listUsers(){
        $users = User::all();
        $this->data = UserResource::collection($users)
            ->accept(['id','name','email','account_type']);
        $this->apiSuccess();
        return $this->apiOutput(Response::HTTP_OK, 'Users ...');
    }
}
