<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{ 
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect(route('dashboard.index'))->with("success", "Sukses Login");
        } else {
            return redirect("login")->with("error", "Gagal Login");
        }
    }

    public function register(Request $request){
        // Validasi data input
        $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
       ]);

       // Buat pengguna baru
       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password), // Enkripsi password
       ]);

    //    // Login otomatis setelah registrasi
    //    Auth::login($user);

       // Redirect ke halaman dashboard
       return redirect(route('dashboard.index'))->with('success', 'Registrasi berhasil. Selamat datang!');
   
   }



    public function logout(Request $request) {
        // dd("logout");
        Auth::logout(); // Logout user
        
        // Hapus session dan regenerasi untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
  
    }

    public function users(){
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function adduser(){
        return view('user.create');
    }
   
    public function storeuser(Request $request){
          // Validasi data input
          $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
 
        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);
 
     //    // Login otomatis setelah registrasi
     //    Auth::login($user);
 
        // Redirect ke halaman dashboard
        return redirect(route('user-index'))->with('success', 'Registrasi berhasil. Selamat datang!');
    
    }
    // Menampilkan form edit user
    public function edituser($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view edit dengan data user
        return view('user.edit', compact('user'));
    }

    // Memproses update user
    public function updateuser(Request $request, $id)
    {

        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Mengabaikan email pengguna yang sedang di-update
            'password' => 'nullable|string|min:8|confirmed', // Password boleh kosong jika tidak diubah
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika password diisi, maka perbarui password
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman dashboard atau halaman lain dengan pesan sukses
        return redirect(route('user-index'))->with('success', 'User updated successfully!');
    }

    public function deleteuser($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        // Redirect ke halaman lain dengan pesan sukses
        return redirect(route('user-index'))->with('success', 'User deleted successfully!');
    }
}