<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserActivityCollection;
use App\Models\UserActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request, $user_id)
    {
        $user_activities = UserActivity::query()
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc');

        if ($request->get('keyword')) {
            $user_activities->where('overview', 'LIKE', '%'.$request->get('keyword').'%');
        }

        if ($request->get('date_from') OR $request->get('date_to')) {
            $user_activities->whereBetween('created_at', [
                date('Y-m-d H:i:s', strtotime($request->get('date_from') ?? '2021-01-01 00:00:00')),
                date('Y-m-d H:i:s', strtotime($request->get('date_to') ?? now())),
            ]);
        }

        $activities = $user_activities->paginate((int) $request->get('per_page'))
            ->withQueryString();

        if ($activities->isNotEmpty()) {
            return new UserActivityCollection($activities);
        } else {
            return response()->json('No activities found.', 404);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
