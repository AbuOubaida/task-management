<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            if ($request->isMethod('post'))
            {
                return $this->store($request);
            }
            $roles = Role::all();
            return view('admin.user.create',compact('roles'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (!$request->isMethod('post'))
            {
                return back()->with('error', 'Requested methode are not allowed!')->withInput();
            }
            $validData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'numeric', 'unique:'.User::class],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'status' => ['required','numeric','between:0,1'],
                'role' => ['required','numeric','exists:roles,id'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            extract($validData);
            $role = Role::find($role);
            if (!$role)
                return back()->with('error','Role not found!')->withInput();

            $user = User::create([
                'user_name' => str_replace(' ','',$request->name),
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'status' => $status,
                'password' => Hash::make($password),
            ]);
            $user->addRole($role->name);
            return back()->with('success','User create successfully');
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $users = User::all();
            return view('admin.user.list',compact('users'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $user_id)
    {
        try {
            $id = Crypt::decryptString($user_id);
            if ($request->isMethod('put'))
            {
                return $this->update($request,$id);
            }
            $user = User::find($id);
            if (!$user)
                return back()->with('error','Data not found!');
            $roles = Role::all();
            return view('admin.user.edit',compact('user','roles'))->render();
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            if (!$request->isMethod('put'))
            {
                return back()->with('error', 'Requested methode are not allowed!')->withInput();
            }
            $validData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'numeric', Rule::unique('users')->ignore($id)], // Fixed ignore()
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($id)], // Fixed ignore()
                'status' => ['required', 'numeric', 'between:0,1'],
                'role' => ['required', 'numeric', 'exists:roles,id'],
                'password' => [
                    'sometimes',
                    'nullable',
                    'confirmed',
                    Rules\Password::min(8)->letters()->numbers()->mixedCase() // Fixed closure issue
                ]
            ]);
            extract($validData);
            $user = User::find($id);
            if ($user) {
                // Update user details including password (if provided)
                $updateData = [
                    'name' => $name,
                    'phone' => $phone,
                    'email' => $email,
                    'status' => $status,
                ];

                if (!empty($password)) {
                    $updateData['password'] = Hash::make($password);
                }

                $user->update($updateData);

                $currentRole = $user->roles()->first();

                if ($currentRole && $currentRole->id != $role) {
                    $user->syncRoles([$role]);
                }
                return back()->with('success','Data updated successfully');
            }
            return back()->with('error',"Data not found");
        }catch (\Throwable $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            if ($request->isMethod('delete'))
            {
                $request->validate([
                    'id' => ['required','numeric','exists:users,id'],
                ]);
                extract($request->post());
                if (Auth::user()->id == $id)
                {
                    return back()->with('error','Data delete not possible!');
                }
                $user = User::find($id);
                if ($user) {
                    $user->roles()->detach();
                    $user->delete();

                    return back()->with("success",'User and roles deleted successfully');
                }
                return back()->with('error','User data not found!');
            }
            return back()->with('error','Requested method are not allowed');
        }catch (\Throwable $exception)
        {
            return back()->with('error',$exception->getMessage());
        }
    }
}
