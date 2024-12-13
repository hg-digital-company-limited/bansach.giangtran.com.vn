<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\admin\ShippingAddress;
use App\Models\SalesOrder;
use Carbon\Carbon;

class AccountController extends Controller
{
    const MAX_ADDRESSES = 3; // Giới hạn số địa chỉ

    public function AccountDetail()
    {
        $userId = Session::get('user')->UserID;

        // Lấy danh sách địa chỉ giao hàng và đơn hàng
        $shippingAddressList = ShippingAddress::where('UserID', $userId)->get();
        $orders = SalesOrder::where('UserID', $userId)
            ->where('OrderStatus', '!=', 'COMPLETED')
            ->get();

        return view("user.account-detail", [
            'numberAdd' => $shippingAddressList->count(),
            'shippingAddressList' => $shippingAddressList, // Đảm bảo sử dụng đúng biến
            'orders' => $orders
        ]);
    }

    public function updateAccount(Request $request)
    {
        $user = Session::get('user');

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'userName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dateOfBirth' => 'nullable|date',
            'phoneNumber' => 'nullable|regex:/^[0-9]{10}$/',
            'gender' => 'nullable|in:Male,Female,Other',
            'new-pass' => 'nullable|min:8',
            'new-pass-confirm' => 'nullable|same:new-pass',
        ]);

        // Cập nhật thông tin người dùng
        try {
            $user->UserName = $validatedData['userName'];
            $user->FirstName = $validatedData['firstName'];
            $user->LastName = $validatedData['lastName'];
            $user->DateOfBirth = $validatedData['dateOfBirth'] ?? $user->DateOfBirth;
            $user->PhoneNumber = $validatedData['phoneNumber'] ?? $user->PhoneNumber;
            $user->Gender = $validatedData['gender'] ?? $user->Gender;

            // Xử lý thay đổi mật khẩu
            if (!empty($validatedData['new-pass'])) {
                $user->password = Hash::make($validatedData['new-pass']);
            }

            // Lưu thông tin người dùng
            $user->save();
            return response()->json(['message' => 'Thông tin tài khoản đã được cập nhật thành công.']);
        } catch (\Exception $e) {
            \Log::error('Lỗi cập nhật tài khoản: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function AddAddress()
    {
        return view('user.add-address');
    }

    public function addNewAddress(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'userID' => 'required|integer',
            'default' => 'boolean',
        ]);

        try {
            // Tạo bản ghi mới
            ShippingAddress::create([
                'UserID' => $request->userID,
                'Name' => $request->name,
                'City' => $request->city,
                'District' => $request->district,
                'Ward' => $request->ward,
                'Address' => $request->address,
                'Phone' => $request->phone,
                'Default' => $request->default,
            ]);

            return response()->json(['message' => 'Địa chỉ đã được thêm thành công.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi lưu địa chỉ: ' . $e->getMessage()], 500);
        }
    }

    public function updateAddress(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'userID' => 'required|integer',
            'addressID' => 'required|integer',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'isDefault' => 'nullable|boolean',
        ]);

        $address = ShippingAddress::find($validatedData['addressID']);
        if (!$address) {
            return response()->json(['error' => true, 'message' => 'Địa chỉ không tồn tại'], 404);
        }

        // Cập nhật thông tin địa chỉ
        $address->UserID = $validatedData['userID'];
        $address->FullName = $validatedData['name'];
        $address->City = $validatedData['city'];
        $address->Address = $validatedData['address'];
        $address->PhoneNumber = $validatedData['phone'];
        $address->District = $validatedData['district'];
        $address->Ward = $validatedData['ward'];
        $address->IsDefault = $validatedData['isDefault'] ? 1 : 0;

        // Cập nhật địa chỉ mặc định
        if ($validatedData['isDefault']) {
            ShippingAddress::where('UserID', $validatedData['userID'])
                ->where('AddressID', '!=', $validatedData['addressID'])
                ->update(['IsDefault' => 0]);
        }

        try {
            $address->save();
            return response()->json(['message' => 'Đã cập nhật địa chỉ thành công', 'status' => 200]);
        } catch (\Exception $e) {
            \Log::error('Lỗi cập nhật địa chỉ: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }

    public function AddressList()
    {
        // Lấy danh sách địa chỉ của người dùng hiện tại
        $userId = Session::get('user')->UserID;
        $shippingAddressList = ShippingAddress::where('UserID', $userId)->get();

        return view('user.address-list', [
            'shippingAddressList' => $shippingAddressList // Đảm bảo sử dụng đúng biến
        ]);
    }
}
