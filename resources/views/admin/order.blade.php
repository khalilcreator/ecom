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
          width: 100%;
          margin-top:30px;
        }
        .hed{
            font-size: 40px;
            text-align: center;
        }
        </style>
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar');
        <!-- partial -->
        @include('admin.header');
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="hed">Orders</h1>
                <form action="{{url('/search')}}" method="POST">
                    @csrf
                    <input type="text" name="search" placeholder="Search Here" style="padding:10px;margin:auto;color:black;">
                    <input type="submit"  class="btn btn-primary" value="Search" style="padding:15px;">
                </form>
                <div class="center">
                    <table class="  ">
                        <thead class="thead-dark">
                            <tr class="table_th bg-light text-dark">
                                <th >Name</th>
                                <th >Email</th>
                                <th >Address</th>
                                <th >Phone</th>
                                <th >Product Title</th>
                                <th >Quantity</th>
                                <th >Payment Status</th>
                                <th >Delivery Status</th>
                                <th >Image</th>
                                <th >Delivered</th>
                                <th >PDF</th>

                            </tr>
                        </thead>
                        <tbody>
                             @forelse($order as $order)

                            <tr style="border-bottom:1px solid black;">
                                <td>{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->product_title}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                                <td><img src="/product/{{$order->image}}" height="100px" width="100px"></td>
                                <td>
                                    @if($order->delivery_status=="processing")
                                    <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure product is deliverd!?')" class="btn btn-danger">Deliver</a>
                                    @else
                                    <p class="text-warning">Delivered</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('print_pdf',$order->id)}}" onclick="return confirm(']Do you want to download pdf!?')" class="btn btn-danger">Print</a>

                                </td>
                            </tr>
                            @empty
                                 <tr><td colspan="12">No data Found</td></tr>
                            @endforelse


                        </tbody>

                    </table>

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

