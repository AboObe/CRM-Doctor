@extends('user.base')
@section('action-content')
<div class="p-4 bg-light" >
    <form  method="POST" id="post-form" name="create-user1e" action="{{ route('user.store') }}"   enctype="multipart/form-data">
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

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label for="status" class="ms-0">Name</label>
                        <input type="text" class="form-control" id="zone-name" name="zone-name" placeholder="enter zone name" required >


                    </div>
                    <div class="col-md-6">
                        <label for="status" class="ms-0">Region</label>
                        <input type="text" class="form-control" id="zone-region" name="zone-region" required placeholder="Enter Region" >
                    </div>
                </div>
                <br>
                <a  class="btn btn-success" id="addZoneBtn" onclick="addZone()">Add Zone </a>

            </div>
            <div class="col-md-6">
                <table id="zoneList" class="table table-stripped">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Remove</th>

                    </tr>

                    <tbody id="zoneListBody">
                        @if(count($user->zones) > 0)
                        @foreach ($user->zones as $zone)
                            <tr>
                                <td>
                                    {{$loop->index +1}}
                                </td>
                                <td>
                                    <input type="text" name="name[]" value="{{$zone->city}}" >
                                </td>
                                <td>
                                    <input type="text" name="region[]" value="{{$zone->region}}" >
                                </td>
                                <td> <a class='removeInput' onclick='removeZone(this)' > <i class='fa fa-trash'></i>  </a> </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" id="addBtnAction" type="submit" data-bs-placement="left" >
                        {{ isset($user) ? 'Update':'Create'}}
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('user.index')}}">
                        Cancel
                    </a>
                </div>
    </form>
</div>
<script>
    function addZone(){

var name = $("#zone-name").val();
        var region = $("#zone-region").val();
        if(name.length < 2){
            alert("Please Enter Name");
            return;
        }
        if(region.length < 2){
            alert("enter region please");
            return;
        }
        var html =
        "<tr>" +
        "<td></td>"+
        "<td> <input type='text' name='z_name[]' value='"+name+"'>  </td>" +
        "<td> <input type='text' name='z_region[]' value='"+region+"'>  </td>"+
        "<td> <a class='removeInput' onclick='removeZone(this)' > <i class='fa fa-trash'></i>  </a> </td>"+
        "</tr>" ;


        $("#zoneListBody").append(html);
}
function removeZone(ele){
    var item = ele;
    $(ele).parent().parent().remove();
    // $(this).parent().remove();
    // $item.parent().remove();

}



</script>
@endsection
@push('pageJs')
<script>




$(function(){
$('body').on('click',".removeInput" , function(e){
    e.preventDefault();
    alert("will remove");
    $(this).parent().remove();

});
});

  $(function(){



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click',"#addBtnAction" , function(e){

                $("#addBtnAction").html('<i class="fa fa-spinner"></i> ');
                $("#addBtnAction").attr('disabled',true);
            });
        $('body').on('click',"#addZoneBtn" , function(e){
            e.preventDefault();
            alert("clicled");
            var name = $("#zone-name").val();
            var region = $("#zone-region").val();
            if(name.length < 2){
                alert("Please Enter Name");
                return;
            }
            if(region.length < 2){
                alert("enter region please");
            }
            var html = name + " " + region;

            $("#zoneListBody").append(html);
        });

//
//       e.preventDefault();

//       var btn = $(this);

//        btn.html('<i class="fa fa-spinner"></i> ');
//        btn.attr('disabled',true);
//        var url = "{{ route('user.store') }}";
//        var method = "POST";

//         var operation = $("#operation").val();
//         var operation_id = $("#operation_id").val();
//         if(operation == "update"){
//           if(!$("#operation_id").val()){
//             showErrorFunction("please Choose Item to edit");
//             return;
//           }
//             url ="{{ route('user.index') }}"+ '/' + $("#operation_id").val() ;
//             method = "PUT";
//         }

//             $.ajax({

//                 data: $("#post-form").serialize() ,

//                 url:url ,

//                 type: method,

//                 dataType: 'json',
//                 timeout:10000,
//                 success: function (data) {
//                   if(operation == "update"){
//                       btn.html('Update');
//                   }else{
//                     btn.html('Create');
//                   }
//                        btn.attr('disabled',false);

//                     if(data.status==200) {
//                       if(operation !== "update"){
//                         $("#operation_id").val('');
//                         $("#operation").val('');
//                         $("#post-form").trigger('reset');
//                       }
//                       else{
//                         $("#operation_id").val(operation_id);
//                         $("#operation").val("update")
//                       }


//                         showSuccesFunction(data.message);

//                       }
//                     else{

//                         showErrorFunction(data.message);
//                     }
//                 },

//                 error: function (data) {
//                   if(operation == "update"){
//                       btn.html('Update');
//                       $("#operation_id").val(operation_id);
//                         $("#operation").val("update")
//                   }else{
//                     btn.html('Create');
//                   }
//                        btn.attr('disabled',false);

//                     showErrorFunction();
//                 }
//               });
//             }); // end add new record



  });


@endpush




