@include('includes.header')

    <section class="ptb40 darkSection">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 p_col ">
                <!-- offset-lg-2 -->
                    <div class="payfeesSection">
                        <div class="payfeesRow submittedRow">

                            <div class="payfeesheader">
                                <h6>Edit Product</h6>
                            </div>
                            
                        </div>

                        <div class="submittedDocTable">

                           
                            <form class="" action="{{url('save_product')}}" autocomplete="on" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                            
                                <input type="hidden" name="product_id" value="{{isset($product['id'])?$product['id']:'0'}}">
                                <div class="form-group row" >
                                    <label class="col-md-2" style="text-align:right"><h5>Product Name</h5> </label>
                                    <input type="text" class="cardinput col-md-3 offset-md-1" name="product_name" placeholder="name"  value="{{!empty($product)?$product['name_e']:old('product_name')}}" >
                                    <input type="text" class="cardinput col-md-3 offset-md-1" name="product_name_ara" placeholder="name_ara"  value="{{!empty($product)?$product['name_a']:old('product_name_ara')}}" >
                                </div>
                                @foreach($detail as $key3 =>$item3)
                                    <div class="form-group row" >
                                        <label class="col-md-2" style="text-align:right"><h5> {{$item3->detail_item}}</h5></label>
                                        <textarea  class="cardinput col-md-7 offset-md-1" name="detail_{{$item3->id}}" required>{{isset($product[$item3->id])?$product[$item3->id]:''}}</textarea>
                                    </div>
                                @endforeach
                                <div class="form-group row" >
                                    <label class="col-md-2" style="text-align:right"><h5>Document</h5> </label>
                                    <div class="choseFileFiled col-md-7 offset-md-1">
                                    <input type="file" class="cardinput" style="opacity:0" name="document" placeholder="document" id="document" onchange="preview(this);" required>
                                        <span class="fileText"><img src="{{ URL::asset('assets/front/images/uploadFile.jpg')}}">{{!empty($product)?$product['document']:''}}</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                 <a href="javascript:return_product()"><button type="button" style="background-color:#58c358;border-color:#58c358;" class="btn " >Return</button></a>
                                 <button type="submit" class="btn btn-primary" id="resbmit">Change & Save</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div>

   
@include('includes.footer')

<script>
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $(input.files).each(function () {
                var s =this.name;
                $(input).parent().find('.fileText').html(s);
            })
        }
    };
    function return_product() {
        Swal.fire({
            title: "Data  unsaved!",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#58db83",
            cancelButtonColor: "#ec536c",
            confirmButtonText: "Yes"
          }).then(function (result) {
            if (result.value) {
            window.location.href="{{url('product_list')}}";
            }
        });
        
    }

</script>