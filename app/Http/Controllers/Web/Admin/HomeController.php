<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:home display', ['only' => ['index']]);
    }

    public function index()
    {
        $user = Auth::user();
       if (!$user->can('home display')) {
          return view('dashboard.admin.empty');
       }
        return view('dashboard.admin.dashboard');
    }
}
