@extends('doctor.base')
@section('action-content')
<div class="p-4 bg-light" >
    <form  method="POST"  action="{{ route('doctor.store') }}" data-parsley-validate novalidate enctype="multipart/form-data">
                {{ csrf_field() }}
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Doctor Name</label>
        <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Center Name</label>
        <input type="text" class="form-control" id="center" name="center">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" id="mobile_number" name="mobile_number">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Website</label>
        <input type="url" class="form-control" id="website" name="website">
        </div>

        <div class="input-group input-group-outline my-3">
        <label class="form-label">City</label>
        <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Region</label>
        <input type="text" class="form-control" id="region" name="region">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="input-group input-group-outline my-3">
        <label class="form-label">Postal Code</label>
        <input type="text" class="form-control" id="postal_code" name="postal_code">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-static mb-3">
                    <label for="status_doctor" class="ms-0">Doctor Status</label>
                    <select class="form-control" id="status_doctor" name="status_doctor">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group input-group-static mb-2">
                    <label for="status_contract" class="ms-0">Contract Status</label>
                    <select class="form-control" id="status_contract" name="status_contract">
                    <option value="pending">Pending</option>
                    <option value="signature">Signature</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary" type="submit" data-bs-placement="left">
                        Create
                    </button>
                    <a class="btn btn-secondary m-l-5" href ="{{route('doctor.index')}}">
                        Cancel
                    </a>
                </div>

    </form>
</div>
@endsection