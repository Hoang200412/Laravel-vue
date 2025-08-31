<?php

namespace App\Http\Controllers;

use App\Models\Proof;
use App\Models\ActivityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProofRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProofController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $Proof = Proof::query()
        ->join('users', 'users.id', '=', 'proofs.user_id')
        ->select('proofs.*', 'users.name as author')
        ->where('proofs.user_id', $request->user()->id)
        ->get();
        return response()->json($Proof, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProofRequest $request)
    {
        try {
            DB::transaction(function () use ($request){
                $data = [
                    'user_id' => $request->user()->id,
                    'activity_type_id' => $request->activitytype_id,
                    'title' => $request->title,
                    'note' => $request->note,
                    'hours_earned' => $request->hours_earned,
                    'submitted_at' => Date::now(),
                    'file_path' => Storage::disk('public')->put('proofs', $request->file('file_upload'))
                ];
                $proof = Proof::create($data);
            });
            return response()->json(['message' => 'Thêm thành công'], 201);
        } catch (\Throwable $th) {
            return response()
            ->json([
                'message' => 'lỗi khi thêm',
                'error' => $th->getMessage()
            ], 500);
        }
        
    }

    public function create() {
        $activitytype = ActivityType::query()
        ->get();
        return response()->json($activitytype, 200);
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

    public function edit(Proof $proof)
    {
        Gate::authorize('edit', $proof);
        return response()->json($proof, 200);
    }


    public function update(ProofRequest $request, Proof $proof)
    {
        Gate::authorize('update', $proof);
        try {
            DB::transaction(function () use ($request, $proof) {
                $data = [
                    'activity_type_id' => $request->activitytype_id,
                    'title' => $request->title,
                    'note' => $request->note,
                    'hours_earned' => $request->hours_earned,
                ];

                if ($request->hasFile('file_upload')) {
                    if (Storage::disk('public')->exists($proof->file_path)) {
                        Storage::disk('public')->delete($proof->file_path);
                    }
                    $data['file_path'] = Storage::disk('public')->put('proofs', $request->file('file_upload'));
                }
                $proof->update($data);
            });
            return response()->json(['message' => 'Cập nhật thành công'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi khi cập nhật',
                'error' => $th->getMessage()
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proof $proof)
    {
        Gate::authorize('delete', $proof);
        try {
            DB::transaction(function () use ($proof) {
                if (Storage::disk('public')->exists($proof->file_path)) {
                    Storage::disk('public')->delete($proof->file_path);
                }
                $proof->delete();
            });
            return response()->json(['message' => 'Xóa thành công'], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Lỗi khi xóa',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function dashboardStats(Request $request)
    {
        $userId = $request->user()->id;
        $proofs = Proof::where('user_id', $userId)->get();

        return response()->json([
            'total' => $proofs->count(),
            'pending' => $proofs->where('status', 'pending')->count(),
            'approved' => $proofs->where('status', 'approved')->count(),
            'rejected' => $proofs->where('status', 'rejected')->count(),
            'total_hours' => $proofs->sum('hours_earned'),
        ]);
    }
}
