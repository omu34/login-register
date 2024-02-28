<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'client_type' => 'required|in:2,3',
            'employer_identity' => ($request->client_type == 2) ? 'required|string' : '',
            'employer_coop_account_number' => ($request->client_type == 2) ? 'required|string' : '',
            'employer_phone_number' => ($request->client_type == 2) ? 'required|string' : '',
            'business_identity' => ($request->client_type == 3) ? 'required|string' : '',
            'business_coop_account_number' => ($request->client_type == 3) ? 'required|string' : '',
            'business_phone_number' => ($request->client_type == 3) ? 'required|string' : '',
            // 'dealer_type' => 'required|in:4,5',
            // 'dealer_identity' => ($request->dealer_type == 4) ? 'required|string' : '',
            // 'dealer_address' => ($request->dealer_type == 4) ? 'required|string' : '',
            // 'dealer_phone_number' => ($request->dealer_type == 4) ? 'required|string' : '',
            // 'agent_identity' => ($request->dealer_type == 5) ? 'required|string' : '',
            // 'agent_phone_number' => ($request->dealer_type == 5) ? 'required|string' : '',
            // 'agent_location' => ($request->dealer_type == 5) ? 'required|string' : '',
            // 'employee_type' => 'required|in:6',
            // 'employee_job_id' => 'required|string|unique:users,employee_job_id',
            // 'employee_title' => 'required|string',
        ]);

        // Determine the role_id based on the selected type
        $roleId = $this->determineRoleId($request->input('client_type', $request->input('dealer_type', $request->input('employee_type', 3))));

        // Create the user with the provided data including the role_id
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
            // 'admin_address' => ($request->client_type == 1) ? $request->your_address : null,
            // 'admin_phone_number' => ($request->client_type == 1) ? $request->your_phone_number : null,

            'employer_identity' => ($request->client_type == 2) ? $request->employer_identity : null,
            'employer_coop_account_number' => ($request->client_type == 2) ? $request->employer_coop_account_number : null,
            'employer_phone_number' => ($request->client_type == 2) ? $request->employer_phone_number : null,
            'business_identity' => ($request->client_type == 3) ? $request->business_identity : null,
            'business_coop_account_number' => ($request->client_type == 3) ? $request->business_coop_account_number : null,
            'business_phone_number' => ($request->client_type == 3) ? $request->business_phone_number : null,
            // 'dealer_identity' => ($request->dealer_type == 4) ? $request->dealer_identity : null,
            // 'dealer_address' => ($request->dealer_type == 4) ? $request->dealer_address : null,
            // 'dealer_phone_number' => ($request->dealer_type == 4) ? $request->dealer_phone_number : null,
            // 'agent_identity' => ($request->dealer_type == 5) ? $request->agent_identity : null,
            // 'agent_phone_number' => ($request->dealer_type == 5) ? $request->agent_phone_number : null,
            // 'agent_location' => ($request->dealer_type == 5) ? $request->agent_location : null,
            // 'employee_job_id' => ($request->employee_type == 6) ? $request->employee_job_id : null,
            // 'employee_title' => ($request->employee_type == 6) ? $request->employee_title : null,

        ]);

        // Handle successful user creation
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
        } else {
            // Handle error if user creation fails
            return back()->withErrors(['registration_error' => 'Failed to register user. Please try again.']);
        }
    }

    /**
     * Determine the role_id based on the selected type.
     *
     * @param  int|string  $type
     * @return int
     */
    protected function determineRoleId($type)
    {
        switch ($type) {
            case 2: // Employer
                return 2;
            case 4: // Dealer
                return 4;
            case 5: // Agent
                return 5;
            case 6: // Employee
                return 6;
            default:
                return 3; // Business (default)
        }
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You have logged out successfully!');
    }
}










// namespace App\Http\Controllers\Auth;

