@extends('user.base')
@section('action-content')
<div class="p-4 bg-light" >
    <form  method="POST" id="post-form" name="create-user" action="{{ route('user.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="operation" id="operation" value="{{isset($user) ? 'update':''}}">
                <input type="hidden" name="operation_id" id="operation_id" value="{{isset($user) ? $user->id:''}}">



        <div class="input-group input-group-outline my-3 {{ isset($user) ? 'focused is-focused':'' }}">
          <label class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required value="{{$user->name ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($user) ?  'focused is-focused':''}}">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="{{$user->email ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($user) ?  'focused is-focused':''}}">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="{{$user->password ?? ''}}">
        </div>
        <div class="input-group input-group-outline my-3 {{ isset($user) ?  'focused is-focused':''}}">
        <label class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{$user->mobile_number ?? ''}}">
        </div>
        

        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="Role" class="ms-0">Role</label>
                    <select class="form-control" id="admin" name="admin">
                    <option value="1" @if( isset($user) && $user->admin == 1 ) selected @endif >Admin</option>
                    <option value="0"  @if(isset($user) && $user->admin == 0  ) selected @endif>Agent</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="status" class="ms-0">Status</label>
                    <select class="form-control" id="status" name="status">
                    <option value="active" @if( isset($user) && $user->status =="active") selected @endif >Active</option>
                    <option value="inactive"  @if(isset($user) && $user->status =="inactive") selected @endif>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="status_doctor" class="ms-0">Work Type</label>
                    <select class="form-control" id="work_type" name="work_type">
                    <option value="freelancer" @if( isset($user) && $user->work_type == "freelancer") selected @endif >Freelancer</option>
                    <option value="contract"  @if(isset($user) && $user->work_type == "contract") selected @endif>Contract</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="profile_photo" class="ms-0">Profile Photo</label>
                    <input type="file" class="form-control"  id="profile_photo" name="profile_photo" value="{{$user->profile_photo ?? ''}}">
                </div>
            </div>
        </div>

        <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" id="addBtnAction" type="button" data-bs-placement="left">
                        {{ isset($user) ? 'Update':'Create'}}
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('user.index')}}">
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
       var url = "{{ route('user.store') }}";
       var method = "POST";

        var operation = $("#operation").val();
        var operation_id = $("#operation_id").val();
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
  $("form[name='create-user']").validate({
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




