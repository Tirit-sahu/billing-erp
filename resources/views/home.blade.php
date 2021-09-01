@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-bars"></i> Dashboard <small>Welcome, Admin!</small></h5>
       
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"><a href="#" class="btn btn-default">52</a> <span>new pending tasks</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">520</a> <span>pending orders</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">14</a> <span>new opened tickets</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">48</a> <span>new user registrations</span></li>
    </ul>
    <!-- /statistics -->

        
 


 



    <!-- Footer -->
    <div class="footer">
        &copy; Copyright 2011. All rights reserved. Powered by <a href="#" title="">Codaxo Information Technology</a>
    </div>
    <!-- /footer -->

</div>

@endsection