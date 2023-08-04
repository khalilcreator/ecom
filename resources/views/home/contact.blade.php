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

      <div class="">
         <!-- header section strats -->
     @include('home.header')
         <!-- end header section -->
      </div>
    <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Contact us</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="col-md-4 mx-auto mt-4">
        @if(session()->has('message'))
        <div class="alert alert-success">
      <button type="btn" class="close" data-dismiss="alert" aria-haspopup="true">X</button>

          {{ session()->get('message') }}
        </div>
        @endif
        <form action="{{('contact_submit')}}" method="post">
        @csrf
          <div class="row">
            <label for=""><strong> Name </strong></label>
            <input type="text" class="" name="name" placeholder="Please enter Your Name" required>
          </div>
          <div class="row">
            <label for=""><strong> Email </strong></label>
            <input type="text" class="" name="email" placeholder="Please enter Your Email" required>
          </div>
          <div class="row">
            <label for=""><strong> Phone No </strong></label>
            <input type="text" class="" name="phone" placeholder="Please enter Your phone no" required>
          </div>
          <div class="row">
            <label for=""><strong> Issue </strong></label>
            <textarea name="issue" id="" cols="30" rows="3" placeholder="Describe Your Issue Here" required></textarea>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-dark rounded-5 mb-4 bg-dark" >Submit Response</button>
          </div>
        </form>
      </div>
      <!-- end inner page section -->
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
