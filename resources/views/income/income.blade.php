@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Incmoe</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Incmoe</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('expenses.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('expenses.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
            
               

                <div class="form-group">
                    <label class="col-sm-2 control-label">Head Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Head Name..." class="select-search" name="head_id" id="head_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($heads as $head)
                                <option value="{{ $head->id }}">{{ $head->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("head_id").value = "{{ old('head_id',isset($data->head_id) ? $data->head_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="date" value="{{ old('date',isset($data->date) ? $data->date : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Amount : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="amount" value="{{ old('amount',isset($data->amount) ? $data->amount : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pay Type : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Pay Type..." class="select-search" name="payType" id="payType" required tabindex="2">
                                <option value=""></option> 
                                <option value="1">Cash</option> 
                                <option value="2">Check</option> 
                            
                            </select>

                            <script>document.getElementById("payType").value = "{{ old('payType',isset($data->payType) ? $data->payType : '' ) }}"; </script>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="note" value="{{ old('note',isset($data->note) ? $data->note : '' ) }}">

                        <input class="form-control" type="hidden" name="insertType" value="{{ old('insertType',isset($data->insertType) ? $data->insertType : '2' ) }}">
                    </div>
                </div>

                

                <div class="form-actions pull-right">
                    <a href="{{ route('incomeIndex') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection