@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{$sanpham->image}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h2>{{$sanpham->name}}</h2></p>
								<p class="single-item-price">
									@if($sanpham->promotion_price==0)
										<span class="flash-sale">{{number_format($sanpham->unit_price)}} đồng</span>
									@else
										<span class="flash-del">{{number_format($sanpham->unit_price)}} đồng</span>
										<span class="flash-sale">{{number_format($sanpham->promotion_price)}} đồng</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$sanpham->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Số lượng:</p>
							
							<div class="single-item-options">
						
							
								
								<select class="wc-select" name="color">
								
									<option>Số lượng</option>
									<option value="1" >1</option>
									<option value="2" >2</option>
									<option value="3" >3</option>
									<option value="4" >4</option>
									<option value="5" >5</option>
									
								</select>
								<a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
							
							
						</div>
					</div>
			
					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$sanpham->description}}</p>
						</div>
					</div>
					<h2 style="text-align:center;margin-top:50px">Bình luận </h2>
					<form role="form" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">@if(Session::has('thongbao')){{Session::get('thongbao')}}@endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product-name">Email</label>
                            <input type="text" class="form-control" id="product-name" name="email" placeholder="Enter your email">
                        </div>
						<div class="form-group">
                            <label for="product-name">Tên</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Enter your name">
                        </div>
						<div class="form-group">
                            <label>Bình luận</label>
                            <textarea class="form-control" id="product-desc" name="binhluan" rows="3" placeholder="Enter product comment">
                            </textarea>
                        </div>
						<div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
						</div>
						<div class="row list-product">
						   <div class="col-md-12 comment-list"style="background : black;margin-top:10px;border-radius:35px;padding-bottom:10px">
						      <div class="col-md-9 comment" style="padding-left:0;padding-top:15px">
							   @foreach($comments as $comment)
							     <ul>
								    <li class="com-title" style="list-style:none;color:white;font-size:15px">
									{{$comment->com_name}}
									<br>
									<span style="color:white;font-size:15px">{{date('d/m/Y H:i',strtotime($comment->created_at))}}</span>
									</li>
									<li class="com-datails"style="list-style:none;color:white;font-size:15px">
									   {{$comment->com_content}}
									</li>
								</ul>
								@endforeach
								</div>
							</div>
						</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm tương tự</h4>

						<div class="row">
						@foreach($sp_tuongtu as $sptt)
							<div class="col-sm-4" style="margin-bottom: 10px;">
								<div class="single-item">
									@if($sptt->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{route('chitietsanpham',$sptt->id)}}"><img src="source/image/product/{{$sptt->image}}" alt="" height="150px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sptt->name}}</p>
										<p class="single-item-price" style="font-size: 18px">
											@if($sptt->promotion_price==0)
												<span class="flash-sale">{{number_format($sptt->unit_price)}} đồng</span>
											@else
												<span class="flash-del">{{number_format($sptt->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format($sptt->promotion_price)}} đồng</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption" style="margin-top: 5px;">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}" ><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$sptt->id)}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
						<div class="row">{{$sp_tuongtu->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Sale</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($sanpham_khuyenmai as $spkm)
								<div class="media beta-sales-item">
									<div class="single-item">
										<div class="pull-left">
											<a href="{{route('chitietsanpham',$spkm->id)}}"><img src="source/image/product/{{$spkm->image}}" alt="" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$spkm->name}}</p>
											<p class="single-item-price"  style="font-size: 18px">
												<span class="flash-sale">{{number_format($spkm->promotion_price)}} đồng</span>
											</p>
										</div>
										<div class="single-item-caption" style="margin-top: 5px;">
											<a class="add-to-cart pull-left" href="{{route('themgiohang',$spkm->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$spkm->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								
									@foreach($new_product as $new)
									<div class="media beta-sales-item">
									<div class="single-item">
									@if($new->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										<div class="pull-left">
											<a href="{{route('chitietsanpham',$new->id)}}"><img src="source/image/product/{{$new->image}}" alt="" ></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$new->name}}</p>
											<p class="single-item-price" style="font-size: 18px">
											@if($new->promotion_price==0)
												<span class="flash-sale">{{number_format($new->unit_price)}} đồng</span>
											@else
												
												<span class="flash-sale">{{number_format($new->promotion_price)}} đồng</span>
											@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('themgiohang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$new->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection