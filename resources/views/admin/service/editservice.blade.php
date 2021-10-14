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
                                <h4 class="mt-0 header-title" style="display:inline-block">Edit service</h4>
                                <a href="{{url('admin/service')}}"><button type="button" class="btn btn-outline-primary waves-effect waves-light"  style="display:inline-block; float:right;"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;  List</button>
                                </a>
                            </div>
                            
                            <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card m-b-20 ">
                                    <div class="card-body">
                                        <form class="" action="{{url('admin/insert_service')}}" autocomplete="on" method="post" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                <input type="hidden" name="id" value="{!! isset($service)? $service[0]->id:''  !!}" />    
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Sector Name</label>
                                                        <div class="col-sm-7" style="padding:0px">
                                                        <select class="form-control " name="sector_id" >
                                                            @foreach($sector as $key=>$item)
                                                            <option value="{{$item->id}}" {!! isset($service) &&  $service[0]->sector_id == $item->id? 'selected':''  !!} >{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" > Name_En</label>
                                                        <input type="text" class="form-control col-sm-7" name="name" required placeholder=" Name" value="{!! isset($service) ? $service[0]->name:old('name') !!}" />
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" > Name_Ar</label>
                                                        <input type="text" class="form-control col-sm-7" name="name_a" required placeholder=" Arabic Name" value="{!! isset($service) ? $service[0]->name_a:old('name_a') !!}" />
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Description</label>
                                                        <input type="text" class="form-control col-sm-7" name="description" required placeholder="Description" value="{!! isset($service)? $service[0]->description:old('description') !!}"/>
                                                    </div>
                                                    <div class="form-group row" >
                                                        <label class="col-sm-4" >Price</label>
                                                        <input type="text" class="form-control col-sm-7" name="price" required placeholder="Price" value="{!! isset($service)? $service[0]->price:old('price') !!}"/>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div style="float:right;">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                            
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->

    </div> <!-- content -->

   


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


        
});



</script>