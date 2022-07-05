    <!-- *** FOOTER ***  -->
    
    <!-- /#footer-->

    
    <!--  *** COPYRIGHT ***    -->
    <div style="background-color: #333333" class="mt-5 footer" >
      <div class="container  ">
        <div class="row m-0">
          <div class="col-lg-9 p-0">
            <p class=" text-left text-muted mt-1 mb-1">©2022 Edraak</p>
          </div>
          <div class="col-lg-3 p-0">
            <p class="text-muted text-right mt-1 mb-1 ">created with  <i class="fa fa-heart text-danger"></i>  by <a href="" class="text-info"> Hebh Alawam</a>
            </p>
          </div>
        </div>
      </div>
    </div>


<!-- Script -->
    <!-- Script bootstrap-->
    <script src="{{ asset('frontednd/js/bootstrap.min.js') }}"></script>
    <!-- Script Ajax-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Script jquery-->
    <script src="{{ asset('frontednd/js/jquery-3.6.0.min.js') }}"></script> 
    <!-- Script owl carousel -->
    <script src="{{ asset('frontednd/js/owl.carousel.min.js') }}"></script> 
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Script bundle-->
	<script src="{{ asset('frontednd/js/bootstrap.bundle.min.js')}}"></script>






<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#category').on('change',function(e) {
            var cat_id = e.target.value;
            $.ajax({
                url:"{{ route('subcat') }}",
                type:"POST",
                data: {
                    cat_id: cat_id
                },
                beforeSend: function () {
                    $('#subcategory').html('<img src="/admin/img/loading.gif">');
                },
                success:function (data) {
                    $('#subcategory').empty();
                    $.each(data.subcategories[0].subcategories,function(index,subcategory){
                        $('#subcategory').append(
                            '<div class="form-check"> <input class="form-check-input @error("subcategory") is-invalid @enderror" type="checkbox"  name="subcategory[]" value="'+subcategory.id+'" id="flexCheckChecked'+subcategory.id+'"> <label class="form-check-label" for="flexCheckChecked'+subcategory.id+'">' +subcategory.name+' </label> </div> ');
                    })
                }
            })
        });
    });
</script> 



<!-- add and remove from cart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
	$(document).ready(function() {
		$('.add-to-cart-btn').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            var product_id = $(this).closest('.product_data').find('.product_id').val();
            var quantity = $(this).closest('.product_data').find('.qty_input').val();

            $.ajax({
                url: "{{ route('add.to.cart') }}",
                //crossDomain: true,
                method: "GET",
                data: {
                    'quantity': quantity,
                    'product_id': product_id,
                },
                success: function (data) {   
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    var content = document.getElementById("cart"+product_id);
                    if(content){
                        content.innerHTML="<i class='fa fa-shopping-cart'></i> Added to cart";
                    } else {
                         location.reload();
                    }
                },
                error: function (xhr) {
                  if (xhr.status == 401) {
                    window.location.href = '{{route("login")}}';
                  }
                  if (xhr.status == 404) {
                    //location.reload();
                  }
                }
            });
        });

        $('.remove-frome-cart-btn').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            var product_id = $(this).closest('.product_data').find('.product_id').val();
            $.ajax({
                url: "{{ route('remove.from.cart') }}",
                method: "GET",
                data: {
                    'product_id': product_id,
                },
                success: function (data) {
                	toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message); 
                    var content = document.getElementById("cart"+product_id);
                    if(content){
                     content.innerHTML="<i class='fa fa-shopping-cart'> Removed from cart";
                    } else {
                         location.reload();
                    }
                },

            });
        });

        
    });
		
</script>

     @yield('script')

</body>

</html>