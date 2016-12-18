<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(0);
class ModelUploadCsvUpload extends Model {

//////Add code by TP ////
public function upload_error($file_name,$vendorid='') {
  $handle = fopen($file_name, "r");
  $vendorid=$vendorid;
  // START TRANSACTION;
  $r=0;
  $i=0;
  $j=0;
  
 
  $upload_error=array();        
  while (($data = fgetcsv($handle, 47108864, ",")) !== FALSE) {              
      if($r==0)
      {
        /// try to checking sheet hvae proper column
         echo "==".$count=count($data);
          if($count!=24)
          {
            echo 'csv file is not proper format***';
            exit();
          }
      } else {
//pre($data);
    $manufacturer_id=$data[0];
    $categoryId=utf8_substr(strip_tags(html_entity_decode($data[1],ENT_QUOTES, 'UTF-8')),0,200);
    $data3=trim($data[2]);
    $sub_categoryId=utf8_substr(strip_tags(html_entity_decode($data3,ENT_QUOTES, 'UTF-8')),0,200);
    $sub_sub_categoryId=utf8_substr(strip_tags(html_entity_decode($data[3],ENT_QUOTES, 'UTF-8')),0,200);
    $productName=$data[4];
    $sku=$data[5];
    $model=$data[6];     
    $productDescription=$data[7];
    $price=$data[8];
    $quantity=$data[9];
    $image=$data[10];
    $weight=$data[17];
    $weighttype=$data[18];
    $length=$data[19];    
    $width=$data[20];
    $height=$data[21];    
    $tag=$data[22];


    $pattern = '/^\d{1,10}(?:\.\d{1,4})?$/';
    $pattern1 = '/^\d{1,10}(?:\.\d{1,10})?$/';
    $pattern2 = '/^[a-zA-Z ]+[ a-zA-Z]+$/';
    $pattern3 = '/^\d{1,10}?$/';

    $keyword = strtolower(str_replace(' ','-', str_replace(array( '\'', '"', ',' , ';', '<', '>','&','#','+','/','(',')','?'),'',$productName)));


      if ($categoryId=='') {
           $ja=$i+1;
          //echo $strerror="Please check category Row No "."$ja";
           $upload_error[]=array('value11'=>$ja);
            }
           else {

        $categoryIds=$this->getcategory($categoryId,0);
          $grandfather=$categoryIds;

             if($categoryIds==0 || $categoryIds=='')
             {
             $ja=$i+1;
             $upload_error[]=array('value11'=>$ja);

             }
          }
            
      if ($sub_categoryId=='') {
           $jb=$i+1;
           //$strerror="Product category or subcategory Will not Blank, Please check Row No "."$j";
           $upload_error[]=array('value12'=>$jb);
            } 
            else {
          $sub_categoryIds=$this->getcategory($sub_categoryId,$grandfather);  
                   $father=$sub_categoryIds;
          
             if($sub_categoryIds==0 || $sub_categoryIds=='')
             {
             $jb=$i+1;
             $upload_error[]=array('value12'=>$jb);

             }
          } 

        //if (!preg_match($pattern2, $sub_sub_categoryId) || $sub_sub_categoryId=='') {
          if ($sub_sub_categoryId=='') {
           $jc=$i+1;
           //echo $strerror="Product category or meta subcategory Will not Blank, Please check Row No "."$jc";
           $upload_error[]=array('value13'=>$jc);
            } 
             else {
          $sub_sub_categoryIds=$this->getcategory($sub_sub_categoryId,$father); 
                   $insertcategory =$sub_sub_categoryIds;
          
             if($insertcategory==0 || $insertcategory=='')
             {
             $jc=$i+1;
             $upload_error[]=array('value13'=>$jc);

             }
          }               


if ($model=='') {
    $k=$i+1;
   $upload_error[]=array('value2'=>$k);
   
    } else {

          $model_num=$this->checkModel($model);
          
             if($model_num>0)
             {
             $k=$i+1;
             $upload_error[]=array('value2'=>$k);

             }
          }
    // $sql = "SELECT model FROM `oc_product` WHERE model='".$model."'";
    // $query = $this->db->query($sql);      
    // $num = $query->num_rows;
    // $k=$i+1;
    //   if($num!=0) {
    //   //$strerror="Model is same value in our database, Please check Row No "."$k";
    //   $upload_error[]=array('value2'=>$k);
    //   }
    // $sql = "SELECT sku FROM `oc_product` WHERE sku='".$sku."'";
    // $query = $this->db->query($sql);
    // $num = $query->num_rows;
    // $l=$i+1;
    //   if($num!=0) {
    //    $upload_error[]=array('value3'=>$l);
    //    }
if ($sku=='') {
    $l=$i+1;
    $upload_error[]=array('value3'=>$l);
   
    } else {

          $sku_num=$this->checkSku($sku);
          
             if($sku_num>0)
             {
             $l=$i+1;
              $upload_error[]=array('value3'=>$l);

             }
          }

if($data[12]==''){
  $h=$i+1;
  $upload_error[]=array('value9'=>"Please check attribute row no: ".$h);
  }
  else
      {
         $h=$i+1;
           $attributes=explode('#',$data[12]);
$att_name=array();
            foreach ($attributes as $attribute) {
            $attributes_array = explode('>',$attribute);            
            
            $attribute_query = $this->db->query("select attribute_id from `oc_attribute_description` where `name` like '".trim($attributes_array[0])."'");
            
              if($attribute_query->num_rows == 0)
              {                
                $att_name[] = $attributes_array[0];
              }

            }
         
    if(!empty($att_name)) {        
    $attibute_value = implode(',', $att_name);
    $upload_error[]=array('value9'=>$attibute_value ." attribute is not matched, Please check row no: ".$h);
  }

}     

    if ($length=='' || $length==0) {
    $m=$i+1;
    $upload_error[]=array('value4'=>$m);
    }

    if ($width=='' || $width==0) {
    $n=$i+1;
    $upload_error[]=array('value5'=>$n);
    }

    if ($height=='' || $height==0) {
    $o=$i+1;
    $upload_error[]=array('value6'=>$o);
    }
    
    if ($delivery_day=='' || $delivery_day==0) {
    $p=$i+1;
    $upload_error[]=array('value7'=>$p);
    }

    if (!preg_match($pattern3, $product_mode) || $product_mode=='' || $product_mode==0 || $product_mode>2) {
    $q=$i+1;
    $upload_error[]=array('value8'=>$q);
    }


 
  if ($productDescription=='') {
    $t=$i+1;
    $upload_error[]=array('value14'=>$t);
    }  

 //$pattern = '/^\d{1,10}(?:\.\d{1,4})?$/';

  if (!preg_match($pattern, $price) || $price=='' || $price==0) {

    $u=$i+1;
    $upload_error[]=array('value15'=>$u);
        
    }

    
      
  if (!preg_match($pattern3, $quantity) || $quantity=='') {
    $x=$i+1;
    $upload_error[]=array('value18'=>$x);    
    } 


  if ($image=='') {
  $y=$i+1;
  $upload_error[]=array('value19'=>$y);  
  
  }  


  if ($weight=='' || $weight==0) {
    $z=$i+1;
    $upload_error[]=array('value20'=>$z);
    }

  if ($weighttype=='') {
    $ab=$i+1;
   $upload_error[]=array('value21'=>$ab);
   
    } else {

         $weight_num=$this->checkWeighttype($weighttype);
          
             if($weight_num==0)
             {
             $ab=$i+1;
             $upload_error[]=array('value21'=>$ab);

             }
          } 
  
  if ($productName=='') {
  $ac=$i+1;
  $upload_error[]=array('value22'=>$ac);  
  
  }  
 

 //Commented to allow blank value
 /*
 if ($tag=='') {
  $ad=$i+1;
  $upload_error[]=array('value23'=>$ad);  
  }      
*/
  //$productName    



//Added by Amandeep for search
	if($product_type_id != ''){
	$ptype_id=$this->checkProducttype($product_type_id);
	if($ptype_id=='')
       {
         $est=$i+1;
         $upload_error[]=array('value24'=>$est);
       }
	}
	if($product_for_id != ''){
	$pfor_id=$this->checkProductfor($product_for_id);
	if($pfor_id=='')
       {
         $esf=$i+1;
         $upload_error[]=array('value25'=>$esf);
       }
	}
	if($product_usability_id != ''){
	$pusability_id=$this->checkProductusability($product_usability_id);
	if($pusability_id=='')
       {
         $esu=$i+1;
         $upload_error[]=array('value26'=>$esu);
       } 
	}	   


  

}
  $r++; 
  $i++; 
  $j++; 
     

}



$values=array();
$valuecheck=array();
$counts=count($upload_error);
  for($a=0;$counts>$a; $a++)
  {
      // if(!empty($upload_error[$a]['value1'])) {
      //   $errvalue1[]=$upload_error[$a]['value1'];
      // }
      
      if(!empty($upload_error[$a]['value2'])) {
        $errvalue2[]=$upload_error[$a]['value2'];
      }

      if(!empty($upload_error[$a]['value3'])) {
        $errvalue3[]=$upload_error[$a]['value3'];
      }

      if(!empty($upload_error[$a]['value4'])) {
        $errvalue4[]=$upload_error[$a]['value4'];
      }

      if(!empty($upload_error[$a]['value5'])) {
        $errvalue5[]=$upload_error[$a]['value5'];
      }

      if(!empty($upload_error[$a]['value6'])) {
        $errvalue6[]=$upload_error[$a]['value6'];
      }

      if(!empty($upload_error[$a]['value7'])) {
        $errvalue7[]=$upload_error[$a]['value7'];
      }

      if(!empty($upload_error[$a]['value8'])) {
        $errvalue8[]=$upload_error[$a]['value8'];
      }

      if(!empty($upload_error[$a]['value9'])) {
        $errvalue9[]=$upload_error[$a]['value9'];
      }

      if(!empty($upload_error[$a]['value10'])) {
        $errvalue10[]=$upload_error[$a]['value10'];
      }
      if(!empty($upload_error[$a]['value11'])) {
        $errvalue11[]=$upload_error[$a]['value11'];
      }
      if(!empty($upload_error[$a]['value12'])) {
        $errvalue12[]=$upload_error[$a]['value12'];
      }
      if(!empty($upload_error[$a]['value13'])) {
        $errvalue13[]=$upload_error[$a]['value13'];
      }
      if(!empty($upload_error[$a]['value14'])) {
        $errvalue14[]=$upload_error[$a]['value14'];
      }
      if(!empty($upload_error[$a]['value15'])) {
        $errvalue15[]=$upload_error[$a]['value15'];
      }
      if(!empty($upload_error[$a]['value16'])) {
        $errvalue16[]=$upload_error[$a]['value16'];
      }
      if(!empty($upload_error[$a]['value17'])) {
        $errvalue17[]=$upload_error[$a]['value17'];
      }
      if(!empty($upload_error[$a]['value18'])) {
        $errvalue18[]=$upload_error[$a]['value18'];
      }
      if(!empty($upload_error[$a]['value19'])) {
        $errvalue19[]=$upload_error[$a]['value19'];
      }
      if(!empty($upload_error[$a]['value20'])) {
        $errvalue20[]=$upload_error[$a]['value20'];
      }
      if(!empty($upload_error[$a]['value21'])) {
        $errvalue21[]=$upload_error[$a]['value21'];
      }
      if(!empty($upload_error[$a]['value22'])) {
        $errvalue22[]=$upload_error[$a]['value22'];
      }
      if(!empty($upload_error[$a]['value23'])) {
        $errvalue23[]=$upload_error[$a]['value23'];
      }
	  //Added for search assistence by Amandeep
	  if(!empty($upload_error[$a]['value24'])) {
        $errvalue24[]=$upload_error[$a]['value24'];
      }
	  if(!empty($upload_error[$a]['value25'])) {
        $errvalue25[]=$upload_error[$a]['value25'];
      }
	  if(!empty($upload_error[$a]['value26'])) {
        $errvalue26[]=$upload_error[$a]['value26'];
      }
     
    
  }
if(count($errvalue11)>0) {
  $valuecheck[]='Please check category Row No: '.implode(',',$errvalue11);
}
if(count($errvalue12)>0) {
  $valuecheck[]='Please check sub category Row No: '.implode(',',$errvalue12);
}
if(count($errvalue13)>0) {
  $valuecheck[]='Please check meta category Row No: '.implode(',',$errvalue13);
}
if(count($errvalue22)>0) {
  $valuecheck[]='Please check product name Row No: '.implode(',',$errvalue22);
}
if(count($errvalue2)>0) {
  $valuecheck[]='Please check model Row No: '.implode(',',$errvalue2);
}
if(count($errvalue3)>0) {
  $valuecheck[]='Please check sku Row No: '.implode(',',$errvalue3);
}
if(count($errvalue14)>0) {
  $valuecheck[]='Please check description Row No: '.implode(',',$errvalue14);
}
if(count($errvalue15)>0) {
  $valuecheck[]='Please check MRP Row No: '.implode(',',$errvalue15);
}

if(count($errvalue18)>0) {
  $valuecheck[]='Please check quantity Row No: '.implode(',',$errvalue18);
}
if(count($errvalue19)>0) {
  $valuecheck[]='Please check image name Row No: '.implode(',',$errvalue19);
}

if(count($errvalue4)>0) {
  $valuecheck[]='Please check length Row No: '.implode(',',$errvalue4);
}
if(count($errvalue5)>0) {
  $valuecheck[]='Please check width Row No: '.implode(',',$errvalue5);
}
if(count($errvalue6)>0) {
  $valuecheck[]='Please check height Row No: '.implode(',',$errvalue6);
}


if(count($errvalue9)>0) {
  $valuecheck[] = implode('<br>',$errvalue9);
}



if(count($errvalue20)>0) {
  $valuecheck[]='Please check weight Row No: '.implode(',',$errvalue20);
}
if(count($errvalue21)>0) {
  $valuecheck[]='Please check weight type Row No: '.implode(',',$errvalue21);
}
if(count($errvalue23)>0) {
  $valuecheck[]='Please check product tags Row No: '.implode(',',$errvalue23);
}



  $values['value']=implode('<br>',$valuecheck);


  if(!empty($values['value']) && $counts>0)
    {       
      return $values;
    }
    else 
    {
      
      return true;
    }
}
//////End code by TP ////
  
