<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\FinanceOuts;
use App\FinanceTrans;
use App\Member;
use App\Department;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use FooWeChat\Authorize\Auth;
use FooWeChat\Core\WeChatAPI;
use FooWeChat\Helpers\Helper;
use FooWeChat\Selector\Select;

class FinanceController extends Controller
{
	protected $seekDpArray;
	protected $seekName;

	/*
	 *财务首页
	 *
	 *
	 */
	public function index()
	{
		$a = new Auth;
		if($a->auth(['admin'=>'no', 'position'=>'>=总监', 'department'=>'>=运营部|资源部'])){
			$outs = FinanceOuts::where(function ($query) { 
	                            if(count($this->seekDpArray)) $query->whereIn('finance_outs.out_about', $this->seekDpArray);
	                            if ($this->seekName != '' && $this->seekName != null) {
	                                $query->where('finance_outs.out_user', 'LIKE', '%'.$this->seekName.'%');
	                            }
	                        })
							->orderBy('out_date', 'desc')
							->leftjoin('departments', 'finance_outs.out_about', '=', 'departments.id')
							->leftjoin('config', 'finance_outs.out_bill', '=', 'config.id')
							->select('finance_outs.*', 'config.name as outBill', 'departments.name as dpName')
							->paginate(30);
			$trans = FinanceTrans::where(function ($query) { 
	                            if ($this->seekName != '' && $this->seekName != null) {
	                                $query->where('finance_trans.tran_to', 'LIKE', '%'.$this->seekName.'%');
	                            }
	                        })
							->orderBy('tran_date', 'desc')
							->leftjoin('members as a', 'finance_trans.tran_from', '=', 'a.id')
							->leftjoin('members as b', 'finance_trans.createdBy', '=', 'b.id')
							->leftjoin('members as c', 'finance_trans.tran_to', '=', 'c.id')
							->leftjoin('config', 'finance_trans.tran_type', '=', 'config.id')
							->select('finance_trans.*', 'a.name as fromName', 'config.name as tranType', 'b.name as createdByName', 'c.name as toName')
							->paginate(30);
			

		}elseif ($a->auth(['admin'=>'no', 'position'=>'=总监'])) {

			$id = Session::get('id');
			$user_dp = Member::find($id)->department;
			$user = Session::get('name');
			$outs = FinanceOuts::where(function ($query) { 
	                            if(count($this->seekDpArray)) $query->whereIn('finance_outs.out_about', $this->seekDpArray);
	                            if ($this->seekName != '' && $this->seekName != null) {
	                                $query->where('finance_outs.out_user', 'LIKE', '%'.$this->seekName.'%');
	                            }
	                        })
							->where('out_about', $user_dp)
							->orderBy('out_date', 'desc')
							->leftjoin('departments', 'finance_outs.out_about', '=', 'departments.id')
							->leftjoin('config', 'finance_outs.out_bill', '=', 'config.id')
							->select('finance_outs.*', 'config.name as outBill', 'departments.name as dpName')
							->paginate(30);				
			$recs = Member::where('department', $user_dp)->get();
			foreach ($recs as $rec) {
				$name = $rec->name;
			}
			$trans = FinanceTrans::where(function ($query) { 
	                            if ($this->seekName != '' && $this->seekName != null) {
	                                $query->where('finance_trans.tran_to', 'LIKE', '%'.$this->seekName.'%');
	                            }
	                        })
							->whereIn('tran_to', [$name, $id])
							->orwhere('tran_from', $id)
							->orderBy('tran_date', 'desc')
							->leftjoin('members as a', 'finance_trans.tran_from', '=', 'a.id')
							->leftjoin('members as b', 'finance_trans.createdBy', '=', 'b.id')
							->leftjoin('members as c', 'finance_trans.tran_to', '=', 'c.id')
							->leftjoin('config', 'finance_trans.tran_type', '=', 'config.id')
							->select('finance_trans.*', 'a.name as fromName', 'config.name as tranType', 'b.name as createdByName', 'c.name as toName')
							->paginate(30);

		}else{

			$members = Session::get('name');
			$id = Session::get('id');
			$outs = FinanceOuts::where('out_user', $members)
							->orderBy('out_date', 'desc')
							->leftjoin('departments', 'finance_outs.out_about', '=', 'departments.id')
							->leftjoin('config', 'finance_outs.out_bill', '=', 'config.id')
							->select('finance_outs.*', 'config.name as outBill', 'departments.name as dpName')
							->paginate(30);
			$trans = FinanceTrans::where('tran_to', $id)
							->orwhere('tran_from', $id)
							->orderBy('tran_date', 'desc')
							->leftjoin('members as a', 'finance_trans.tran_from', '=', 'a.id')
							->leftjoin('members as b', 'finance_trans.createdBy', '=', 'b.id')
							->leftjoin('members as c', 'finance_trans.tran_to', '=', 'c.id')
							->leftjoin('config', 'finance_trans.tran_type', '=', 'config.id')
							->select('finance_trans.*', 'a.name as fromName', 'config.name as tranType', 'b.name as createdByName', 'c.name as toName')
							->paginate(30);
		}

		$recs = Department::where('id', '>', 1)
					->get();
		if(count($recs)){
			$dp = ['0'=>'不限部门'];
			foreach ($recs as $rec) {
				$dp = array_add($dp, $rec->id, $rec->name);
			}
		}
		
		return view('finance.finance', ['seekName'=>$this->seekName, 'seekDp'=>$this->seekDpArray, 'outs'=>$outs, 'trans'=>$trans, 'Dp'=>$dp]);
	}

