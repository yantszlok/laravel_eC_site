<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Image;
use Cart;
use App\Notification\Notification\Notifiable;

class ProductController extends Controller
{

    public function Create(){

        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();

        return view('admin.product.create',compact('category','brand'));
    }

    public function Index(){

        $product = DB::table('products')
                        ->join('categories','products.category_id','categories.id')
                        ->join('brands','products.brand_id','brands.id')
                        ->select('products.*','categories.category_name','brands.brand_name')
                        ->get();
                        //return response()->json();
                        return view('admin.product.index',compact('product'));
    }

    public function Store(Request $request){
    
    $data = array();
    $data['product_name'] = $request->product_name;
    $data['product_code'] = $request->product_code;
    $data['product_quantity'] = $request->product_quantity;
    
    $data['category_id'] = $request->category_id;
    $data['brand_id'] = $request->brand_id;
    $data['product_size'] = $request->product_size;
    $data['product_color'] = $request->product_color;
    $data['selling_price'] = $request->selling_price;
    $data['product_details'] = $request->product_details;
    $data['video_link'] = $request->video_link;
    $data['main_slider'] = $request->main_slider;
    $data['hot_deal'] = $request->hot_deal;
    $data['best_rated'] = $request->best_rated;
    $data['trend'] = $request->trend;
    $data['mid_slider'] = $request->mid_slider;
    $data['hot_new'] = $request->hot_new;
    $data['buyone_getone'] = $request->buyone_getone;
    $data['status'] = 1;

    $image_one = $request -> file('image_one');
    $image_two = $request -> file('image_two');
    $image_three = $request -> file('image_three');

    //return response()->json($data);

    if ($image_one && $image_two && $image_three){
        $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(300,300)->save('app/public/media/product/'.$image_one_name);
        $data['image_one']='app/public/media/product/'.$image_one_name;

        $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(300,300)->save('app/public/media/product/'.$image_two_name);
        $data['image_two']='app/public/media/product/'.$image_two_name;

        $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(300,300)->save('app/public/media/product/'.$image_three_name);
        $data['image_three']='app/public/media/product/'.$image_three_name;

        DB::table('products')->insert($data);

        return redirect()->back();
    }

    }

    public function Inactive($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return Redirect()->back();
    }

    public function Active($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return Redirect()->back();
    
    }
    public function DeleteProduct($id){

        $product = DB::table('products')->where('id',$id)->first();
        $image1 = $product->image_one;
        $image2 = $product->image_two;
        $image3 = $product->image_three;
        /* unlink($image1);
        unlink($image2);
        unlink($image3); */
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function ViewProduct($id){
        $product = DB::table('products')
                        ->join('categories','products.category_id','categories.id')
                        ->join('brands','products.brand_id','brands.id')
                        ->select('products.*','categories.category_name','brands.brand_name')
                        ->where('products.id',$id)
                        ->first();

                        //return response()->json($product);
                        return view('admin.product.show',compact('product'));
                    
    }


    public function EditProduct($id){
        $product =DB::table('products')->where('id',$id)->first();
        return view('admin.product.edit',compact('product'));

    }


    public function UpdateProductWithoutPhoto(Request $request,$id){

        $data = array();
    $data['product_name'] = $request->product_name;
    $data['product_code'] = $request->product_code;
    $data['product_quantity'] = $request->product_quantity;
    $data['category_id'] = $request->category_id;
    $data['brand_id'] = $request->brand_id;
    $data['product_size'] = $request->product_size;
    $data['product_color'] = $request->product_color;
    $data['selling_price'] = $request->selling_price;
    $data['product_details'] = $request->product_details;
    $data['video_link'] = $request->video_link;
    $data['main_slider'] = $request->main_slider;
    $data['hot_deal'] = $request->hot_deal;
    $data['best_rated'] = $request->best_rated;
    $data['trend'] = $request->trend;
    $data['mid_slider'] = $request->mid_slider;
    $data['hot_new'] = $request->hot_new;
    $data['buyone_getone'] = $request->buyone_getone;
    $data['status'] = 1;

    $update = DB::table('products')->where('id',$id)->update($data);
    return redirect()->route('all.product');
    }

    public function UpdateProductPhoto(Request $request,$id){

        
 $old_one = $request->old_one;
 $old_two = $request->old_two;
 $old_three = $request->old_three;

$data = array();


 	$image_one = $request->file('image_one');
	 $image_two = $request->file('image_two');
	 $image_three = $request->file('image_three');

 	if ($image_one) {
 		//unlink($old_one);
 	  $image_name = date('dmy_H_s_i');
 	  $ext = strtolower($image_one->getClientOriginalExtension());
 	  $image_full_name = $image_name.'.'.$ext;
 	  $upload_path = 'app/public/media/product/';
 	  $image_url = $upload_path.$image_full_name;
 	  $success = $image_one->move($upload_path,$image_full_name);

 	  $data['image_one'] = $image_url;
 	  $product = DB::table('products')->where('id',$id)->update($data);
 	   $notification=array(
            'messege'=>'image Updated Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->route('all.product')->with($notification);
 	}if ($image_two) {
        //unlink($old_two);
      $image_name = date('dmy_H_s_i');
      $ext = strtolower($image_two->getClientOriginalExtension());
      $image_full_name = $image_name.'.'.$ext;
      $upload_path = 'app/public/media/product/';
      $image_url = $upload_path.$image_full_name;
      $success = $image_two->move($upload_path,$image_full_name);

      $data['image_two'] = $image_url;
      $product = DB::table('products')->where('id',$id)->update($data);
       $notification=array(
           'messege'=>'image Updated Successfully',
           'alert-type'=>'success'
            );
          return Redirect()->route('all.product')->with($notification);
    }if ($image_three) {
        //unlink($old_three);
      $image_name = date('dmy_H_s_i');
      $ext = strtolower($image_three->getClientOriginalExtension());
      $image_full_name = $image_name.'.'.$ext;
      $upload_path = 'app/public/media/product/';
      $image_url = $upload_path.$image_full_name;
      $success = $image_three->move($upload_path,$image_full_name);

      $data['image_three'] = $image_url;
      $product = DB::table('products')->where('id',$id)->update($data);
       $notification=array(
           'messege'=>'image Updated Successfully',
           'alert-type'=>'success'
            );
          return Redirect()->route('all.product')->with($notification);
        }
     
     
     
     
     
     
     else{
 		 $brand = DB::table('brands')->where('id',$id)->update($data);
 		 $notification=array(
            'messege'=>'Update Without Images',
            'alert-type'=>'success'
             );
           return Redirect()->route('brands')->with($notification);
            } 

    }

    public function ProductView($id,$product_name){

        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','brands.brand_name')
                    ->where('products.id',$id)
                    ->first();

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);
        return view('pages.product_details',compact('product','product_size','product_color'));
    }


    public function AddCart(Request $request, $id){

        $product = DB::table('products')->where('id',$id)->first();
       
        $data = array();

        if ($product->discount_price == NULL) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;

             Cart::add($data);
             $notification = array(
                'message' =>'Product Successfully Added',
                'alert-type' => 'success');
                return redirect()->back()->with($notification);
    
        }else{
       
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
    
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
             Cart::add($data);
             $notification = array(
                'message' =>'Product Successfully Added',
                'alert-type' => 'success');
                return redirect()->back()->with($notification);
       
        } 
    }


    public function CategoryProductView($id){

        $products = DB::table('products')->where('category_id',$id)->paginate(10);

        $categories = DB::table('categories')->get();

        $brands = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();


        return view('pages.all_products',compact('products','categories','brands'));

    }

}






