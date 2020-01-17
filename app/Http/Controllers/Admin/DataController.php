<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    private $page = "data";
    private $path_foto = "public/foto"; // file in storage public foto
    private $path_file = "data"; // file in storage data
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
        $data = $this->streamAll();
        return view('admin/data/list', ['data'=>$data,'nav'=>$this->page]);
    }

    /**
     * @return array
     */
    public function streamAll(){
        //get data from file
        $result= [];
        $file = Storage::files($this->path_file);
        foreach ($file as $path){
            $data=Storage::get($path);
            if(!empty($data)){
                $data = explode(',',$data);
                $result[] = array(
                  'id'  => base64_encode($path),
                  'name'  => $data[0],
                  'email'  => $data[1],
                  'date_of_birth'  => $data[2],
                  'no_telp'  => $data[3],
                  'gender'  => $data[4],
                  'foto'  => $data[5],
                );
            }
        }
        return $result;
    }

    public function findById($id){
        //get data from file
        $result= [];
        $path = base64_decode($id);
        $data=Storage::get($path);
        if(!empty($data)){
            $data = explode(',',$data);
            $result = array(
                'id'  => base64_encode($path),
                'name'  => $data[0],
                'email'  => $data[1],
                'date_of_birth'  => $data[2],
                'no_telp'  => $data[3],
                'gender'  => $data[4],
                'foto'  => $data[5],
            );
        }
        return $result;
    }

    public function deleteFile($id){
        $data=$this->findById($id);
        try{
            Storage::delete($this->path_foto.'/'.$data['foto']);
            Storage::delete(base64_decode($id));
        }catch (\Exception $e){
            return false;
        }
        return true;
    }
    public function add(Request $request)
    {
        return view('admin/data/form', ['data'=>'','nav'=>$this->page]);
    }

    public function insert(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'date' => ['required', 'string'],
            'no_telp' => ['required', 'numeric'],
            'gender' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('admin.data.add')
                ->withErrors($validator)
                ->withInput();
        }
        try{
            //initial data
            $file_name= $input['name'].'-'.date('dmYHis');
            if ($request->hasFile('foto')) {
                $photo = $file_name.'.'.$request->file('foto')->extension();

                //save file foto
                $request->file('foto')->storeAs(
                    $this->path_foto, $photo
                );
            }else{
                $photo = "";
            }

            $data = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'date_of_birth' => $input['date'],
                'no_telp' => $input['no_telp'],
                'gender' => $input['gender'],
                'foto' => $photo,
            );

            //save data to file .txt
            $path= $this->path_file.'/'.$file_name.'.txt';
            Storage::disk('local')->put($path, implode(',',$data));

        }catch (\Exception $e){
            return redirect()
                ->route('admin.data.add')
                ->withErrors($e->getMessage())
                ->withInput();
        }
        return redirect()->route('admin.data.list')->with('message','Add data successful');

    }

    public function edit(Request $request,$id)
    {
        //find user
        $data = $this->findById($id);

        $data['status'] = 'edit';
        return view('admin/data/form', ['data'=>$data,'nav'=>$this->page]);
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'date' => ['required', 'string'],
            'no_telp' => ['required', 'numeric'],
            'gender' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.account.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            //initial data
            $file_name= $input['name'].'-'.date('dmYHis');
            if ($request->hasFile('foto')) {
                $photo = $file_name.'.'.$request->file('foto')->extension();

                //save file foto
                $request->file('foto')->storeAs(
                    $this->path_foto, $photo
                );
            }else{
                $photo = "";
            }

            $data = array(
                'name' => $input['name'],
                'email' => $input['email'],
                'date_of_birth' => $input['date'],
                'no_telp' => $input['no_telp'],
                'gender' => $input['gender'],
                'foto' => $photo,
            );

            //save data to file .txt
            $this->deleteFile($id);
            $path = base64_decode($id);
            $result = Storage::disk('local')->put($path, implode(',',$data));

        }catch (\Exception $e){
            return redirect()
                ->route('admin.account.edit',$id)
                ->withErrors($e->getMessage())
                ->withInput();
        }
        return redirect()->route('admin.data.list')->with('message','Edit data successful');

    }

    public function delete(Request $request,$id)
    {
        try{
            $this->deleteFile($id);
        }catch (\Exception $e){
            return redirect()
                ->route('admin.data.list')
                ->withErrors($e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.data.list')->with('message','Deleted data successful');
    }
}
