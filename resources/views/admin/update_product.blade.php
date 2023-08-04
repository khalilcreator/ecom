<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css');
    <style>
        .h2_font{
            padding-bottom: 40px;
            padding-top: 40px;
            font-size: 25px;
        }
        .text_color{
            color: black;
        }
        label{
            display: inline-block;
            width: 200px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success">
              <button type="btn" class="close" data-dismiss="alert" aria-haspopup="true">X</button>

                  {{ session()->get('message') }}
                </div>
                @endif
                <div class="text-center">

                <h1 class="h2_font">Add Product</h1>
                 <form action="{{url('/update_product_confirm',$product->id)}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="dic_design">
                        <label for="title">Product title:</label>
                        <input class="text_color" type="text" name="title" placeholder="Enter the Title for Product" required="" value="{{$product->title}}">
                    </div>
                    <div class="dic_design">
                        <label for="description">Product description:</label>
                        <input class="text_color" type="text" name="description" placeholder="Enter the description for Product"value="{{$product->description}}">
                    </div>
                    <div class="dic_design">
                        <label for="price">Product price:</label>
                        <input class="text_color" type="number" name="price" placeholder="Enter the price for Product" required=""value="{{$product->price}}">
                    </div>
                    <div class="dic_design">
                        <label for="discount_price">discounted price:</label>
                        <input class="text_color" type="text" name="discount_price" placeholder="Enter the discount price for Product" value="{{$product->disscount_price}}">
                    </div>
                    <div class="dic_design">
                        <label for="quantity">Product quantity:</label>
                        <input class="text_color" type="number" min="0" name="quantity" placeholder="Enter the quantity for Product" required="" value="{{$product->quantity}}">
                    </div>
                    <div class="dic_design">
                        <label for="category">Product category:</label>
                        <select name="category" class="text_color" required="">
                            <option selected value="{{$product->title}}">{{$product->title}}</option>
                            @foreach($category as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option >
                            @endforeach
                        </select>
                    </div>
                    <div class="dic_design">
                        <label for="image">Image</label>
                        <input class="text_color" type="file" name="image" placeholder="Enter the image" value="{{$product->image}}">
                    </div>
                    <div class="dic_design">
                        <input type="submit" value="update product" class="btn btn-primary">
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>
