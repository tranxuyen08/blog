<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminLoginRequest;


class AdminController extends Controller
{
    public function index() {

        return view('admin/login');
    }

    public function login(AdminLoginRequest $request) {
        $payload = $request->all();
        $email = $payload['email'];
        $password = $payload['password'];
        $password = md5($password);
        $admin = Admin::where('email', $email)
            ->where('password', $password)
            ->first();
        if (!empty($admin)) {
            $admin_info = array(
                'email' => $admin->email,
                'name' => $admin->name,
            );
            session(array(
                'admin_info' => $admin_info
            ));

            return redirect('admin/home');
        }

        return redirect('admin/');
    }

    public function home() {
        // dd(session('admin_info'));  
    }

    public function logout(){
        $admin_info = session('admin_info');
        if(!empty($admin_info)){
            session()->forget('admin_info');
        }
        return redirect('admin/');
    }

    public function users(){
        $users = array(
            array(
                'name' => 'Xuyen',
                'age' => 21,
                'email' => 'xuyen123@'
            ),
            array(
                'name' => 'Xuyen',
                'age' => 1,
                'email' => 'xuyen123@'
            ),
            array(
                'name' => 'Xuyen',
                'age' => 12,
                'email' => 'xuyen123@'
            ),
            array(
                'name' => 'Xuyen',
                'age' => 31,
                'email' => 'xuyen123@'
            )
        );
        return response()->json($users);
        // header('Content-Type: application/json; charset=utf-8');
        // echo json_encode($users);
    }
}
