@extends('layout.app')
@section('content')

<?php 
$party_id = 0;
$date = '';
$purchase_id = 0;
if(isset($purchase)){
  $party_id = $purchase->party_id;
  $purchase_id = $purchase->id;
  $date = date('d-m-Y', strtotime(date($purchase->date))); 
}
?>


<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> Add Purchase</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">Add Purchase</h6></div>
            <div class="panel-body">
            <x-alert />
            
            <form id="purchase-form" class="form-horizontal" method="post" >
                @csrf
                
                <input type="hidden" id="purchase_id" value="{{ $purchase_id }}">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Party Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Party Name" class="select-search" name="party_id" id="party_id" required tabindex="2">
                            </select>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" data-mask="99-99-9999" type="text" name="date" id="date" required value="{{ $date }}">
                    </div>
                </div>

                <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>    
                                <th>Unit</th>                            
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>    
                                    <input type="hidden" name="purchase_detail_id" id="purchase_detail_id">
                                      <select data-placeholder="Choose a Party Name" class="select-search" name="product_id" id="product_id"  tabindex="2" onchange="getPrice(this.value)">
                                      </select>
                                </td>

                                <td>
                                    <select data-placeholder="Choose a unit" class="select-search" name="unit_id" id="unit_id"  tabindex="2">
                                    </select>
                                </td>

                                <td>
                                        <input class="form-control" type="text" name="rate" id="rate" readonly required>
                                </td>

                                <td>
                                    <input class="form-control" type="number" name="qty" id="qty" required onkeyup="calcTotal(this.value)">                                    
                                </td>  

                                <td>
                                        <input class="form-control" type="text" name="total" id="total" readonly required>
                                </td>

                                <td>
                                    <button id="AddBTN" class="form-control btn btn-default" type="submit" name="total">ADD</button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
               



            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>    
                                <th>Unit</th>                            
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="purchase_details">
                            
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><center><b>Sub Total :</b></center></td>
                            <td><b>10000</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><center><b>Discount :</b></center></td>
                            <td><b>10000</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><center><b>Total :</b></center></td>
                            <td><b>10000</b></td>
                            <td></td>
                        </tr>
                    </table>

                </div>
            </div>


                <div class="form-actions pull-right">
                    {{-- <a href="" class="btn btn-danger">Back </a> --}}
                    <input type="button" onclick="final_submit()" value="Submit" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>

    <script>
        function final_submit(){
            var party_id = $("#party_id").val();
            var date = $("#date").val();
            var purchase_id = $("#purchase_id").val();
            var status = false;
            // alert(party_id+" - "+date);
            if(party_id=='' || party_id==null){
                alert('Select a party');
                status = false;
            }
            else{
                status = true;
            }

            if(date=='' || date==null){
                alert('Enter Date');
                status = false;
            }
            else{
                status = true;
            }

            if(status){
                $.ajax({
                    type:"GET",
                    url:"{{ route('purchase.final.submit') }}",
                    // dataType:'json',
                    data:{party_id:party_id,date:date,purchase_id:purchase_id},
                    success:function(data){
                        console.log(data);
                        if(data=="ADD"){
                            alert('SUBMIT SUCESSFULLY');
                            location.reload();
                        }
                        else if(data=="UPDATED"){
                            alert('UPDATED SUCESSFULLY');
                            location.reload();
                        }
                        else{
                            alert('SOMETHING WENT WRONG');
                        }
                    }
                });
            }

        }
    </script>



    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#purchase-form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
          url: "{{ route('purchase.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success:function(response){
            console.log(response);
            // alert(response);
            if(response=='UPDATE_SUCESSFULLY'){
                $("#AddBTN").html('ADD');
            }

            @if(isset($purchase))
                getDataForEdit({{$purchase_id}});
            @else
                getData();
            @endif
          
          },
          error: function(response) {
           }
         });

        });
      </script>

      <script>
          function getData(){
              $.ajax({
                  type:"GET",
                  url:"{{ route('purchaseDetails.index') }}",
                  success:function(data){
                    //   console.log(data);
                      $("#purchase_details").html(data);
                  }
              });
          }

          function getDataForEdit(id){
              $.ajax({
                  type:"GET",
                  url:"{{ url('purchaseDetailsEdit') }}?purchase_id="+id,
                  success:function(data){
                    //   console.log(data);
                      $("#purchase_details").html(data);
                  }
              });
          }

          @if(isset($purchase))
            getDataForEdit({{$purchase_id}});
          @else
            getData();
          @endif
            
          function edit_record(id){
              $.ajax({
                type:"GET",
                url:"{{ url('common-get-edit') }}?table=purchase_details&key=id&value="+id,
                success:function(data){
                    // console.log(data);
                    var x = JSON.parse(data);
                    fetchUnit(x.unit_id);
                    fetchProduct(x.product_id);
                    $("#rate").val(x.rate);
                    $("#qty").val(x.qty);
                    $("#total").val(x.total);
                    $("#purchase_detail_id").val(x.id);
                    $("#AddBTN").html('UPDATE');
                }
              });
          }
      </script>

      <script>
          function delete_record(id){
              if(confirm("Are you sure?")){
                    $.ajax({
                    type:"GET",
                    url:"{{ url('common-ajax-delete') }}?table=purchase_details&key=id&value="+id,
                    success:function(data){
                        // console.log(data);
                        alert(data);
                        getData();                   
                    }
                });
              }              
          }
      </script>



<script>
//Fetch Parties list 

function fetchParty(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=parties&id=id&column=name&type=supplier',
  success:function(response){
        //   console.log(response);
      $("#party_id").html(response);
      $("#party_id").val({{$party_id}});
      $('#party_id').trigger('change'); 
  }
  });
}   
//onload rung party function
fetchParty();

function fetchUnit(id=0){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=units&id=id&column=name&type=status',
  success:function(response){
    //   console.log(response);
      $("#unit_id").html(response);
      $("#unit_id").val(id);
      $('#unit_id').trigger('change'); 
  }
  });
}   
//onload rung party function
fetchUnit();
</script>

<script>
function fetchProduct(id=0){
$.ajax({
type:'GET',
url:'{{ url("common-get-select2") }}?table=products&id=id&column=name&type=status',
success:function(response){
    //  console.log(response);
    $("#product_id").html(response);
    $("#product_id").val(id);
    $('#product_id').trigger('change');
}
});
}  

fetchProduct();


//Calc Total
function calcTotal(qty){
    rate = $("#rate").val();
    total = parseFloat(rate)*qty;
    $("#total").val(total);
}
</script>

<script>
    function getPrice(id){
        $.ajax({
        type:'GET',
        url:'{{ url("common-get-value") }}?table=products&colum=price&key=id&val='+id,
        success:function(response){
             console.log(response);
            $("#rate").val(response);
        }
        });
    }
</script>

@endsection