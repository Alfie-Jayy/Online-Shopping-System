<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change Password Page
    public function changePassPage()
    {
        return view('admin.Account.changePass');
    }

    //change Password Btn
    public function changePassBtn(Request $req)
    {

        Validator::make($req->all(), [
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmNewPassword' => 'required|min:6|same:newPassword',
        ])->validate();

        $userID = Auth::user()->id;
        $user = User::where('id', $userID)->first();
        $userPass = $user->password;

        if (Hash::check($req->currentPassword, $userPass)) {
            $newPass = Hash::make($req->newPassword);
            User::where('id', $userID)->update([
                'password' => $newPass
            ]);

            return back()->with(['SuccessMsg' => 'Successfully changed the password! Do you want to stay logged in?']);
        } else {
            return back()->with(['PassChangeError' => 'Incorrect Password.']);
        }
    }


    //account Details Page
    public function detailsPage()
    {
        return view('admin.Account.accDetails');
    }

    // edit Details Page
    public function editPage()
    {
        return view('admin.Account.editDetails');
    }


    //edit Confirm Btn
    public function confirmBtn(Request $req)
    {
        $this->updateValidation($req);
        $data = $this->getData($req);

        if ($req->hasFile('image')) {

            //delete current image


            // $currentImageName = Auth::user()->image;
            // if($currentImageName != null){
            //     Storage::delete('public/'.$currentImageName);
            // }


            if (Auth::user()->image) {
                Storage::delete('public/' . Auth::user()->image);
            }

            //store uploaded image
            $uploadImage = $req->file('image');
            $uploadImageName = uniqid() . '_' . $uploadImage->getClientOriginalName();
            $uploadImage->storeAs('public', $uploadImageName);
            $data['image'] = $uploadImageName;
        }
        User::where('id', Auth::user()->id)->update($data);
        return redirect()->route('admin#accountDetailsPage')->with(['UpdateSuccess' => "Successfully Updated Your Account!"]);
    }

    //admin list
    // public function adminList()
    // {

    //     $admins = User::when(request('adminSearch'), function ($query) {
    //         $query->orWhere('name', 'like', '%' . request('adminSearch') . '%')
    //             ->orWhere('email', 'like', '%' . request('adminSearch') . '%')
    //             ->orWhere('gender', request('adminSearch'))
    //             ->orWhere('phone', 'like', '%' . request('adminSearch') . '%')
    //             ->orWhere('address', 'like', '%' . request('adminSearch') . '%');
    //     })
    //         ->where('role', 'admin')
    //         ->orderByRaw("id = " . auth()->id() . " DESC")
    //         ->paginate(3);

    //     return view('admin.Account.adminList', compact('admins'));
    // }

    //user List
    // public function userList()
    // {

    //     $users = User::when(request('userSearch'), function ($q) {
    //         $q->orWhere('name', 'like', '%' . request('userSearch') . '%')
    //             ->orWhere('email', 'like', '%' . request('userSearch') . '%')
    //             ->orWhere('gender', request('userSearch'))
    //             ->orWhere('phone', 'like', '%' . request('userSearch') . '%')
    //             ->orWhere('address', 'like', '%' . request('userSearch') . '%');
    //     })
    //         ->where('role', 'user')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(4);

    //     return view('admin.User.userList', compact('users'));
    // }

    // Admin list
    public function adminList()
    {
        $admins = User::when(request('adminSearch'), function ($query) {
                $query->where('role', 'admin')
                    ->where(function ($query) {
                        $query->orWhere('name', 'like', '%' . request('adminSearch') . '%')
                            ->orWhere('email', 'like', '%' . request('adminSearch') . '%')
                            ->orWhere('gender', request('adminSearch'))
                            ->orWhere('phone', 'like', '%' . request('adminSearch') . '%')
                            ->orWhere('address', 'like', '%' . request('adminSearch') . '%');
                    });
            })
            ->where('role', 'admin')
            ->orderByRaw("id = " . auth()->id() . " DESC")
            ->paginate(3);

        return view('admin.Account.adminList', compact('admins'));
    }

    // User List
    public function userList()
    {
        $users = User::when(request('userSearch'), function ($query) {
                $query->where('role', 'user')
                    ->where(function ($query) {
                        $query->orWhere('name', 'like', '%' . request('userSearch') . '%')
                            ->orWhere('email', 'like', '%' . request('userSearch') . '%')
                            ->orWhere('gender', request('userSearch'))
                            ->orWhere('phone', 'like', '%' . request('userSearch') . '%')
                            ->orWhere('address', 'like', '%' . request('userSearch') . '%');
                    });
            })
            ->where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('admin.User.userList', compact('users'));
    }


    //to Admin Btn
    public function toAdminBtn(Request $req, $id)
    {
        User::where('id', $id)->update([
            'role' => $req->role
        ]);
        return redirect()->route('admin#userList');
    }


    //remove admin
    public function removeAdmin($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#list')->with(['removeSuccess' => "Successfully removed an admin!"]);
    }

    //remove users
    public function removeUsers($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#userList')->with(['removeSuccess' => "Successfully removed an user!"]);
    }

    //change Role Page
    public function changeRolePage($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.Account.changeRole', compact('account'));
    }

    // role Change Btn
    public function roleChangeBtn(Request $req, $id)
    {
        $data = $this->getRequestData($req);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    // Feedbacks
    public function feedback()
    {
        $feedbacks = Contact::when(request('feedbackSearch'), function ($query) {
            $query
                ->orWhere('id', request('feedbackSearch'))
                ->orWhere('user_id',request('feedbackSearch'))
                ->orWhere('name', 'like', '%' . request('feedbackSearch') . '%')
                ->orWhere('email', 'like', '%' . request('feedbackSearch') . '%')
                ->orWhere('message', 'like', '%' . request('feedbackSearch') . '%');
        })
          ->paginate(3);
        return view('admin.User.userFeedback', compact('feedbacks'));
    }

    //remove Feedback
    public function removeFeedback($id){
        Contact::where('id', $id)->delete();
        return redirect()->route('admin#userFeedback')->with(['removeSuccess' => 'A feedback has been removed!']);
    }

    //ajax change role
    public function changeRole(Request $req)
    {
        // logger($req->all());
        User::where('id', $req->id)->update([
            'role' => $req->role
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'successfully changed'
        ], 200);
    }

    private function updateValidation($req)
    {

        Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
            'address' => 'required',
        ])->validate();
    }

    private function getData($req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
        ];
    }

    private function getRequestData($req)
    {
        return [
            'role' => $req->role
        ];
    }
}
