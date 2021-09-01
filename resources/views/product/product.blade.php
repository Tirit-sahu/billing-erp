@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> Add Product</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">Add Product</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('product.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('product.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Category Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="category_id" id="category_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($category as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("category_id").value = "{{ old('category_id',isset($data->category_id) ? $data->category_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Category Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="sub_category_id" id="sub_category_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($subCategory as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("sub_category_id").value = "{{ old('sub_category_id',isset($data->sub_category_id) ? $data->sub_category_id : '' ) }}"; </script>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Unit Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="unit_id" id="unit_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($units as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("unit_id").value = "{{ old('unit_id',isset($data->unit_id) ? $data->unit_id : '' ) }}"; </script>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Price : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" value="{{ old('price',isset($data->price) ? $data->price : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Status: </label>
                    <div class="col-sm-10">
                        <div class="widget-inner">
                            <label class="checkbox-inline">
                                <input type="checkbox"  class="styled" @if(isset($data)) @if($data->status==1) checked  @endif @endif name="status">
                                Active
                            </label>

                        </div>
                    </div>
                </div>

                <div class="form-actions pull-right">
                    <a href="{{ route('product.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection