<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use function GuzzleHttp\Promise\all;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('id', Auth::user()->id)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        return view('admin.users.store');
    }

    /**
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        $userData = $request->all();

        $request->validated();
        $userData['password'] = bcrypt($userData['password']);
        $user = new User();
        $user->create($userData);

        flash('Usuário criado com sucesso')->success();
        return redirect()->route('user.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param UserRequest $request
     * @param $id
     */
    public function update(UserRequest $request, $id)
    {
        $userData = $request->all();

        $request->validated();

        if($userData['password']) {
            $userData['password'] = bcrypt($userData['password']);
        }

        $user = User::findOrFail($id);
        $user->update($userData);

        flash('Usuário atualizado com sucesso')->success();
        return redirect()->route('user.edit', ['user' => $id]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        flash('Usuário removido com sucesso')->success();
        return redirect()->route('user.index');
    }
}
