@extends('user.base')
@section('action-content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Users table</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table id="tableData" class="table align-items-center mb-0  data-table">

                  <thead>
                    <thead>
                      <tr>
                         <th style="width:10%;">#</th>
                         <th style="width: 35%;">Name</th>
                         <th style="width: 35%;">Role</th>

                         <th style="width: 20%;">Action</th>

                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>


              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Start Head -->
        @include('layouts.footer')
	    <!-- End Head -->




    </div>

@endsection

@push('pageJs')

<script>
    $(function(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
       var table = $('.data-table').DataTable({

                  destroy: true,
                  processing: true,

                  serverSide: true,
                  stateSave: true,

              ajax:"{{route('user.index')}}",

              columns: [

                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                  {data: 'name', name: 'name'},
                  {data: 'admin', name: 'admin'},


                  {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

                });


        $('body').on('click',"#addBtnAction" , function(e){
        e.preventDefault();

        var btn = $(this);

         btn.html('<i class="fa fa-spinner"></i> ');
         btn.attr('disabled',true);
         var url = "{{ route('user.store') }}";
         var method = "POST";

          var operation = $("#operation").val();
          if(operation == "update"){
            if(!$("#operation_id").val()){
              showErrorFunction("please Choose Item to edit");
              return;
            }
              url ="{{ route('user.index') }}"+ '/' + $("#operation_id").val() ;
              method = "PUT";
          }

              $.ajax({

                  data: $("#post-form").serialize() ,

                  url:url ,

                  type: method,

                  dataType: 'json',
                  timeout:10000,
                  success: function (data) {
                      if(operation == "update"){

                          btn.html('Update');
                          }else{

                          btn.html('Add');
                          }
                         btn.attr('disabled',false);
                      if(data.status==200) {
                         $("#operation_id").val('');
                         $("#operation").val('')
                        table.draw(false);
                          $("#post-form").trigger('reset');
                          showSuccesFunction(data.message);

                        }
                      else{

                          showErrorFunction(data.message);
                      }
                  },

                  error: function (data) {
                        btn.html('Add');
                         btn.attr('disabled',false);
                          $("#operation_id").val('');
                         $("#operation").val('')
                      showErrorFunction();
                  }
                });
              }); // end add new record


              $('body').on('click', '.edit', function () {

                  var product_id = $(this).data('id');
                  var name = $(this).data('name');
                  var email = $(this).data('email');
                  var nationality = $(this).data('nationality');
                  var phone = $(this).data('phone');
                  $("#name").val(name);
                  $("#email").val(email);
                  $("#phone").val(phone);
                  $("#nationality").val(nationality);
                  $("#addBtnAction").html("Update");
                  $("#operation").val("update");
                  $("#operation_id").val(product_id);



              }) ;// end edit function;

          $('body').on('click', '.delete', function () {
            var btn = $(this);

               btn.html('<i class="fa fa-spinner"></i>  ');
               btn.attr('disabled',true);
                  var _id = $(this).data("id");
                var route =  "{{ route('user.index') }}"+ '/' + _id;
                  sweetConfirm( function (confirmed) {
                  if (confirmed) {

                      $.ajax({

              type: "DELETE",

              url:route,
              data:{
                  '_token':'{{csrf_token()}}'
              },
              success: function (data) {
               showSuccesFunction(data.message);
                  btn.html('<i class="fa fa-trash"></i>');
                  btn.attr('disabled',false);
                  table.draw(false);

              },

              error: function (data) {
                  btn.html('<i class="fa fa-trash"></i>');
                  btn.attr('disabled',false);
               }

              }); // ajax
            } // if
            else{

                  btn.html('<i class="fa fa-trash"></i>');
                  btn.attr('disabled',false);
            }


          });

          }); // end delete row

    });
  </script>
  @endpush

