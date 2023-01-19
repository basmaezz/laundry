<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\AppUser;
use App\Models\Delegate;
use App\Models\educationLevel;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::whereNull('subCategory_id')->paginate();
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if(!Gate::allows('users.create')){
        if(Gate::denies('users.create')){
            abort(403);
        };
        $levels=educationLevel::all();
        $roles=Role::all();
        return view('dashboard.users.create',compact(['levels','roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if($request->file('avatar')){
            $filename = request('avatar')->getClientOriginalName();
            request()->file('avatar')->move(public_path() . '/images/' , $filename);
        }
       $user=User::create($request->validated()+[
            'avatar'=> $filename
            ]
        );
        $user->roles()->attach([
            'role_id'=>$request->role_id,
        ]);

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
        $user=User::findorFail($id);
        if($user->level_id !=null ){
            $levels=educationLevel::all();
            return  view('dashboard.users.view',compact(['user','levels']));
        }
        return  view('dashboard.users.view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findorFail($id);
        if($user->level_id !=null ){
            $levels=educationLevel::all();
        return  view('dashboard.users.edit',compact(['user','levels']));
        }
        return  view('dashboard.users.edit',compact('user'));
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
        $user= User::find($id);
        $user->update([
            $user['name']=$request->get('name'),
            $user['last_name']=$request->get('last_name'),
            $user['email']=$request->get('email'),
            $user['phone']=$request->get('phone'),
            $user['level_id']=$request->get('level_id'),
            $user['birthdate']=$request->get('birthdate'),
            $user['joindate']=$request->get('joindate'),
        ]);

        $user->save();
        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return  redirect()->back();
    }

    public function customers(Request $request){

        $customers=AppUser::all();
        return view('dashboard.users.customers',compact('customers'));

    }
    public function customerDelete($id)
    {
        AppUser::find($id)->delete();
        return  redirect()->back();
    }
    public function delegates(Request $request)
    {
        if ($request->ajax()) {
            $data=Delegate::all();
            return Datatables::of($data)
                ->addColumn('user',function ($data){
                    return $data->user->name;
                })->addColumn('action', function($user){
                    $btn = '    <a href="'.route('customer.delete',$user->id).'" class="edit btn btn-danger btn-sm">حذف</a>

                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.users.delegates');
    }

    public function profile()
    {
        $user=User::find(Auth::user()->id);
        return view('dashboard.users.profile',compact('user'));
    }
    public function updateProfile()
    {

    }
    public function logOut() {
        Session::flush();
        Auth::logout();
        return Redirect()->route('customer.login');
    }
}
