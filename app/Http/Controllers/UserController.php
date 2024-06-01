<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class UserController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:createuser', ['only' => ['create','store']]);
        $this->middleware('permission:indexuser', ['only' => ['show', 'index']]);
        $this->middleware('permission:updateuser', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deleteuser', ['only' => ['delete', 'destroy']]);
    }

    public function index(){
        $user = array();
        $user = User::with('team', 'garageid')->orderBy("created_at", "desc")
                        ->where('isarchive', '!=', '1')
                        ->get();
        return view('user.index', compact('user'));
    }

    public function create(){
        $team = Team::all();
        $garage = Garage::all();
        return view('user.create', compact('team', 'garage'));
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'garage_id' => 'required',
            'password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $this->validate($request, $rules);
        try {
            $user = new User();
            if($request->has('image')){
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $imagesname = time().'_'.$filename;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('storage/profile/' .$imagesname));

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->team_id = $request->input('team_id');
                $user->garage_id = $request->input('garage_id');
                $user->profile_photo_path = $request->image=$imagesname;
                $user->password = bcrypt($request->password);
                $user->save();
            } else {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->team_id = $request->input('team_id');
                $user->garage_id = $request->input('garage_id');
                $user->password = bcrypt($request->password);
                $user->save();
            }
            return redirect()->route('user.index')->with('succes','User was successfully created');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function edit(User $user) {
        $team = Team::all();
        $garage = Garage::all();
        return view('user.edit', compact('user', 'team', 'garage'));
    }
    public function update(Request $request, User $user){
        $rules = [
            'name' => 'required',
            'email' => 'unique:users,email,'.$user->id,
            'garage_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rules);
        try {
            $photo = User::select('profile_photo_path')->where('id',$user->id)->first();
            if($request->has('image')){
                Storage::delete('public/profile/'.$photo->profile_photo_path);
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $imagesname = time().'_'.$filename;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('storage/profile/' .$imagesname));

                $users = User::findOrFail($user->id);
                $users->name = $request->input('name');
                $users->email = $request->input('email');
                $users->team_id = $request->input('team_id');
                $users->garage_id = $request->input('garage_id');
                $users->profile_photo_path = $request->image=$imagesname;
                $users->updated_at = now();
                $users->save();
            } else
            {
                $users = User::findOrFail($user->id);
                $users->name = $request->input('name');
                $users->email = $request->input('email');
                $users->team_id = $request->input('team_id');
                $users->garage_id = $request->input('garage_id');
                $users->updated_at = now();
                $users->save();
            }
            return redirect()->route('user.index')->with('succes', 'User was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function updatepassword(Request $request, User $user){
        $rules = [
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8'
        ];
        $customMessages = [
            'min' => 'The  password must be at least 8 characters.',
            'password5.same' => 'New password and  confirm password must match.',
            'confirm_password.required' => 'The confirm password is required.',
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            $users = User::findOrFail($user->id);
            $users->password = $request->input('password');
            $user->save();
            return redirect()->route('user.index')->with('succes', 'Pasword user was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function show($id){
        $user = User::with('team')->findOrFail($id);
        return view('user.details', compact('user'));
    }
    public function destroy(User $user){
        try {
            $user =  User::findOrFail($user->id);
            $user->isarchive = true;
            $user->save();
            return redirect()->route('user.index')->with('succes', 'User was successfully deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function detailself(){
        return view('user.detailself');
    }
    public function updateself(Request $request, User $user){
        $rules = [
            'name'=> 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rules);
        try {
            $photo = User::select('profile_photo_path')->where('id',$request->id)->first();
            if($request->has('image')){
                Storage::delete('public/profile/'.$photo->profile_photo_path);
                $image       = $request->file('image');
                $filename    = $image->getClientOriginalName();
                $imagesname = time().'_'.$filename;
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('storage/profile/' .$imagesname));

                $user = User::findOrFail($request->id);
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->updated_at = now();
                $user->profile_photo_path = $request->image=$imagesname;
                $user->save();

            } else {
                $user = User::findOrFail($request->id);
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->updated_at = now();
                $user->save();
            }
            return redirect()->route('user.detailself')->with('succes','Your profile was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function uprofilepassword(Request $request, User $user){
        $rules = [
            'currentpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Wrong password');
                    }
                },
            ],
            'newpassword' => 'min:8|required_with:confirmpassword|same:confirmpassword',
            'confirmpassword' => 'required|min:8'
        ];
        $customMessages = [
            'min' => 'The  password must be at least 8 characters.',
            'newpassword.same' => 'New password and  confirm password must match.',
            'confirmpassword.required' => 'The confirm password is required.',
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            $user = User::find($request->id);
            $user->password = bcrypt($request->newpassword);
            $user->save();
            return redirect()->route('user.detailself')->with('succes','Your password was successfully updated');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