	/**
	* 支出页面
	*/
	public function out()
	{
		$user = Session::get('name');
		$recs = Department::where('id', '>', 1)
					->get();
		if(count($recs)){
			$dp = [];
			foreach ($recs as $rec) {
				$dp = array_add($dp, $rec->id, $rec->name);
			}
		}

		return view('finance.finance_outs', ['user'=>$user, 'dp'=>$dp]);
	}

	/**
	* 支出信息存入数据库
	*/
	public function outStore(Requests\Finance\FinanceOutRequest $request)
	{
		$input = $request->all();
		
		FinanceOuts::create($input);

		//微信通知		
		$s = new Select;
        $w = new WeChatAPI;
        $h = new Helper;

        $body = '[资金支出]'.$request->out_user.' 支出: ¥ '.floatval($request->out_amount).' 用途: '.$request->out_item;

        $array = [
              'user'       => '8|6',//8|6|2
              // 'department' => '资源部',
              'seek'       => '>=:经理@运营部',
              'self'       => 'own',
            ];
        
        $url = $h->app('ssl').'://'.$h->custom('url').'/finance';
        $picurl = $h->app('ssl').'://'.$h->custom('url').'/custom/image/news/finance.png';
        $arr_news = [['title'=>'财务','description'=>$body,'url'=>$url,'picurl'=>$picurl]];
        
        $w->safe = 0;
        $w->sendNews($s->select($array), $arr_news);

		return redirect('/finance');
	}

	/**
	* 支出页面
	*/
	public function tran($id)
	{
		$M_work_id = Member::find($id)->work_id;
		$M_name = Member::find($id)->name;
		$S_id = Session::get('id');
		$S_name = Session::get('name');

		return view('finance.finance_trans', ['S_name'=>$S_name, 'S_id'=>$S_id, 'M_id'=>$id, 'M_name'=>$M_name, 'M_work_id'=>$M_work_id]);
	}

	/**
	* 支出信息存入数据库
	*/
	public function tranStore(Requests\Finance\FinanceTranRequest $request)
	{
		$s = new Select;
        $w = new WeChatAPI;
        $h = new Helper;
        $input = $request->all();
        $input['tran_state'] = 0;
        $input['createdBy'] = $request->S_id;

        if($request->f_or_t != 1){
			$input['tran_from'] = $request->S_id;
			$input['tran_to'] = $request->M_id;
			
			$id = Financetrans::create($input)->id;

	        $body = '[资金流向]'.$request->S_name.' -> '.$request->M_name.' : ¥ '.floatval($request->tran_amount).' 用途: '.$request->tran_item;

        }else{
			$input['tran_from'] = $request->M_id;
			$input['tran_to'] = $request->S_id;
			
			$id = Financetrans::create($input)->id;

	        $body = '[资金流向]'.$request->M_name.' -> '.$request->S_name.' : ¥ '.floatval($request->tran_amount).' 用途: '.$request->tran_item;

        }

        $work_id = $request->M_work_id;

	        $array_1 = [
	              'user'       => $work_id,//8|6|2
	              // 'department' => '资源部',
	              // 'seek'       => '>=:经理@运营部', 
	              // 'self'       => 'own',
	            ];
	        $array_2 = [
	              'user'       => '8|6',//8|6|2
	              // 'department' => '资源部',
	              'seek'       => '>=:经理@运营部', 
	              'self'       => 'own',
	            ];

        $url_1 = $h->app('ssl').'://'.$h->custom('url').'/finance/trans/note/'.$id;
        $url_2 = $h->app('ssl').'://'.$h->custom('url').'/finance/trans/show/'.$id;
        $picurl = $h->app('ssl').'://'.$h->custom('url').'/custom/image/news/finance.png';
        $arr_news_1 = [['title'=>'财务','description'=>$body,'url'=>$url_1,'picurl'=>$picurl]];
        $arr_news_2 = [['title'=>'财务','description'=>$body,'url'=>$url_2,'picurl'=>$picurl]];
        
        $w->safe = 0;
        $w->sendNews($s->select($array_1), $arr_news_1);
        $w->sendNews($s->select($array_2), $arr_news_2);

		return redirect('/finance');
	}

