<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css');
    <style>
      .div_center{
        text-align: center;

      }
      .h2_font{
        font-size: 40px;
      }
      .input_color{
        color: black;
      }
      .center{
        text-align: center;
        margin: auto;
        width: 50%;
        margin-top:30px;
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
        @include('admin.header');
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
                    <h1 class="h2_font">Add category</h1>

                    <form action="{{url('/add_category')}}" method="post">
                      @csrf
                    <input class="input_color" type="text" name="category_name" placeholder="Write new category name">
                    <input type="submit" name="submit" class="btn btn-primary">
                    </form>
                </div>
                <table class="center">
                    <tr>
                        <th>Category name</th>
                        <th>Action</th>
                    </tr>
                 @foreach ($data as $data)
                    <tr>

                            <td>{{$data->category_name}}</td>
                            <td><a onclick="confirm('are you sure to delete it?')" href="{{url("delet_category",$data->id)}}" class="btn btn-danger">Delete</a></td>

                    </tr>
                 @endforeach
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

