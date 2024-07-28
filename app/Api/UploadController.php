<?php

namespace App\Api;


use App\Models\Platform;
use App\Models\Ssr;
use App\Models\UserCc;
use App\Models\UserSsr;
use App\Models\UserUrl;
use App\Models\Website;
use Illuminate\Http\Request;

class UploadController
{

    /**
     * @var array|mixed
     */
    private mixed $return_ssrs;
    /**
     * @var array|mixed
     */
    private mixed $return_urls;

    public function remoteApi(Request $request){
        $data=Website::all()->toArray();
        $ssr=Ssr::all()->toArray();
        return response()->json(['code'=>1,'data'=>$data,'ssr'=>$ssr]);
    }
    public function upload(Request $request){
        $file = request()->file('file');
        $filename = request()->input('userKey');
        $userId = request()->input("userId");
        $path = request()->input("path");

//        $path=$this->unicode_decode($path);
//        return $path;

        $pa=date('Ymd')."/_".$path;
        $pa=str_replace("/",'_',$path);

        $arr=explode("/",$path);
//        var_dump($arr);die;
        $pp=implode("_",$arr);
//        return $pa;
        $pp=$this->unicode_decode($pp);
        $path2 = $file->storeAs(date('Ymd')."\\".$userId."\\".$pp,time()."_".$filename, 'public');
//        $path = $file->storeAs("iikk",time()."_44", 'public');
        return $path2;
    }

    function unicode_decode($name)
    {
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
        preg_match_all($pattern, $name, $matches);
        if (!empty($matches))
        {
            $name = '';
            for ($j = 0; $j < count($matches[0]); $j++)
            {
                $str = $matches[0][$j];
                if (strpos($str, '\\u') === 0)
                {
                    $code = base_convert(substr($str, 2, 2), 16, 10);
                    $code2 = base_convert(substr($str, 4), 16, 10);
                    $c = chr($code).chr($code2);
                    $c = iconv('UCS-2', 'UTF-8', $c);
                    $name .= $c;
                }
                else
                {
                    $name .= $str;
                }
            }
        }
        return $name;
    }

    //初始化设备
    public function checData(Request $request){
        $this->return_ssrs=[];
        $this->return_urls=[];
        $request->validate([
            'device_id'=>'required',
            'urls'=>'required',
            'ssrs'=>'required',
            'app_name'=>'required',

        ]);
//        return $request->input("ssrs");
        $model= UserCc::where('device_id',$request->input('device_id'))->first();
        if (empty($model)){
            $model=new UserCc();
            $model->device_id=$request->input('device_id');
            $model->app_name=$request->input('app_name');
            $model->times=1;
            $model->save();



        }else{
            $model->times=$model->times+1;
            $model->save();
        }

        //保存ssr
        try{
            $ssrs=json_decode($request->input("ssrs"),true);
        }catch (\Exception $e){
            $ssrs=[];
        }
        try {
            $urls=json_decode($request->input('urls'),true);

        }catch (\Exception $e){
            $urls=[];
        }
        if(empty(Platform::where([['app_name','=',$request->post('app_name')],['status','=',1]]))){
            return ['code'=>0,'message'=>'平台禁止使用'];
        }

        $platform=Platform::where('app_name',$request->post('app_name'))->first();

        $database_urls=$this->getDataBase_Ulrs($platform->id);
        $database_ssrs=$this->getDataBase_Ssrs($platform->id);
        if (!empty($database_urls)){
            $this->return_urls=$database_urls;
        }else{
            if(!empty($urls)){
                foreach ($urls as $u){
                    $urlM=new UserUrl();
                    $urlM->name=$u['name'];
                    $urlM->url=$u['url'];
                    $urlM->app_name=$platform->id;
                    $urlM->save();
                }
            }
        }
        if (!empty($database_ssrs)){
            $this->return_ssrs=$database_ssrs;
        }else{
            if(!empty($ssrs)){
                foreach ($ssrs as $u){
                    $urlM=new UserSsr();
                    $urlM->name=$u['name'];
                    $urlM->ssr=$u['ssr'];
                    $urlM->app_name=$platform->id;
                    $urlM->save();
                }
            }
        }


        return ['code'=>1,'ssrs'=>$this->return_ssrs,'urls'=>$this->return_urls];




    }

    private function getDataBase_Ulrs(array|string|null $post)
    {
        $model=UserUrl::where('app_name',$post)->get();
        $data=[];
        foreach ($model as $m){
            $data[]=['name'=>$m->name,'url'=>$m->url];
        }
        return $data;

    }

    private function getDataBase_Ssrs(array|string|null $post)
    {
        $model=UserSsr::where('app_name',$post)->get();
        $data=[];
        foreach ($model as $m){
            $data[]=['name'=>$m->name,'ssr'=>$m->ssr];
        }
        return $data;
    }

}
