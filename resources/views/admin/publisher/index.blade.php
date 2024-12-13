@extends('admin.layout.default')

@section('template_title')
    Nhà xuất bản
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="dt-buttons btn-group flex-wrap">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="exportData"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Xuất dữ liệu
                            </button>
                            <div class="dropdown-menu" aria-labelledby="exportData">
                                <a class="dropdown-item" href="#" id="buttons-excel">Excel</a>
                                <a class="dropdown-item" href="#" id="buttons-pdf">PDF</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('publisher.create') }}" class="btn btn-primary float-right"
                       data-placement="left">
                        {{ __('Thêm mới') }}
                    </a>
                    <div class="dataTables_filter" style="padding: 0; padding-top: 0.75rem">
                        <input type="search" class="form-control form-control-sm" placeholder="Tìm kiếm..."
                               aria-controls="example1">
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table data-bs-spy="scroll"
                                       class="table table-bordered table-striped dataTable dtr-inline table-hover"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>Mã NXB</th>
                                        <th>Tên NXB</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Ngày sửa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($publishers as $pbl)
                                        <tr class="even" onmouseover="readListScripts.showTableActions()"
                                            onmouseleave="readListScripts.hideTableActions()">
                                            <td>{{ $pbl->PublisherID }}</td>
                                            <td>{{ $pbl->PublisherName }}</td>
                                            <td>{{ $pbl->IsActive ? 'Đang hoạt động' : 'Ngưng hoạt động' }}</td>
                                            <td>{{ $pbl->CreatedDate }}</td>
                                            <td>{{ $pbl->ModifiedDate }}</td>
                                            <td>{{ $pbl->ModifiedBy }}</td> <!-- Sửa lại ở đây -->
                                            <td style="position: absolute; right: 0; display: none">
                                                <div style="position: sticky;">
                                                    <form action="{{ route('publisher.destroy', $pbl->PublisherID) }}"
                                                          method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                           href="{{ route('publisher.show', $pbl->PublisherID) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success"
                                                           href="{{ route('publisher.edit', $pbl->PublisherID) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                {!! $publishers->links() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                    Hiển thị {{ $i + 1 }} đến {{ $i + $publishers->count() }} trong tổng
                                    số {{ $publishers->total() }} bản ghi
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('exportToExcelScripts')
    <script>
        function exportToExcel() {
            let tableName = 'publisher';
            let apiUrl = `/api/${tableName}/all`;
            alert('Đang xuất thành file ' + tableName + '.xlsx');
            // Lấy dữ liệu từ API
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Chuyển đổi dữ liệu thành định dạng Excel
                    const workbook = XLSX.utils.book_new();
                    const worksheet = XLSX.utils.json_to_sheet(data);
                    XLSX.utils.book_append_sheet(workbook, worksheet, tableName);

                    // Xuất Excel
                    XLSX.writeFile(workbook, tableName + '.xlsx');
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    </script>
@endsection
