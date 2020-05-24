<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\welcomeMail;


Route::get('/', 'PageController@getIndex');

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);
Route::post('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@PostComment'
]);


Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);
Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckout'
]);

Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
]);

Route::get('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);
Route::post('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@postLogin'
]);

Route::get('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@getSignin'
]);

Route::post('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@postSignin'
]);

Route::get('dang-xuat',[
	'as'=>'logout',
	'uses'=>'PageController@postLogout'
]);
Route::get('admin',function(){
	return view('admin.dashboard');
 });
 Route::get('admin','PageController@dashboard');
 
 Route::get('add-product',function(){
	return view('admin.add-product');
 });
 
 Route::post('add-product',[
	 'as'=>'add-product',
	 'uses'=>'PageController@addProduct'
 ]);
 Route::get('list-product','PageController@listProduct');
 //Product type 
 
 Route::get('add-product-type',function(){
	 return view('admin.add-product-type');
  });
  
  Route::post('add-product-type',[
	  'as'=>'add-product-type',
	  'uses'=>'PageController@addProductType'
  ]);
  //Customer
  Route::get('add-customer',function(){
	 return view('admin.add-customer');
  });
  
  Route::post('add-customer',[
	  'as'=>'add-customer',
	  'uses'=>'PageController@addCustomer'
  ]);
  //Bill
  Route::get('add-bill',function(){
	 return view('admin.add-bill');
  });
  
  Route::post('add-bill',[
	  'as'=>'add-bill',
	  'uses'=>'PageController@addBill'
  ]);
  //List product type
  Route::get('list-product-type','PageController@listProductType');
 
 //List customer
 Route::get('list-customer','PageController@listCustomer');
 //List bill
 Route::get('list-bill','PageController@listBill'); 
 
 // edit product
 Route::get('edit-product/{id}','PageController@editProduct');
 Route::post('edit-product/{id}',[
	 'as'=>'edit-product',
	 'uses'=>'PageController@editProduct'
 ]);
 //edit bill
 Route::get('edit-bill/{id}','PageController@editBill');
 Route::post('edit-bill/{id}',[
	 'as'=>'edit-bill',
	 'uses'=>'PageController@editBill'
 ]);
 //edit customer
 Route::get('edit-customer/{id}','PageController@editCustomer');
 Route::post('edit-customer/{id}','PageController@editCustomer');
 //edit loại sản phẩm
 Route::get('edit-product-type/{id}','PageController@editProductType');
 Route::post('edit-product-type/{id}',[
	 'as'=>'edit-product-type',
	 'uses'=>'PageController@editProductType'
 ]);
 //edit bill
 Route::get('edit-bill/{id}','PageController@editbill');
 Route::post('edit-bill/{id}',[
	 'as'=>'edit-bill',
	 'uses'=>'PageController@editbill'
 ]);
 Route::get('delete-product/{id}','PageController@removeProduct');
 //Xóa bill
 Route::get('delete-bill/{id}','PageController@removeBill');
 //chức năng xử lý form liên hệ
 Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@show'
]);
Route::post('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@mail'
]);




Route::get('admin','PageController@dashboard');
Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
Route::group(['middleware'=>['admin']],function(){
	Route::get('admin',function(){
		return view('admin.dashboard');
	 });
	 Route::get('admin','PageController@dashboard');
	 
	 Route::get('add-product',function(){
		return view('admin.add-product');
	 });
	 
	 Route::post('add-product',[
		 'as'=>'add-product',
		 'uses'=>'PageController@addProduct'
	 ]);
	 Route::get('list-product','PageController@listProduct');
	 //Product type 
	 
	 Route::get('add-product-type',function(){
		 return view('admin.add-product-type');
	  });
	  
	  Route::post('add-product-type',[
		  'as'=>'add-product-type',
		  'uses'=>'PageController@addProductType'
	  ]);
	  //Customer
	  Route::get('add-customer',function(){
		 return view('admin.add-customer');
	  });
	  
	  Route::post('add-customer',[
		  'as'=>'add-customer',
		  'uses'=>'PageController@addCustomer'
	  ]);
	  //Bill
	  Route::get('add-bill',function(){
		 return view('admin.add-bill');
	  });
	  
	  Route::post('add-bill',[
		  'as'=>'add-bill',
		  'uses'=>'PageController@addBill'
	  ]);
	  //List product type
	  Route::get('list-product-type','PageController@listProductType');
	 
	 //List customer
	 Route::get('list-customer','PageController@listCustomer');
	 //List bill
	 Route::get('list-bill','PageController@listBill'); 
	 
	 // edit product
	 Route::get('edit-product/{id}','PageController@editProduct');
	 Route::post('edit-product/{id}',[
		 'as'=>'edit-product',
		 'uses'=>'PageController@editProduct'
	 ]);
	 //edit bill
	 Route::get('edit-bill/{id}','PageController@editBill');
	 Route::post('edit-bill/{id}',[
		 'as'=>'edit-bill',
		 'uses'=>'PageController@editBill'
	 ]);
	 //edit customer
	 Route::get('edit-customer/{id}','PageController@editCustomer');
	 Route::post('edit-customer/{id}','PageController@editCustomer');
	 //edit loại sản phẩm
	 Route::get('edit-product-type/{id}','PageController@editProductType');
	 Route::post('edit-product-type/{id}',[
		 'as'=>'edit-product-type',
		 'uses'=>'PageController@editProductType'
	 ]);
	 //edit bill
	 Route::get('edit-bill/{id}','PageController@editbill');
	 Route::post('edit-bill/{id}',[
		 'as'=>'edit-bill',
		 'uses'=>'PageController@editbill'
	 ]);
	 Route::get('delete-product/{id}','PageController@removeProduct');
	 //Xóa bill
	 Route::get('delete-bill/{id}','PageController@removeBill');
	

   



});



