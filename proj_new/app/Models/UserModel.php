<?php
namespace App\Models;
use App\Models\AdminModel;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class UserModel extends AdminModel
{ 
	public function __construct()
	{
		$this->table               = 'user';
		$this->folderUpload        = 'user';
		$this->fieldSearchAccepted = ['id','username','email','fullname'];
		$this->crudNotAccepted     = ['_token', 'avatar_current','password_comfirmation','task'];
	}
	public function listItems($params=null, $option=null)
	{ 	
		if($option['task']=='admin-list-items') {
			$query =  $this->select('id','username','email','fullname','password','avatar','status','level','created','created_by','modified','modified_by');
			if ($params['filter']['status']!=='all' ) {
				$query->where('status','=',$params['filter']['status']);
			}
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							echo $query->orwhere($column,'LIKE',"%{$params['search']['value']}%");
						};
					});
				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->orderBy('id', 'desc')->paginate($params['pagination']['totalItemsPerPage']); 
		} 
		if($option['task']=='news-list-items') {
			$query =  $this->select('id','name','link','thumb')->where('status','=','active')->limit(5); 
			$result = $query->get()->toArray();
		} 
		return $result;
	}
	public function countItems($params, $option)
	{
		$result =null;
		if($option['task']=='admin-count-items-group-by-status') {
			$result =  self::select(DB::raw('count(id) as count, status'))		 
			->groupBy('status')		
			->get()
			->toArray();
			$query = $this::groupBy('status')
			->select(DB::raw('status,COUNT(id) as count'));
			if ($params['search']['value']!=='' ) {
				if ($params['search']['field']=='all') {
					$query->where(function ($query) use ($params)
					{
						foreach ($this->fieldSearchAccepted  as $column) {
							$query->orwhere($column,'LIKE',"%{$params['search']['value']}%");
						};
					});
				}else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
					$query->where($params['search']['field'],'LIKE',"%{$params['search']['value']}%");
				}
			}
			$result = $query->get()->toArray();
		} 
		return $result;
	}
	public function saveItem($params=null, $option=null)
	{
		if($option['task']=='change-status') {
			$status = (($params['currentStatus'])=='active') ? 'inactive' :'active';
			self::where('id', $params['id'])->update(['status' => $status]);
		};
		if($option['task']=='change-level') { 
			self::where('id', $params['id'])->update(['level' => $params['level']]);
		};
		if($option['task']=='change-password') {  
			$password = md5($params['password']);
			self::where('id', $params['id'])->update(['password' => $password]);
		};
		if($option['task']=='change-level-post') {  
			$level = $params['level'];
			self::where('id', $params['id'])->update(['level' => $level]);
		};
		if($option['task']=='add-item') {
			$params['avatar'] = $this->uploadThumb($params['avatar']);
			$params['created'] =  date('Y-m-d');
			$params['created_by'] = 'ducnamjr';
			$params['password'] = md5($params['password']);

			self::insert($this->prepareParams($params));
		}
		if($option['task']=='edit-item') { 
			if (!empty($params['thumb'])) {
				$this->deleteThumb($params['avatar_current']);
				$params['thumb'] = $this->uploadThumb($params['thumb']);
			}
			$params['modified'] =  date('Y-m-d');
			$params['modified_by'] = 'ducnamjr';
			self::where('id',$params['id'])->update($this->prepareParams($params));
		}
	}
	public function getItem($params=null, $option=null)
	{
		$result = null;
		if($option['task']=='get-thumb') {  
			$result = self::select('id','thumb')->where('id',$params['id'])->first();
		}

		if($option['task']=='get-item') {  
			$result = self::select('id','username','fullname','level','email','status','avatar')->where('id',$params['id'])->first();
		}
		if($option['task'] == 'auth-login') {
			$result = self::select('id', 'username', 'fullname', 'email', 'level', 'avatar')
			->where('status', 'active')
			->where('email', $params['email'])
			->where('password', md5($params['password']) )->first();

			if($result) $result = $result->toArray();
		}
		return $result;
	}
	public function deleteItem($params=null, $option=null)
	{
		if($option['task']=='delete-item') {
			$item = self::getItem($params,['task'=>'get-thumb']);
			$this->deleteThumb($item['thumb']);
			self::where('id',$params['id'])->delete();
		}
	}
}
