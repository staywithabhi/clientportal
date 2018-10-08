@extends('adminlte::layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editmember') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<!-- Default box -->
        		<div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Update Member Details</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <b>Edit Details of `{{ $member->name }}`</b>
                                </div>
                                <div class="panel-body">

                                        {{ Form::model($member,array('route'=>array('memberUpdate', $member->id),'method'=>'PUT','enctype'=>'multipart/form-data'))}}
                                        <div class="row text-center">
                                                    <img src="/uploads/avatars/{{ $member->avatar }}" class="img-circle" style="width:100px;height:100px" alt="User Image" />
                                                </div>

                                        <div class="form-group required has-feedback ">
                                            {{ Form::label('name','Name')}}
                                           {{ Form ::text('name',null,array('class'=>'form-control ','required'=>'required'))}}
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>

                                    <div class="form-group required has-feedback ">
                                            {{ Form::label('name','Email')}}
                                           {{ Form ::email('email',null,array('class'=>'form-control','required'=>'required'))}}
                                           <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                        {{ Form::label('name','Password')}}
                                            <input minlength="12" id="password-field" placeholder="Please leave empty to use old existing password" name="password" class="form-control" type="password" >
                                            <span title="Show Password" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password "></span> 
                                         </div>	
                                        <div class="form-group has-feedback">
                                        {{ Form::label('name','Roles')}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                {{ Form::label('manager','Manager')}}
                                                    <input id="manager" class="member_role" type="checkbox" {{ $member->hasRole('manager') ? 'checked' : '' }} name="roles[manager]">
                                                </div>
                                                <div class="col-md-4">
                                                {{ Form::label('readonly','Read Only')}}
                                                    <input id="readonly" class="member_role" type="checkbox" {{ $member->hasRole('readonly') ? 'checked' : '' }} name="roles[readonly]">
                                                </div>
                                                <div class="col-md-4">
                                                {{ Form::label('readwrite','Read Write') }}
                                                    <input id="readwrite" class="member_role" type="checkbox" {{ $member->hasRole('readwrite') ? 'checked' : '' }} name="roles[readwrite]">         
                                                </div>
                                            </div>
                                        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
                                        </div>

                                        <!-- <input type="hidden" name="client_id" value=""> -->
                                         {{ Form ::hidden('client_id',null,array('class'=>'form-control ','required'=>'required'))}}
                                        <div class="form-group has-feedback">
                                                
                                                  
                                                        {{ Form::label('name','Avatar Image')}}
                                                    <input placeholder="Upload Profile Avatar" name="avatar" class="form-control" type="file" >
                                                    <span class="glyphicon glyphicon-camera form-control-feedback"></span>
                                               
                                        </div>	

                                        
                                    {{Form::submit('Save',array('class'=>'pull-right btn btn-primary'))}}
                                    {{ Form::close()}}
            </div>

                            </div>
                        </div>

                    </div>

                </div>

				<!-- /.box -->
        	</div>
		</div>
	</div>

@endsection
@section('customscripts')
<script type="text/javascript">
	    $('.member_role').on('change', function() {
		    $('.member_role').not(this).prop('checked', false);  
		});
                $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                // alert("hello");
                input.attr("type", "text");
            } else
            {
                // alert("hello2");
                input.attr("type", "password");
            }
        });
    </script>
@endsection
