<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','rol.admin']);
    }

    public function index()
    {
        // User::find(2)->tags()->sync([1,2,3,4]);
        // with agiliza las consultas relacionadas
        $users=User::with('rol')->orderBy('created_at', 'desc')->paginate(2);
        return view('dashboard.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', ['user'=>new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        User::create([
            'name' => $request['name'],
            'rol_id'=>1,//rol admin
            'surname' => $request['surname'],
            'email' => $request['email'],
            // 'password' => Hash::make($request['password']),
            'password' => $request['password'],
        ]);
        return back()->with('status','Usuario creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.user.show',["users"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', ["user"=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPut $request, User $user)
    {
        // echo $request->route('user')->id
        $user->update([
            'name' => $request['name'],
            // 'rol_id'=>1,//rol admin
            'surname' => $request['surname'],
            'email' => $request['email'],
            // 'password' => Hash::make($data['password']),
        ]);
        return back()->with('status', 'Usuario Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('status','Usuario eliminado con exito');
    }
}
