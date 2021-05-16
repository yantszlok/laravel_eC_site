@extends('admin.admin_master')


<link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
@section('admin')

<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Product Section</span>
      </nav>

      <div class="sl-pagebody">


      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Product Details Page
          <br>
          <br>



          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label><br>
                  <br>
                  <strong>{{ $product->product_name}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Code: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->product_code}}</strong>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->product_quantity}}</strong>
                </div>
              </div><!-- col-4 -->

              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->category_name}}</strong>
                    <option label="Choose Category"></option>
                   
                    
                  
                  </select>
                </div>
              </div><!-- col-4 -->



              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->brand_name}}</strong>
                    <option label="Choose country"></option>
                 
                   
                  </select>
                </div>
              </div><!-- col-4 -->



              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Size: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->product_size}}</strong>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Product Color: <span class="tx-danger">*</span></label>
                  <strong>{{ $product->product_color}}</strong>
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Selling Price: <span class="tx-danger">*</span></label>
                  product_details
                </div>
              </div><!-- col-4 -->


              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Product Details: <span class="tx-danger">*</span></label>
                  <p>{!! $product->product_details !!}</p>
            

             </textarea>
                  
                </div>
              </div><!-- col-4 -->

              </div><!-- col-4 -->

<div class="col-lg-12">
<div class="form-group">
  <label class="form-control-label">Video Link: <span class="tx-danger">*</span></label>
  <strong>{{ $product->video_link}}</strong>
</div>
</div><!-- col-4 -->

<div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image One ( Main Thumbnali): <span class="tx-danger">*</span></label>
                 <label class="custom-file">
          <img src="{{ URL::to($product->image_one)}}" style="height: 80px; width: 80px;">
            </label>
                </div>
              </div><!-- col-4 -->
              <br><br>
              <br><br>
<div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                 <label class="custom-file">
                 <img src="{{ URL::to($product->image_two)}}" style="height: 80px; width: 80px;">
            </label>
                </div>
              </div>
              <br><br>
              <br><br>
 <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label>
                 <label class="custom-file">
                 <img src="{{ URL::to($product->image_three)}}" style="height: 80px; width: 80px;">
            </label>
                </div>
              </div>
              <br><br>

              <br><br>
<hr>
<br><br>

<div class="row">

<div class="col-lg-4">
<label class="">
 @if($product->main_slider == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 

  <span>Main Slider</span>
</label>

</div> <!-- col-4 --> 

 <div class="col-lg-4">
<label class="">
 @if($product->hot_deal == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 
  
  <span>Hot Deal</span>
</label>

</div> <!-- col-4 --> 



 <div class="col-lg-4">
<label class="">
 @if($product->best_rated == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 
  
  <span>Best Rated</span>
</label>

</div> <!-- col-4 --> 


 <div class="col-lg-4">
<label class="">
 @if($product->trend == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 

  <span>Trend Product </span>
</label>

</div> <!-- col-4 --> 

<div class="col-lg-4">
<label class="">
 @if($product->mid_slider == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 
  
  <span>Mid Slider</span>
</label>

</div> <!-- col-4 --> 

<div class="col-lg-4">
<label class="">
 @if($product->hot_new == 1)
 <span class="badge badge-success">Active</span>

 @else
<span class="badge badge-danger">Inactive</span>
 @endif 
  
  <span>Hot New </span>
</label>

</div> <!-- col-4 --> 


  </div><!-- end row --> 

 

          </div><!-- end row --> 
<br><br>








@endsection