    /**
    * 资金往来确认提醒
    */
    public function tranNote($id)
    {      
        $state = FinanceTrans::find($id)->tran_state;
        
        if($state != 1){
        	return view('note',['color'=>'info', 'type'=>'6','code'=>'6.2', 'btn1'=>'确认', 'link1'=>'/finance/trans/confirm/'.$id, 'btn2'=>'稍后确认', 'link2'=>'/finance']);
    	}else{
    		return view('note',['color'=>'success', 'type'=>'5', 'code'=>'5.3', 'btn1'=>'返回', 'link1'=>'/finance/trans/show/'.$id]);
    	}
	    
    }

    /**
    * 资金往来确认
    */
    public function outShow($id)
    {
    	$rec = FinanceOuts::leftjoin('departments', 'finance_outs.out_about', '=', 'departments.id')
							->leftjoin('config', 'finance_outs.out_bill', '=', 'config.id')
							->select('finance_outs.*', 'config.name as outBill', 'departments.name as dpName')
							->find($id);
    	return view('finance.finance_outs_show', ['rec'=>$rec]);
    }

    /**
    * 资金往来确认
    */
    public function tranShow($id)
    {
    	$rec = FinanceTrans::leftjoin('members as a', 'finance_trans.tran_from', '=', 'a.id')
							->leftjoin('members as b', 'finance_trans.createdBy', '=', 'b.id')
							->leftjoin('members as c', 'finance_trans.tran_to', '=', 'c.id')
							->leftjoin('config', 'finance_trans.tran_type', '=', 'config.id')
							->select('finance_trans.*', 'a.name as fromName', 'config.name as tranType', 'b.name as createdByName', 'c.name as toName')
							->find($id);
    	return view('finance.finance_trans_show', ['rec'=>$rec]);
    }

    /**
    * 资金往来确认
    */
    public function tranConfirm($id)
    {
    	$rec = FinanceTrans::find($id);
    	$rec->update(['tran_state' => 1]);
    	$fromName = Member::find($rec->tran_from)->name;
    	$toName = Member::find($rec->tran_to)->name;
    	$S_name = Session::get('name');

    	$s = new Select;
        $w = new WeChatAPI;
        $h = new Helper;

        $body = '[资金往来] 您创建的信息: '.$fromName.' -> '.$toName.' : ¥ '.floatval($rec->tran_amount).' 用途: '.$rec->tran_item."\n".'已由 '.$S_name.' 确认';

        $work_id = Member::find($rec->createdBy)->work_id;

    	$array = [
              'user'       => $work_id,
            ];       
        
        $w->sendText($s->select($array), $body);

    	return redirect('/finance/trans/note/'.$id);
    }

	/**
    * 查询
    */
    public function financeSeek(Requests\Finance\FinanceSeekRequest $request)
    {
        $seek = $request->all();

        if ($seek['seekDp'] == 0 && ($seek['seekName'] =='' || $seek['seekName'] == null)) {
            //go on
        }else{

            if($seek['seekDp'] != 0) {
                $seekDp = $seek['seekDp'];
                if(count($seekDp)){
                    $this->seekDpArray = [$seekDp];
                }else{
                    $arr = ['color'=>'info', 'type'=>'6','code'=>'6.1', 'btn'=>'返回资源管理', 'link'=>'/resource'];
                    return view('note',$arr);
                }
            }

            if($seek['seekName'] != '' && $seek['seekName'] != null) $this->seekName= $seek['seekName'];
        }
       
        return $this->index();       
    }
} 
