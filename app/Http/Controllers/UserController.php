<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Authenticatable;

class UserController extends Controller
{
    public function index(){
        $user = new User;
        $user->EmailHasVerified(18);

        return $user;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $user = User::find($id);

        if ($request->hasFile('image')) {
            // Hapus old image
            Storage::disk('local')->delete('public/users/' . $user->image);

            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/users', $image->hashName());
            $user->image = $image->hashName();
            $user->update(); 
        }
        

        return redirect()->back();
       
    }
}