  public function upload($file_name,$vendorid='') {
    
      $handle = fopen($file_name, "r");
        $vendorid=$vendorid;
      // START TRANSACTION;
        $r=0; 

     while (($data = fgetcsv($handle, 47108864, ",")) !== FALSE) {
         
          if($r==0)
           {
            /// try to checking sheet hvae proper column
                $count=count($data);
                 if($count!=24)
                 {
                  echo 'csv file is not proper format';
                  exit();
                 }
       }
       else{
        
        /// getting vendor info
                  //pre($data);
         
                //$vendordata=$this->vendorinfo($vendorid);
                //$imageprefix="catalog/".$vendordata['folder'].'/';
        $imageprefix="catalog/";
                $manufacturer_id='';
                $weight_class_id='';
        $size_class_id='';
                $length_class_id='';
        $length='';
        $categoryId='';
            $sub_categoryId='';
            $attributes=0;
            $filter=0;
            $sub_sub_categoryId='';
            $subvendor='';
        $dateadded=date("Y-m-d h:i:s"); 
        
         $manufacturer_id=$data[0]; 
         

         $manufacturer_id=$this->manufacturer($manufacturer_id);

             
    $categoryId=utf8_substr(strip_tags(html_entity_decode($data[1],ENT_QUOTES, 'UTF-8')),0,200);
    $data3=trim($data[2]);
    $sub_categoryId=utf8_substr(strip_tags(html_entity_decode($data3,ENT_QUOTES, 'UTF-8')),0,200);
    $sub_sub_categoryId=utf8_substr(strip_tags(html_entity_decode($data[3],ENT_QUOTES, 'UTF-8')),0,200);
    

                    if($categoryId){
                     
                     $categoryId=$this->getcategory($categoryId,0);
                     $grandfather=$categoryId;
                       }

               if($sub_categoryId){
                             
                   $sub_categoryId=$sub_categoryId=$this->getcategory($sub_categoryId,$grandfather);  
                   $father=$sub_categoryId;
                  
                }
               if($sub_sub_categoryId){
                   $sub_sub_categoryId=$this->getcategory($sub_sub_categoryId,$father); 
                   $insertcategory =$sub_sub_categoryId;
                }
          
             //$status=$this->checkparent($categoryId,$sub_categoryId,$sub_sub_categoryId);
               // exit;
                
                  //echo 'grandfather'.$categoryId.'father'.$sub_categoryId.'child'.$sub_sub_categoryId;
                 // exit;
               // if($status==0)
                //{
                  //echo 'category subcategory Mismatch';
                  //exit();
                //}
 
 
                //// checking category
               /// insert category to product
                       
            ///
         
          $productName=$this->db->escape($data[4]);
        $sku=$data[6];
        $model=$data[7];


        $productDescription=$this->db->escape($data[7]);
        
    $sku=$data[5];
    $model=$data[6];     
    
    $price=$data[8];
    $quantity=$data[9];
    //$image=$data[10];
    
                   
        
          //$delivery_charges="";
        
        $image= $imageprefix.$data[10];
        
        $additional_image=$this->db->escape($data[11]);
          $imgarray=explode(',',$additional_image);

                    
           if($data[22]!=''){
           $attributes=explode('#',$data[12]);
          // pre($attributes);
//exit;
           }
           
                  if($data[13]!=''){
        $filter=explode(',',$data[13]);
         
           }

        $dimendtion=$data[14];
        
        $size_option=explode(',',$data[15]);
         
         
        $color_option=explode(',',$data[16]);
          
        $weight=$data[17];
    $weighttype=$data[18];
    $length=$data[19];    
    $width=$data[20];
    $height=$data[21];    
    $tag=$data[22];
          
           
          if($weighttype!='')
          {
            //$weight_class_id=2;
            $weight_id=$this->checkWeighttype($weighttype);
            if($weight_id>0)
            {
              $weight_class_id = $weight_id;
            }

          }
          //$vendorid=$data[21];
          $blank='';
       
        $keyword = strtolower(str_replace(' ','-', str_replace(array( '\'', '"', ',' , ';', '<', '>','&','#','+','/','(',')','?'),'',$productName)));
       ///data insert into product table
         
         $isbn=$data["23"];
         
		 

    echo  $product="INSERT into oc_product set quantity='".$quantity."', sku='".$sku."', upc='', ean='', jan='', isbn='".$isbn."', mpn='', stock_status_id='2', model='".$model."', manufacturer_id='".$manufacturer_id."', image='".$image."', shipping='1', price='".$price."', date_added='".$dateadded."', weight='".$weight."', weight_class_id='".$weight_class_id."', status='2', length='".$length."', width='".$width."', height='".$height."', location='', points='', tax_class_id='', sort_order='', viewed='', date_modified='', minimum=''";

         
          $this->db->query($product);
          $productId = $this->db->getLastId();
          $productDescriptions=$productDescription;

          $productDescs=$productDescriptions;

      $product_description="INSERT into oc_product_description set product_id='".$productId."', language_id='1', name='".$productName."', description='".$productDescs."', meta_description='".$productName."', tag='".addslashes($tag)."', meta_keyword='', meta_title='".$productName."'";     
       $this->db->query($product_description);

if(count($size_chart) > 0 && $size_chart!='' ) {
      $size_chart="INSERT into oc_size_chart_option set product_id='".$productId."', template_id='".$size_chart."'";
    }
     
       $this->db->query($size_chart);  
            
            /// sepecial product
            if(!empty($finalseling_price) && $finalseling_price!='' || $finalseling_price>0)
       {
             $sp="INSERT INTO oc_product_special SET product_id = '" . (int)$productId  . "', customer_group_id = 1, priority = 1, price = '" . (float)$finalseling_price. "'";
            $this->db->query($sp);
         }
            ///
            /// insert additional image

if(!empty($imgarray))
{
    foreach($imgarray as $key=>$additional_image)
    {
      if($additional_image!='') {
      $img = "INSERT INTO `oc_product_image` (`product_id`,`image`) VALUES ";

      $additional_image=$imageprefix.trim($additional_image);
      $img .= "($productId,'$additional_image')".',';

      $img=rtrim($img,',');
      $img .= ";";
      $this->db->query($img);
      }
    }
}
            ///
            /// insert category to product
            
            if ($insertcategory!='' ) {
            $category= "INSERT INTO `oc_product_to_category` (`product_id`,`category_id`) VALUES('$productId',$insertcategory) ";
            $this->db->query($category);
            
        }
        
            ///
            /// insert data size option here option id take oc_option
            
            if (count($size_option) > 0 && $size_option[0]!='') {
              //pre($size_option); exit;

          $sql = "INSERT INTO oc_product_option SET product_id = '" . (int)$productId . "', option_id = '2', `required`=1";
          $this->db->query($sql);
          $product_option_id = $this->db->getLastId();
          
         $sql = "INSERT INTO `oc_product_option_value` (`product_option_id`,`product_id`, `option_id`, `option_value_id`,`quantity`,`subtract`) VALUES ";
          $first = TRUE;
          
          foreach ($size_option as $size_option_result) {
               $explode=explode('-',$size_option_result);
               $size_option_result=$explode[0];
               @$size_option_qnty=$explode[1];
            $size_option =$this->db->query("select option_value_id from `oc_option_value_description` where `name` like '".$size_option_result."' and `option_id`=2 ");
            $option_value = '';
            

            if($size_option->num_rows)
            {
              $option_data = $size_option->row;
              $option_value = $option_data['option_value_id'];
            }
            else
            {
              $option_sql = "insert into `oc_option_value` set `option_id`='2'";
              $this->db->query($option_sql);
              $option_value = $this->db->getLastId();
              $option_sql = "insert into `oc_option_value_description` set `option_value_id`='$option_value', `language_id`=1, `option_id`='2', `name`='$size_option_result'";
              $this->db->query($option_sql);
            }
            $sql .= ($first) ? "\n" : ",\n";
            $first = FALSE;
            $sql .= "('$product_option_id','$productId','2','$option_value','$size_option_qnty','1')";
          }
          
          $sql .= ";";
          
          $this->db->query($sql);
        }
          
            ////end size option
            
            /// color option
            
        if (count($color_option) > 0 && $color_option[0]!='') {
          $sql = "INSERT INTO oc_product_option SET product_id = '" . (int)$productId . "', option_id = '1', `required`=1";
          $this->db->query($sql);
          $product_option_id = $this->db->getLastId();
          
          $sql = "INSERT INTO `oc_product_option_value` (`product_option_id`,`product_id`, `option_id`, `option_value_id`) VALUES ";
          $first = TRUE;
          
          foreach ($color_option as $color_option_result) {
            $color_option_val = $this->db->escape($color_option_result);
            $color_option = $this->db->query("select option_value_id from `oc_option_value_description` where `name` like '".$color_option_val."' and `option_id`=1 ");
            $option_value = '';
            
            if($color_option->num_rows)
            {
              $option_data = $color_option->row;
              $option_value = $option_data['option_value_id'];
            }
            else
            {
              $option_sql = "insert into `oc_option_value` set `option_id`='1'";
              $this->db->query($option_sql);
              $option_value = $this->db->getLastId();
              $option_sql = "insert into `oc_option_value_description` set `option_value_id`='$option_value', `language_id`=1, `option_id`='1', `name`='$color_option_val'";
              $this->db->query($option_sql);
            }
            $sql .= ($first) ? "\n" : ",\n";
            $first = FALSE;
            $sql .= "('$product_option_id','$productId','1','$option_value')";
          }
          
          $sql .= ";";
          //echo '<hr>'.$sql;
          $this->db->query($sql);
        }
            /////// end color option
            ///attribute option
            if (count($attributes) > 0 && $attributes[0]!='') {
           // $sql = "INSERT INTO `oc_product_attribute` (`product_id`,`attribute_id`, `language_id`, `text`) VALUES ";

          $first = TRUE;
          //echo '<hr>';
          //echo '<pre>';
         // print_r($attributes);
 
          foreach ($attributes as $attribute) {
              $attributes_array = explode('>',$attribute);
            //  pre($attributes_array);
            
 //echo "select attribute_id from `oc_attribute_description` where `name` like '".trim($attributes_array[0])."'"; exit;
            $attribute_query = $this->db->query("select attribute_id from `oc_attribute_description` where `name` like '".trim($attributes_array[0])."'");
            $attribute_id = '';
            
            if($attribute_query->num_rows)
            {
              $attribute_data = $attribute_query->row;
                $attribute_id = $attribute_data['attribute_id'];
            }
               if($attribute_id!='' && $attribute_id!=0){
              //$sql .= ($first) ? "\n" : ",\n";
              $first = FALSE;

              $attributes_array_value = explode(',',$attributes_array[1]);
              //pre($attributes_array_value);
              for($i=0; $i < count($attributes_array_value); $i++)                             
              {
                
                $sql = "INSERT into oc_product_attribute set product_id='".$productId."', attribute_id='".$attribute_id."', language_id='1', text='".trim($attributes_array_value[$i])."'";
                $this->db->query($sql);
                //$sql .= "('$productId','$attribute_id','1','".trim($attributes_array_value[$i])."')";
              }
            }            
          }
         
            //$sql .= ";";  
          //$this->db->query($sql);
             
        }     
            ////
            /// insert filter
            if (count($filter) > 0 && $filter[0]!='') {
          
          $sql = "INSERT INTO `".DB_PREFIX."product_filter` (`product_id`, `filter_id`) VALUES ";
          $first = TRUE;
          
          foreach ($filter as $filter_result) {
            
            $filter_array = explode('>',$filter_result);
            
             $filter_sql = "select fd.filter_id from `".DB_PREFIX."filter_group_description` as fgd 
            left join `".DB_PREFIX."filter_description` as fd on fgd.filter_group_id=fd.filter_group_id where fgd.name like '".trim($filter_array[0])."' and fd.name like '".trim($filter_array[1])."'";
            $filter_id='';

            $filter_query = $this->db->query($filter_sql);
            
            $filter_result = $filter_query->row;
            
            $filter_id = @$filter_result['filter_id'];
            if($filter_id !='' && $filter_id !=0){
            $sql .= ($first) ? "\n" : ",\n";
            $first = FALSE;
            $sql .= "('$productId','$filter_id')";
             }
          }
          
          $sql .= ";";
          
          $this->db->query($sql);
        }
       //// assigen filter to category 
        if($insertcategory!='' && $productId!='')
        $this->assigenFilter($insertcategory,$productId);
            /// end filter
            ////// keyword 
              $sku_key = strtolower(str_replace(' ','-', str_replace(array( '\'', '"', ',' , ';', '<', '>','&','#','+','/','(',')','?'),'',$sku))); 
        if ($keyword) {
          $sql5 = "INSERT INTO `oc_url_alias` (`query`,`keyword`) VALUES ('product_id=$productId','".$keyword.'-'.$sku_key."');";
          $this->db->query($sql5);
        }
        $sql6 = "INSERT INTO `oc_product_to_store` (`product_id`,`store_id`) VALUES ($productId,'0');";
            $this->db->query($sql6);
            /////
// /*---------------------KEYWORD CREATION ACCORDING TO LAST PRODUCT-----------------------------------------*/
//   $cat1  = utf8_substr(strip_tags(html_entity_decode($data[2],ENT_QUOTES, 'UTF-8')),0,200);
//   $cat2  = utf8_substr(strip_tags(html_entity_decode($data[3],ENT_QUOTES, 'UTF-8')),0,200);
//   $cat3  = utf8_substr(strip_tags(html_entity_decode($data[4],ENT_QUOTES, 'UTF-8')),0,200);
  
//   if(strtolower($data[2])=='mens'){
//     $table1 = DB_PREFIX.'key_men';
//     $table2 = DB_PREFIX.'key_pro_men';
//   }elseif(strtolower($data[2])=='kids'){
//     $table1 = DB_PREFIX.'key_kids';
//     $table2 = DB_PREFIX.'key_pro_kids';
//   }elseif(strtolower($data[2])=='women'){
//     $table1 = DB_PREFIX.'key_women';
//     $table2 = DB_PREFIX.'key_pro_women';
//   }elseif(strtolower($data[2])=='books'){
//     $table1 = DB_PREFIX.'key_books';
//     $table2 = DB_PREFIX.'key_pro_books';
//   }elseif(strtolower($data[2])=='sports'){
//     $table1 = DB_PREFIX.'key_sports';
//     $table2 = DB_PREFIX.'key_pro_sports';
//   }elseif(strtolower($data[2])=='electronics'){
//     $table1 = DB_PREFIX.'key_electronics';
//     $table2 = DB_PREFIX.'key_pro_electronics';
//   }elseif(strtolower($data[2])=='automobiles'){
//     $table1 = DB_PREFIX.'key_automobiles';
//     $table2 = DB_PREFIX.'key_pro_automobiles';
//   }elseif(strtolower($data[2])=='art and crafts'){
//     $table1 = DB_PREFIX.'key_art_and_crafts';
//     $table2 = DB_PREFIX.'key_pro_art_and_crafts';
//   }elseif(strtolower($data[2])=='home and kitchen'){
//     $table1 = DB_PREFIX.'key_home_and_kitchen';
//     $table2 = DB_PREFIX.'key_pro_home_and_kitchen';
//   }elseif(strtolower($data[2])=='health and fitness'){
//     $table1 = DB_PREFIX.'key_health_and_fitness';
//     $table2 = DB_PREFIX.'key_pro_health_and_fitness';
//   }
  

//   if(!empty($product_for_name)){
//     if(strtolower($product_for_name)=='kids' || strtolower($product_for_name)=='boys'){
//       $pfor1 = $product_for_name.' ';
//       $pfor2 = ' '.$product_for_name.' ';
//     }else{
//       $pfor1 = $product_for_name.'s ';
//       $pfor2 = ' '.$product_for_name.'s ';
//     }
//     $pfor3 = ' for '.$product_for_name.' ';
//     $pfor4 = ' for '.$product_for_name;
//   }else{
//     $pfor1 = '';
//     $pfor2 = '';
//     $pfor3 = '';
//     $pfor4 = '';
//   }

//   if(!empty($brandname)){
//     $brand = ' in '.$brandname.' ';
//   }else{
//     $brand = '';
//   }
  
//   $product_title = str_replace("men's",'mens',$productName);
//   $product_title = str_replace("Men's",'Mens',$productName);
//   $product_title = str_replace("women's",'womens',$productName);
//   $product_title = str_replace("Womens's",'Womens',$productName);
  
//   $keyData[] = array("pid" => $productId, "key" => $model, "sort" => '3', "sno" => '1');
//   $keyData[] = array("pid" => $productId, "key" => $product_title, "sort" => '3', "sno" => '2');
  
//   $keyData[] = array("pid" => $productId, "key" => $cat1, "sort" => '9', "sno" => '3');
//   $keyData[] = array("pid" => $productId, "key" => $cat2, "sort" => '8', "sno" => '4');
//   $keyData[] = array("pid" => $productId, "key" => $cat3, "sort" => '7', "sno" => '5');/////////
//   $keyData[] = array("pid" => $productId, "key" => $cat3.$pfor4, "sort" => '1', "sno" => '6');
//   $keyData[] = array("pid" => $productId, "key" => $cat3.' '.$pfor2.$brandname, "sort" => '2', "sno" => '7');
//   $keyData[] = array("pid" => $productId, "key" => $cat3.' '.$brandname, "sort" => '7', "sno" => '8');/////////
  
//   $keyData[] = array("pid" => $productId, "key" => $brandname, "sort" => '3', "sno" => '9');
//   $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$cat3, "sort" => '1', "sno" => '10');
//   $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$cat3.$pfor4, "sort" => '2', "sno" => '11');
//   $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$pfor2.$cat3, "sort" => '3', "sno" => '12');
  
//   $keyData[] = array("pid" => $productId, "key" => $pfor1.$cat3, "sort" => '1', "sno" => '13');
//   $keyData[] = array("pid" => $productId, "key" => $pfor1.$cat3.' '.$brandname, "sort" => '2', "sno" => '14');
//   $keyData[] = array("pid" => $productId, "key" => $pfor1.$brandname.' '.$cat3, "sort" => '3', "sno" => '15');
  
//   $keyData[] = array("pid" => $productId, "key" => $cat2.$pfor4, "sort" => '1', "sno" => '16');
//   $keyData[] = array("pid" => $productId, "key" => $pfor1.$cat2, "sort" => '1', "sno" => '17');
  

//   $strMatch = strstr($data[22],'Color>');
//   $arrayAtt = explode("#",$strMatch);
// if(!empty($arrayAtt[0])){
//   $arrCheckColor = explode(">",$arrayAtt[0]);
//   if($arrCheckColor[0]=='Color' || $arrCheckColor[0]=='color'){
//     $colorArray = explode('|',$arrCheckColor[1]);
//     $color = rtrim($colorArray[0]);
    
//     $keyData[] = array("pid" => $productId, "key" => $cat3.' '.$color.$pfor4, "sort" => '4', "sno" => '18');
//     $keyData[] = array("pid" => $productId, "key" => $cat3.' '.$pfor3.'in '.$color, "sort" => '5', "sno" => '19');
//     $keyData[] = array("pid" => $productId, "key" => $cat3.' '.$brandname.' '.$pfor3.'in '.$color, "sort" => '6', "sno" => '20');
//     $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$color.' '.$cat3.$pfor4, "sort" => '4', "sno" => '21');
//     $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$cat3.' '.$color.$pfor4, "sort" => '5', "sno" => '22');
//     $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$pfor2.$cat3.' in '.$color, "sort" => '6', "sno" => '23');
//     $keyData[] = array("pid" => $productId, "key" => $pfor1.$color.' '.$cat3, "sort" => '4', "sno" => '24');
//     $keyData[] = array("pid" => $productId, "key" => $pfor1.$cat3.' in '.$color, "sort" => '5', "sno" => '25');
//     $keyData[] = array("pid" => $productId, "key" => $pfor1.$brandname.' '.$cat3.' in '.$color, "sort" => '6', "sno" => '26');
//     $keyData[] = array("pid" => $productId, "key" => $color.' '.$cat3, "sort" => '1', "sno" => '27');
//     $keyData[] = array("pid" => $productId, "key" => $color.' '.$cat3.$pfor4, "sort" => '2', "sno" => '28');
//     $keyData[] = array("pid" => $productId, "key" => $color.' '.$brandname.' '.$cat3, "sort" => '3', "sno" => '29');
//     $keyData[] = array("pid" => $productId, "key" => $color.' '.$pfor2.$cat3, "sort" => '4', "sno" => '30');
//     $keyData[] = array("pid" => $productId, "key" => $color.' color '.$cat3, "sort" => '5', "sno" => '31');
    
//     if(!empty($product_type_name)){
//       $keyData[] = array("pid" => $productId, "key" => $color.' '.$product_type_name.$pfor4, "sort" => '6', "sno" => '32');
//       $keyData[] = array("pid" => $productId, "key" => $color.' '.$brandname.' '.$product_type_name, "sort" => '7', "sno" => '33');
//       $keyData[] = array("pid" => $productId, "key" => $color.' color '.$product_type_name, "sort" => '8', "sno" => '34');
//     }
//   }
// }
    
    
//     if(!empty($res['tag'])){
//       $arrTag = explode(',',$res['tag']);
//       if(count($arrTag)>0){
//         foreach($arrTag as $tagKey){
//           $tagKey = ltrim($tagKey);
//           $tagKey = rtrim($tagKey);
//           $keyData[] = array("pid" => $res['product_id'], "key" => $tagKey, "sort" => '1', "sno" => '888');
//         }
//       }
//     }
    
//     if(!empty($product_type_name)){
//       $keyData[] = array("pid" => $productId, "key" => $product_type_name.$pfor4, "sort" => '2', "sno" => '35');
//       $keyData[] = array("pid" => $productId, "key" => $product_type_name.' '.$brandname, "sort" => '3', "sno" => '36');
//       $keyData[] = array("pid" => $productId, "key" => $product_type_name.' '.$pfor2.$brandname, "sort" => '4', "sno" => '37');
      
//       $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$product_type_name, "sort" => '4', "sno" => '38');
//       $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$product_type_name.$pfor4, "sort" => '5', "sno" => '39');
//       $keyData[] = array("pid" => $productId, "key" => $brandname.' '.$pfor2.$product_type_name, "sort" => '6', "sno" => '40');
      
      
//       $keyData[] = array("pid" => $productId, "key" => $pfor1.$product_type_name, "sort" => '6', "sno" => '41');
//       $keyData[] = array("pid" => $productId, "key" => $pfor1.$product_type_name.' '.$brandname, "sort" => '7', "sno" => '42');
//     }
  
//   //echo '<pre>';print_r($keyData);die;
//   for($i=0; $i<count($keyData); $i++){
//     $keyltrim = ltrim($keyData[$i]['key']);
//     $keytrim = rtrim($keyltrim);
//     $keyStr = str_replace('  ',' ',$keytrim);
//     $keyStr = str_replace("&amp;","and",$keyStr);
//     $keyStr = str_replace("&","and",$keyStr);
//     $keyStr = str_replace("'", '&#39;', $keyStr);
//     $keyStr = str_replace('"', "&#34;", $keyStr);
//     $keyStr = strtolower($keyStr);
//     $keyStr = str_replace("kids for kids","",$keyStr);
//     $keyStr = str_replace("mens for men","",$keyStr);
//     $keyStr = str_replace("womens for women","",$keyStr);
//     $keyStr = str_replace("mens mens","mens",$keyStr);
//     $keyStr = str_replace("kids kids","kids",$keyStr);
//     $keyStr = str_replace("womens womens","womens",$keyStr);
//     $keyStr = str_replace('  ',' ',$keyStr);
//     if(!empty($keyStr)){
      
//       $qryCount = $this->db->query("select key_id from ".$table1." where keyword='".$keyStr."'");
//       $keyCount = $qryCount->num_rows;
//       if($keyCount==0){
//         $qryKeyInsert = "insert into ".$table1." set product_id='".$keyData[$i]['pid']."', keyword='".$keyStr."', length='".strlen($keyStr)."', sno='".$keyData[$i]['sno']."', priority='".$keyData[$i]['sort']."'";
//         $this->db->query($qryKeyInsert);
//         $keyID = $this->db->getLastId();
//       }else{
//         $qryGetKey = $this->db->query("select key_id FROM ".$table1." where keyword='".$keyStr."' ");
//         $resGetKey = $qryGetKey->row;
//         $keyID = $resGetKey['key_id'];
//       }

//       $qryCount2 =$this->db->query("select id from ".$table2." where key_id='".$keyID."' and product_id='".$keyData[$i]['pid']."'");
//       $keyCount2 = $qryCount2->num_rows;
//       if($keyCount2==0 && !empty($keyID) && $keyID!=0){
//         $proKeyIns = "insert into ".$table2." set product_id='".$keyData[$i]['pid']."', key_id='".$keyID."'";
//         $this->db->query($proKeyIns);
//       }
//     }
//   }
  
// /*---------------------KEYWORD CREATION ACCORDING TO LAST PRODUCT-----------------------------------------*/
 
            
           }
            $r++;
      }
    
        
   //   COMMIT;
     fclose($handle); 
 }

