@extends('user.layout.layout')

@section('content')
    <div class="main-content w-100 float-left">
        <div class="container">
            <div class="row">
                <div class="content-wrapper col-xl-9 col-lg-9 order-lg-2">
                    <header class="product-grid-header d-flex d-xs-block d-sm-flex d-lg-flex w-100 float-left">
                        <div class="hidden-sm-down total-products d-flex d-xs-block d-lg-flex col-md-3 col-sm-3 col-xs-12 align-items-center">
                            <div class="row">
                                <div class="nav" role="tablist">
                                    <a class="grid active" href="#grid" data-toggle="tab" role="tab"
                                        aria-selected="true" aria-controls="grid"><i
                                            class="material-icons align-middle">grid_on</i></a>
                                    <a class="list" href="#list" data-toggle="tab" role="tab" aria-selected="false"
                                        aria-controls="list"><i
                                            class="material-icons align-middle">format_list_bulleted</i></a>
                                    <a class="sort" href="#sort-view" data-toggle="tab" role="tab"
                                        aria-selected="false" aria-controls="sort-view"><i
                                            class="material-icons align-middle">reorder</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="shop-results-wrapper d-flex d-sm-flex d-xs-block d-lg-flex justify-content-end col-md-9 col-sm-9 col-xs-12">
                            <div class="shop-results d-flex align-items-center"><span>Hiện</span>
                                <div class="shop-select">
                                    <select name="number" id="number">
                                        <option value="9">9</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="shop-results d-flex align-items-center"><span>Sắp xếp theo</span>
                                <div class="shop-select">
                                    <select name="sort" id="sort">
                                        <option id="default" value="position">Mặc định</option>
                                        <option id="outstanding" value="p-name">Nổi bật</option>
                                        <option id="pricesell" value="p-price">Giá</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </header>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const priceFilters = document.querySelectorAll('.form-check-input'); // Các checkbox lọc giá
                            const products = document.querySelectorAll('.product-layouts'); // Các sản phẩm

                            priceFilters.forEach(filter => {
                                filter.addEventListener('change', function () {
                                    // Lấy danh sách các khoảng giá đã chọn
                                    const selectedRanges = Array.from(priceFilters)
                                        .filter(input => input.checked)
                                        .map(input => input.id);

                                    // Lọc sản phẩm
                                    products.forEach(product => {
                                        const price = parseFloat(product.dataset.price); // Lấy giá của sản phẩm
                                        let isVisible = false;

                                        // Kiểm tra sản phẩm thuộc khoảng giá nào
                                        if (selectedRanges.includes('price-1') && price <= 25) isVisible = true;
                                        if (selectedRanges.includes('price-2') && price > 25 && price <= 50) isVisible = true;
                                        if (selectedRanges.includes('price-3') && price > 50 && price <= 75) isVisible = true;
                                        if (selectedRanges.includes('price-4') && price > 75) isVisible = true;

                                        // Hiển thị hoặc ẩn sản phẩm
                                        product.style.display = isVisible ? 'block' : 'none';
                                    });
                                });
                            });
                        });
                    </script>

                    @if(!empty($textSearch))
                        <h5 data-textsearch="{{$textSearch}}">Kết quả tìm kiếm cho: "{{ $textSearch }}"</h5>
                    @endif
                    <div class="tab-content text-center products w-100 float-left">
                        <div class="tab-pane grid fade active" id="grid" role="tabpanel">
                            <div class="row showProFilter1">
                                @foreach($products as $product)
                                <div class="product-layouts col-lg-3 col-md-3 col-sm-6 col-xs-6" data-price="{{ $product->SellingPrice }}">

                                    <div class="product-thumb">
                                        <div class="image zoom">
                                            <a href="{{ route('product-detail', $product->BookID) }}">
                                                <img src="{{$product->Avatar}}" alt="01" />
                                                <img src="{{$product->Avatar}}" alt="02"
                                                    class="second_image img-responsive" /> </a>
                                        </div>
                                        <div class="thumb-description">
                                            <div class="caption">
                                                <h4 class="product-title text-capitalize"><a
                                                        href="{{ route('product-detail', $product->BookID) }}">{{$product->BookTitle}}</a></h4>
                                            </div>
                                            <div class="rating">
                                                <div class="product-ratings d-inline-block align-middle">
                                                    {{-- @php
                                                        $starRatingHTML = '';

                                                        $star = $product->AVGRating >= 5 ? 5 : $product->AVGRating;
                                                    for($i = 0; $i < $star; $i++){
                                                        $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons'>star</i></span>";
                                                    }
                                                    for( $i = $star; $i < 5; $i++){
                                                        $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons off'>star</i></span>";
                                                    }

                                                    echo $starRatingHTML;
                                                    @endphp --}}
                                                </div>
                                            </div>

                                            <div class="price">
                                                <div class="regular-price">{{ number_format($product->SellingPrice, 0, ',', '.') }}₫</div>
                                                <div class="old-price">{{ number_format($product->CostPrice, 0, ',', '.') }}₫</div>
                                            </div>
                                            <div class="button-wrapper">
                                                <div class="button-group text-center">
                                                    <button type="button" class="btn btn-primary btn-cart"
                                                        data-target="#cart-pop" data-toggle="modal"
                                                        data-book-name="{{ $product->BookTitle }}"
                                                        data-book-price="{{ $product->SellingPrice }}"
                                                        data-book-id="{{ $product->BookID }}">
                                                        <i class="material-icons">shopping_cart</i>
                                                    </button>
                                                    <a href="wishlist.html" class="btn btn-primary btn-wishlist"><i
                                                            class="material-icons">favorite</i><span>wishlist</span></a>
                                                    <button type="button" class="btn btn-primary btn-compare"><i
                                                            class="material-icons">equalizer</i><span>Compare</span></button>
                                                    <button type="button" class="btn btn-primary btn-quickview"
                                                        data-toggle="modal" data-target="#product_view"><i
                                                            class="material-icons">visibility</i><span>Quick
                                                            View</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade list text-left showProFilter2" id="list" role="tabpanel">
                            @foreach($products as $product)
                            <div class="product-layouts">
                                <div class="product-thumb row">
                                    <div class="image zoom col-xs-12 col-sm-5 col-md-4">
                                        <a href="{{ route('product-detail', $product->BookID) }}" class="d-block position-relative">
                                            <img src="{{$product->Avatar}}" alt="01" />
                                            <img src="{{$product->Avatar}}" alt="02"
                                                 class="second_image img-responsive" />
                                        </a>
                                    </div>
                                    <div class="thumb-description col-xs-12 col-sm-7 col-md-8 position-static text-left">
                                        <div class="caption">
                                            <h4 class="product-title text-capitalize"><a
                                                    href="{{ route('product-detail', $product->BookID) }}">{{ $product->BookTitle }}</a></h4>
                                        </div>
                                        <div class="rating mb-10">
                                            <div class="product-ratings d-inline-block align-middle">
                                                {{-- @php
                                                    $starRatingHTML = '';

                                                    $star = $product->AVGRating >= 5 ? 5 : $product->AVGRating;
                                                for($i = 0; $i < $star; $i++){
                                                    $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons'>star</i></span>";
                                                }
                                                for( $i = $star; $i < 5; $i++){
                                                    $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons off'>star</i></span>";
                                                }

                                                echo $starRatingHTML;
                                                @endphp --}}
                                            </div>
                                        </div>

                                        <div class="description">
                                            {{ $product->Description }} </div>

                                        <div class="price">
                                            <div class="regular-price">{{ number_format($product->SellingPrice, 0, ',', '.') }}₫</div>
                                            <div class="old-price">{{ number_format($product->CostPrice, 0, ',', '.') }}₫</div>
                                        </div>
                                        <div class="color-option d-flex align-items-center float-left w-100">
                                            <ul class="color-categories">
                                                <li>
                                                    <a class="tt-pink" href="#" title="Pink"></a>
                                                </li>
                                                <li>
                                                    <a class="tt-blue" href="#" title="Blue"></a>
                                                </li>
                                                <li>
                                                    <a class="tt-yellow" href="#" title="Yellow"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="button-wrapper">
                                            <div class="button-group text-center">
                                                <button type="button" class="btn btn-primary btn-cart"
                                                        data-target="#cart-pop" data-toggle="modal" disabled="disabled"><i
                                                        class="material-icons">shopping_cart</i><span>out of
                                                        stock</span></button>
                                                <a href="wishlist.html" class="btn btn-primary btn-wishlist"><i
                                                        class="material-icons">favorite</i><span>wishlist</span></a>
                                                <button type="button" class="btn btn-primary btn-compare"><i
                                                        class="material-icons">equalizer</i><span>Compare</span></button>
                                                <button type="button" class="btn btn-primary btn-quickview"
                                                        data-toggle="modal" data-target="#product_view"><i
                                                        class="material-icons">visibility</i><span>Quick
                                                        View</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="tab-pane fade sort text-left showProFilter3" id="sort-view" role="tabpanel">
                            @foreach($products as $product)
                            <div class="product-layouts">
                                <div class="product-thumb row">
                                    <div class="image zoom col-xs-12 col-sm-3 col-md-2">
                                        <a href="{{ route('product-detail', $product->BookID) }}" class="d-block position-relative">
                                            <img src="{{$product->Avatar}}" alt="01" />
                                            <img src="{{$product->Avatar}}" alt="02"
                                                 class="second_image img-responsive" /> </a>
                                    </div>
                                    <div class="thumb-description col-xs-12 col-sm-9 col-md-10 position-static text-left">
                                        <div class="sort-title col-md-5 col-sm-7 float-left">
                                            <div class="caption">
                                                <h4 class="product-title text-capitalize"><a
                                                        href="{{ route('product-detail', $product->BookID) }}">{{ $product->BookTitle }}</a></h4>
                                            </div>

                                            <div class="rating mb-10">
                                                <div class="product-ratings d-inline-block align-middle">
                                                    {{-- @php
                                                        $starRatingHTML = '';

                                                        $star = $product->AVGRating >= 5 ? 5 : $product->AVGRating;
                                                    for($i = 0; $i < $star; $i++){
                                                        $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons'>star</i></span>";
                                                    }
                                                    for( $i = $star; $i < 5; $i++){
                                                        $starRatingHTML .= "<span class='fa fa-stac'><i class='material-icons off'>star</i></span>";
                                                    }

                                                    echo $starRatingHTML;
                                                    @endphp --}}
                                                </div>
                                            </div>
                                            <div class="description mb-10">
                                                {{ $product->Description }} </div>
                                            <div class="color-option d-flex align-items-center float-left w-100">
                                                <ul class="color-categories">
                                                    <li>
                                                        <a class="tt-pink" href="#" title="Pink"></a>
                                                    </li>
                                                    <li>
                                                        <a class="tt-blue" href="#" title="Blue"></a>
                                                    </li>
                                                    <li>
                                                        <a class="tt-yellow" href="#" title="Yellow"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div
                                            class="price-main col-md-3 col-sm-5 float-left text-center text-sm-center text-xs-left">
                                            <div class="price">
                                                <div class="regular-price">{{ number_format($product->SellingPrice, 0, ',', '.') }}₫</div>
                                                <div class="old-price">{{ number_format($product->CostPrice, 0, ',', '.') }}₫</div>
                                            </div>
                                        </div>
                                        <div
                                            class="button-wrapper col-md-4 col-sm-5 float-left text-center text-md-center text-sm-center text-xs-left">
                                            <div class="button-group text-center">
                                                <button type="button" class="btn btn-primary btn-cart"
                                                        data-target="#cart-pop" data-toggle="modal" disabled="disabled"><i
                                                        class="material-icons">shopping_cart</i><span>out of
                                                        stock</span></button>
                                                <a href="wishlist.html" class="btn btn-primary btn-wishlist"><i
                                                        class="material-icons">favorite</i><span>wishlist</span></a>
                                                <button type="button" class="btn btn-primary btn-compare"><i
                                                        class="material-icons">equalizer</i><span>Compare</span></button>
                                                <button type="button" class="btn btn-primary btn-quickview"
                                                        data-toggle="modal" data-target="#product_view"><i
                                                        class="material-icons">visibility</i><span>Quick
                                                        View</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="pagination-wrapper float-left w-100">
                        <p id="pagination-left-text"></p>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" >
                                    <a class="page-link" href="#" aria-label="Previous" id="previous-page-button">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only" >Previous</span>
                                    </a>
                                </li>
                                <li class="page-item" >
                                    <a class="page-link" href="#" aria-label="Next" id="next-page-button">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only" id="next-page-button">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="left-column sidebar col-xl-3 col-lg-3 order-lg-1">
                    <div class="sidebar-filter left-sidebar w-100 float-left">
                        <div class="title">
                            <a data-toggle="collapse" href="#sidebar-main" aria-expanded="false"
                                aria-controls="sidebar-main" class="d-lg-none block-toggler">Product Categories</a>
                        </div>
                        <div id="sidebar-main" class="sidebar-main collapse">
                            <div class="sidebar-block categories">
                                <h3 class="widget-title"><a data-toggle="collapse" href="#categoriesMenu"
                                        role="button" aria-expanded="true" aria-controls="categoriesMenu">Nhóm sản
                                        phẩm</a></h3>
                                @foreach ($formattedCategories as $category)
                                <div id="categoriesMenu" class="expand-lg collapse show">
                                    <div class="nav nav-pills flex-column mt-4"> <a href="#"
                                            class="nav-link d-flex justify-content-between mb-2 "><span>{{ $category['name'] }}</span><span class="sidebar-badge"></span></a>
                                        @foreach ($category['genres'] as $genre)
                                        <div class="nav nav-pills flex-column ml-3">
                                            <a href="{{ route('proByCate', $genre->GenreID) }}" class="nav-link mb-2">{{ $genre->GenreName }}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="sidebar-block size">
                                <h3 class="widget-title"><a data-toggle="collapse" href="#size" role="button"
                                        aria-expanded="true" aria-controls="size">Giá</a></h3>
                                <div id="size" class="sidebar-widget-option-wrapper collapse show">
                                    <div class="size-inner">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="group-1" id="price-1">
                                            <label class="form-check-label" for="price-1">Free - 150,000₫</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="group-1" id="price-2">
                                            <label class="form-check-label" for="price-2">150,000₫ - 500,000₫</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="group-1" id="price-3">
                                            <label class="form-check-label" for="price-3">500,000₫ - 1,000,000₫</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="group-1" id="price-4">
                                            <label class="form-check-label" for="price-4">1,000,000₫ - 1,500,000₫</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="sidebar-block size">

                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#author" role="button" aria-expanded="true" aria-controls="author">Tác giả</a>
                                </h3>

                                <div id="author" class="sidebar-widget-option-wrapper collapse show">
                                    <div class="size-inner">
                                        @foreach($authors as $author)

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="group-2" id="author-{{ $author->Author }}">
                                                <label class="form-check-label" for="author-{{ $author->Author }}">{{ $author->Author ?? 'Tên tác giả' }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="sidebar-block size">

                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#publisher" role="button" aria-expanded="true" aria-controls="publisher">Nhà xuất bản</a>
                                </h3>

                                <div id="publisher" class="sidebar-widget-option-wrapper collapse show">
                                    <div class="size-inner">
                                        @if(isset($publisher) && $publisher->isNotEmpty())
                                            @foreach($publisher as $pub)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="group-3" id="publisher-{{ $pub->id ?? $loop->index }}">
                                                    <label class="form-check-label" for="publisher-{{ $pub->id ?? $loop->index }}">{{ $pub->name ?? 'Tên nhà xuất bản' }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Không có nhà xuất bản nào.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            // events.setOnClickBtnQuickView();
            events.handleCheckBox();
        });

        $('.btn-cart').click(function() {
        var bookID = $(this).data('book-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/cart/add',
            data: {
                book_id: bookID
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log('Product added to cart successfully.');
            },
            error: function(xhr, status, error) {
                console.error('Error adding product to cart:', error);
            }
        });
    });
    </script>
@endsection