// use App\Models\User;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class LoginRegisterController extends Controller
// {
//     /**
//      * Instantiate a new LoginRegisterController instance.
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except([
//             'logout', 'dashboard'
//         ]);
//     }

//     /**
//      * Display a registration form.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function register()
//     {
//         return view('auth.register');
//     }

//     /**
//      * Store a new user.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:250',
//             'email' => 'required|email|max:250|unique:users',
//             'password' => 'required|min:8|confirmed',
//             'client_type' => 'required|in:2,3', // Ensure a client type is selected
//             'employer_identity' => ($request->client_type == 2) ? 'required|string' : '',
//             'employer_coop_account_number' => ($request->client_type == 2) ? 'required|string' : '',
//             'employer_phone_number' => ($request->client_type == 2) ? 'required|string' : '',
//             'business_identity' => ($request->client_type == 3) ? 'required|string' : '',
//             'business_coop_account_number' => ($request->client_type == 3) ? 'required|string' : '',
//             'business_phone_number' => ($request->client_type == 3) ? 'required|string' : '',
//             'dealer_type' => 'required|in:4,5',
//             'dealer_identity' => ($request->dealer_type == 4) ? 'required|string' : '',
//             'dealer_address' => ($request->dealer_type == 4) ? 'required|string' : '',
//             'dealer_phone_number' => ($request->dealer_type == 4) ? 'required|string' : '',
//             'agent_identity' => ($request->dealer_type == 5) ? 'required|string' : '',
//             'agent_phone_number' => ($request->dealer_type == 5) ? 'required|string' : '',
//             'agent_location' => ($request->dealer_type == 5) ? 'required|string' : '',
//             'employee_type' => 'required|in:6',
//             'employee_job_id' => 'required|string|unique:users,employee_job_id',
//             'employee_title' => 'required|string',
//         ]);

//         $userData = [
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'role_id' => $request->client_type, // Set role based on client type
//             // Set additional fields based on client type
//             'admin_address' => ($request->client_type == 1) ? $request->your_address : null,
//             'admin_phone_number' => ($request->client_type == 1) ? $request->your_phone_number : null,
//             'employer_identity' => ($request->client_type == 2) ? $request->employer_identity : null,
//             'employer_coop_account_number' => ($request->client_type == 2) ? $request->employer_coop_account_number : null,
//             'employer_phone_number' => ($request->client_type == 2) ? $request->employer_phone_number : null,
//             'business_identity' => ($request->client_type == 3) ? $request->business_identity : null,
//             'business_coop_account_number' => ($request->client_type == 3) ? $request->business_coop_account_number : null,
//             'business_phone_number' => ($request->client_type == 3) ? $request->business_phone_number : null,
//             'dealer_identity' => ($request->dealer_type == 4) ? $request->dealer_identity : null,
//             'dealer_address' => ($request->dealer_type == 4) ? $request->dealer_address : null,
//             'dealer_phone_number' => ($request->dealer_type == 4) ? $request->dealer_phone_number : null,
//             'agent_identity' => ($request->dealer_type == 5) ? $request->agent_identity : null,
//             'agent_phone_number' => ($request->dealer_type == 5) ? $request->agent_phone_number : null,
//             'agent_location' => ($request->dealer_type == 5) ? $request->agent_location : null,
//             'employee_job_id' => ($request->employee_type == 6) ? $request->employee_job_id : null,
//             'employee_title' => ($request->employee_type == 6) ? $request->employee_title : null,
//         ];

//         $user = User::create($userData);

//         if ($user) {
//             Auth::login($user);
//             return redirect()->route('dashboard')->withSuccess('You have successfully registered & logged in!');
//         }

//         return back()->withErrors(['registration_failed' => 'Registration failed. Please try again.']);
//     }

//      /**
//      * Display a login form.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function login()
//     {
//         return view('auth.login');
//     }

//     /**
//      * Authenticate the user.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function authenticate(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required'
//         ]);

//         if(Auth::attempt($credentials))
//         {
//             $request->session()->regenerate();
//             return redirect()->route('dashboard')
//                 ->withSuccess('You have successfully logged in!');
//         }

//         return back()->withErrors([
//             'email' => 'Your provided credentials do not match in our records.',
//         ])->onlyInput('email');

//     }

//     /**
//      * Display a dashboard to authenticated users.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function dashboard()
//     {
//         if(Auth::check())
//         {
//             return view('auth.dashboard');
//         }

//         return redirect()->route('login')
//             ->withErrors([
//             'email' => 'Please login to access the dashboard.',
//         ])->onlyInput('email');
//     }

//     /**
//      * Log out the user from application.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect()->route('login')
//             ->withSuccess('You have logged out successfully!');;
//     }
// }
