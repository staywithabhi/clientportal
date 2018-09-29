@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Current user
            </div>
            <div class="modal-body">
                Are you sure you want to delete this client?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">

				<!-- Default box -->
        		<div id="page-wrapper">
<!--                     <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                    </div> -->
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-right">
                                    <b style="float:left;margin-top:5px">Manage Members For - "{{ $clienttitle }}"</b>
            <a href="{{ route('addMember') }}" class="btn btn-primary btn-add-new" style="border: 1px solid;">
                <i class="voyager-plus"></i> <span>{{ trans('adminlte_lang::message.AddNew') }}</span>
            </a>
                                </div>
                                <div class="panel-body">
                                 
                                {!! $html->table(['class'=>'table-stripped']) !!}
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
<!-- @section('customscripts')
{!! $html->scripts() !!}
@stop -->