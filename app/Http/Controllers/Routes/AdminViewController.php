<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPasswordChangeRequest;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminViewController extends Controller
{
    function user_password_update_link($token)
    {
        $pwd = UserPasswordChangeRequest::where('token', $token)->first();
        if (!$pwd) {
            return redirect()->back()->with('error', 'Invalid or expired token');
        }
        $pwd = UserPasswordChangeRequest::where('user_id', $pwd->user_id)->first();
        return view('admin.auth.updatePassword', ['pwd' => $pwd]);
    }
    /*function get()
    {
        $password = Hash::make('Admin@123');
        return view("home", ['password' => $password]);
    }
*/
    // admin update other user profile
    function admin_user_profile_update($id)
    {

        $user = User::select("id", "wg_id", "fullname", "email", "phone", "created_datetime", "is_active", )->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        if ($user->user_type_id == 1) {
            return redirect()->back()->with('error', 'Cannot update this user profile');
        }
        return view('admin.userupdate', ['user' => $user]);
    }
    function admin_login()
    {
        return view('admin.auth.login');
    }
    function admin_register($id)
    {
        $sponsor = User::where('wg_id', $id)->first();
        //dd($sponsor->fullname);
        return view('admin.auth.register', ['sponsor' => $sponsor]);
    }
    function admin_register2()
    {
        $sponsor = User::where('wg_id', null)->first();
        return view('admin.auth.register', ['sponsor' => $sponsor]);
    }
    function admin_home()
    {
        $user = auth()->user();

        if ($user->phone == "9999999999") {
            return view('admin.auth.tmpregister');
        }
        $incomeSummary = [
            'monthly_income' => '$0.00',
            'total_earned' => '$0.00',
            'income_breakdown' => [
                'Monthly ROI Income' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Total Income' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Direct Income' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Level ROI Income' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Arbitrage Salary' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Reward Income' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
                'Total' => [
                    'today' => '$0.00',
                    'total' => '$0.00',
                ],
            ],
        ];


        return view("admin.home", ['user' => $user, 'incomeSummary' => $incomeSummary]);
    }
    function admin_profile()
    {
        $user = auth()->user();
        $sponser_id = DB::table('user_herarchy')
            ->where('user_id', $user->id)
            ->value('parent_id');

        return view("admin.profile", ['user' => $user, 'sponser_id' => $sponser_id]);
    }

    function admin_activation_id()
    {
        return view("admin.activationId");
    }
    function admin_all_team()
    {
        return view("admin.allTeam");
    }
    function admin_change_password()
    {
        return view("admin.changePassword");
    }
    function admin_deposite()
    {
        $qr = [
            "qr_path_1" => "uploads/qr/qr_1.jpeg", // Default QR path, can be changed later
            "code_1" => "TPm8NVSoxLJGKbXoSGbwNdoQKNMLtrJ8NW", // Default QR key, can be changed later
            "qr_path_2" => "uploads/qr/qr_2.jpeg", // Default QR path, can be changed later
            "code_2" => "0xfE1937376057f996a21A0a445D8212202f55C47E", // Default QR key, can be changed later
        ];
        return view("admin.deposite", ['qr' => $qr]);
    }
    function admin_layer_1_team()
    {
        $user = auth()->user();
        $layer1Team = DB::table('user_herarchy')
            ->where('parent_id', $user->id)
            ->join('users', 'user_herarchy.user_id', '=', 'users.id')
            ->select('users.id', 'users.wg_id', 'users.fullname', 'users.email', 'users.phone', 'users.is_active', 'users.created_datetime', 'users.updated_datetime')
            ->orderBy('users.created_datetime', 'desc')
            ->get();
        return view("admin.layer1Team", ['users' => $layer1Team]);
    }
    function admin_layer_team()
    {
        return view("admin.layerTeam");
    }
    function admin_level_wise_gridlist()
    {
        return view("admin.levelWiseGridList");
    }
    function admin_transaction_history()
    {
        return view("admin.transactionHistory");
    }

    /*public function getHierarchyJson()
    {
        // Fetch all users
        $users = User::all()->keyBy('id');

        // Fetch hierarchy
        $hierarchy = DB::table('user_herarchy')->get();

        // Build children map
        $childrenMap = [];
        foreach ($hierarchy as $relation) {
            if ($relation->parent_id != 0) { // only map if has parent
                $childrenMap[$relation->parent_id][] = $relation->user_id;
            }
        }

        // Recursive builder
        $buildTree = function ($userId, $level = 0) use (&$buildTree, $users, $childrenMap) {
            if (!isset($users[$userId])) {
                return null;
            }

            return [
                'id' => "s" . $userId,
                'name' => $users[$userId]->fullname,
                'level' => $level,
                'children' => array_values(array_filter(array_map(function ($childId) use ($buildTree, $level) {
                    return $buildTree($childId, $level + 1);
                }, $childrenMap[$userId] ?? [])))
            ];
        };

        // Roots = parent_id = 0
        $rootRelations = $hierarchy->where('parent_id', 0);
        $tree = [];

        foreach ($rootRelations as $root) {
            $tree[] = $buildTree($root->user_id, 0);
        }

        return $tree;
        //return response()->json($tree);
    }*/
    public function getHierarchyJson($userId = null)
    {
        // Fetch all users
        $users = User::all()->keyBy('id');

        // Fetch hierarchy
        $hierarchy = DB::table('user_herarchy')->get();

        // Build children map
        $childrenMap = [];
        foreach ($hierarchy as $relation) {
            if ($relation->parent_id != 0) { // only map if has parent
                $childrenMap[$relation->parent_id][] = $relation->user_id;
            }
        }

        // Recursive builder
        $buildTree = function ($userId, $level = 0) use (&$buildTree, $users, $childrenMap) {
            if (!isset($users[$userId])) {
                return null;
            }

            return [
                'id' => "s" . $userId,
                'name' => $users[$userId]->fullname,
                'level' => $level,
                'children' => array_values(array_filter(array_map(function ($childId) use ($buildTree, $level) {
                    return $buildTree($childId, $level + 1);
                }, $childrenMap[$userId] ?? [])))
            ];
        };

        // If a specific user is passed, build tree only for that user
        if ($userId) {
            $tree = $buildTree($userId, 0);
            return $tree;
            // return response()->json($tree);
        }

        // Otherwise, return all root trees (parent_id = 0)
        $rootRelations = $hierarchy->where('parent_id', 0);
        $tree = [];

        foreach ($rootRelations as $root) {
            $tree[] = $buildTree($root->user_id, 0);
        }

        return $tree;
        // return response()->json($tree);
    }

    function admin_tree()
    {

        $hierarchy = $this->getHierarchyJson(Auth::user()->id);
        //dd($hierarchy);
        return view("admin.treeView", ['hierarchy' => Json::encode($hierarchy)]);
    }
    function admin_withdraw()
    {
        return view("admin.withdraw");
    }

    function admin_usermanager()
    {

        if (Auth::user()->user_type_id == 1) {
            $users = User::select('id', 'wg_id', 'fullname', 'email', 'phone', 'is_active', 'created_datetime', 'updated_datetime')->orderBy('created_datetime', 'desc')->get();
        } else {
            $users = User::select('id', 'wg_id', 'fullname', 'email', 'phone', 'is_active', 'created_datetime', 'updated_datetime')->where('user_type_id', '!=', 1)->where('id', '!=', Auth::user()->id)->orderBy('created_datetime', 'desc')->get();
        }
        return view("admin.usermanager", ['users' => $users]);
    }

    function admin_tempregister()
    {
        return view("admin.auth.tmpregister");
    }

    function admin_requests()
    {
        // join with users and userdeposite by user_id
        // and get deposite amount with is_active status
        $users = DB::table('user_deposite')
            ->join('users', 'user_deposite.user_id', '=', 'users.id')
            ->select('users.id as user_id', 'user_deposite.id as id', 'users.wg_id', 'users.fullname', 'users.email', 'users.phone', 'users.is_active', 'user_deposite.created_datetime', 'user_deposite.amount', 'user_deposite.is_active as deposite_is_active')
            ->orderBy('users.created_datetime', 'desc')
            ->get();
        return view("admin.requests", ['users' => $users]);
    }


}
