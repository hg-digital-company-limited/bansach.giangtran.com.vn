@extends('user.layout.layout')

@section('content')
    <div class="container mt-5">
        <h4>Thêm mới địa chỉ</h4>
        <form id="addForm">
            @csrf <!-- Thêm csrf token vào form -->
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" class="form-control" id="name" placeholder="Nhập tên" required>
            </div>

            <div class="form-group">
                <label for="city">Tỉnh/Thành phố:</label>
                <input type="text" class="form-control" id="city" placeholder="Nhập thành phố" required>
            </div>

            <div class="form-group">
                <label for="district">Quận/Huyện:</label>
                <input type="text" class="form-control" id="district" placeholder="Nhập quận">
            </div>

            <div class="form-group">
                <label for="ward">Phường/Xã:</label>
                <input type="text" class="form-control" id="ward" placeholder="Nhập phường">
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="defaultCheckbox" checked>
                <label class="form-check-label" for="defaultCheckbox">Đặt làm mặc định</label>
            </div>

            <input type="hidden" id="userID" value="{{ Auth::id() }}">
            <input type="submit" class="btn btn-primary mt-3" value="Thêm địa chỉ">
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('addForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                city: document.getElementById('city').value,
                district: document.getElementById('district').value,
                ward: document.getElementById('ward').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value,
                default: document.getElementById('defaultCheckbox').checked,
                userID: document.getElementById('userID').value
            };

            if (!formData.name || !formData.city || !formData.address || !formData.phone) {
                alert('Vui lòng điền đầy đủ thông tin.');
                return;
            }

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/api/account/addressnew', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(formData),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    alert(errorData.message || 'Có lỗi xảy ra khi gửi dữ liệu.');
                } else {
                    const data = await response.json();
                    alert(data.message); // Hiển thị thông báo thành công
                    window.location.href = "{{ route('account.detail') }}"; // Chuyển hướng nếu thành công
                }
            } catch (error) {
                console.error('Lỗi khi gửi dữ liệu:', error);
                alert('Có lỗi xảy ra. Vui lòng thử lại sau.');
            }
        });
    </script>
@endsection
