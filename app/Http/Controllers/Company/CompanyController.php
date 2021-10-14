<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Services;
use App\Evaluate;
use App\Service_history;
use App\Food_client_inf;
use App\Product_details;
use App\Products;
use Illuminate\Http\UploadedFile;
use PDF;
use stdClass;
class CompanyController extends Controller
{   
     public function __construct()
    {
        
    }
    
    public function productdetail(Request $request)
    {   
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $company_id = Session::get('user')['id'];
            $detail = DB::select('SELECT a.*
                                 FROM product_details a
                                 WHERE company_id = '.$company_id);

            view()->share("detail", $detail);
            return view('company.product_details');
        } else {
            return redirect('login');
        } 
    }

    public function insert_productDetail(Request $request)
    {
        $company_id = Session::get('user')['id'];
        $detail_item = $request->detail;
        $detail_item_ara = $request->detail_ara;
        $detail = DB::select('SELECT *
                             FROM product_details
                             Where company_id = '.$company_id.' AND detail_item = "'.$detail_item.'"');
        $detail_ara = DB::select('SELECT *
                             FROM product_details
                             Where company_id = '.$company_id.' AND detail_item_ara = "'.$detail_item_ara.'"');
        if(count($detail)>0 ||count($detail_ara)>0){
                echo json_encode('error');
        }else{

            $id = $request->detail_id;
            $detail = Product_details::find($id);

            $detail = new Product_details;
            $detail->detail_item = $request->detail;
            $detail->detail_item_ara = $request->detail_ara;
            $detail->company_id = Session::get('user')['id'];
            $detail->created_at = date('Y-m-d H:i:s');
            $detail->save();
            $insertId = $detail->id;
            echo json_encode($insertId);  
            }
        
    }
    // public function update_product_details(Request $request)
    // {
    //     $id = $request->detail_id;
    //     $detail = Product_details::find($id);
        
    //     $detail->detail_item = $request->detail_name;
       
    //     $detail->updated_at = date('Y-m-d H:i:s');
    //     $detail->save();
    //     return redirect()->back(); 
    // }
    public function delete_product_detail(Request $request){
      $id = $request->detail_id;
      $detail = Product_details::find($id);
      $detail->delete();    
      return redirect()->back(); 
    }
    public function product_list(Request $request){
      if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $company_id = Session::get('user')['id'];
            $products = DB::select('SELECT a.*,b.category_title
                                 FROM products a
                                 LEFT JOIN category b ON a.category_id = b.id
                                 WHERE a.company_id = '.$company_id);
            $detail = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$company_id);
          
            $product_info = array();

            foreach ($products as $key => $item) {
                
                $details = json_decode($item->details,true);

                foreach ($details as $key1 => $item1) {
                    
                      $product_info[$key][$key1] = substr($item1,0,30);

                } 
                $product_info[$key]['name'] = $item->name_e;
                $product_info[$key]['id'] = $item->id;
                $product_info[$key]['document'] = $item->document;
                $product_info[$key]['category_title'] = $item->category_title;
  
            }

            view()->share("product_info", $product_info);
            view()->share("detail", $detail);
            return view('company.products_list');
        } else {
            return redirect('login');
        } 
    }
    public function edit_product(Request $request,$id){
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $id = $request->id;
            $company_id = Session::get('user')['id'];
            $product = DB::select('SELECT a.*
                                 FROM products a
                                 WHERE id = '.$id);
            $detail = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$company_id);
            if(count($detail)<1)
                return redirect()->back()->with('error_msg','Please Insert Your Product Detail Infomation'); 
            $product_info=array();
            if(count($product)>0){
                
                foreach ($product[0] as $key => $value) {
                    $product_info[$key] = $value;
                }
                $details = json_decode($product[0]->details,true);
                foreach ($details as $key1 => $item1) {
                    // $k = $key1." ";
                      $product_info[$key1] = $item1;
                } 
            }

            view()->share("product", $product_info);
            view()->share("detail", $detail);

            return view('company.edit_product');
           
        } else {
            return redirect('login');
        } 
    }

    public function save_product(Request $request)
    {
        $company_id = Session::get('user')['id'];
        $details = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$company_id);
        $details_info = array();
        foreach ($details as $key => $item) {
            $val = $item->id;
            $data = 'detail_'.$val;
            $details_info[$val] = $request->$data;
        } 

