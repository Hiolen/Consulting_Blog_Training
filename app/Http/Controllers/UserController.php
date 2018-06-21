<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UserRequest;
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
        $this->middleware('admin');
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
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        try {
            $user->save();
            Session::flash('flash_message', 'User added successfully.');
            return redirect()->route('user.index');
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
     * @param UserRequest $request
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        try {
            $user->save();
            Session::flash('flash_message', 'User updated successfully.');
            return redirect()->route('user.index');
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
            return redirect()->route('user.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('flash_message_error', $e->getMessage());
            return redirect()->back();
        }
    }
}