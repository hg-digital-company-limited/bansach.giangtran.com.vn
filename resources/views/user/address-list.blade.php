@extends('user.layout.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Danh sách địa chỉ</h2>
                <ul class="list-group" id="addressList">
                    @foreach($shippingAddressList as $address)
                        <li class="list-group-item list-group-item-action" data-id="{{ $address->AddressID }}">
                            {{ $address->Address }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <h2>Thông tin địa chỉ</h2>
                <form id="editFormAddress">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="city">Tỉnh/Thành phố</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="district">Quận/Huyện</label>
                        <input type="text" class="form-control" id="district" name="district" required>
                    </div>
                    <div class="form-group">
                        <label for="ward">Phường/Xã</label>
                        <input type="text" class="form-control" id="ward" name="ward" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- Checkbox mặc định -->
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="defaultCheckbox">
                        <label class="form-check-label" for="defaultCheckbox">Đặt làm mặc định</label>
                    </div>

                    <input type="hidden" id="addressID">
                    <input type="hidden" id="userID" value="{{ Auth::id() }}">

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const addressList = $('#addressList');
            const editFormAddress = $('#editFormAddress');
            const nameInput = $('#name');
            const cityInput = $('#city');
            const districtInput = $('#district');
            const wardInput = $('#ward');
            const addressInput = $('#address');
            const phoneInput = $('#phone');
            const defaultCheckbox = $('#defaultCheckbox');
            const addressIDInput = $('#addressID');

            addressList.on('click', '.list-group-item', function() {
                const selectedAddress = $(this);
                const addressID = selectedAddress.data('id');

                // Xóa lựa chọn cũ
                addressList.find('.selected-address').removeClass('selected-address');
                selectedAddress.addClass('selected-address');

                // Lấy thông tin địa chỉ từ API
                fetch(`/api/account/address/${addressID}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const addressData = data[0];
                            nameInput.val(addressData.FullName);
                            cityInput.val(addressData.City);
                            districtInput.val(addressData.District);
                            wardInput.val(addressData.Ward);
                            phoneInput.val(addressData.PhoneNumber);
                            addressInput.val(addressData.Address);
                            defaultCheckbox.prop('checked', addressData.IsDefault === 1);
                            addressIDInput.val(addressID);
                        }
                    })
                    .catch(error => console.error('Error fetching address:', error));
            });

            editFormAddress.on('submit', function(event) {
                event.preventDefault();

                const formData = {
                    name: nameInput.val(),
                    city: cityInput.val(),
                    district: districtInput.val(),
                    phone: phoneInput.val(),
                    address: addressInput.val(),
                    ward: wardInput.val(),
                    isDefault: defaultCheckbox.is(':checked') ? 1 : 0,
                    addressID: addressIDInput.val(),
                    userID: $('#userID').val()
                };

                fetch('/api/account/update-address', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(response => {
                    if (response.status === 200) {
                        alert(response.message);
                    } else {
                        alert('Cập nhật địa chỉ không thành công. Vui lòng thử lại.');
                    }
                })
                .catch(error => console.error('Error updating address:', error));
            });
        });
    </script>
@endsection
