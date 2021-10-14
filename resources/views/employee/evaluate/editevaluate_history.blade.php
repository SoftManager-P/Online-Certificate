@include('template.header')
@include('template.sidebar')
<style type="text/css">
  .input{
    display:inline-block;
    /*float: left;*/
  }
</style>
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
                                <h4 class="mt-0 header-title" style="display:inline-block">{{$eval_his->sector_name}}</h4>
                                <a href="{{url('employee/evaluate')}}"><button type="button" class="btn btn-outline-primary waves-effect waves-light"  style="display:inline-block; float:right;"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;  List</button>
                                </a>
                            </div>
                            
                            <div class="row">
                               
                                 <!-- <p style="font-size: 20px;text-align:center"></p> -->
                               
                                <table class="rwd-table  dt-responsive table table-hover mb-0" >
                                    <thead class="thead-light" style="text-align:center">
                                    <tr>
                                        <th>Product Name</th>
                                        @foreach($detail as $key =>$item)
                                        <th>{{$item->detail_item}}</th>
                                        @endforeach
                                        <th>Category </th>
                                        <th>Docment</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                    </thead>
                                    <tbody style="text-align:center">
                                    @foreach($product_info as $key1 => $item1)
                                    <tr class="">
                                        
                                        <td data-th="Sectors">
                                            <div class="sectorsBox">
                                            <input type="hidden" class="row_id" value="{{$item1['id']}}">
                                            <!-- <input type="checkbox" style="margin:10px;width:15px;height:15px;"> -->
                                                <div class="sectors2">
                                                    <h6>{{$item1['name']}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach($detail as $key2 =>$item2)
                                        <td data-th="Sectors">
                                            <span class="sectors2">{{isset($item1[$item2->id])?$item1[$item2->id]:''}}</span>
                                        </td>
                                        @endforeach
                                        <td data-th="Time">
                                            <div class="sectorTime">{{$item1['category_title']}}</div>
                                        </td>
                                        <td data-th="Time">
                                            <a href="{{url('')}}{{$item1['document']}}" target="_blank"><img src="{{ URL::asset('assets/front/images/pdfdownload.png')}}" style="width: 80px; height: 80px;"></a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div style="float:right">
                                <button type="button" data-toggle="modal" data-target=".approvedescript" class="btn btn-success waves-effect waves-light mr-1">Approve</button>
                                <button type="button" data-toggle="modal" data-target=".descript" class="btn btn-danger waves-effect waves-light mr-1">Reject</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->

        <button type="button" class="btn btn-primary waves-effect waves-light hidden" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
    <div class="modal fade bs-example-modal-center descript" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Reject Decription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="" action="{{url('employee/insert_evaluate')}}" autocomplete="on" method="post" role="form">
                @csrf
                <div class="modal-body">
                
                    <input type="hidden" name="id" value="{{$eval_his->id}}">
                    <input type="hidden" name="status" value="3">
                    <div class="form-group" >
                        <label class="" >Description</label>
                        <input type="text" class="form-control" name="review"  id="review"  required placeholder="Description" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-example-modal-center approvedescript" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Approve Decription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="" action="{{url('employee/insert_evaluate')}}" autocomplete="on" method="post" role="form">
                @csrf
                <div class="modal-body">
                
                    <input type="hidden" name="id" value="{{$eval_his->id}}">
                    <input type="hidden" name="status" value="2">
                    <div class="form-group" >
                        <label class="" >Description</label>
                        <input type="text" class="form-control" name="review"   required placeholder="Description" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



<!-- /.content-wrapper -->
@include('template.footer')  
<script>
  var s='{{Session::get('msg')}}';
  if(s !=''){
    Swal.fire(s);
  }
  var e='{{Session::get('error_msg')}}';
  if(e !=''){
    Swal.fire(e);
  }
  
$(document).ready(function() {
        var $table = $('.rwd-table');
        var datatable = $table.dataTable({
            "ordering": false,
            "info": true,
            "searching": true,
            "lengthMenu": [
                [5, 10, 20, 50, 150, -1],
                [5, 10, 20, 50, 150, "All"] // change per page values here
            ],
            "scrollY": false,
            "scrollX": true,
            "scrollCollapse": true,
            "jQueryUI": true,
            "paging": true,
            "pagingType": "full_numbers",
            "pageLength": 20, // default record count per page
            bProcessing: true,
            autoWidth: false,
        });
        $('#DataTables_Table_0_wrapper').attr('style','width:100%');
        $('.rwd-table').attr('style','width:100%');
        $('.dataTables_scrollHeadInner').attr('style','width:100%');

})
</script>