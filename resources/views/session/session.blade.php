@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> Add Categories</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">Add Session</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))
            <form action="{{ route('session.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');
            @else
            <form action="{{ route('session.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
        

                <div class="form-group">
                    <label class="col-sm-2 control-label">Start Date : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="startDate" value="{{ old('startDate',isset($data->startDate) ? $data->startDate : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">End Date : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="endDate" value="{{ old('endDate',isset($data->endDate) ? $data->endDate : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Session Name : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Sale Invoice Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="saleInvoicePrefix" value="{{ old('saleInvoicePrefix',isset($data->saleInvoicePrefix) ? $data->saleInvoicePrefix : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Purchase Invoice Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="purchaseInvoicePrefix" value="{{ old('purchaseInvoicePrefix',isset($data->purchaseInvoicePrefix) ? $data->purchaseInvoicePrefix : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Customer Payment Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="CPPrefix" value="{{ old('CPPrefix',isset($data->CPPrefix) ? $data->CPPrefix : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Payment Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="SPPrefix" value="{{ old('SPPrefix',isset($data->SPPrefix) ? $data->SPPrefix : '' ) }}">
                    </div>
                </div>

          
                <div class="form-actions">
                    <a href="{{ route('category.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection