    
        <!-- <link href="{{ public_path('assets/css/icons.css')}}" rel="stylesheet" type="text/css"> -->
 <link rel="stylesheet" type="text/css" href="{{ public_path('assets/front/css/bootstrap.min.css')}}" />
   
    <link rel="stylesheet" type="text/css" href="{{ public_path('assets/front/css/style.css')}}" />
    
<style>
    .font1 {
        padding-top: 8px;
        font-size: 11px;
        font-weight: bold;
        font-family: serif;
        letter-spacing: -1px
    }
    .font2{
        font-weight: bold;
        font-family: serif;
    }
    .font3{
        font-size: 12px;
        color: #0a3a6d;
        margin:0px 10px 0px 0px;
        font-weight: bold;
    }
    .text_right{
        margin:0px 10px 5px 0px;
        font-size: 12px;
        text-align: right;
    }
    .font4{
        font-size: 10px;
        font-family: serif;
    }
</style>
<div class="container" style="height:800px;  width: 750px; padding-left:30px"  >
<img src="{{ public_path('assets/front/images/stamp.png')}}" alt="Certificate" align="center" style="position: absolute;left:35%;top:30px;z-index:-1;width:200px;height:200px">
    <table style="width:100%; border: 9px #CCC; height: 130px; padding-top:50px; padding-left: 10px;font-size: 1.2em; margin: 0 auto;">
        <tr>
            <td>
                <table style="width:95%; border: 1px #000 solid;">
                    <tr>
                        <td >
                        </td>
                        <td> 
                        </td>
                        <td class="font1" style="text-align: right;"> :)C.R(
                            <span style = "font-family: DejaVu Sans, serif;">رقم اؤًجي ا خًجاري</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font1" style="text-align: right;"> :)Ref. No(
                            <span style="font-family: DejaVu Sans, serif;letter-spacing: -1px"> رقم المعاملة</span>
                        </td>
                        <td class="font1" style="text-align: center;"> 
                            <span style="font-family: DejaVu Sans, serif;color:red">وزارة ا خًجارة واصًناعة</span>
                        </td>
                        <td class="font1" style="text-align: right;">: )Name of Company(
                            <span style="font-family: DejaVu Sans, serif;"> ملدم ا طًلب</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font1" style="text-align: right;">:)Date(
                            <span style="font-family: DejaVu Sans, serif;">تاريخ ا خًلديم</span>
                        </td>
                        <td class="font1" style="text-align: center;"> 
                            <span style="font-family: DejaVu Sans, serif;color:red">المديرية ا عًامة لٌمواصفات والملاييس</span>
                        </td>
                        <td class="font1" style="text-align: right;">: )Contact No.(
                            <span style="font-family: DejaVu Sans, serif;">رقم ا خًواص</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td class="font1" style="text-align: center;"> 
                            <span style="font-family: DejaVu Sans, sans-serif;color:red">دائرة المطابلة</span>
                        </td>
                        <td class="font1" style="text-align: right;margin-bottom:5px"> :)Company Stamp(
                            <span style="font-family: DejaVu Sans, sans-serif;">ختم اشًرنة</span>
                        </td>
                    </tr>
                </table>
                <br>
                <div style="text-align: center; margin-bottom:10px; letter-spacing: -0.5px">
                    <span style="font-family: DejaVu Sans, sans-serif;text-align:right;letter-spacing: -1.5px;font-size: 15px;">أ مام طلبم</span>
                    )<img style="margin-top: 5px;" src="{{ public_path('assets/front/images/check.png')}}" alt="Certificate" >(
                    <span style="font-family: DejaVu Sans, sans-serif;letter-spacing: -1.5px;font-size: 15px;">ا رًجاء وضع       </span>
                    <span class="font2" style="margin-left:30px; font-size: 15px;">PLEASE PUT )
                        <img style="margin-top: 5px;" src="{{ public_path('assets/front/images/check.png')}}" alt="Certificate" >( NEAR
                    </span>
                    <span style="font-size: 12px;">YOUR REQUEST</span>
                </div>
                <hr style="margin-top:0px;  margin-bottom: 1rem; border: 0; border-top: 1px solid rgb(0, 0, 0)">
            </td>
    </table>
    <div style="text-align:center"><span style="text-align: center;font-family: DejaVu Sans, sans-serif; color:#0a3a6d;text-decoration: underline;"><b>{{$eval_his->sector_name}}</b><b>&#32;{{$eval_his->sector_name_a}} </b></span></div>
    
    
    <table style="width:100%;margin-top:3px;">
        <tr  style="border: 0px #000 solid; text-align: center;">
            <th  rowspan="1" style=" width:0%; border: 1px #000 solid; padding:2px;">
                <p style="font-family: DejaVu Sans, sans-serif;letter-spacing: -1.5px;" class="font3">رسوم المعاملة</p>
                <p class="font3">Coast</p>
            </th>
            <th  rowspan="1" style="width:5%; border: 1px #000 solid;"> 
                <p style="font-family: DejaVu Sans, sans-serif;letter-spacing: -1.5px;" class="font3">عدد ا وًثائق</p>
                <p class="font3">No. of</p>
                <p class="font3">DOC.s</p>
            </th>
            <th  colspan="2" style="width:60%;border: 1px #000 solid;"> 
                <p style="font-family: DejaVu Sans, sans-serif;" class="font3">ا وًثائق الملدمة</p>
                <p class="font3">Documents</p>
            </th>
            <th rowspan="1" style="width:30%;border: 1px #000 solid;"> 
                <p style="font-family: DejaVu Sans, sans-serif;" class="font3">الخدمة</p>
                <p class="font3">Request</p>
            </th>
        </tr>
        	@foreach($services as $key => $service_item)
                @foreach($service_item['document_url'] as $key1 =>$doc_item)
                <tr  >
                    <td style="border: 1px #000 solid; font-size:12px; ">
                      {{ $service_item['service']->price != "" ? $service_item['service']->price.' OMR':''}}
                    </td>
                    <td style="border: 1px #000 solid;"> 
                        
                    </td>
                    <td style="border: 1px #000 solid;font-family: DejaVu Sans, sans-serif; padding:3px;" class="font4">
                        <img src="{{ public_path('assets/front/images/unchecked.png')}}" style="width:10px;height:10px; margin:5px" alt="checkbox" > <span>{{$doc_item->doc_name_en}}</span>
                    </td>
                    <td style="border: 1px #000 solid; padding:3px;text-align: right; " class="font4" > 
                        <img src="{{ public_path('assets/front/images/unchecked.png')}}" style="width:10px;height:10px; margin:5px; float:right" alt="checkbox" > <span style="font-family: DejaVu Sans, sans-serif; margin-right:0px;letter-spacing: -1.5px;"> {{$doc_item->doc_name_ar}}</span>
                    </td>
                    @if($key1 < 1)  
                    <td style="border: 1px #000 solid; padding:3px;"  rowspan="{{count($service_item['document_url'])}}" >
                        <div class="text_right"><img src="{{ public_path('assets/front/images/unchecked.png')}}"style="width:10px;height:10px; margin:5px;float:right"  alt="checkbox" ><span style="font-family: DejaVu Sans, sans-serif;letter-spacing: -1.5px;">{{$service_item['service']->name_a}}</span></div>
                        <div class=""><span >{{$service_item['service']->name}}</span></div>
                    </td>
                    @endif
                </tr>
                @endforeach
            @endforeach

                
    </table>
    <br>
    <img src="{{ public_path('assets/front/images/bottom.png')}}" alt="Certificate" align="center" style="position: absolute;top:700px;">
</div>