<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css');
    <style>
        .div_center{
          text-align: center;
          padding-top: 40px;
        }
        .h2_font{
          font-size: 40px;
          padding-bottom: 40px
        }
        .input_color{
          color: black;
        }
        .center{
          text-align: center;
          margin: auto;
          width: 50%;
          margin-top:30px;
          border: 3px solid white;
        }
        .table_th{
            background-color: skyblue;
        }
        .table_dg{
            padding: 30px;

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
                <div class="div_center">
                    <h1 class="h2_font">Products Details</h1>
                </div>
                <table class="center table" >
                    <tr class="table_th">
                        <th class="table_dg">Product Titile</th>
                        <th class="table_dg">Description</th>
                        <th class="table_dg">Quantity</th>
                        <th class="table_dg">Category</th>
                        <th class="table_dg">Price</th>
                        <th class="table_dg">Discount</th>
                        <th class="table_dg">Product Image</th>
                        <th class="table_dg">Delete</th>
                        <th class="table_dg">Edit</th>

                    </tr>
                 @foreach ($product as $product)
                    <tr>

                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->disscount_price}}</td>
                            <td><img src="/product/{{$product->image}}" alt=""></td>
                            <td><a  class="btn btn-danger" onclick="Confirm('message','Atr you Sure? ')" href="{{url('delete_product',$product->id)}}">Delete</a></td>
                            <td ><a class="btn btn-primary" href="{{url('update_product',$product->id)}}">edit</a></td>
                    </tr>
                 @endforeach

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

