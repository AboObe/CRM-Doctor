@extends('doctor.base')
@section('action-content')
<div class="p-4 bg-light" >
    <form  method="POST" id="post-form" name="create-doctor" action="{{ route('doctor.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="operation" id="operation" value="{{isset($doctor) ? 'update':''}}">
                <input type="hidden" name="operation_id" id="operation_id" value="{{isset($doctor) ? $doctor->id:''}}">
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ? 'focused is-focused':'' }}">
        <label class="form-label">Doctor Name</label>
        <input type="text" class="form-control" id="name" name="name" required value="{{$doctor->name ?? ''}}">

        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Center Name</label>
        <input type="text" class="form-control" id="center" name="center" value="{{$doctor->center ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{$doctor->mobile_number ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="{{$doctor->phone ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{$doctor->email ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Website</label>
        <input type="url" class="form-control" id="website" name="website" value="{{$doctor->website ?? ''}}">
        </div>

        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city" value="{{$doctor->city ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Region</label>
        <input type="text" class="form-control" id="region" name="region" value="{{$doctor->region ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country" value="{{$doctor->country ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{$doctor->address ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($doctor) ?  'focused is-focused':''}}">
        <label class="form-label">Postal Code</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{$doctor->postal_code ?? ''}}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="status_doctor" class="ms-0">Doctor Status</label>
                    <select class="form-control" id="status_doctor" name="status_doctor">
                    <option value="active" @if( isset($doctor) && $doctor->status_doctor =="active") selected @endif >Active</option>
                    <option value="inactive"  @if(isset($doctor) && $doctor->status_doctor =="inactive") selected @endif>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-2">
                    <label for="status_contract" class="ms-0">Contract Status</label>
                    <select class="form-control" id="status_contract" name="status_contract">
                    <option value="pending"  @if(isset($doctor) && $doctor->status_doctor =="pending") selected @endif >Pending</option>
                    <option value="signature"  @if(isset($doctor) && $doctor->signature =="inactive") selected @endif>Signature</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" id="addBtnAction" type="button" data-bs-placement="left">
                        {{ isset($doctor) ? 'Update':'Craete'}}
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('doctor.index')}}">
                        Cancel
                    </a>
                </div>

    </form>
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



      $('body').on('click',"#addBtnAction" , function(e){
      e.preventDefault();

      var btn = $(this);

       btn.html('<i class="fa fa-spinner"></i> ');
       btn.attr('disabled',true);
       var url = "{{ route('doctor.store') }}";
       var method = "POST";

        var operation = $("#operation").val();
        var operation_id = $("#operation_id").val();
        if(operation == "update"){
          if(!$("#operation_id").val()){
            showErrorFunction("please Choose Item to edit");
            return;
          }
            url ="{{ route('doctor.index') }}"+ '/' + $("#operation_id").val() ;
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
                    btn.html('Create');
                  }
                       btn.attr('disabled',false);

                    if(data.status==200) {
                      if(operation !== "update"){
                        $("#operation_id").val('');
                        $("#operation").val('');
                        $("#post-form").trigger('reset');
                      }
                      else{
                        $("#operation_id").val(operation_id);
                        $("#operation").val("update")
                      }


                        showSuccesFunction(data.message);

                      }
                    else{

                        showErrorFunction(data.message);
                    }
                },

                error: function (data) {
                  if(operation == "update"){
                      btn.html('Update');
                      $("#operation_id").val(operation_id);
                        $("#operation").val("update")
                  }else{
                    btn.html('Create');
                  }
                       btn.attr('disabled',false);

                    showErrorFunction();
                }
              });
            }); // end add new record



  });

  $(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='create-doctor']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      name: "required",
      center: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@endpush




