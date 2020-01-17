<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    private $page = "account";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //list user
        $data=User::stream()->paginate(100);
        print_r($data);die;
        return view('admin/account/list', ['data'=>$data,'nav'=>$this->page]);
    }

    public function add(Request $request)
    {
        return view('admin/account/form', ['data'=>'','nav'=>$this->page]);
    }

    public function insert(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('admin.account.add')
                ->withErrors($validator)
                ->withInput();
        }
        try{
            //initial data
            $data = array(
              'name' => $input['name'],
              'email' => $input['email'],
              'password' => Hash::make($input['name']),
              'is_deleted' => 0,
            );

            //cek user if deleted
            $cek_email=User::cekEmail($data['email'])->first();
            if(empty($cek_email)){
                //save new user
                User::create($data);
            }else{
                if($cek_email['is_deleted']==1){
                    //update user
                    User::UpdateUser($cek_email['id'],$data);
                }else{
                    return redirect()
                        ->route('admin.account.add')
                        ->withErrors(['error'=>['email is already exist']])
                        ->withInput();
                }

            }

        }catch (\Exception $e){
            return redirect()
                ->route('admin.account.add')
                ->withErrors($e->getMessage())
                ->withInput();
        }
        return redirect()->route('admin.account.list')->with('message','Add account successful');

    }

    public function edit(Request $request,$id)
    {
        //find user
        $data = User::find($id);

        $data['status'] = 'edit';
        return view('admin/account/form', ['data'=>$data,'nav'=>$this->page]);
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.account.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $update = array(
                'password' => Hash::make($input['password']),
                'email' => $input['email'],
                'name' => $input['name'],
            );

            //cek email if exist
            $cek_email=User::find($id);

            if($cek_email['email']!=$update['email']){
                if(!empty($cek_email)){
                    return redirect()
                        ->route('admin.account.edit',$id)
                        ->withErrors(['error'=>['email is already taken']])
                        ->withInput();
                }
            }

            //update user
            User::UpdateUser($id,$update);

        }catch (\Exception $e){
            return redirect()
                ->route('admin.account.edit',$id)
                ->withErrors($e->getMessage())
                ->withInput();
        }
        return redirect()->route('admin.account.list')->with('message','Edit account successful');

    }

    public function delete(Request $request,$id)
    {
        try{
            User::deleteUser($id);
        }catch (\Exception $e){
            return redirect()
                ->route('admin.account.list')
                ->withErrors($e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.account.list')->with('message','Deleted account successful');
    }
}