        $detaildata = json_encode($details_info);
        $id = $request->product_id;
        if($id == '0'){
            $products = new Products;
            $products->name_e = $request->product_name;
            $products->name_a = $request->product_name_ara;
            $products->details = $detaildata;
            $products->company_id = Session::get('user')['id'];
            $products->created_at = date('Y-m-d H:i:s');
            $products->save();
            $insertId = $products->id;
        }else{
            $products = Products::find($id);
            $products->name_e = $request->product_name;
            $products->name_a = $request->product_name_ara;
            $products->details = $detaildata;
            $products->company_id = Session::get('user')['id'];
            $products->updated_at = date('Y-m-d H:i:s');
            $products->save();
            $insertId = $id;
        }
        
        if($file = $request->file('document')){
            $destinationPath = public_path() . '/uploads/pdf/';
            $safeName = time().str_shuffle('abcdefgh').'.'.'pdf';
                      
            $file->move($destinationPath, $safeName);

            $products = Products::find($insertId );
            $products->document = '/uploads/pdf/'.$safeName;
            $products->save();

        }
        return redirect('product_list'); 
    }
     public function delete_product(Request $request)
    {
        $id = $request->product_id;
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back(); 
    }
    public function set_category(Request $request){
        $ids = $request->checked_ids;
        $category = $request->category;
        $category_id = DB::table('category')->insertGetId(
            ['category_title' => $category]
        );
        $product_id = explode(',', $ids);
        foreach ($product_id as $key => $item) {
            $products = Products::find($item);
            $products->category_id = $category_id;
            $products->updated_at = date('Y-m-d H:i:s');
            $products->save();
        }
        return redirect()->back(); 
    }

    public function down_temp($type = '')
    {
        ini_set('max_execution_time', '0');
        require_once dirname(__FILE__) . '/../../../../excel/PHPExcel.php';
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('Product Name(en)','Product Name(ar)');

        $company_id = Session::get('user')['id'];
        $details = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$company_id);
        if(count($details)<1) return redirect()->back()->with('error_msg','Please Insert Your Product Detail Infomation'); 
        foreach ($details as $key => $item) {
            array_push($field_name, $item->detail_item);
        }
        
        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename="template.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        //$objWriter->save('template.xls');
    }
    protected function importExcelFile($file){
        ini_set('max_execution_time', '0');
        require_once dirname(__FILE__) . '/../../../../excel/PHPExcel.php';
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($file);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            foreach ($worksheet->getRowIterator() as $key=>$row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells( false);
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {  //如果列不给空就得到它的坐标和计算的值
                        $rows[$key][]=   $cell->getCalculatedValue();
                    }
                }
            }
        }
        return $rows;
    }
    public function uploadCsvFile(Request $request)
    {
        $company_id = Session::get('user')['id'];
        $details = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$company_id);
        if(count($details)<1) return redirect()->back()->with('error_msg','Please Insert Your Product Detail Infomation'); 
       
        if ($file = $request->file('excelfile')) {
            $extension = $file->getClientOriginalExtension();


            // if($extension==""){
            //     return json_encode(array('status'=>0, 'msg' => 'Not Only  *.xls file!'));
            // }
            // $extension = strtolower($extension);
            // if($extension != 'xls'){
            //     return json_encode(array('status'=>0, 'msg' => 'Not Only  *.xls file!'));

            // }
            $destinationPath = public_path('uploads'.DIRECTORY_SEPARATOR.'xls'.DIRECTORY_SEPARATOR);
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $filePath = $destinationPath.$safeName;


            $result = $this->importExcelFile($filePath);
//             var_dump($result);
// die();
            // unlink($filePath);
            // if(count($result) == 0){
            //     return json_encode(array('status'=>0, 'msg' => 'Not Found file contents!'));

            // }

            // $format = $result[1];
            // if(count($format)<5){
            //     return json_encode(array('status'=>0, 'msg' => 'Incorrect file format!'));

            // }
            $rows=$result;
            for($i=2; $i < count($rows)+1; $i++){
                $item = $rows[$i];
                $details_info = array();
                foreach ($details as $key => $value) {

                    $details_info[$value->id] = $item[$key+2];
                }

                $products = new Products;
                $products->company_id = $company_id;
                $products->name_e = $item[0];
                $products->name_a = $item[1];
                $products->details = json_encode($details_info);
                $products->created_at = date('Y-m-d H:i:s');
                $products->save();
                
                // $this->importItemFromCsv($item);
            }
            // $this->importDatasFromCsv($result);
            // return json_encode(array('status'=>1, 'msg' => 'the opration success!'));
            return redirect()->back();

        }else{
            return ;
        }
        return ;
    }

    
}