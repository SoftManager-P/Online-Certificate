@include('template.header')
<meta name="csrf_token" content="{{ csrf_token() }}">
@include('template.sidebar')
<style type="text/css">
  .input{
    display:inline-block;
    /*float: left;*/
  }
</style>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-page">
                <!-- Start content -->
   <div class="content">
        <div class="container-fluid" style="padding-top:15px;">

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                    
                        <div class="card-body">
                            
                            <div class="" style="padding:25px;">
                                <h4 class="mt-0 header-title" style="display:inline-block">Evaluate History</h4>
                                
                            </div>
                            <div class="form-group row" style="padding:15px;">
                             
                                <label class="col-sm-2 col-form-label">Sector Name</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="sector_id" id="sector">
                                        <option value="">select sector name</option>
                                        @foreach($sector as $key => $value)
                                        <option value="{{$value->id}}" >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-1 col-form-label">Status</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="status_id" id="status">
                                        <option value="">select status</option>
                                        <option value="1" >Pending</option>
                                        <option value="2" >Approved</option>
                                        <option value="3" >Rejected</option>
                                       
                                    </select>
                                </div>
                         
                                <!-- <label class="col-sm-2 col-form-label">Service Name</label>
                                <div class="col-sm-4">
                                    <select  id="service_id" class="form-control" >
                                        <option value="0" >select service name</option>
                                    </select>
                                </div> -->
                            </div>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 10; width: 100%;">
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->

    </div> <!-- content -->

    

</div> 

   <button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Detail view</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <!-- <form class="" action="{{url('resubmit')}}" autocomplete="on" method="post" enctype="multipart/form-data">
                @csrf -->
                <div class="modal-body">
                
                    <input type="hidden" name="his_id" id="update_id">
                    <div class="form-group">
                        <span class="form-group" id="review" style="width:100%">
                            
                        </span>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal" id="resbmit">Close</button>

                </div>
                <!-- </form> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>

<!-- /.modal -->


<!-- /.content-wrapper -->
@include('template.footer')  
<script>

    var $table = $('#datatable');
    function user_delete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            confirmButtonText: "Yes, delete it!"
          }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "{{url('employee/delete_evaluate')}}",
                    type: 'POST',
                    data: {id:id},
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },// processData:false,
                    // contentType: false,
                    success: function (result) {
                        var res = $.parseJSON(result);
                        if(res.success==true){
                            Swal.fire("Deleted!", "Item has been deleted.", "success");
                            $table.DataTable().ajax.reload('', false);

                        }
                        
                    },
                    error: function(){ 
                       
                    }
                }); 
            }
        });
    }

    $(document).ready(function() {
      
        var datatable = $table.dataTable({
            "ordering": false,
            "info": true,
            "searching": true,
            "ajax": {
                "type": "POST",
                "async": true,
                "url": '{{url("/employee/evaluate_history")}}',
                "data" : function(d){
                    return {                
                            sector_id: $('#sector').val(),
                            status_id: $('#status').val(),
                           };

                },
                
                "dataSrc": "data",
                "dataType": "json",
                "cache": false,
                "headers": {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },
            },
            "columnDefs":[
            {
                "targets": [1],
                orderable: true,
                "createdCell": function (td, cellData, rowData, row, col) {
                   
                    $(td).html(''+rowData.first_name+' '+rowData.last_name+'');
                }
            },{
                "targets": [5],
                orderable: true,
                "createdCell": function (td, cellData, rowData, row, col) {
                   if(cellData == '1'){
                    $(td).html('<span class="btn btn-warning">Pending</span>');
                   } else if(cellData == '2'){
                    $(td).html('<a href = "javascript:detail(\''+rowData.review+'\')"><span class="btn btn-success">Approved</span></a>');
                   } else if(cellData == '3'){
                    $(td).html('<a href = "javascript:detail(\''+rowData.review+'\')"><span class="btn btn-danger">Rejected</span></a>');
                   }
                    
                }
            },
            {
                "targets": [6],
                orderable: false,
                "createdCell": function (td, cellData, rowData, row, col) {
                    var id = ''+cellData+'';
                    html = '<a href="{{url('employee/editevaluate_history/')}}/'+cellData+'"><input class="btn btn-info" type="button" value="Evaluate"></a> <input class="btn btn-danger" type="button" value="Delete" onclick="user_delete('+cellData+')">'
                    $(td).html(html);
                }
            }],

            "columns": [
                {"title": "No", "data": "index", "class": "text-center", "width": "5%"},
                
                {"title": "Name", "data": "id", "class": "text-center", "width": "15%"},
                {"title": "Company Name", "data": "company_name", "class": "text-center", "width": "10%"},
                {"title": "Sector Name", "data": "sector_name", "class": "text-center", "width": "5%"},
                {"title": "Created at", "data": "created_at", "class": "text-center", "width": "10%"},
                {"title": "Status", "data": "status", "class": "text-center", "width": "10%"},
                {"title": "Active", "data": "id", "class": "text-center", "width": "10%"},
                
            ],
            "lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
            "scrollX": true,
            "scrollCollapse": false,
            "jQueryUI": true,
            "paging": true,
            "pagingType": "full_numbers",
            "pageLength": 20, // default record count per page
            bProcessing: true,
            autoWidth: true,
        });

       
    });
    function detail(review) {
        $('#review').html(review);
        $('#modal_button').click(); 
    }
    
    $('#sector').on('change',function(){
        $table.DataTable().ajax.reload("",false);
    })

    $('#status').on('change',function(){
        $table.DataTable().ajax.reload("",false);
    })
</script>