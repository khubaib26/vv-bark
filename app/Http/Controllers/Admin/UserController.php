<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCredit;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::latest()->get();

        return view('setting.user.index',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('setting.user.new',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name'=>'required',
            'pseudonym'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'pseudonym'=>$request->pseudonym,
            'designation'=>$request->designation,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'hod'=>$request->hod,
            'active'=>'1'
        ]);

        $user->syncRoles($request->roles);
        //dd($user);
        return redirect()->back()->withSuccess('User created !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $role = Role::get();
        $user->roles;
       return view('setting.user.edit',['user'=>$user,'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
        ]);

        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withSuccess('Role deleted !!!');
    }


    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->active = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }

    //create user Credits
    public function createUserCredit(Request $request){
        
        $unUsedCredit = UserCredit::where('user_id',$request->user_id)->latest()->value('unused_credits');
        
        if(empty($unUsedCredit)){
            $unUsed = $request->credits;
        }else{
            $unUsed = $unUsedCredit + $request->credits;
        }

        $credit = UserCredit::create([
            'user_id'=>$request->user_id,
            'month'=>$request->month,
            'total_credits'=>$request->credits,
            'unused_credits' => $unUsed
        ]);

        return response()->json(['success'=>'Store Credit successfully.']);
       
    }
}