  /*geting brand id*/
  public function brand($name)
  {
         $sql = "SELECT brand_id,brand_name FROM `oc_brand` WHERE brand_name='".$name."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return $query->row['brand_id'];
       }else{

             return 0;
          }

  }


//////geting sku
public function checkSku($name)
  {
         $sql = "SELECT sku FROM `oc_product` WHERE sku='".$name."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return 1;
       }else{

             return 0;
          }
  }
///////geting model


public function checkModel($name)
  {
         $sql = "SELECT model FROM `oc_product` WHERE model='".$name."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return 1;
       }else{

             return 0;
          }
  }
  

  

  public function checkWeighttype($name)
  {
         $sql = "SELECT weight_class_id FROM `oc_weight_class_description` WHERE title='".$name."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return $query->row['weight_class_id'];
       }else{

          return 0;
          }
  } 

     
  
  /*
      geting vendor list

  */
  public function vendorlist() {
        $data = array();
        $sql = "SELECT vendor_id,company_name FROM `oc_vendor`  WHERE status='1'";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function vendorinfo($vendorid) {
        $data = array();
          $sql = "SELECT * FROM `oc_vendor` INNER JOIN oc_user USING(user_id) WHERE oc_vendor.vendor_id='".$vendorid."' LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function getcategory($category,$parent)
    {
        $categoryid='';
        
        
           //$category=htmlspecialchars($category);
           //$category= str_replace('�Â�', "", $category);
         //$category=trim($category);
       //$category= $this->slug($category, $replacement = '');
         $category=str_replace("&","&amp;",$category);
        
     $sql=" SELECT d.category_id  FROM oc_category_description as d INNER JOIN oc_category as c ON(d.category_id=c.category_id) WHERE d.name='".$this->db->escape($category)."' AND c.parent_id='".$parent."' LIMIT 1";

       
      $qry=$this->db->query($sql);
       if ($qry->num_rows) {

           $categoryid=$qry->row['category_id'];
            return  $categoryid;
         } else {
            $categoryid;
         }
    }
   public function manufacturer($name)
   {
     $manufacturer_id='';

         $sql=" SELECT manufacturer_id  FROM  oc_manufacturer WHERE name='".$name."' LIMIT 1";
       
      $qry=$this->db->query($sql);
       if ($qry->num_rows) {

           $manufacturer_id =$qry->row['manufacturer_id'];
            return  $manufacturer_id;
         } else {
            $manufacturer_id;
         }

   }
   public function checkparent($categoryId,$sub_categoryId,$sub_sub_categoryId)
   {
    $status=0;
    //// check sub sub
      if($sub_sub_categoryId!='' && $sub_categoryId!='')
         
       {
             $qq="Select parent_id FROM oc_category WHERE category_id='".$sub_sub_categoryId."' LIMIT 1";
            $qry=$this->db->query($qq);
            $parent=$qry->row['parent_id'];
            if($sub_categoryId==$parent)
            {
                 $status=1;
            }else{
                 
                   $status=0;
                 }

       }

        if($categoryId!='' && $sub_categoryId!='')
        {
            
            
            $qq="Select parent_id FROM oc_category WHERE category_id='".$sub_categoryId."' LIMIT 1";
            $qry=$this->db->query($qq);
            $parent=$qry->row['parent_id'];
            if($categoryId==$parent)
            {
                 $status=1;
            } 
            else{
                  $status=0;
                }
        }
        if($categoryId!='' && $sub_categoryId=='' && $sub_sub_categoryId=='')
        {
           $status=1;
              
        }
     return $status;
        
     }
	 
//Added by Amandeep	for search 
public function checkProducttype($typeid)
  {
         $sql = "SELECT product_type_id FROM `oc_product_type` WHERE name='".$typeid."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return 1;
       }else{

             return 0;
          }
  }
 public function checkProductfor($forid)
  {
         $sql = "SELECT product_for_id FROM `oc_product_for` WHERE name='".$forid."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return 1;
       }else{

             return 0;
          }
  } 
 public function checkProductusability($usability)
  {
         $sql = "SELECT product_usability_id FROM `oc_product_usability` WHERE name='".$usability."'  LIMIT 1";
         $query = $this->db->query($sql);
        if ($query->num_rows > 0) {
        return 1;
       }else{

             return 0;
          }
  }
