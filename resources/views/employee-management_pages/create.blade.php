@extends('layouts.app', ['title' => 'Add Employee'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 2.2])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">Add Employee <small>Fill required information.</small></h2>
    {!! Form::open(['url' => url('/employees'), 'method' => 'POST', 'files' => true]) !!}
        <div class="row">
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading" title="Click to Show">
                        ID
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('employee_id', 'Employee ID: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('employee_id', null, ['class' => 'form-control', 'placeholder' => '23153']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('date_employed', 'Date Employed: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('date_employed', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control input-date', 'id' => 'date_employed']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        EMPLOYEE INFORMATION
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('first_name', 'First Name: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Juan', 'id' => 'first_name']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('middle_name', 'Middle Name: ', ['class' => "col-sm-3 control-label"]) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('middle_name', null, ['id' => 'middle_name', 'class' => 'form-control', 'placeholder' => 'Dela']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('last_name', 'Last Name: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Cruz']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('name_suffix', 'Suffix: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('name_suffix', null, ['class' => 'form-control', 'id' => 'name_suffix', 'placeholder' => 'Sr., Jr., II, III']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('email', 'E-mail: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('position', 'Position: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('position', $positions, null, ['class' => 'form-control', 'id' => 'position']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('designation', 'Designation: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('designation', $designations, null, ['class' => 'form-control', 'id' => 'designation']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('department', 'Department: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('department', $departments, null, ['class' => 'form-control']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('business_unit', 'Business Unit: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('business_unit', $businessUnits, null, ['class' => 'form-control']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        EMPLOYEE ADDRESS
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('street', 'Street: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => 'Street', 'id' => 'street']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'City', 'id' => 'city']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('province', 'Province: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('province', null, ['class' => 'form-control', 'placeholder' => 'Province', 'id' => 'province']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('zipcode', 'Zipcode: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('zipcode', null, ['class' => 'form-control', 'placeholder' => 'Zipcode', 'id' => 'zipcode']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        EMPLOYEE BENEFITS
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        @for($benefitCounter = 0; $benefitCounter < count($benefits); $benefitCounter++)
                            <div class="form-group row">
                                {!! Form::label('benefits['. $benefitCounter .']', $benefits[$benefitCounter] . ': ', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('benefits['. $benefitCounter .']', null, ['class' => 'form-control', 'placeholder' => $benefits[$benefitCounter]]) !!}
                                </div>
                            </div>
                        @endfor
                        {{-- /.row --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        CONTACT INFORMATION
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('mobile_number', 'Mobile No: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('mobile_number', null, ['class' => 'form-control', 'placeholder' => 'Mobile No', 'id' => 'mobile_number']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('telephone_number', 'Telephone No: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('telephone_number', null, ['class' => 'form-control', 'placeholder' => 'Telephone No', 'id' => 'telephone_number']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label(null, 'In case of Emergency: ', ['class' => 'col-sm-12 control-label text-danger']) !!}
                            {{-- /label --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('emergency_name', 'Contact Name: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('emergency_name', null, ['class' => 'form-control', 'placeholder' => 'Contact Name', 'id' => 'emergency_name']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('emergency_number', 'Emergency No: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('emergency_number', null, ['class' => 'form-control', 'placeholder' => 'Emergency No', 'id' => 'emergency_number']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ADDITIONAL INFORMATION
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('dob', 'Date of Birth: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('dob', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control input-date' , 'id' => 'dob']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('birthplace', 'Place of Birth: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('birthplace', null, ['class' => 'form-control', 'placeholder' => 'Place of Birth', 'id' => 'birthplace']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        <div class="form-group row">
                            {!! Form::label('height', 'Height: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::input('number', 'height', null, ['class' => 'form-control', 'placeholder' => 'Height in centimeters']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        <div class="form-group row">
                            {!! Form::label('weight', 'Weight: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::input('number', 'weight', null, ['class' => 'form-control', 'placeholder' => 'Weight in kilograms']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('religion', 'Religion: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::text('religion', null, ['class' => 'form-control', 'placeholder' => 'E.g. Catholic', 'id' => 'religion']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('civil_status', 'Civil Status: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('civil_status', array('Single' => 'Single', 'Married' => 'Married'), null, ['class' => 'form-control']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        <div class="not-single-additional-info-container">
                            <div class="form-group row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="row">
                                        {!! Form::label('spouse_name', 'Name of Spouse:', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::text('spouse_name', null, ['class' => 'form-control', 'placeholder' => 'Name of Spouse']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- /.row --}}
                            <div class="form-group row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="row">
                                        {!! Form::label('number_of_children', 'Number of Children:', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::input('number', 'number_of_children', null, ['class' => 'form-control positive-only', 'placeholder' => 'Number of Children']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- /.row --}}
                        </div>
                        <div class="form-group row">
                            {!! Form::label('gender', 'Gender: ', ['class' => 'col-sm-3 control-label']) !!}
                            {{-- /label --}}
                            <div class="col-sm-9">
                                {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), null, ['class' => 'form-control']) !!}
                            </div>
                            {{-- /.form-control --}}
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('educational_attainment', 'Educ. Attainment: ', ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('educational_attainment', array(
                                    'None' => 'None',
                                    'Elementary' => 'Elementary',
                                    'Some High School' => 'Some High School',
                                    'High School Degree' => 'High School Degree',
                                    'Some College, No Degree' => 'Some College, No Degree',
                                    'Associate Degree' => 'Associate Degree',
                                    'Bachelor\'s Degree' => 'Bachelor\'s Degree',
                                    'Master\'s Degree' => 'Master\'s Degree',
                                    'Professional Degree' => 'Professional Degree',
                                    'Doctorate' => 'Doctorate',
                                ), null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('course', 'Course: ', ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('course', null, ['class' => 'form-control', 'placeholder' => 'Course']) !!}
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="panel panel-default">
                    <div class="panel-heading">
                        FAMILY INFORMATION
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            {!! Form::label('mother_name', 'Mother:  ', ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('mother_name', null, ['class' => 'form-control', 'placeholder' => 'Mother\'s Name']) !!}
                            </div>
                        </div>
                        {{-- /.row --}}
                        <div class="form-group row">
                            {!! Form::label('father_name', 'Father: ', ['class' => 'control-label col-sm-3']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => 'Father\'s Name']) !!}
                            </div>
                        </div>
                        {{-- /.row --}}
                    </div>
                </div>
            </div>
            {{-- /.col-sm-6.col-sm-offset-3 --}}
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Fields
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <button type="submit" class="btn btn-md btn-block btn-primary">Save <span class="fa fa-save"></span></button>
                        <button type="reset" class="btn btn-md btn-block btn-danger">Reset <span class="fa fa-eraser"></span></button>
                    </div>
                </div>
                {{-- /.panel --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Display Photo
                        <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="display-photo-container text-center">
                            <img src="{{ url('images/default_user_thumbnail.png') }}" alt="Employee Display Photo" class="img-thumbnail img-responsive center-block" id="display-photo-thumbnail">
                            {!! Form::input('file', 'display_photo', null, ['accept' => 'image/*', 'class' => 'file-input', 'id' => 'image-input']) !!}
                        </div>
                    </div>
                </div>
                {{-- /.panel --}}
            </div>
        </div>
        {{-- /.row --}}
    {!! Form::close() !!}
    {{-- /.form --}}
@endsection
