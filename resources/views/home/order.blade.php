<<!DOCTYPE html>
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
      <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
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

      <div class="hero_area">
         <!-- header section strats -->
     @include('home.header');
         <!-- end header section -->
         <!-- slider section -->
      <div class="container">
        <table class="table table-hover">
           <tr class="">
                <th scope="col">Product Title</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Delivery status</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Image</th>
                <th scope="col">Cancle Order</th>

                <th scope="col"></th>
           </tr>
           @foreach ($order as $order)


           <tr>
              <td>{{$order->product_title}}</td>
              <td>{{$order->quantity}}</td>
              <td>{{$order->price}}</td>
              <td>{{$order->delivery_status}}</td>
              <td>{{$order->payment_status}}</td>
              <td><img src="./product/{{$order->image}}" alt="product img" height="100px" width="100px"></td>
              <td>
                @if($order->delivery_status=='processing')
                   <a  href="{{url('order_cancel',$order->id)}}" onclick="return confirm('Are you sure you want to cancel the order?')" class="btn btn-danger">Cancel Order</a>
                @else
                <p class="text-warning">Not Allowed</p>
                @endif
            </td>
              @endforeach

           </tr>
        </table>
      </div>
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer');
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
