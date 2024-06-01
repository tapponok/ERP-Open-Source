<?php

namespace App\Http\Controllers;

use App\Models\Permissionuser;
use App\Models\Roleshaspermission;
use App\Models\Roleuser;
use App\Models\Userhaserole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class roleController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:indexrolepermission', ['only' => ['show', 'index']]);
        $this->middleware('permission:createrolepermission', ['only' => ['create','store', 'roleuser']]);
        $this->middleware('permission:updaterolepermission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deleterolepermission', ['only' => ['deleteuser', 'destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roleuser::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required | min:2',
        ];
        $this->validate($request, $rules);

        try {
            $role = Role::create(['name' => $request->input('name')]);
            return redirect()->route('roles.index')->with('succes', 'Role was created successfully');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roledata = Roleuser::find($id);
        $subQuery = Roleshaspermission::where('role_id', $id);
        $permissions = Permissionuser::from('permissions as per')
                        ->leftJoinSub($subQuery, 'sub', function ($join) {
                            $join->on('sub.permission_id', '=', 'per.id');
                        })
                        ->get(['per.id', 'per.name', 'sub.role_id']);
        $roleHasPermission = Roleshaspermission::where('role_id', $id)
                                                ->get();

        $role = Userhaserole::with('userlist')
                            ->where('role_id', $id)->get();
        return view('roles.detail', compact('roledata', 'role', 'roleHasPermission', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $roles = Roleuser::findOrFail($id);
            $roles->delete();
            return redirect()->route('roles.index')->with('succes', 'Role was deleted successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function roleuser(Request $request, $id)
    {
        try {
            $permission = new Userhaserole();
            $permission->model_id = $request->userid;
            $permission->role_id = $id;
            $permission->model_type = 'App\Models\User';
            $permission->save();
            return redirect()->route('roles.show', $id)->with('succes', 'User was add to this roles');
        } catch (\Throwable $th) {
            return redirect()->route('roles.show', $id)->with('fail', 'User has have this roles');
        }

    }
    public function deleteuser(Request $request, $id)
    {
        try {
            $data = Userhaserole::where('role_id',$request->permission_id)->where('model_id', $id);
            $data->delete();
            return redirect()->route('roles.show', $request->permission_id)->with('succes', 'User deleted from this roles');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
