<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\billstatus;
use App\User;
use Hash;
use App\Http\Requests\ContactRequest;
use App\Mail\NewContactRequest;

use App\Models\Comment;
//use Auth;

use Illuminate\Http\Request;
use Mail;


class PageController extends Controller 
{
    public function getIndex(){
        $slide = Slide::all();
    	//return view('page.trangchu',['slide'=>$slide]);
        $new_product = Product::where('new',1)->orderBy('created_at','desc')->paginate(4);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
        $banh_crepe = Product::where('id_type',3)->paginate(8);
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai','banh_crepe'));
    }

    public function getLoaiSp($type){
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $loai = ProductType::all();
        $loap_sp = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loap_sp'));
    }

    public function getChitiet(Request $req,$id){
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
        $comments = Comment::where('com_product',$id)->get();
        $new_product = Product::where('id_type',$sanpham->id_type)->paginate(4);
        $sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(4);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','comments','new_product','sanpham_khuyenmai'));
    }

    public function getLienHe(){
    	return view('page.lienhe');
    }

    public function getGioiThieu(){
    	return view('page.gioithieu');
    }

    public function getAddtoCart(Request $req,$id,$quantity =1){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function getCheckout(){
        return view('page.dat_hang');
    }

    public function postCheckout(Request $req){
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->status_id = 1;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');

    }

    public function getLogin(){
//        dd(Auth::check());
        if(Auth::check()){
            return redirect('/');
        }
        return view('page.dangnhap');
    }
    public function getSignin(){
        return view('page.dangki');
    }

    public function postSignin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tự'
            ]
        );
        $credentials = array('email'=>$req->email,'password'=>$req->password);
