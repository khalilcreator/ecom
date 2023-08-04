<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      {{-- <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type=""> --}}
      <title>Cart</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
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
          width: 60%;
          margin-top:30px;
          border: 3px solid white;
        }

        </style>
   </head>
   <body>

      <div >
         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->
      </div>
      @if(session()->has('message'))
        <div class="alert alert-success">
    <button type="btn" class="close" data-dismiss="alert" aria-haspopup="true">X</button>

        {{ session()->get('message') }}
        </div>
   @endif
     <div class="center">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr class="table_th">
                    <th scope="col" class="table_dg ">Product Title</th>
                    <th scope="col" class="table_dg">Product Quantity</th>
                    <th scope="col" class="table_dg">Price</th>
                    <th scope="col" class="table_dg">Image</th>
                    <th scope="col" class="table_dg">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalprice =0;?>
                 @foreach($cart as $cart)

                <tr style="border-bottom:1px solid black;">
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->price}}</td>
                    <td><img src="/product/{{$cart->image}}" height="100px" width="100px"></td>
                    <td><a href="{{url('/remove_cart',$cart->id)}}" class="btn btn-danger">Remove Product</a></td>
                </tr>
            <?php $totalprice = $totalprice + $cart->price ?>
            @endforeach
            </tbody>

        </table>
        <div>
            <h1 class="total_dg">Total Price: {{$totalprice}}</h1>
        </div>
        <div style="padding-bottom:15px;">
            <h1 style="font-size:25px;padding-bottom:15px;">Proceed to order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger">Cash on delivery</a>
            <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay using Card</a>
        </div>
     </div>
     <!-- footer section strats -->
     @include('home.footer')
     <!-- footer end -->
     <!-- jQery -->
     <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
     <!-- popper js -->
     <script src="{{asset('home/js/popper.min.js')}}"></script>
     <!-- bootstrap js -->
     <script src="{{asset('home/js/bootstrap.js')}}"></script>
     <!-- custom js -->
     <script src="{{asset('home/js/custom.js')}}"></script>
  </body>
</html>
