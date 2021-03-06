<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attend;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use App\Exports\UsersFromView;


use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userRepository;
    private $attendRepository;

    public function __construct(User $user){
        $this->userRepository = new User();
        $this->attendRepository = new Attend();
    }


    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.pages.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('admin/cadastros');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->can('view', $this->userRepository->findOrFail($id))){
            $user = $this->userRepository->with('reviewsAboutMe.ownerReview')->findOrFail($id);
            $attends = Attend::attendsForExecute()->attendsById($user->id)->whereBetween('status_id', [3, 5])->with('orders', 'orders.service', 'status', 'orders.type')->get();

            return view('admin.pages.user.details', [
            'user' => $user,
            'attends' => $attends
        ]);

        } else {
            return redirect()->route('user.view', auth()->user()->id);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $user = $this->userRepository->find($id);
        return view('admin.pages.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user, $id)
    {
        if($request->hasFile('user_img')){
            // Get filename with the extension
            $filenameWithExt = $request->file('user_img')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('user_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('user_img')->storeAs('public/usr_img', $fileNameToStore);
        } else {
            $fileNameToStore = User::findOrFail($id)->user_img;
        }
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_img' => $fileNameToStore
        ]);
        
        Alert::success('Success', 'Atualizado com sucesso');

        return redirect('admin/detalhes-cadastro/'.$user->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $user->destroy($id);

        return redirect('admin/cadastros');
    }

    public function export() 
    {
        return Excel::download(new UsersFromView, 'users.xlsx');
    }
}
