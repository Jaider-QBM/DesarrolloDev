<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Cliente');
        })->paginate(10);
        return inertia('Client/HomeClient', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Client/Processes/CreateClient');
    }

    public function importClient()
    {
        return inertia('Client/Processes/ImportClient');
    }

    public function createGoogle()
    {
        $googleUser = session('google_user');
        return inertia('Client/Processes/RegisterGoogle', ['googleUser' => $googleUser]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);
        $user->assignRole('Cliente');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = User::find($id);
        return inertia('Client/Processes/EditClient', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $client)
    {
        $client->update($request->validated());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx|max:2048'
        ]);
        Excel::import(new UsersImport, $request->file('import_file'));
        return redirect()->route('users.index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        if (!User::where('email', $user->getEmail())->exists()) {
            session(['google_user' => $user]);
            return redirect()->route('users.google');
        }

        $existingUser = User::where('email', $user->getEmail())->first();
        Auth::login($existingUser);

        return redirect()->intended('dashboard');
    }
}
