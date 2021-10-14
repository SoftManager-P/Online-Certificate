@include('includes.header')

    <section class="ptb40 darkSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12 p_col offset-lg-2">
                    <div class="payfeesSection">
                        <div class="payfeesRow submittedRow">

                            <div class="payfeesheader">
                                <h6>Submitted documents</h6>
                                <p>(Check status of submitted documents)</p>
                            </div>
                            <div class="seachbox">
                                <div class="searchWidth"><input type="text" class="cardinput search"
                                        placeholder="Search by name. Tag" id="search" onchange="search_submitted()">
                                </div>
                                <!-- <div class="filterbtn"><img src="{{ URL::asset('assets/front/images/filter.svg')}}"></div> -->
                            </div>
                        </div>

                        <div class="submittedDocTable">

                            <table class="rwd-table">
                                <tr>
                                    <th>Sectors</th>
                                    <th>Services</th>
                                    <th>Time </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($evlauate_history as $key => $item)
                                <tr style="">
                                    <td data-th="Sectors">
                                        <div class="sectorsBox">
                                            <a href="{{url('document_detail')}}/{{$item->id}}" target="_blank"><div class="sectors1"><img src="{{ URL::asset('assets/front/images/pdfdownloadsmall.png')}} "style="width: 80px; height: 50px;" ></div></a>
                                            <div class="sectors2">

                                                <h2>{{$item->sector_name}}</h2>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Services">
                                        @if($item->cert_type == 'product')
                                        <span>All My Products </span>
                                        @else
                                        @foreach($item->service as$sitem)
                                        <span class="tagSector">{{$sitem}}</span>
                                        @endforeach
                                        @endif
                                    
                                    </td>
                                    <td data-th="Time">
                                        <div class="sectorTime">{{date("H:ia",strtotime($item->updated_at))}}</div>
                                        <div class="sectorDate">{{date("m/d/Y",strtotime($item->updated_at))}}</div>
                                    </td>
                                    <td data-th="Status">
                                        @if($item->status == '1')
                                        <div class="waiting">Waiting for Approval</div>
                                        @elseif($item->status == '2')
                                        <div class="approved">Approved</div>
                                        @elseif($item->status == '3')
                                        <div class="rejected">Rejected</div>
                                        @endif

                                    </td>
                                    <td data-th="print">
                                        @if($item->status == '3')
                                        <button class="btn print"   onclick="detail({{$item->id}},'{{$item->review}}')" >Details</button>
                                        @else
                                        <button class="btn print"  onclick="approvedetail({{$item->id}},'{{$item->review}}')" {{ $item->status == '2'?'':'disabled'}}>Print</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div>

    <form id="print_form" method="POST" action="{{url('print_certification')}}">
        @csrf

        <input type="hidden" id="eval_id" name="eval_id">
    </form>
<!-- </div> -->

<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".bs-example-modal-center" id="modal_button"></button>
<div class="modal fade bs-example-modal-center descript" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                     <button type="submit" class="btn btn-primary" id="resbmit">Change Upload file</button>
                </div>
                <!-- </form> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<button type="button" class="btn btn-primary waves-effect waves-light" style="display: none;" data-toggle="modal" data-target=".approved_modal" id="approve_modal_button"></button>
<div class="modal fade bs-example-modal-center approved_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Detail view</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span class="form-group" id="approvereview" style="width:100%">
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn print"  onclick="print_cert()">Print</button>

                </div>
                <!-- </form> -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@include('includes.footer')

<script>

    // function print_cert(id) {
    //     $('#eval_id').val(id);
    //     $('#print_form').submit(); 
    //     setTimeout (function(){
    //         window.location.href = "{{url('submitted')}}";
    //     },10000)
    // }

    function detail(id, review) {
        $('#update_id').val(id);
        $('#review').html(review);

        $('#modal_button').click(); 
    }
    function approvedetail(id, approvereview) {
        // $('#update_id').val(id);
        $('#approvereview').html(approvereview);
        $('#approve_modal_button').click(); 
    }
    $('#resbmit').on('click', function(){
        window.location.href = "{{url('resubmit')}}/"+$('#update_id').val();
        
    })

    function search_submitted(){
        var search = $('#search').val();

        var table_tr = $('tr');
        for (var i = 1; i < table_tr.length; i++) {
            var $that = $(table_tr[i]);
            var str = '';
            $that.find('.sectors2').each(function() {
                // var s = this;
            str += this.innerText;
            })
            $that.find('.tagSector').each(function() {
            str += this.innerText;
            })
            
            var pos = str.indexOf(search);
            if(pos == -1){
                $that.css('display','none');
            }else{
                $that.css('display','')
            }
            if(search == '')
                {$that.css('display','');}
        }
    }

</script>