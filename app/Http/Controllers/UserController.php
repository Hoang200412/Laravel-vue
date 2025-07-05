<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->get();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */

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
                    'avata'         => Storage::disk('public')->put('avatar', $request->file('avatar')),
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $user = User::findOrFail($id);
                if(Storage::disk('public')->exists($user->avata)) {
                    Storage::disk('public')->delete($user->avata);
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