public function getProducttype($typename)
  {
        $sql = "SELECT product_type_id FROM `oc_product_type` WHERE name='".$typename."'  LIMIT 1";
        $query = $this->db->query($sql);
		if ($query->num_rows > 0) {
        return $query->row['product_type_id'];
		}else{

             return 0;
        }

  }
 public function getProductfor($forname)
  {
         $sql = "SELECT product_for_id FROM `oc_product_for` WHERE name='".$forname."'  LIMIT 1";
         $query = $this->db->query($sql);
		if ($query->num_rows > 0) {
        return $query->row['product_for_id'];
		}else{

             return 0;
        }
  } 
 public function getProductusability($usabilityname)
  {
         $sql = "SELECT product_usability_id FROM `oc_product_usability` WHERE name='".$usabilityname."'  LIMIT 1";
         $query = $this->db->query($sql);
		if ($query->num_rows > 0) {
        return $query->row['product_usability_id'];
		}else{

             return 0;
        }
  }  
	 
	 
    /*filter Assigen   start here*/

   public function assigenFilter($category_id,$product_id) {
      
            $this->product_assigen_filter_price($category_id,$product_id);
             $this->brand_filter($category_id,$product_id);
             $this->size_filter($category_id,$product_id);
             $this->color_filter($category_id,$product_id);
             $this->price_filter($category_id,$product_id);

  }

  /*  this function assigen price to product
       product_assigen_filter_price
  */

  public function product_assigen_filter_price($category_id,$productid)
  {
           
            $qq="SELECT product_id,price FROM  oc_product_special WHERE product_id='".$productid."'";
            $row=$this->db->query($qq);
            $specialprice=$row->row;
          
          
           if($specialprice['price']>100 && $specialprice['price']<500)
           {
               $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '171'");
               $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '171', product_id='".$productid."'");
           }
           elseif ($specialprice['price']>500 && $specialprice['price']<1000) {
           
                   $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '172'");
                   $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '172', product_id='".$productid."'");
           
           }elseif ($specialprice['price']>1000 && $specialprice['price']<5000) {
                   
                   $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '173'");
                   
                   $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '173', product_id='".$productid."'");
           }elseif ($specialprice['price']>5000 && $specialprice['price']<10000) {
                   
                    $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '174'");
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '174', product_id='".$productid."'");
           }elseif ($specialprice['price']>10000 && $specialprice['price']<50000) {
                   
                    $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '175'");
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '175', product_id='".$productid."'");
           
           }
           else{
                 
                 $this->db->query("DELETE FROM oc_product_filter WHERE product_id='".$productid."' AND  filter_id = '175'");
                 $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET filter_id = '175', product_id='".$productid."'");
            }

           /* $pp=" SELECT  filter_id,name FROM oc_filter_description WHERE filter_group_id='7' ";
           $row=$this->db->query($pp);
           $price_filter_string=$row->rows;

           $filterprice=array();
           foreach($price_filter_string as $filterid)
           {
             
             $filterprice[$filterid['filter_id']]=$filterid['name'];
             
           } 
          //pre($filterprice); */
}

  public function size_filter($category_id,$productid)
  {
          //// geting size filter
         $size=" SELECT  p.filter_id FROM oc_product_filter as p INNER JOIN oc_filter_description as d  ON(p.filter_id=d.filter_id) WHERE  filter_group_id='2' AND p.product_id='".$productid."'";
           $row=$this->db->query($size);
           $size_filter_string=$row->rows;
           foreach($size_filter_string as $filterid)
           {
              $this->db->query("DELETE FROM oc_category_filter WHERE category_id='".$category_id."' AND  filter_id = '" .(int)$filterid['filter_id']. "'");
             $this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET filter_id = '" .(int)$filterid['filter_id']. "', category_id='".$category_id."'");
           }
        

  }

  public function brand_filter($category_id,$productid)

  {

       
        //// geting brand filter
          $brand=" SELECT  p.filter_id FROM oc_product_filter as p INNER JOIN oc_filter_description as d  ON(p.filter_id=d.filter_id) WHERE filter_group_id='3' AND product_id='".$productid."' ";
          $row=$this->db->query($brand);
          $brand_filter_string=$row->rows;
          foreach($brand_filter_string as $filterid)
          {
             $this->db->query("DELETE FROM oc_category_filter WHERE category_id='".$category_id."' AND  filter_id = '" .(int)$filterid['filter_id']. "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET filter_id = '" .(int)$filterid['filter_id']. "', category_id='".$category_id."'");

          }
        

  }


 public function color_filter($category_id,$productid)

  {
    
        //// geting brand filter
           $color=" SELECT  p.filter_id FROM oc_product_filter as p INNER JOIN oc_filter_description as d  ON(p.filter_id=d.filter_id) WHERE filter_group_id='1' AND product_id='".$productid."' ";
             
             $query=$this->db->query($color);
          
          foreach($query->rows as $filterid)
          {
            
            $this->db->query("DELETE FROM oc_category_filter WHERE category_id='".$category_id."' AND  filter_id = '" .(int)$filterid['filter_id']. "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET filter_id = '" .(int)$filterid['filter_id']. "', category_id='".$category_id."'");

          }
        

  }

  public function price_filter($category_id,$productid)

  {
        //// geting brand filter
          $brand=" SELECT  p.filter_id FROM oc_product_filter as p INNER JOIN oc_filter_description as d  ON(p.filter_id=d.filter_id) WHERE filter_group_id='7' AND product_id='".$productid."' ";
          $row=$this->db->query($brand);
          $brand_filter_string=$row->rows;
          foreach($brand_filter_string as $filterid)
          {
            $this->db->query("DELETE FROM oc_category_filter WHERE category_id='".$category_id."' AND  filter_id = '" .(int)$filterid['filter_id']. "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "category_filter SET filter_id = '" .(int)$filterid['filter_id']. "', category_id='".$category_id."'");

          }
        

  }


    /*filter assigen end here*/
      
}
?>