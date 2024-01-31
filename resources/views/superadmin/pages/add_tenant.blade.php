@extends('superadmin.layouts.default')

@section('title', 'Tenants')
@section('content')
<div class="main-content container">
    <div class="row mt-6">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Add Tenant</h3>
                </div>
                <!--begin::Form-->
                <form class="form" id="add_tenant_form" method="post" action="{{ url('create-tenant') }}">
                    @csrf

                    @if ( session()->has('error') )
                    <div>{{ session()->get('error') }}</div>
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <label>Tenant Name:</label>
                            <input type="text" class="form-control form-control-solid" id="tenant_name" name="tenant_name" placeholder="Enter Tenant Name" value="{{isset($tenant) ? $tenant->tenant_name :  old('tenant_name') }}" />
                            @error('tenant_name')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>School Name:</label>
                            <input type="text" class="form-control form-control-solid" id="school_name" name="school_name" placeholder="Enter School Name" value="{{isset($tenant) ? $tenant->school_name : old('school_name') }}" />
                            @error('school_name')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>School Location:</label>
                            <input type="text" class="form-control form-control-solid" id="school_location" name="school_location" placeholder="Enter School Location" value="{{isset($tenant) ? $tenant->school_location : old('school_location') }}" />
                            @error('school_location')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control form-control-solid" id="first_name" name="first_name" placeholder="Enter First Name" value="{{isset($tenant) ? $tenant->owner->first_name : old('first_name') }}" />
                            @error('first_name')
                            <p class="text-sm text-danger" id="admin-name-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control form-control-solid" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{isset($tenant) ? $tenant->owner->last_name : old('last_name') }}" />
                            @error('last_name')
                            <p class="text-sm text-danger" id="admin-name-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control form-control-solid" id="email" name="email" placeholder="Enter Email" value="{{isset($tenant) ? $tenant->owner->email : old('email') }}" />
                            @error('email')
                            <p class="text-sm text-danger" id="admin-name-error">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control form-control-solid" id="password" name="password" placeholder="Enter Password" value="{{ old('password') }}" />
                            @error('password')
                            <p class="text-sm text-danger" id="admin-name-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control form-control-solid" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="{{isset($tenant) ? $tenant->owner->note : old('confirm_password') }}" />
                            @error('confirm_password')
                            <p class="text-sm text-danger" id="admin-name-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" class="form-control form-control-solid" id="tenant_id" name="tenant_id" value="{{ isset($tenant) ? $tenant->id : '' }}" />
                        <div class="form-group">
                            <label>Note:</label>
                            <textarea class="form-control form-control-solid" name="note" placeholder="Enter Note" />{{ old('note') }}</textarea>
                            @error('note')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary add_tenant_save mr-2">Submit</button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
</div>
@endsection