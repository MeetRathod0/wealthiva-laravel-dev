<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\MetaDatum;
use App\Models\User;
use App\Models\UserDeposite;
use App\Models\UserHerarchy;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function update_user_profile(Request $request)
    {

        $data = $request->validate([
            'id' => 'required',
            'fullname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $user = User::find($data['id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->fullname = $data['fullname'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    function generate_new_password(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::find($data['user_id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $new_password = random_int(100000, 999999);
        $user->password = Hash::make($new_password);
        $user->save();

        return response()->json(['message' => 'New password generated successfully', 'new_password' => $new_password]);
    }

    function update_user_password(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        $user = User::find($data['id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }


    function add_deposite_qr_file(Request $request)
    {
        $data = $request->validate([
            'qr_key' => 'required|string', // new key
            'qr_file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $qr = new MetaDatum();
        $qr->mkey = $data['qr_key'];
        $qr->is_active = 1;
        $qr->created_by = Auth::id();
        $qr->created_datetime = now();
        $qr->updated_datetime = now();
        if ($request->hasFile('qr_file')) {
            $file = $request->file('qr_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/qr'), $filename);
            $qr->mvalue = 'uploads/qr/' . $filename;
        } else {
            return response()->json(['message' => 'QR file is required'], 400);
        }
        $qr->save();

        return response()->json(['message' => 'QR file updated successfully']);
    }

    function add_deposite_amount(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        $deposite = new UserDeposite();
        $deposite->user_id = $user->id;
        $deposite->amount = $data['amount'];
        $deposite->entry_date = now();
        $deposite->is_active = 2;
        $deposite->save();
        return response()->json(['message' => 'Deposit added successfully']);
    }

    function update_deposite_status(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:user_deposits,id',
            'status' => 'required',
        ]);

        $deposite = UserDeposite::find($data['id']);
        if (!$deposite) {
            return response()->json(['message' => 'Deposit not found'], 404);
        }

        $deposite->is_active = $data['status'];
        $deposite->save();

        return response()->json(['message' => 'Deposit status updated successfully']);
    }

    public function getHierarchyJson()
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

        return response()->json($tree);
    }
    /*
    {
        // Get all users
        $users = User::all()->keyBy('id');

        // Get hierarchy
        $hierarchy = DB::table('user_herarchy')->get();

        // Build adjacency list
        $childrenMap = [];
        foreach ($hierarchy as $relation) {
            $childrenMap[$relation->parent_id][] = $relation->user_id;
        }
        // Recursive builder
        $buildTree = function ($userId, $level = 0) use (&$buildTree, $users, $childrenMap) {
            $user = $users[$userId];

            return [
                'id' => "s" . $user->id, // or just $user->id
                'name' => $user->name,
                'level' => $level,
                'children' => array_map(function ($childId) use ($buildTree, $level) {
                    return $buildTree($childId, $level + 1);
                }, $childrenMap[$userId] ?? [])
            ];
        };


        // Find root nodes (users who are not a child of anyone)
        $allUserIds = $users->pluck('id')->toArray();
        $childIds = $hierarchy->pluck('user_id')->toArray();
        $rootIds = array_diff($allUserIds, $childIds);

        // Build final tree
        $tree = [];
        foreach ($rootIds as $rootId) {
            $tree[] = $buildTree($rootId, 0);
        }

        return response()->json($tree);
    }
*/
    /*{
        // Step 1: Fetch all hierarchy and user records in one go to avoid N+1 issues
        $hierarchies = UserHerarchy::all();
        $users = User::all()->keyBy('id');

        // Step 2: Build a lookup for children
        $childrenMap = [];
        foreach ($hierarchies as $hierarchy) {
            $parentId = $hierarchy->parent_id;
            $childrenMap[$parentId][] = $hierarchy;
        }

        // Step 3: Recursive function to build tree
        function buildTree($parentId, $childrenMap, $users, $level = 0)
        {
            $tree = [];
            if (!isset($childrenMap[$parentId])) {
                return $tree;
            }
            foreach ($childrenMap[$parentId] as $hierarchy) {
                $user = $users[$hierarchy->user_id];
                $children = buildTree($hierarchy->id, $childrenMap, $users, $level + 1);

                $tree[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'level' => $level,
                    'children' => $children
                ];
            }
            return $tree;
        }

        // Check all data loaded
        dd($hierarchies);

        // Or check the $childrenMap


        // Or after building the tree


        // Step 4: Build the tree starting from root parent_id, which is usually null or 0
        $tree = buildTree(null, $childrenMap, $users);


        // Step 5: Output as JSON
        return response()->json($tree);
    }*/
}