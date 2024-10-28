<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
        /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End Method

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));

    }// End Method 


    public function EditProfile(){

        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }// End Method 

    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('image')) {
           $file = $request->file('image');
           @unlink(public_path('upload/admin_images/'.$data->image));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $data['image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'info'
        );

        return redirect()->route('admin.profile')->with($notification);

    }// End Method


    public function ChangePassword(){

        return view('admin.admin_change_password');

    }// End Method

    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => ['required','current_password'],
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            // session()->flash('message','Password Updated Successfully');
            $notification = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        } else{
            // session()->flash('message','Old password is not match');
            $notification = array(
                'message' => 'Old password is not match',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

    }// End Method

    public function AllAdmin(){
        $alladminuser = User::where('role','admin')->latest()->get();
        return view('admin.all_admin',compact('alladminuser'));
    }// End Mehtod 

    public function AddAdmin(){
        $roles = Role::all();
        return view('admin.add_admin',compact('roles'));
    }// End Mehtod 

    public function AdminUserStore(Request $request){

        $user = new User();
        // $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        // $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod 

    public function EditAdminRole($id){

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.edit_admin',compact('user','roles'));
    }// End Mehtod 


    public function AdminUserUpdate(Request $request,$id){

        $user = User::findOrFail($id);
        // $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->address = $request->address; 
        $user->role = 'admin';
        // $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);

    }// End Mehtod 

    public function DeleteAdminRole($id){

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }

         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Mehtod 

}
