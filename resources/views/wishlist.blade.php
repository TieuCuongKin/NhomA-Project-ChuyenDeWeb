@extends('layout.master')
@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
			<!-- container -->
    <div class="container-fluid about py-5">
		<div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Wish list</h2>
                <h1 class="display-4 text-uppercase">Your Wish</h1>
            </div>
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
        <div class="container"> 
            <table id="wish" class="table table-hover table-condensed"> 
                <thead> 
                <tr> 
                    <th style="width:10%">STT</th>
                    <th style="width:10%">Ảnh sản phẩm</th>  
                    <th style="width:25%">Tên sản phẩm</th> 
                    <th style="width:15%">Giá</th> 
                    <th style="width:10%">Thao Tác</th> 
                </tr> 
                </thead> 
                @if($wishlist->count() > 0)
                   <tbody>
                   <?php $n = 1; ?>
                    @foreach($wishlist as  $item)
                    <tr> 
                        <td>{{$n}}</td>
                        <td data-th="Image"> 
                                <div class="col-sm-2 hidden-xs"><img src="{{ asset('/img') }}/{{ $item->product->image }}" style="width: 80px" alt="">
                                </div>  
                        </td>
                        <td data-th="Product"> 
                                <div class="col-sm-10"> 
                                    <h4 class="nomargin"><a href="{{ route('thongtinsp',$item->product->id) }}">{{$item->product->product_name}}</a></h4>  
                                </div> 
                        </td>
                        <td data-th="Price">{{number_format($item->product->price,0,',','.')}} VND</td>   
                        <td class="actions" data-th="">
                            <a href="{{route('wish.remove',$item->product_id)}}"><button class="btn btn-danger btn-sm" ><i class="fa fa-heartbeat"></i></button></a>
                        </td>
                    </tr>
                    <?php $n++ ?>
                    @endforeach
                    </tbody>         
                @else
                <tbody>
                    <td colspan="5" class="text-center p-5"><h4>There are no product in your WishList</h4></td>
                </tbody>          
                @endif
             
        </table>
</div>
@stop