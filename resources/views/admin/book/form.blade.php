<div class="box box-info padding-1">
    <div class="box-body">
        <!-- Tên sách -->
        <div class="form-group required">
            {{ Form::label('Tên sách') }}
            {{ Form::text('BookTitle', $book->BookTitle, ['class' => 'form-control' . ($errors->has('BookTitle') ? ' is-invalid' : '')]) }}
            {!! $errors->first('BookTitle', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Tên tác giả -->
        <div class="form-group required">
            {{ Form::label('Tên tác giả') }}
            {{ Form::text('Author', $book->Author, ['class' => 'form-control' . ($errors->has('Author') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Author', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Nhà xuất bản -->
        <div class="form-group required">
            {{ Form::label('Nhà xuất bản') }}
            <select name="PublisherID" class="form-control">
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->PublisherID }}" {{ $publisher->PublisherID == $book->PublisherID ? 'selected' : '' }}>
                        {{ $publisher->PublisherName }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Giá bán và giá khuyến mại -->
        <div class="form-group required">
            {{ Form::label('Giá bán (VNĐ)') }}
            {{ Form::number('CostPrice', $book->CostPrice, ['class' => 'form-control' . ($errors->has('CostPrice') ? ' is-invalid' : '')]) }}
            {!! $errors->first('CostPrice', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Giá khuyến mại (VNĐ)') }}
            {{ Form::number('SellingPrice', $book->SellingPrice, ['class' => 'form-control' . ($errors->has('SellingPrice') ? ' is-invalid' : '')]) }}
            {!! $errors->first('SellingPrice', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Số trang và trọng lượng -->
        <div class="form-group required">
            {{ Form::label('Số trang') }}
            {{ Form::number('PageCount', $book->PageCount, ['class' => 'form-control' . ($errors->has('PageCount') ? ' is-invalid' : '')]) }}
            {!! $errors->first('PageCount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group required">
            {{ Form::label('Trọng lượng (gram)') }}
            {{ Form::number('Weight', $book->Weight, ['class' => 'form-control' . ($errors->has('Weight') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Weight', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Ảnh đại diện -->
        <div class="form-group">
            {{ Form::label('Ảnh đại diện') }}
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab"
                       aria-controls="tab1" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                       aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="AvatarUrl"
                               placeholder="https://example.com/image.jpg" value="{{ $book->Avatar }}">
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="form-group mt-4">
                        <input type="file" class="form-control-file" name="Avatar" accept="image/*">
                    </div>
                </div>
            </div>
            {!! $errors->first('Avatar', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Loại bìa -->
        <div class="form-group required">
            {{ Form::label('Loại bìa') }}
            <select name="CoverStyle" class="form-control">
                <option value="0">-- Bìa cứng --</option>
                <option value="1" {{ ($method == 'PATCH' && $book->CoverStyle == 1) ? 'selected' : '' }}>-- Bìa mềm --</option>
            </select>
        </div>

        <!-- Kích thước -->
        <div class="form-group">
            {{ Form::label('Kích thước ([Chiều Dài]x[Chiều Rộng])') }}
            {{ Form::text('Size', $book->Size, ['class' => 'form-control' . ($errors->has('Size') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Size', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Năm xuất bản -->
        <div class="form-group required">
            {{ Form::label('Năm xuất bản') }}
            {{ Form::number('YearPublished', $book->YearPublished, ['class' => 'form-control' . ($errors->has('YearPublished') ? ' is-invalid' : '')]) }}
            {!! $errors->first('YearPublished', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Mô tả -->
        <div class="form-group">
            {{ Form::label('Mô tả') }}
            {{ Form::textarea('Description', $book->Description, ['class' => 'form-control' . ($errors->has('Description') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Description', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Thể loại -->
        <div class="form-group">
            {{ Form::label('Thể loại') }}
            <div class="row">
                @foreach($genres as $genre)
                    <div class="col-md-2">
                        <div class="form-check">
                            <input type="checkbox" name="bookgenre[]" value="{{ $genre->GenreID }}"
                                   {{ in_array($genre->GenreID, $selectedGenres) ? 'checked' : '' }} class="form-check-input">
                            <label class="form-check-label">{{ $genre->GenreName }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Thuộc bộ sách -->
        <div class="form-group">
            {{ Form::label('Thuộc bộ sách') }}
            <select name="SetID" class="form-control">
                <option value="">-- Không thuộc bộ nào --</option>
                @foreach($bookSets as $bookSet)
                    <option value="{{ $bookSet->SetID }}" {{ $bookSet->SetID == $book->SetID ? 'selected' : '' }}>
                        {{ $bookSet->SetTitle }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Danh Sách Hình Ảnh Đính Kèm -->
        <div class="form-group" id="ImageAttach">
            {{ Form::label('Danh Sách Hình Ảnh Đính Kèm') }}
            <div class="row">
                @foreach($images as $image)
                    <div class="col-3 position-relative image-items d-flex align-items-center justify-content-center">
                        <img src="{{ $image->ImagePath }}" alt="{{ $image->Description }}" class="img-thumbnail rounded"
                             style="max-width: 200px">
                        <div class="image-overlay">
                            <div id="btnDeleteImage" data-imgid="{{ $image->ImageID }}" style="cursor: pointer;"><i
                                    class="fa fa-trash" aria-hidden="true"></i> Xoá
                            </div>
                        </div>
                        <input type="hidden" name="ImagesIds[]" value="{{ $image->ImageID }}">
                    </div>
                @endforeach
            </div>

            <label>Thêm ảnh đính kèm mới</label>
            <ul class="nav nav-tabs" id="myTabs2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-2-tab" data-toggle="tab" href="#tab1-2" role="tab"
                       aria-controls="tab1-2" aria-selected="true">Nhập URL ảnh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab2-2-tab" data-toggle="tab" href="#tab2-2" role="tab"
                       aria-controls="tab2-2" aria-selected="false">Tải lên tệp</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabsContent2">
                <div class="tab-pane fade show active" id="tab1-2" role="tabpanel" aria-labelledby="tab1-2-tab">
                    <div class="form-group mt-4">
                        <input type="text" class="form-control" name="ImageUrls[]"
                               placeholder="https://example.com/image.jpg">
                    </div>
                </div>
                <div class="tab-pane fade" id="tab2-2" role="tabpanel" aria-labelledby="tab2-2-tab">
                    <div class="form-group mt-4">
                        <input type="file" class="form-control-file" name="ImageUploads[]" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</div>
