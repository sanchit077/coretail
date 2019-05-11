<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AWS;
use Carbon\Carbon;
use Image,Validator;
use Response,Redirect;

use DateTimeImmutable, DateInterval,DatePeriod;

class CommonController extends Controller {

    ///////////		Multiple	Image Uploads 			//////////////////////////////

    public static function upload_multiple_images($images, $data) {

        $con = array();
        $s3 = \AWS::createClient('s3');

        foreach ($images as $key => $image) {

            $extention = $image->GetClientOriginalExtension();
            $filename = substr(sha1(time() . time()), 0, 25) . str_random(25) . ".{$extention}";

            $upload_success = $s3->putObject(array(
                'ACL' => 'public-read',
                'Bucket' => env('AWS_BUCKET'),
                'Key' => 'Files/' . $filename,
                'Body' => fopen($image->getPathname(), 'r'),
                'ContentType' => 'image/' . $extention,
            ));

            array_push($con, $filename);
        }

        if (count($con) == count($images))
            return $con;
        else
            return [];
    }

////////////////////////////////// Image Uploader ////////////////////////////////////////////////

    public static function image_uploader($image) {
        try {              
            $extention = $image->GetClientOriginalExtension();
            $filename = substr(sha1(time() . time()), 0, 30) . str_random(30) . ".{$extention}";
            if($extention=='pdf'){ 
                $image->move(public_path('uploads/admin_images/'),$filename);
            }else{
                $image_resize = Image::make($image->getRealPath());    
              if($image->getSize()>=2000){
                  $image_resize->save(public_path('uploads/admin_images/' .$filename),50);
              }else{
                  $image_resize->save(public_path('uploads/admin_images/' .$filename),100);
              }
            }
            return $filename ; 
           
            /*  
            $upload_success = $s3->putObject(array(
                'ACL' => 'public-read',
                'Bucket' => env('AWS_BUCKET'),
                'Key' => 'Files/' . $filename,
               // 'Body' => fopen($image->getPathname(), 'r'),
                'Body' => fopen(public_path('images/ServiceImages/' .$filename), 'r'),
                'ContentType' => 'image/' . $extention,
            ));
            unlink(public_path('images/ServiceImages/' .$filename));
            return $upload_success ? $filename : '';*/
        } catch (\Exception $e) { 
            return '';
        }
    }
 //////////////////////////////      Image Upload    ////////////////////////////////////////
    public static function image_upload_local($image)
        {
        try{     
            // echo  $extensions = $image->getMimeType();
            // echo '<br>'; 
            $extension =$image->getClientOriginalExtension();//get extension of file
            //echo '<br>';       
            $directory = 'uploads/admin_images/';//define directory to store images
            //  echo '<br>';
            $filename = substr(sha1(time().time()), 0, 25) . str_random(25).".{$extension}";//Filename to a random sha1 plus current time            
            // echo '<br>';
            //Move the uploaded file to temp directory
            $upload_success = $image->move($directory, $filename);
            // echo  '<br>';

            // if(!$upload_success)
            //  return '';

            // $optimizerChain = OptimizerChainFactory::create();
            // $optimizerChain->optimize(env('IMAGE_URL').$filename);
            // 
            // dd($filename, $extension);
            return $filename;
            }
        catch (\Exception $e) 
            {
                return '';
            }
        }


    public function getDownload($fileName)
    { 
      try{

        $file= public_path(). "/uploads/admin_images/".$fileName; 
        if(file_exists($file)){
             $headers = array(
              'Content-Type: application/pdf',
            );
            return Response::download($file, 'contract.pdf', $headers);
        }else{
            return Redirect::back()->witherrors('Contrato no disponible.');
        }

        }catch(\Exception $e){  
          return Redirect::back()->witherrors($e->getMessage())->withInput();
      } 
    }
//////////////////////////////////////		Starting Ending DT  //////////////////////////////////////////////////

    public static function set_starting_ending($data) {
                $custom_week = '';
                $dates    = [];
                $end      = new DateTimeImmutable('Monday');
                $start    = $end->modify('-1 weeks');
                $interval = new DateInterval('P1W');
                $period   = new DatePeriod($start, $interval, $end);
                foreach ($period as $date) {
                    $sunday = $date->modify('Sunday');
                    //  $dates[] = sprintf('%s - %s%s', $date->format('D j M'), $sunday->format('D j M'), PHP_EOL);
                    $custom_week    =    sprintf('%s - %s%s', $date->format('d/m/Y'), $sunday->format('d/m/Y'), PHP_EOL);
                    // $dates[] = sprintf('%s - %s%s', $date->format('Y-m-d'), $sunday->format('Y-m-d'), PHP_EOL);
                }
            $data['custom_week'] = $custom_week;
                // die;
                // $dates = array_reverse($dates);
                // foreach ($dates  as $week) {
                //     echo $week;
                // }
             // die;

            $time = new \DateTime('now', new \DateTimeZone($data['timezone']));
            $data['timezonez'] = $time->format('P');

                if(!isset($data['daterange']))
                    {
                        $data['starting_dt'] = Carbon::now()->subMonths(12)->format('Y-m-d');
                        $data['ending_dt'] = Carbon::now()->addday(1)->format('Y-m-d');
                } else {
                        $data['daterange'] = urldecode($data['daterange']);
                        $temp_array = explode(' - ', $data['daterange']);
                        $data['starting_dt'] = Carbon::CreateFromFormat('d/m/Y',$temp_array[0],$data['timezone'])->timezone('UTC')->format('Y-m-d');
                        $data['ending_dt'] = Carbon::CreateFromFormat('d/m/Y',$temp_array[1],$data['timezone'])->timezone('UTC')->format('Y-m-d');
                    }
                $data['starting_dt']    = $data['starting_dt'].' 00:00:00';
                $data['ending_dt']      = $data['ending_dt'].' 23:59:59';

                $data['fstarting_dt'] = Carbon::CreateFromFormat('Y-m-d H:i:s',$data['starting_dt'],'UTC')->timezone($data['timezone'])->format('d/m/Y');
                $data['fending_dt'] = Carbon::CreateFromFormat('Y-m-d H:i:s',$data['ending_dt'])->timezone($data['timezone'])->format('d/m/Y');

            return $data;  
    }

///////////////////
//
    
    
 
   public static function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          imagejpeg($image, $destination_url, $quality);
          return $destination_url;
        }
        //  $url = 'C:/Users/admin/Downloads/compressed.jpg';
        //  $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80);
   
    public static function file_delete($file) {
        try{
            $s3 = \AWS::createClient('s3');
            $delete = $s3->deleteObject(array(
                        'Bucket' => env('AWS_BUCKET'),
                        'Key'    => $file 
                    ));
            if($delete)
                return true;
            else
                return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function rand_string($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
 
}
