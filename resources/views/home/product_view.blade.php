<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>


                 <form action="{{url('search_allproducts')}}" method="Get">

                    <input type="text" name="search"  placeholder="Search any product Here" class=" mt-3" style="width:400px;text-align:center;" value="{{ isset($search) ? $search : '' }}">
                    <input type="submit" value="Search" class="btn btn-info">
                </form>
    </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
             <button type="btn" class="close" data-dismiss="alert" aria-haspopup="true">X</button>

          {{ session()->get('message') }}
        </div>
        @endif
       <div class="row">
        @foreach ($product as $products)

          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('product_details',$products->id)}}" class="option1">
                       Product Detail
                      </a>
                     <form action="{{url('add_cart',$products->id)}}" method="post">
                        @csrf
                         <div class="row">
                            <div class="col-md-4">
                              <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                            </div>
                            <div class="col-md-4">
                              <input type="submit" value="add to cart">
                            </div>
                         </div>
                     </form>
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{$products->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{$products->description}}
                   </h5>
                   @if($products->disscount_price!=null)
                    <h6 style="color:red">
                        Discounted Price<br>
                        {{'$'.$products->disscount_price}}
                    </h6>
                    <h6 style="text-decoration:line-through;color:blue;">
                        price<br>
                        {{'$'.$products->price}}

                       </h6>
                    @else


                    <h6 style="color:blue">
                        price<br>
                        {{'$'.$products->price}}

                    </h6>
                    @endif
                </div>
             </div>
          </div>
        @endforeach

        {{-- {!! $product->appends(Request::all())->links()!!} --}}
       </div>
       <div class="text-start">
        {!! $product->withQueryString()->links('pagination::bootstrap-5')!!}
       </div>
       <div class="btn-box">
          <a href="">
          View All products
          </a>
       </div>
    </div>
 </section>
