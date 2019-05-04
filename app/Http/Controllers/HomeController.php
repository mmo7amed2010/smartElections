<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Election;
use Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
       $x= $image->move($destinationPath, $input['imagename']);
       $image=  "images\\".$input['imagename'];
        $locale='de_DE.UTF-8';
        setlocale(LC_ALL,$locale);
        putenv('LC_ALL='.$locale);
        $id_no = shell_exec('python beta2a/y.py '.public_path($image).'  '."2".$input['imagename'].' 2>&1');
        $id_no = preg_replace('/\s+/', ' ', $id_no);
        $name = preg_replace("/[^0-9]/", "", $id_no );

        // return '"C:\Program Files (x86)\Tesseract-OCR\tesseract.exe" '.$id_no.' E: -l ara-Amiri 2>&1';
        $id_no = shell_exec('"C:\Program Files (x86)\Tesseract-OCR\tesseract.exe" '.$id_no.' E:/ip/public/'.$name.' -l ara-Amiri-layer 2>&1');
        $file = file_get_contents($name.'.txt');

        $id_no= $this->faTOen($file);

        $id_no = preg_replace("/[^0-9]/", "", $id_no );
        $numberss=strlen($id_no);
        $half=(int)($numberss/2);
        $user_data = Election::where("national_id",$id_no)
        ->orWhere("national_id","like","%".substr($id_no,0,$half)."%")
        ->orWhere("national_id","like","%".substr($id_no,$half,$numberss)."%")
        ->orWhere("national_id","like","%".str_replace("2","3",substr($id_no,1,$half/2))."".substr($id_no,($half/2)+1,$half-1)."%")
        ->orWhere("national_id","like","%".substr($id_no,1,$half/2)."".str_replace("2","3",substr($id_no,($half/2)+1,$half-1))."%")
        ->orWhere("national_id","like","%".str_replace("2","3",substr($id_no,$half,1.5*$half))."%")
        ->first();

        if(isset($user_data->id)){
            if($user_data->status=="no"){
                $user_data->status="yes";
                $user_data->save();
                $response[0]  = "هذا الرقم القومى لم ينتخب بعد";

            }else{
                $response[0]  = "تم الانتخاب بهذا الرقم القومى من قبل";

            }
                $response["name"]  = $user_data->name;
                $response["address"]  = $user_data->address;
                $response["national_id"]  = $user_data->national_id;

        }else{

            $response[0]  = "الرقم القومى ".$id_no." غير موجود بقاعدة البيانات.";
            $response[1]  = "اذا كان الرقم القومى خطأ قم بأخذ صورة اوضح";
        }
        return Redirect::back()->with('success',$response);
    }
    function faTOen($string) {
        return strtr($string, array('.'=>'0', '۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }

}