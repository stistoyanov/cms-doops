<?php

namespace App\Http\Controllers;

use App\Helpers\DataMapper;

use DB;
use Hash;

use App\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $data = User::where('id', '!=', User::getLoggedUserId())->orderBy('id', 'DESC')->paginate(DataMapper::DEFAULT_PAGINATE);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * DataMapper::DEFAULT_PAGINATE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id < 2) {
            session()->flash('errors', 'System user must not be deleted!');
            return redirect('/home');
        }
        if (!\Auth::user()->hasRole('Admin')) {
            session()->flash('errors', 'User have not permission for this page access!');
            return redirect('/home');
        }
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}