<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
 
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum'),
            new Middleware('IsAdmin'),
        ];
    }

    public function index()
    {
        $users = DB::table('users')
        ->join('departments', 'users.department_id', '=', 'departments.id')
        ->join('users_status', 'users.status_id', '=', 'users_status.id')
        ->select('users.*', 'departments.name as department', 'users_status.name as status')->get();
        return response()->json($users, 200);
    }


    public function create() {
        $departments = DB::table('departments')->select('id', 'name as department')->get();
        $user_status = DB::table('users_status')->select('id', 'name as status')->get();
        $data = [
            "department" => $departments,
            "user_status" => $user_status
        ];
        return response()->json($data, 200);
    }
    
    public function store(UserRequest $request)
    {

        try {
            DB::transaction(function () use ($request) {

                $user = User::create([
                    'username'      => $request->username,
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => $request->password,
                    'department_id' => $request->department_id,
                    'status_id'     => $request->status_id,
                    'avatar'        => Storage::disk('public')->put('avatar', $request->file('avatar')),
                    'role'          => $request->role,  
                ]);

            });

            return response()->json('them thanh cong', 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message'   =>  'Có lỗi xảy ra',
                'error'     =>  $th->getMessage(),
            ], 500);
        }
    }

    public function getProfile(Request $request) {
        $user = $request->user();
        return response()->json($user, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function edit(User $user)
    {
        return response()->json($user, 200);
    }
   
    public function update(UserRequest $request, User $user)
    {
        try {
            DB::transaction(function () use ($request, $user) {
                $data = [
                    'username'      => $request->username,
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'password'      => $request->password,
                    'department_id' => $request->department_id,
                    'status_id'     => $request->status_id,
                    'role'          => $request->role,
                ];
                if ($request->hasFile('avatar')) {
                    if(Storage::disk('public')->exists($user->avatar)) {
                        Storage::disk('public')->delete($user->avatar);
                        $data['avatar'] = Storage::disk('public')->put('avatar', $request->file('avatar'));
                    }else {
                        $data['avatar'] = Storage::disk('public')->put('avatar', $request->file('avatar'));
                    }
                }
                $user->update($data);
            });

            return response()->json('Cập nhật thành công', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'   =>  'Có lỗi xảy ra',
                'error'     =>  $th->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                if(Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->delete();
            });
            return response()->json('Xóa thành công', 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'   =>  'Có lỗi xảy ra',
                'error'     =>  $th->getMessage(),
            ], 500);
        }
    }
}
