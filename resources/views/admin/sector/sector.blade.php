@include('template.header')
<meta name="csrf_token" content="{{ csrf_token() }}">
@include('template.sidebar')
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
                                <h4 class="mt-0 header-title" style="display:inline-block">Sectors</h4>
                                <a href="{{url('admin/editsector/0')}}"><button type="button" class="btn btn-outline-primary waves-effect waves-light"  style="display:inline-block; float:right;"><i class="mdi mdi-table-edit"></i>&nbsp;New</button>
                                </a>
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
                    url: "{{url('admin/delete_sector')}}",
                    type: 'POST',
                    data: {id:id},
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },
                    // processData:false,
                    // contentType: false,
                    success: function (result) {
                        var res = $.parseJSON(result);
                        if(res.success==true){
                            Swal.fire("Deleted!", "Your file has been deleted.", "success");
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
                "url": '{{url("/admin/sectorlist")}}',
                "data": {},
                "dataSrc": "data",
                "dataType": "json",
                "cache": false,
                "headers": {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },
            },
            "columnDefs":[
            {
                "targets": [4],
                orderable: false,
                "createdCell": function (td, cellData, rowData, row, col) {
                    var id = ''+cellData+'';
                    html = '<a href="{{url('admin/editsector/')}}/'+cellData+'"><input class="btn btn-info" type="button" value="Edit"></a> <input class="btn btn-danger" type="button" value="Delete" onclick="user_delete('+cellData+')">'
                    $(td).html(html);
                }
            }],
            
            

            "columns": [
                {"title": "No", "data": "index", "class": "text-center", "width": "5%"},
                {"title": "Name_En", "data": "name", "class": "text-center", "width": "5%"},
                {"title": "Name_Ar", "data": "name_a", "class": "text-center", "width": "5%"},
                {"title": "Description", "data": "description", "class": "text-center", "width": "10%"},
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

        
</script>