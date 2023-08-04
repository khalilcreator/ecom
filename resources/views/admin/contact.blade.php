<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success">
              <button type="btn" class="close" data-dismiss="alert" aria-haspopup="true">X</button>

                  {{ session()->get('message') }}
                </div>
                @endif
                <div class="div_center">
                    <h1 class="h2_font text-center">Contacts Details</h1>
                </div>
                <table class="center table text-light" >
                    <tr class="table_th bg-light text-dark">
                        <th class="table_dg">Name</th>
                        <th class="table_dg">Email</th>
                        <th class="table_dg">Phone</th>
                        <th class="table_dg">issue</th>
                        <th class="table_dg">Status</th>
                        <th class="table_dg">Resolved</th>
                        <th class="table_dg">Revoke</th>

                    </tr>
                 @foreach ($contact as $contact)
                    <tr>

                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->issue}}</td>
                            @if($contact->status=='Pending')
                                <td class="text-success">
                                    {{$contact->status}}
                                </td>
                            @else
                                <td>
                                    {{$contact->status}}
                                </td>
                            @endif
                           @if($contact->status=='resolved')
                             <td class="text-warning">Resolved</td>
                           @else
                            <td ><a class="btn btn-primary"onclick="return Confirm('message','Arr you Sure Issue is resolved? ')" href="{{url('resolve_contact',$contact->id)}}">Resolved</a></td>
                            @endif
                           @if($contact->status=='revoked')
                            <td class="text-danger">Revoked</td>
                           @else
                            <td><a  class="btn btn-danger" onclick="return Confirm('message','Arr you Sure? ')" href="{{url('revoke_contact',$contact->id)}}">Revoke</a></td>
                           @endif
                        </tr>
                 @endforeach

            </div>
        </div>
    </div>
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
