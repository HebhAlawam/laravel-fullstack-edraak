
  <!-- Script -->
    <script src="{{ asset('frontednd/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('frontednd/js/jquery-3.6.0.min.js') }}" ></script>

<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script> 
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const deleteForm = document.getElementsByClassName("delete_form");
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    deleteForm[0].submit();
                }
            });
        });
    </script>


<!-- subcategories for spcific category -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#category').on('change',function(e) {
                event.preventDefault();
                var cat_id = e.target.value;
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                    url:"{{ route('subcat') }}",
                    type:"POST",
                    data: {
                        cat_id: cat_id
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

     @yield('script')


</body>

</html>