//        dd(Hash::make($req->password));
        $user = User::where([
                ['email','=',$req->email],
            ])->first();

        if($user){
            if(Auth::attempt($credentials)){
                return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
            }
            else{
                return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
            }
        }
        else{
           return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản không tồn tại']);
        }
        
    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function addProduct(Request $request){
        $product = new Product;
        $product->name = $request->name;
        $product->id_type = $request->type;
        $product->description = $request->desc;
        $product->unit_price = $request->price;
        $product->promotion_price = $request->promotion;
        $product->unit = $request->unit;
        $product->new = $request->new=='on'?1:0;
        //img
        if ($request->hasFile('img')) {
            $file = $request->img;
            $file->move('uploads', $file->getClientOriginalName());
            $product->image = $file->getClientOriginalName();
        }
        $product->save();

        return redirect()->back()->with('thongbao','Thêm sản phẩm thành công');
    }

    public function listProduct() {
        $products = Product::all();
        return view('admin.list-product' ,compact('products'));
    }

    //Add product type
    public function addProductType(Request $request){
        $productType = new ProductType;
        $productType->name = $request->name;
        $productType->description = $request->desc;
        if ($request->hasFile('img')) {
            $file = $request->img;
            $file->move('uploads', $file->getClientOriginalName());
            $productType->image = $file->getClientOriginalName();
        }
        $productType->save();

        return redirect()->back()->with('thongbao','Thêm loại sản phẩm thành công');

    }
    //Add customer
    public function addCustomer(Request $request){
        $customer = new Customer;
        $customer->id = $request->id;
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->address= $request->address;
        $customer->phone_number=$request->phone;
        $customer->note=$request->note;
        $customer->save();
        return redirect()->back()->with('thongbao','Thêm khách hàng thành công');
    }
    public function addBill(Request $request){
        $bill = new Bill;
        $bill->id_customer = $request->id;
        $bill->date_order = $request->date_order;
        $bill->total = $request->total;
        $bill->payment = $request->payment;
        $bill->note=$request->note;
        $bill->save();
        return redirect()->back()->with('thongbao','Thêm bill của khách hàng thành công');
    }
    // List product type
    public function listProductType(Request $request) {
        $productType = ProductType::all();
        return view('admin.list-product-type' ,compact('productType'));
    }

    // List customer
    public function listCustomer(){
        $customer = Customer::all();
        return view('admin.list-customer',compact('customer'));
    }
    //List bill
    public function listBill(){
        $bills = Bill::all();
        $customers = array();
        $status = array();
        foreach($bills as $bill){
            $customer = array();
            $customer_name = Customer::find($bill->id_customer)->name;
            $customers[$bill->id] = $customer_name;
            $status_bill = array();
            $status_bill_name = billstatus::find($bill->status_id)->name;
            $status[$bill->id]= $status_bill_name;
        }
       
        
        
      
        return view('admin.list-bill',compact('bills','customers','status'));
    }


    public function editProduct(Request $request, $id = null){
        if($request->isMethod('get')){
            $product_type = ProductType::all();
            $product = Product::find($id);
            return view('admin.edit-product',compact('product','product_type'));
        }else{
            $product = Product::find($id);

            $product->name = $request->name;
            $product->id_type = $request->type;
            $product->description = $request->desc;
            $product->unit_price = $request->price;
            $product->promotion_price = $request->promotion;
            $product->unit = $request->unit;
            $product->new = $request->new=='on'?1:0;
            if($request->hasFile('img')){
                $file = $request->img;
                if ($product->image != $file->getClientOriginalName()) {
                    $file->move('source/image/product', $file->getClientOriginalName());
                    $product->image = $file->getClientOriginalName();
                }
            }

            $product->save();
            return redirect()->back()->with('thongbao','Cập nhật sản phẩm thành công');
        }
        
    }

    public function editCustomer(Request $request, $id = null){
        if($request->isMethod('get')){
            
            $customer = Customer::find($id);
            return view('admin.edit-customer',compact('customer'));
        }else{
            $customer = Customer::find($id);

            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone;
            $customer->note = $request->note;

            $customer->save();
            return redirect()->back()->with('thongbao','Cập nhật nhân viên mới thành công');
        }
    }
    //edit bill
    public function editbill(Request $request, $id = null){
        if($request->isMethod('get')){
            
            $bill = Bill::find($id);
            return view('admin.edit-bill',compact('bill'));
        }else{
            $bill = Bill::find($id);

            $bill->id = $request->id1;
            $bill->id_customer = $request->id;
            $bill->date_order = $request->date_order;
            $bill->total = $request->total;
            $bill->payment = $request->payment;
            $bill->note = $request->note;
            $bill->status_id = $request->status_id;

            $bill->save();
            return redirect()->back()->with('thongbao','Cập nhật nhân viên mới thành công');
        }
    }
        public function editProductType(Request $request, $id = null){
            if($request->isMethod('get')){
                $product = Product::all();
                $productType = ProductType::find($id);
                return view('admin.edit-product-type',compact('productType','product'));
            }else{
                $productType = ProductType::find($id);
    
                $productType->name = $request->name;
                $productType->description = $request->desc;
                
                if($request->hasFile('img')){
                    $file = $request->img;
                    if ($productType->image != $file->getClientOriginalName()) {
                        $file->move('source/image/product', $file->getClientOriginalName());
                        $productType->image = $file->getClientOriginalName();
                    }
                }
    
                $productType->save();
                return redirect()->back()->with('thongbao','Cập nhật sản phẩm thành công');
            }
            
        
    }
    public function removeProduct($id){
        Product::destroy($id);
        return redirect()->back()->with('thongbao','Xóa sản phẩm thành công');
    }
    public function removeBill($id){
        Bill::destroy($id);
        return redirect()->back()->with('thongbao','Xóa hóa đơn thành công');
    }
    
    

    public function dashboard(){
        $bills = Bill::all();
        $orders = $bills->count();
        $customers = Customer::all()->count();
        $products = Product::all()->count();
        $total = 0;
        foreach($bills as $bill){
            $total += $bill->total;
        }
//        dd($orders);
        return view('admin.dashboard',compact('orders','customers','products','total'));
    }
    // nút seach
    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->s.'%')
        ->orWhere('unit_price',$req->s)->get();
        return view('page.search',compact('product'));

    }
    //Chức năng bình luận 
    public function PostComment(Request $request ,$id){
       $comment = new Comment;
       $comment->com_name = $request->name;
       $comment->com_email = $request->email;
       $comment->com_content=$request->binhluan;
       $comment->com_product = $id;
       $comment->save();
       return back();

    }
    //Xử lý form liên hệ
    public function show(){
        return view('page.lienhe');
    }
    public function mail(ContactRequest $Request){
        Mail::to('tranphat0410@gmail.com')->send(new NewContactRequest($Request));
        return back()->with('status','Your message have been received');
    }

}
