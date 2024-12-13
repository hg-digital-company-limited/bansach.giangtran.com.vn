<?php


namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
{
    const MAX_ADDRESSES = 3; // Giới hạn số địa chỉ

    public function addNewAddress(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'default' => 'boolean',
        ]);

        // Kiểm tra số lượng địa chỉ hiện tại của người dùng
        $addressCount = Address::where('user_id', Auth::id())->count();
        if ($addressCount >= self::MAX_ADDRESSES) {
            throw ValidationException::withMessages([
                'message' => 'Mỗi người dùng chỉ có thể có tối đa ' . self::MAX_ADDRESSES . ' địa chỉ.',
            ]);
        }

        // Tạo địa chỉ mới
        $addressData = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'city' => $request->city,
            'district' => $request->district,
            'ward' => $request->ward,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_default' => $request->default ?? false,
        ];

        // Nếu địa chỉ mới là mặc định, cập nhật các địa chỉ khác thành không mặc định
        if ($request->default) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create($addressData);

        // Chuyển hướng về trang hiển thị địa chỉ (giả sử bạn có route 'account.detail')
        return redirect()->route('account.detail')->with('success', 'Địa chỉ đã được thêm thành công!');
    }
}
