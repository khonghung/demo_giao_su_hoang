<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller implements BaseInterface, UserInterface
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    function index()
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    function detail($id)
    {
        echo $id;
    }

    function getComment($idUser, $idComment = 1)
    {
    }

    function create()
    {
        return \view('users.add');
    }


    function edit($id)
    {
        $users =  DB::select('select * from users where id = :id', ['id' => $id]);

        return \view('users.update', compact('users'));
    }



    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    function getPostOfUser($idUser)
    {
        // TODO: Implement getPostOfUser() method.
    }

    function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('users.index');
    }


    function update(Request $request, $id)
    {

        DB::table('users')->where('id', $id)
            ->update(
                ['email' => $request->email, 'name' => $request->name],
            );
            return redirect()->route('users.index');
        }
}
