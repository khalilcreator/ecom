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
      <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" type="">
      <title>Our Products</title>
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

             <!-- header section strats -->
         @include('home.header')
             <!-- end header section -->



          <!-- product section -->
         @include('home.product_view')
          <!-- end product section -->

          <!-- subscribe section -->

          <!-- footer start -->
          @include('home.footer')
          <!-- footer end -->
          <script>
        // for relosading page on same podition where it was after reload
            document.addEventListener("DOMContentLoaded", function (event) {
                var scrollpos = sessionStorage.getItem('scrollpos');
                if (scrollpos) {
                    window.scrollTo(0, scrollpos);
                    sessionStorage.removeItem('scrollpos');
                }
            });

            window.addEventListener("beforeunload", function (e) {
                sessionStorage.setItem('scrollpos', window.scrollY);
            });
          </script>
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
