<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;


class UserController extends Controller
{
    public function users()
    {
        $users = User::select('name','status','id')->where('is_admin',0)->withCount('orders')->orderBy('name')->paginate(15);
        return view('admin.order.user',compact('users'));
    }
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

}
