@extends('layout')
@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Product compare</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Product compare</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- STORE -->
            <div id="store" class="col-md-12">
                <!-- store products -->
                <div class="row">
                    <?php
                    foreach ($allproducts as $value) {
                        if (session()->has('compare' . $value->product_id)) {
                    ?>
                            <!-- product -->
                            <div class="col-md-6 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ url('/products/'.$value->product_id.'/'.$value->company_name) }}"><img src="{{ asset('img/'.$value->image) }}" alt=""></a>{{ $value->company_name }}
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">Category</p>
                                        <h3 class="product-name"><a href="{{ url('/products/'.$value->product_id.'/'.$value->company_name) }}">{{ $value->product_name }}</a></h3>
                                        <?php if ($value->sale > 0) { ?>
                                        <?php } else { ?>
                                        <?php } ?>
                                        <div class="product-rating">
                                            <?php for ($i = 0; $i < 5; $i++) {
                                                if ($i < $value->star) { ?>
                                                    <i class="fa fa-star"></i>
                                                <?php } else { ?>
                                                    <i class="fa fa-star-o"></i>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div>
                                            <?php $temp = explode("#", $value->description); ?>
                                            <table>
                                                <tbody>
                                                    @foreach($temp as $value)
                                                    <tr>{{ $value }}</tr><br>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product -->
                            <div class="clearfix visible-sm visible-xs"></div>
                    <?php }
                    }
                    ?>
                </div>
                <!-- /store products -->
            </div>
            <div class="newsletter">
                <p><strong><a href="{{ url('/others/clearcompare') }}" class="cta-btn">Back home <i class="fa fa-arrow-circle-right"></i></a></strong></p>
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection