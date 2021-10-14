@include('includes.header')
<div class="container" style="height:600px; <!--  display:none; -->  width: 720px;"  >
    <table style="width:100%; border: 9px #CCC; height: 130px; padding: 18px; padding-left: 10px;font-size: 1.2em; margin: 0 auto;">
        <tr>
            <td style="padding:5%">
                <table style="width:100%; border: 1px #000 solid;">
                    <tr style="width:30%;">
                        <td >
                        </td>
                        <td> 
                        </td>
                        <td style="text-align: right;"> :(C.R) رقم اؤًجي ا خًجاري
                        </td>
                    </tr>
                    <tr>
                        <td  style="text-align: center;"> :)Ref. No( رقم المعاملة
                        </td>
                        <td> 
                        </td>
                        <td style="text-align: right;">: )Name of Company ( ملدم ا طًلب
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">:)Date( تاريخ ا خًلديم
                        </td>
                        <td> 
                        </td>
                        <td style="text-align: right;">: )Contact No.( رقم ا خًواص
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td> 
                        </td>
                        <td style="text-align: right;"> :)Company Stamp) ختم اشًرنة
                        </td>
                    </tr>
                </table>
                <br>
                <h5 style="text-align: center;">أ مام طلبم()ا رًجاء وضع     PLEASE PUT () NEAR YOUR REQUEST</h5>
                <hr style="margin-top:0px;  margin-bottom: 1rem; border: 0; border-top: 1px solid rgb(0, 0, 0)" ;>
            </td>
    </table>

    <h4 style="text-align: center;"><strong style=" text-decoration: underline; text-align: center;"> {{$eval_his->sector_name}}</strong></h4>
    
    <table style="width:100%;">
        <tr  style="border: 1px #000 solid; text-align: center;">
            <th  rowspan="1" style=" width:10%; border: 1px #000 solid;">
                <p>رسوم المعاملة</p>
                <p>Coast</p>
            </th>
            <th  rowspan="1" style="width:10%; border: 1px #000 solid;"> 
                <p>عدد ا وًثائق</p>
                <p>No. of</p>
                <p>DOC.s</p>
            </th>
            <th  colspan="2" style="width:60%;border: 1px #000 solid;"> 
                <p style="">ا وًثائق الملدمة</p>
                <p>Documents</p>
            </th>
            <th rowspan="1" style="width:20%;border: 1px #000 solid;"> 
                <p>الخدمة</p>
                <p>Request</p>
            </th>
        </tr>
            @foreach($services as $key => $service_item)
                @foreach($service_item['document_url'] as $key1 =>$doc_item)
                <tr  style="border: 1px #000 solid;">
                    <td style="border: 1px #000 solid;">
                      {{$service_item['service']->price}}
                    </td>
                    <td style="border: 1px #000 solid;"> 
                        
                    </td>
                    <td style="border: 1px #000 solid;"> 
                        <span>{{$doc_item->doc_name_en}}</span>
                    </td>
                    <td style="border: 1px #000 solid;text-align:left"> 
                        <h6 style="text-align: right;">{{$doc_item->doc_name_ar}}</span>
                    </td>
                    @if($key1 < 1)  
                    <td style="border: 1px #000 solid;" rowspan="{{count($service_item['document_url'])}}">
                    {{$service_item['service']->name}}
                    </td>
                    @endif
                </tr>
                @endforeach
            @endforeach

                
    </table>
    <br>
</div>

        @include('includes.footer')