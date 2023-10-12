@extends("layouts.app")
@section("main")
    <div class="alert alert-success" role="alert">
        {{session("success")}}
    </div>

    @if(count($cart)==0)
        <p>không có sản phẩm nào trong giỏ hàng</p>
    @else
        <!-- Breadcrumb Section Begin -->

        <!-- Breadcrumb Section End -->

        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ $item->thumbnail }}" width="100px" alt="">
                                            <h5>{{ $item->name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <form action="{{ url("/update-cart", ["product" => $item->id]) }}" method="post">
                                                    @csrf
                                                    <div class="pro-qty">
                                                        <input type="text" name="buy_qty" value="{{ $item->buy_qty }}">
                                                    </div>
                                                    @if($item->buy_qty > $item->qty)
                                                        <p class="text-danger">Sản phẩm đã hết hàng</p>
                                                    @endif
                                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ $item->price * $item->buy_qty }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ url("/remove-from-cart", ["product" => $item->id]) }}" class="icon_close"></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__btns">
                            <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                            <a href="{{ route('clearCart') }}" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                <span>Xóa giỏ hàng</span></a>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                <form action="#">
                                    <input type="text" placeholder="Enter your coupon code">
                                    <button type="submit" class="site-btn">APPLY COUPON</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                <li>Subtotal <span>${{$subtotal}}</span></li>
                                <li>VAT <span>10%</span></li>
                                <li>Total <span>${{$total}}</span></li>
                            </ul>
                            <a href="{{url("/checkout")}}" class="primary-btn btn @if(!$can_checkout) disabled @endif">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
        <!-- Shoping Cart Section End -->
        @endsection
