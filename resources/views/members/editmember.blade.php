@extends('adminlte::layouts.app')
@section('members')
{!! 'class="active"' !!}
@stop
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
            
                                    <div class="form-group required has-feedback">
                                        {{ Form::label('name','User Type')}}
                                        <select id="usertype" name ="usertype" class="form-control form-control-lg" required>
                                            <option value=''>Please Select A Role</option>
                                            <option <?php if ($member->usertype=='manager'){ echo "selected='selected'"; } ?> value="manager">Manager</option>
                                            <option <?php if ($member->usertype=='custom'){ echo "selected='selected'"; } ?> value="custom">Custom</option>
                                        </select>       
                                        <span class="glyphicon glyphicon-compressed form-control-feedback"></span>
                                        </div>

                                        <div class="form-group  has-feedback user-module-roles" style="display:none">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                {{ Form::label('name','Manage Clients :')}}
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <input class="client_role" {{ $member->hasRole('readonly') ? 'checked' : '' }}  type="checkbox" id="clientR" name="roles[readonly]">
                                                    {{ Form::label('clientR','Read Only')}}
                                                </div>
                                                <div class="col-md-4 text-center">
                                                        <input class="client_role" {{ $member->hasRole('readwrite') ? 'checked' : '' }} type="checkbox" id="clientRW" name="roles[readwrite]">
                                                    {{ Form::label('clientRW','Read & Write')}}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <input type="hidden" name="client_id" value=""> -->
                                         {{ Form ::hidden('client_id',null,array('class'=>'form-control ','required'=>'required'))}}
                                        <div class="form-group has-feedback">
                                                
                                                  
                                                        {{ Form::label('name','Avatar Image')}}
                                                    <input placeholder="Upload Profile Avatar" name="avatar" class="form-control" type="file" >
                                                    <span class="glyphicon glyphicon-camera form-control-feedback"></span>
                                               
                                        </div>	

                            <input class="admin-role hidden" {{ $member->hasRole('manager') ? 'checked' : '' }} type="checkbox" id="adminbox" name="roles[manager]">

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
    if($("#usertype").prop('selectedIndex')==2){
        $('.user-module-roles').show();
    }
        $('.client_role').on('change', function() {
            $('.client_role').not(this).prop('checked', false);  
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
                        $(function() {
            $('#usertype').change(function(){
                // alert($(this).val());
                if($(this).val()==='custom')
                {
               $('.user-module-roles').show();
               $("#adminbox").prop('checked', false); 
            //    $(".user-module-roles input").attr("required","required");
                }
                else{
                    
                    $("#clientR").prop('checked', false); 
                    $("#clientRW").prop('checked', false); 
                    $('.user-module-roles').hide();
                    $("#adminbox").prop('checked', true);  
                    // $(".user-module-roles input").removeAttr("required");
                }
                // $('#' + $(this).val()).show();
            });
            });
    </script>
@endsection
