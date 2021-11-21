<?php 

namespace App\Http\Helpers;
// use App\Http\Helpers\SimpleImage;
// require_once 'SimpleImage.php';
class Helpers
{

  public static function Token($header){
    $header = substr($header, 7);
    return $token  = \App\Models\Tokens::where('token',$header)->first();
  }
  public static function get_youtube_id( $url ) {
    $youtubeid = explode('v=', $url);
    $youtubeid = explode('&', $youtubeid[1]);
    $youtubeid = $youtubeid[0];
    return $youtubeid;
  }

  public static function get_youtube_thumb( $id ) {
    if ( url_exists( 'https://i.ytimg.com/vi_webp/' .$id . '/sddefault.webp' ) ) {
      $image = 'https://i.ytimg.com/vi_webp/' .$id . '/sddefault.webp';
    }elseif ( url_exists( 'https://i.ytimg.com/vi_webp/' .$id . '/maxresdefault.webp' ) ) {
      $image = 'https://i.ytimg.com/vi_webp/' .$id . '/maxresdefault.webp';
    }
    elseif ( url_exists( 'https://i.ytimg.com/vi_webp/' .$id . '/mqdefault.webp' ) ) {
      $image = 'https://i.ytimg.com/vi_webp/' .$id . '/mqdefault.webp';
    }
    
    elseif ( url_exists( 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg' ) ) {
      $image = 'https://i.ytimg.com/vi/' .$id . '/maxresdefault.jpg';
    }
    elseif ( url_exists( 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg' ) ) {
      $image = 'https://i.ytimg.com/vi/' .$id . '/mqdefault.jpg';
    }
    else {
      $image = false;
    }
    return $image;
  }

  public static function randomString($length = 6, $type = 0)
{
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $str = "";
  $size = strlen($chars);
  for ($i = 0; $i < $length; $i++) {
    $str .= $chars[rand(0, $size - 1)];
  }//end for loop
  if ($type == 1) {
    return md5($str);
  }
  return $str;
}
/**********************************************************************************************************************/
public static function randomNumber($length, $type = 0)
{
  $chars = "0123456789";
  $str = "";
  $size = strlen($chars);
  for ($i = 0; $i < $length; $i++) {
    $str .= $chars[rand(0, $size - 1)];
  }//end for loop
  if ($type == 1) {
    return md5($str);
  }
  return $str;
}
/**********************************************************************************************************************/
public static function cutText($str, $limit, $withDots = true)
{
  $str = strip_tags($str);
  $str = trim($str);
  if (strlen($str) > $limit) {
    $str = substr($str, 0, strrpos(substr($str, 0, $limit), ' '));
    $str .= ($withDots) ? '...' : '';
  }
  return $str;
}
/**********************************************************************************************************************/
public static function getCurrentPageURL()
{
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {
    $pageURL .= "s";
  }
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}
/**********************************************************************************************************************/
public static function getMonthName($month='')
{
  $months = array(
    "Jan" => "يناير",
    "Feb" => "فبراير",
    "Mar" => "مارس",
    "Apr" => "أبريل",
    "May" => "مايو",
    "Jun" => "يونيو",
    "Jul" => "يوليو",
    "Aug" => "أغسطس",
    "Sep" => "سبتمبر",
    "Oct" => "أكتوبر",
    "Nov" => "نوفمبر",
    "Dec" => "ديسمبر"
  );
  return $months[$month];
}
/**********************************************************************************************************************/
public static function stringReplace($text, $type = 0)
{
  $search = array();
  if ($type == 1) {// clear details
    $search = array();
    $str = str_replace($search, '', $text);
    //   $str = strip_tags($str);
    $str = trim($str);
    return $str;
  } else if ($type == 2) {//clear to link ;
    $search=array(';','/','.',',','!','@','#','$','%','^','*','(',')','=','+','~','&','"','||',"'",'&quot;','&ldquo;','&rdquo;','&lsquo;','&rsquo;','&mdash;','&ndash;','<div>','</div>','|','&laquo;','&nbsp;','&raquo;','&middot');
    $text=str_replace($search,'',$text);
    return str_replace(" ","-",strip_tags($text));
  } else if ($type == 3) {//clear to link ;
    $search = array('"', '||', '&quot;', '&ldquo;', '&rdquo;', '&lsquo;', '&rsquo;', '&mdash;', '&ndash;', '<div>', '</div>', '|', '&laquo;', '&nbsp;', '&raquo;', '&middot');
    $text = str_replace($search, '', $text);
    return strip_tags($text);
  }
}
/**********************************************************************************************************************/
public static function checkMobileNo($phoneNumber='')
{
  $phone = preg_replace('/[^0-9]/', '', $phoneNumber);
  if(strlen($phone) === 10) {
    return 1;
  }else{
    return 0;
  }
}

/**********************************************************************************************************************/
public static  function time_elapsed_string($datetime, $full = false)
{
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);
  $diff->w = floor($diff->d / 7);

  $diff->d -= $diff->w * 7;
  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');

    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);

  if ($diff->days > 60) {
    return date('d-m-Y h:i A', strtotime($datetime));
  } else {
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

}
/**********************************************************************************************************************/
public static function city($city_id){
    $city = array(
      '7303419' => 'القدس',
      '281133' => 'غزة',
      '282239' => 'رام الله',
      '281124' => 'خان يونس',
      '281102' => 'رفح',
      '284315' => 'بيت لحم',
      '285066' => 'الخليل',
    );
    return $city[$city_id];
}
/**********************************************************************************************************************/
public static function time_ago($datetime, $full = false)
{
  $now = new \DateTime;
  $ago = new \DateTime($datetime);
  $diff = $now->diff($ago);
  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'سنة',
    'm' => 'شهر',
    'w' => 'اسبوع',
    'd' => 'يوم',
    'h' => 'ساعة',
    'i' => 'دقيقة',
    's' => 'ثانية',
  );
  $string1 = array(
    'y' => 'سنتين',
    'm' => 'شهرين',
    'w' => 'اسبوعان',
    'd' => 'يومان',
    'h' => 'ساعتين',
    'i' => 'دقيقتان',
    's' => 'ثانيتين',
  );
  $string2 = array(
    'y' => 'سنوات',
    'm' => 'شهور',
    'w' => 'اسابيع',
    'd' => 'يوم',
    'h' => 'ساعة',
    'i' => 'دقائق',
    's' => 'ثانية',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      if ($diff->$k == 1) {
        $v = $string[$k];
      } else if ($diff->$k == 2) {
        $v = $string1[$k];
      } else if ($diff->$k > 2) {
        $v = $string2[$k];
        $v = $diff->$k . ' ' . $v;
      }

      // echo $v;exit;
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? 'منذ ' . implode(', ', $string) : 'الآن';
}
/**********************************************************************************************************************/
public static function getDateTimeMessage($date){
  $result='';
  $lastUpdateMessage = date('Y-m-d',strtotime($date));
  if(date('Y-m-d')==$lastUpdateMessage){
    $result=date('H:i',strtotime($date));
  }else{
    $FirstDay = date("Y-m-d", strtotime('sunday last week'));
    $LastDay = date("Y-m-d", strtotime('sunday this week'));
    if($lastUpdateMessage > $FirstDay && $lastUpdateMessage < $LastDay) {
      $result=date('l',strtotime($date));
    } else {
      $result=date('F-d',strtotime($date));
    }
  }
  return $result;
}
public static function dateFormat($date, $check = true)
    {
        $time = mktime(0, 0, 0, date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
        $TDays = round($time / (60 * 60 * 24));
        $HYear = round($TDays / 354.37419);
        $Remain = $TDays - ($HYear * 354.37419);
        $HMonths = round($Remain / 29.531182);
        $HDays = $Remain - ($HMonths * 29.531182);
        $HYear = $HYear + 1389;
        $HMonths = $HMonths + 10;
        $HDays = $HDays + 23;
        if ($HDays > 29.531188 and round($HDays) != 30) {
            $HMonths = $HMonths + 1;
            $HDays = Round($HDays - 29.531182);
        } else {
            $HDays = Round($HDays);
        }
        if ($HMonths > 12) {
            $HMonths = $HMonths - 12;
            $HYear = $HYear + 1;
        }
        $NowDay = $HDays;
        $NowMonth = $HMonths;
        $NowYear = $HYear;
        if ($HMonths == "1") {
            $HMonths2 = "محرم";
        } elseif ($HMonths == "2") {
            $HMonths2 = "صفر";
        } elseif ($HMonths == "3") {
            $HMonths2 = "ربيع الأول";
        } elseif ($HMonths == "4") {
            $HMonths2 = "ربيع الثاني";
        } elseif ($HMonths == "5") {
            $HMonths2 = "جمادي الأول";
        } elseif ($HMonths == "6") {
            $HMonths2 = "جمادي ثاني";
        } elseif ($HMonths == "7") {
            $HMonths2 = "رجب";
        } elseif ($HMonths == "8") {
            $HMonths2 = "شعبان";
        } elseif ($HMonths == "9") {
            $HMonths2 = "رمضان";
        } elseif ($HMonths == "10") {
            $HMonths2 = "شوال";
        } elseif ($HMonths == "11") {
            $HMonths2 = "ذو القعدة";
        } elseif ($HMonths == "12") {
            $HMonths2 = "ذو الحجة";
        }


        $MDay_Num = date('w', strtotime($date));
      if ($MDay_Num == "0") {
            $MDay_Name = 'الأحد'; 
        } elseif ($MDay_Num == "1") {
             $MDay_Name = 'الاثنين';
        } elseif ($MDay_Num == "2") {
           $MDay_Name = 'الثلاثاء';
        } elseif ($MDay_Num == "3") {
            $MDay_Name = 'الأربعاء';
        } elseif ($MDay_Num == "4") {
            $MDay_Name = 'الخميس';
        } elseif ($MDay_Num == "5") {
            $MDay_Name = 'الجمعة';
        } elseif ($MDay_Num == "6") {
            $MDay_Name = 'السبت';
        }
        $NowDayName = $MDay_Name;
        $day = date('d', strtotime($date)) . " " . self::get_month_name(date('M', strtotime($date))) . " " . date('Y', strtotime($date));
        if ($check) {
            return $NowDate = $MDay_Name . " , " . $day . " - " . $HDays . " " . $HMonths2 . " " . $HYear . " هـ";
        } else {
            return $NowDate = $MDay_Name . " , " . $day;
        }
    }

    public static function get_month_name($month)
    {
        $months = array(
            "Jan" => 'ينار',
            "Feb" => 'فبراير',
            "Mar" => 'مارس',
            "Apr" => 'أبريل',
            "May" => 'مايو',
            "Jun" => 'يونيو',
            "Jul" => 'يوليو',
            "Aug" => 'أغسطس',
            "Sep" => 'سمتبمر',
            "Oct" => 'أكتوبر',
            "Nov" => 'نوفمبر',
            "Dec" => 'ديسمبر',
        );
        return $months[$month];
    }

    public static function getDayName($date=''){
        $MDay_Num = date('w', strtotime($date));
        if ($MDay_Num == "0") {
            $MDay_Name = 'الأحد'; 
        } elseif ($MDay_Num == "1") {
            $MDay_Name = 'الاثنين';
        } elseif ($MDay_Num == "2") {
            $MDay_Name = 'الثلاثاء';
        } elseif ($MDay_Num == "3") {
            $MDay_Name = 'الأربعاء';
        } elseif ($MDay_Num == "4") {
            $MDay_Name = 'الخميس';
        } elseif ($MDay_Num == "5") {
            $MDay_Name = 'الجمعة';
        } elseif ($MDay_Num == "6") {
            $MDay_Name = 'السبت';
        }
        return $MDay_Name;
    }

    public static function hft_nice_number($n) {
        $n = (0+str_replace(",","",$n));
        
        if(!is_numeric($n)) return 0;
        
        if($n>1000000000000) return round(($n/1000000000000),1).' trillion';
        else if($n>1000000000) return round(($n/1000000000),1).' billion';
        else if($n>1000000) return round(($n/1000000),1).' M';
        else if($n>1000) return round(($n/1000),1).' k';
        
        return number_format($n);
    }
	
    public static function resizeImage($photoName, $file, $width, $height, $uploadPath)
    {
        require_once 'SimpleImage.php';
        $image = new SimpleImage();
        $image->load($file);
        $image->resize($width, $height);
        $image->save($uploadPath . $photoName);

        if (file_exists($uploadPath . $photoName)) {
            return true;
        }
    }

    public static function resizeImage2($photoName, $file, $width, $height, $uploadPath)
    {
        require_once 'SimpleImage.php';
        $image = new SimpleImage();
        $image->load($file);
        $image->resizeToWidth($width);
        $image->save($uploadPath . $photoName);

        if (file_exists($uploadPath . $photoName)) {
            return true;
        }
    }


    public static function mergeImage($src,$source,$name){
      // $info = getimagesize($src);
      $list =  getimagesize($source);
      $list2 =  getimagesize('site/assets/images/2.png');
      // if ($src == 'jpeg' or $src == 'jpg'){
      //   $dest = imagecreatefromjpeg($source);
      // }elseif ($src == 'gif'){
      //   $dest = imagecreatefromgif($source);
      // }elseif ($src == 'png') {
      //   $dest = imagecreatefrompng($source);
      // }
      $dest = imagecreatefromstring(file_get_contents($source));
      $image = imagecreatefromstring(file_get_contents('site/assets/images/2.png'));
      imagealphablending($dest, false);
      imagesavealpha($dest, true);
    imagecopymerge($dest, $image, $list['0']*(0.99 - (100/$list['0'])),$list['1']*(0.99 - (100/$list['1'])),0,0,$list2['0'],$list2['1'] , 90); 
      imagepng($dest, 'uploads/'.$name);

  }
  

  public static function compressImage($mime,$source, $destination, $quality) {
      // $info = getimagesize($/source);
      // if ($mime == 'jpeg' or $mime == 'jpg'){
      //   $dest = imagecreatefromjpeg($source);
      // }elseif ($mime == 'gif'){
      //   $dest = imagecreatefromgif($source);
      // }elseif ($mime == 'png' or $mime == 'jpg') {
      //   $dest = imagecreatefrompng($source);
      // }
      $image = imagecreatefromstring(file_get_contents($source));
      imagejpeg($image, $destination, $quality);
    }

    public static function compressVideo($video,$dest){
      $bitrate = '200k';
      $command = "/usr/local/bin/ffmpeg -i $video -b:v $bitrate -bufsize $bitrate $dest";
      // $command = "/usr/local/bin/ffmpeg -i $video -s 200K $dest";
      system($command);
      echo '23232';
    }

}