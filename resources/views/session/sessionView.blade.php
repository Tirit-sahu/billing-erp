@extends('layout.app')

@section('content')
    
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Categories </h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
            <a href="{{ route('session.create') }}" class="btn btn-info">ADD NEW SESSION</a>
        </li>
    </ul>
    <!-- /statistics -->

    <x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Table elements</h6></div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SNO.</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Session Name</th>
                        <th>Sale Invoice Prefix</th>
                        <th>Purchase Invoice Prefix</th>  
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $row)
                    <tr>
                    
                        <td class="text-center">{{ $loop->index+1 }} </td>
                        <td> {{ $row->startDate }}</td>
                        <td> {{ $row->endDate }}</td>
                        <td> {{ $row->name }}</td>
                        <td> {{ $row->name }}</td>
                        <td> {{ $row->name }}</td>

                        <td>
                            <div >


                            <a href="{{route('session.edit',$row->id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                            </a>
                            
                            <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                <form action="{{route('session.destroy',$row->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-default btn-icon btn-xs tip">
                                        <i class="fa fa-minus" onclick="return confirm('Are you sure to Delete?')" title="Delete"></i>
                                    </button>
                                </form>
                            </a>

                            </div>
                        </td>
                    </tr>

                   @endforeach 
                   
                </tbody>
            </table>
        </div>
    </div>






</div>

@endsection