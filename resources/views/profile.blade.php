@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.profile') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
				<div class="box">
					<!-- <div class="box-header with-border">
						 <h3 class="box-title">Edit Your Profile</h3> -->

						<!-- <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div> 
					</div>-->
					<div class="box-body">
					<div class="row">
        <div class="col-md-12">
		<h2 class="text-center" style="margin-top: 0px;">{{ $user->name }}'s Profile</h2>
            <div class="col-md-4">
			<img class="text-center" src="/uploads/avatars/{{ $user->avatar }}" style="width:200px; height:200px; border-radius:50%; margin-right:25px;">
       
			</div>
			<div class="col-md-8" style="padding-top: 30px;">
            <form enctype="multipart/form-data" action="/profile" method="POST">
				<div class="form-group has-feedback ">
					<input placeholder="Full Name" name="name" value="{{ $user->name }}" autofocus="autofocus" class="form-control" type="text">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<!-- <div class="form-group has-feedback">
					<input placeholder="Email" name="email" value="{{ $user->email }}" class="form-control" type="email" readonly />
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div> -->
				<div class="form-group has-feedback">
					<input id="password-field"  minlength="12" placeholder="Enter New Password Or Leave Blank To Use Existing" name="new_password" class="form-control" type="password">
						<span title="Show Password" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password "></span>
				</div>
				<div class="form-group has-feedback">
					<input id="password-field1"  minlength="12" placeholder="Enter New Password To Confirm" name="new_password_confirmation" class="form-control" type="password">
						<span title="Show Password" toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password "></span>
				</div>		
				<div class="form-group has-feedback">
					<input placeholder="Upload Profile Avatar" name="avatar" class="form-control" type="file">
					<span class="glyphicon glyphicon-camera form-control-feedback"></span>
				</div>	
				<div class="form-group has-feedback">
					<input id="password-field2"  minlength="5" placeholder="Enter Current Password" name="password" class="form-control" type="password" required>
						<span title="Show Password" toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password "></span>
				</div>	


				                <!-- <label>Update Profile Image</label>
                <input type="file" name="avatar">	 -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" id="submit" value="Save" class="pull-right btn btn-md btn-primary">
			
            	</form>
			</div>
        </div>
    </div>					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
	
@endsection
@section('customscripts')
<script type="text/javascript">
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
	$('#submit').click(function(e){
			if($("#password-field").val().length > 0){
				$("#password-field1").prop('required', true);
					if ($("#password-field").val() != $("#password-field1").val()) {
						// alert("12");
			            $("#password-field1")[0].setCustomValidity('Password Must be Matching.');
			        } else {
			        	// alert("15");
			            // input is valid -- reset the error message
		           		 $("#password-field1")[0].setCustomValidity('');

			        }


			}
			else{
				$("#password-field1").prop('required', false);

			}
			
		});
    </script>
@endsection
