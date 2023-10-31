<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Hash;

class AccountController extends Controller
{
    public function account(){
        return view('frontend.account');
    }

    public function updateAccount(Request $request){
        $user = \Auth::guard('web')->user();
        if($request->avatar){
            $file = $request->avatar;
            $imageName = $file->hashName();
            $res = $file->storeAs('avatars', $imageName, 'public');
            if($res){
                $user->avatar = 'avatars/' . $imageName;
            }
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        toastr()->success('Cập nhật tài khoản thành công.');
        return redirect()->back();
    }

    public function orderHistory(){
        $orders = Order::where('user_id', \Auth::guard('web')->id())->orderByDesc('id')->paginate(10);
        return view('frontend.order-history', compact('orders'));
    }

    public function cancel(Order $order){
        $order->status = 0;
        $order->save();
        toastr()->success('Hủy đơn hàng thành công.');
        return redirect()->back();
    }

    public function receive(Order $order){
        foreach($order->products as $item){
            $item->sold += $item->pivot->quantity;
            $item->save();
        }
        $order->status = 4;
        $order->save();
        toastr()->success('Nhận hàng thành công.');
        return redirect()->back();
    }
    public function return(Order $order){
        $order->status = 1;
        $order->save();
        toastr()->success('Đơn hàng đã được hoàn trả.');
        return redirect()->back();
    }

    public function orderDetail(Order $order){
        return view('frontend.order-detail', compact('order'));
    }

    public function changePassword(){
        return view('frontend.change-password');
    }

    public function updatePassword(Request $request){
        $user = \Auth::guard('web')->user();

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ],[
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        toastr()->success('Thay đổi mật khẩu thành công.');
        return redirect()->back();

    }
}
