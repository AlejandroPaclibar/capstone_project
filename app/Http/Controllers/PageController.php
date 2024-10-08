<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user()->id;
    
        // Fetch user permission IDs
        $permissionIds = UserPermission::where('user_id', $user)->pluck('permission_id');
    
        // Fetch the actual permission details using the IDs
        $permissions = Permission::whereIn('id', $permissionIds)->get();
    
        // Extract permission descriptions into an array
        $userPermissions = $permissions->pluck('description')->toArray(); // Convert to array for safety
    
        // Log for debugging
       
    
        // Pass data to the Inertia view
        return Inertia::render('Dashboard/dashboard', [
            'userPermissions' => $userPermissions,
            'user'=> $user,
            'pageTitle'=>'Dashboard',
            'name'=> Auth::user()->lname . ', '.Auth::user()->fname 
        ]);
    }

    public function index(){

        return Inertia::render('Guest/Dashboard/dashboard');
        
    }

    public function guest(){

        
    return Inertia::render('Guest/Dashboard/dashboard');
    }
}    
    