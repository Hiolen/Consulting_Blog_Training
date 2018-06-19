<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\User;
use Exception;
use Log;
use Session;

class UserController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->findAllUser();

        return view('user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' 		=> 'required|string|unique:users',
            'first_name' 	=> 'required|max:255',
            'last_name' 	=> 'required|max:255',
            'password'      => 'required|confirmed|min:5'
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->password);

        try {
            $user->save();
            Session::flash('flash_message', 'User added successfully.');

            return redirect()->route('userIndex');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Edit view of User.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update User.
     *
     * @param Request $request
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username' 		=> 'required|string',
            'first_name' 	=> 'required|max:255',
            'last_name' 	=> 'required|max:255',
            'password'      => 'required|confirmed|min:5'
        ]);

        $user->fill($request->all());
        $user->password = bcrypt($request->password);

        try {
            $user->save();
            Session::flash('flash_message', 'User updated successfully.');

            return redirect()->route('userIndex');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Get user to delete.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        return view('user.delete', compact('user'));
    }

    /**
     * Destroy the given user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            Session::flash('flash_message', 'User deleted successfully.');

            return redirect()->route('userIndex');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());

            return redirect()->back();
        }
    }
}