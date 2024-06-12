<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductPost;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $query = User::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('fname', 'like', '%' . $search_query . '%')
                    ->orWhere('lname', 'like', '%' . $search_query . '%')
                    ->orWhere('email', 'like', '%' . $search_query . '%')
                    ->orWhere('phone_no', 'like', '%' . $search_query . '%');
            });
        }
        $data['users'] = $query->orderBy('id', 'DESC')->paginate(50);
        $data['searchParams'] = $request->all();
        return view('admin/users/manage_users', $data);
    }
    public function add()
    {
        return view('admin/users/add_user');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|unique:users,email,' . $request->id . ',id',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone_no = $request->phone_no ?? '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/users');
            $image->move($destinationPath, $image_name);
            $user->image_name = $image_name;
        }
        $user->status = '0';
        $query = $user->save();
        if ($query) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            $headers = "From: webmaster@example.com\r\n";
            $headers .= "Reply-To: webmaster@example.com\r\n";
            $headers .= "Content-Type: text/html\r\n";
            $subject = 'An Admin Invited You To Join My Baja Property';
            $emailTemplate = view('emails.invite', compact(['credentials']))->render();
            $sendMail = mail($request->email, $subject, $emailTemplate, $headers);
            if ($sendMail) {
                return redirect('admin/users')->with('success', 'User added successfully.');
            } else {
                return redirect('admin/users')->with('success', 'User added successfully. But failed to send email.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $user = User::where('id', $request->id)->first();
        if (!empty($user)) {
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->phone_no = $request->phone_no ?? '';
            $user->password = $request->password ? bcrypt($request->password) : $user->password;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/users');
                $image->move($destinationPath, $image_name);
                if ($user->image_name != 'user.png') {
                    $image_path = public_path() . '/uploads/users/' . $user->image_name;
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
                $user->image_name = $image_name;
            }
            $query = $user->save();
            if ($query) {
                return redirect()->back()->with('success', 'User updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function user_details($id)
    {
        $data['user'] = User::where('id', $id)->first();
        if ($data['user']->image_name != null && $data['user']->image_name != 'user.png') {
            $data['user']->image = asset('uploads/users/' . $data['user']->image_name);
        } else {
            $data['user']->image = asset('assets/upload_images/user.png');
        }
        unset($data['user']->image_name);
        if (!empty($data['user'])) {
            return view('admin/users/users_details', $data);
        }

        return view('common/admin_404');
    }
    public function update_statuses(Request $request)
    {
        $data = $request->all();
        $status = User::where('id', $data['id'])->update([
            'is_blocked' => $data['status'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($status > 0) {
            if ($data['status'] == '1') {
                $finalResult = response()->json(['msg' => 'success', 'response' => 'User blocked successfully.']);
            } else {
                $finalResult = response()->json(['msg' => 'success', 'response' => 'User unblocked successfully.']);
            }
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }
    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if (!empty($user)) {
            if ($user->image_name != 'user.png') {
                $image_path = public_path() . '/uploads/users/' . $user->image_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $user->delete();
            $finalResult = response()->json(['msg' => 'success', 'response' => 'User deleted successfully.']);
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
        }
        return $finalResult;
    }
}
