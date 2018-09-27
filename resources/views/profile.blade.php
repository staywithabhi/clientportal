@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
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
					<input placeholder="Enter New Password Or Leave Blank To Use Existing" name="password" class="form-control" type="password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>	
				<div class="form-group has-feedback">
					<input placeholder="Upload Profile Avatar" name="avatar" class="form-control" type="file">
					<span class="glyphicon glyphicon-camera form-control-feedback"></span>
				</div>	

				                <!-- <label>Update Profile Image</label>
                <input type="file" name="avatar">	 -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="pull-right btn btn-sm btn-primary">
			
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
