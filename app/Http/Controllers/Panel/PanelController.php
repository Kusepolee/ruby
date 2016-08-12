<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Input;
use Image;
use App\Complaints;
use App\Delivery;
use App\Rules;
use App\Member;
use App\Department;
use FooWeChat\Authorize\Auth;
use FooWeChat\Core\WeChatAPI;
use FooWeChat\Helpers\Helper;
use FooWeChat\Selector\Select;

class PanelController extends Controller
{
    /**
     * 面板首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Session::get('id');
        return view('panel.panel',['id'=>$id]);
    }

    /**
     * 投诉建议
     *
     * @return \Illuminate\Http\Response
     */
    public function complaints()
    {
        $id = Session::get('id');
        return view('panel.complaints',['id'=>$id]);
    }

    /**
     * 投诉存储
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function complaintsStore(Requests\Panel\ComplaintsRequest $request)
    {
        $input = $request->all();
        $input['state'] = 0;
        $id = Complaints::create($input)->id;

        //微信通知      
        $s = new Select;
        $w = new WeChatAPI;
        $h = new Helper;

        $rec = Complaints::find($id);
        if ($rec->type === 0) {
            $user_name = '匿名';
        } else {
            $user_name = Member::find($rec->user_id)->name;
        }
        $dp = Department::find($rec->target)->name;
        
        $body = '投诉人: '.$user_name.' 投送部门: '.$dp.' 内容: '.$rec->content;

        $dp_id = $rec->target;
        switch ($dp_id) {
            case 3:
                $array = [
              'user'       => '8',//8|6|2
              // 'department' => '资源部',
              // 'seek'       => '>=:经理@运营部',
              'self'       => 'own',
            ];
                break;
            case 6:
                $array = [
              'user'       => '8|5',//8|6|2
              // 'department' => '资源部',
              // 'seek'       => '>=:经理@运营部',
              'self'       => 'own',
            ];
                break;
            default:
                $array = [
              'user'       => '8|12',//8|6|2
              // 'department' => '资源部',
              // 'seek'       => '>=:经理@运营部',
              'self'       => 'own',
            ];
                break;
        }
        
        $url = $h->app('ssl').'://'.$h->custom('url').'/panel/complaints/show/'.$id;
        $picurl = $h->app('ssl').'://'.$h->custom('url').'/custom/image/news/advice.png';
        $arr_news = [['title'=>'投诉建议','description'=>$body,'url'=>$url,'picurl'=>$picurl]];
        
        $w->safe = 0;
        $w->sendNews($s->select($array), $arr_news);


        $arr = ['color'=>'success', 'type'=>'5','code'=>'5.1', 'btn1'=>'返回面板', 'link1'=>'/panel', 'btn2'=>'上传图片', 'link2'=>'/panel/complaints/image/set/'.$id];
        return view('note',$arr);
    }

    /**
     * 投诉图片上传
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image($id)
    {
        // return view('upload_image', ['path'=>'/panel/complaints/image/store', 'name'=>'面板首页', 'link'=>'/panel', 'resId'=>$id]);
        return view('panel.complaints_image', ['path'=>'/panel/complaints/image/store', 'name'=>'面板首页', 'link'=>'/panel', 'id'=>$id]);
    }

    /**
     * 投诉图片存储
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imageStore(Requests\Panel\ImageRequest $request)
    {
        $file = Input::file('pic');
        $image = $file->getRealPath();

        $target = Complaints::find($request->id);
        $png_name = $target->id.'-'.time().'.png';

        Image::make($image)->save('upload/advice/'.$png_name);

        if($target->image != '' && $target->image != null){
            $target->update(['image'=>$target->image.'|'.$png_name]);
        }else{
            $target->update(['image'=>$png_name]);
        }
        $arr = ['color'=>'success', 'type'=>'5','code'=>'5.1', 'btn1'=>'返回面板', 'link1'=>'/panel', 'btn2'=>'继续上传图片', 'link2'=>'/panel/complaints/image/set/'.$request->id];
        return view('note',$arr);
    }

    /**
     * 投诉记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complaintsRecord()
    {
        $id = Session::get('id');
        $a = new Auth;
        $h = new Helper;

        if($a->auth(['admin'=>'no', 'position'=>'>=总经理', 'department'=>'>=总经理'])){
            $rec = Complaints::orderBy('created_at', 'desc')
                            ->leftjoin('members', 'complaints.user_id', '=', 'members.id')
                            ->leftjoin('departments', 'complaints.target', '=', 'departments.id')
                            ->select('complaints.*', 'members.name as userName', 'departments.name as dpName')
                            ->paginate(30);
            
        }elseif($a->auth(['admin'=>'no', 'position'=>'>=总监', 'department'=>'>=运营部'])){
            $rec = Complaints::where('target', 6)
                            ->orderBy('created_at', 'desc')
                            ->leftjoin('members', 'complaints.user_id', '=', 'members.id')
                            ->leftjoin('departments', 'complaints.target', '=', 'departments.id')
                            ->select('complaints.*', 'members.name as userName', 'departments.name as dpName')
                            ->paginate(30);

        }elseif($a->auth(['admin'=>'no', 'position'=>'>=总监', 'department'=>'>=监察部'])){
            $rec = Complaints::where('target', 10)
                            ->orderBy('created_at', 'desc')
                            ->leftjoin('members', 'complaints.user_id', '=', 'members.id')
                            ->leftjoin('departments', 'complaints.target', '=', 'departments.id')
                            ->select('complaints.*', 'members.name as userName', 'departments.name as dpName')
                            ->paginate(30);

        }else{
            $rec = Complaints::where('user_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->leftjoin('members', 'complaints.user_id', '=', 'members.id')
                            ->leftjoin('departments', 'complaints.target', '=', 'departments.id')
                            ->select('complaints.*', 'members.name as userName', 'departments.name as dpName')
                            ->paginate(30);

        }
        foreach ($rec as $out) {
            if($out->type === 0) $out->userName = '匿名';
        }

        return view('panel.complaints_record', ['rec'=>$rec]);
    }

    /**
     * 投诉信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complaintsShow($id)
    {
        $user_id = Session::get('id');
        $rec = Complaints::find($id);
        $a = new Auth;

        if($a->auth(['admin'=>'no', 'position'=>'>=总经理', 'department'=>'>=总经理'])){
            if ($rec->type === 0) {
                    $user_name = '匿名';
                } else {
                    $user_name = Member::find($rec->user_id)->name;
                }
                $dp = Department::find($rec->target)->name;
                if($rec->image != '' && $rec->image != null){
                    $img = explode('|', $rec->image);
                }else{
                    $img = 0;
                }
        }elseif($a->auth(['admin'=>'no', 'position'=>'>=总监', 'department'=>'>=运营部'])){
            if ($rec->type === 0) {
                    $user_name = '匿名';
                } else {
                    $user_name = Member::find($rec->user_id)->name;
                }
                $dp = Department::find($rec->target)->name;
                if($rec->image != '' && $rec->image != null){
                    $img = explode('|', $rec->image);
                }else{
                    $img = 0;
                }
        }elseif($a->auth(['admin'=>'no', 'position'=>'>=总监', 'department'=>'>=监察部'])){
            if ($rec->type === 0) {
                    $user_name = '匿名';
                } else {
                    $user_name = Member::find($rec->user_id)->name;
                }
                $dp = Department::find($rec->target)->name;
                if($rec->image != '' && $rec->image != null){
                    $img = explode('|', $rec->image);
                }else{
                    $img = 0;
                }
        }else{
            if($user_id != $rec->user_id){
                return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
                exit;
            }else{
                if ($rec->type === 0) {
                    $user_name = '匿名';
                } else {
                    $user_name = Member::find($rec->user_id)->name;
                }
                $dp = Department::find($rec->target)->name;
                if($rec->image != '' && $rec->image != null){
                    $img = explode('|', $rec->image);
                }else{
                    $img = 0;
                }
            }
        }
        return view('panel.complaints_show', ['rec'=>$rec, 'user_name'=>$user_name, 'dp'=>$dp, 'img'=>$img]);        
    }

    /**
     * 发货记录主页面
     *
     */
    public function delivery()
    {
        $arr = ['position' => '>=经理', 'department' => '>=资源部'];
        $a = new Auth;
        if(!$a->auth($arr)){
            return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
            exit;
        }

        $outs = Delivery::orderBy('name')
                          ->orderBy('date', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->leftJoin('config as b', 'delivery.unit', '=', 'b.id')
                          ->leftJoin('members', 'delivery.created_by', '=', 'members.id')
                          ->select('delivery.*', 'b.name as unitName', 'members.name as createByName')
                          ->paginate(30);

        return view('panel.delivery', ['outs'=>$outs]);
    }

    /**
     * 新建发货记录
     *
     */
    public function deliveryCreate()
    {
        $arr = ['position' => '>=经理', 'department' => '>=资源部'];
        $a = new Auth;
        if(!$a->auth($arr)){
            return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
            exit;
        }

        $id = Session::get('id');
        return view('panel.delivery_create', ['id'=>$id]);
    }

    /**
     * 存储发货记录
     *
     */
    public function deliveryStore(Requests\Panel\DeliveryRequest $request)
    {
        $input = $request->all();
        $id = Delivery::create($input)->id;

        $s = new Select;
        $w = new WeChatAPI;
        $h = new Helper;
        $rec = Delivery::leftJoin('config as b', 'delivery.unit', '=', 'b.id')
                        ->leftJoin('members', 'delivery.created_by', '=', 'members.id')
                        ->select('delivery.*', 'b.name as unitName', 'members.name as createByName')
                        ->find($id);

        $body = '[发货记录]'.$rec->date.','.$rec->name.floatval($rec->amount).$rec->unitName.'发往'.$rec->company;

        $array = [
                  'user'       => '8|6',//8|6|2
                  'department' => '资源部',
                  // 'seek'       => '>=:经理@运营部', 
                  'self'       => 'own',
            ];       
        
        $url = $h->app('ssl').'://'.$h->custom('url').'/panel/delivery/show/'.$id;
        $picurl = $h->app('ssl').'://'.$h->custom('url').'/custom/image/news/delivery.png';
        $arr_news = [['title'=>'发货记录','description'=>$body,'url'=>$url,'picurl'=>$picurl]];
        
        $w->safe = 0;
        $w->sendNews($s->select($array), $arr_news);

        return redirect('/panel/delivery');
    }

    /**
     * 发货记录详细信息
     *
     */
    public function deliveryShow($id)
    {
        $arr = ['position' => '>=经理', 'department' => '>=资源部'];
        $a = new Auth;
        if(!$a->auth($arr)){
            return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
            exit;
        }

        $rec = Delivery::leftJoin('config as b', 'delivery.unit', '=', 'b.id')
                        ->leftJoin('members', 'delivery.created_by', '=', 'members.id')
                        ->select('delivery.*', 'b.name as unitName', 'members.name as createByName')
                        ->find($id);

        return view('panel.delivery_show', ['rec'=>$rec]);
    }

    /**
     * 规章制度主页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rules()
    {
        $id = Session::get('id');
        $dp = Member::find($id)->department;
        $dp_name = Department::find($dp)->name;

        $departments = Rules::where('dp_id', '>', 2)
                     ->rightJoin('departments', 'rules.dp_id', '=', 'departments.id')
                     ->groupBy('rules.dp_id')
                     ->distinct()
                     ->select('rules.dp_id', 'departments.name as departmentName')
                     ->get();
        $dps = [];
        if(count($departments)){
            foreach ($departments as $d) {
                $dps = array_add($dps, $d->dp_id, $d->departmentName);
            }
        }
        
        $firsts = Rules::where('dp_id', 2)->get();
        $recs = Rules::where('dp_id', '>', 2)->get();
        $groups = $recs->groupBy('dp_id');
        $groups->toArray();

        return view('panel.rules', ['firsts'=>$firsts, 'dp'=>$dp, 'dp_name'=>$dp_name, 'dps'=>$dps,'groups'=>$groups]);
    }

    /**
     * 规章制度添加
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function rulesCreate()
    {
        $arr = ['position' => '>=总监', 'department' => '>=运营部'];
        $a = new Auth;
        if(!$a->auth($arr)){
            return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
            exit;
        }

        return view('panel.rules_create');
    }

    /**
     * 规章制度存储
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function rulesStore(Requests\Panel\RulesRequest $request)
    {
        $input = $request->all();
        Rules::create($input);

        return redirect('panel/rules');
    }

    /**
     * 规章制度修改
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function rulesEdit($id)
    {
        $arr = ['position' => '>=总监', 'department' => '>=运营部'];
        $a = new Auth;
        if(!$a->auth($arr)){
            return view('40x',['color'=>'warning', 'type'=>'3', 'code'=>'3.1']);
            exit;
        }
        
        $recs = Rules::find($id);

        return view('panel.rules_create', ['rec'=>$recs]);
    }

    /**
     * 规章制度更新修改
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function rulesUpdate(Requests\Panel\RulesRequest $request, $id)
    {
        $rec = Rules::find($id);
        $update = $request->all();
        unset($update['_token']);
        Rules::where('id', $id)->update($update);

        return redirect('panel/rules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proof()
    {
        return view('panel.proof');
    }


    /**
    * 显示系统设置页面
    *
    */
    public function config()
    {
      return view('panel.config');
    }

    /**
    * others
    */
}













