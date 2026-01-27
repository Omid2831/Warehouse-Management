<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    private $userModel;

    /**
     * construct the userModel as the starter
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('administrator.dashboard');
    }

    /**
     * manage user roles - Unit test
     */
    public function manageUserRoles()
    {
        $users = $this->userModel->getAllUsers(Auth::id());

        return view('administrator.dashboard', [
            'title' => 'Role management'
            ,'users' => $users
        ]);

    }
}
