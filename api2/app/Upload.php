<?php


namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Show;
use App\Podcast;
use InvalidArgumentException;

class Upload extends Model{
	protected $table = 'uploads';
    protected $fillable = array('relation_id','file_name','file_type','size','path','category','description','url','CREATED_AT','UPDATED_AT');
	public function __construct($attributes = array()){
		require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		//Check to make sure we have correct format;
		$allowed_file_types = $djland_upload_categories[$attributes['category']];
		if( in_array($attributes['file_type'],$allowed_file_types) ){
			parent::__construct($attributes);
		}
		else {
			throw new InvalidArgumentException('File Type Not Allowed: '.$attributes['file_type']);
		}
	}

    public function uploadImage($file){
    	require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/custom_exception.php");
		$response = new StdClass();

		if($_FILES == null || $this->file_name == null || $this->path == null || $this->category == null)
			$response->response = "Valid file not given.";
			$response->ok = false;
			return $response;
		$check = getimagesize($_FILES["file"]["tmp_name"]);
		if($check == false){
			$response->response = "File is not an image";
			$response->ok = false;
			return $response;
		}


    	//Get dirs based on file type
    	$base_dir = $_SERVER['DOCUMENT_ROOT']."/uploads/";

		//chars to strip from names + dirs
		$strip = array('(',')',"'",'"','.',"\\",'/',',',':',';','@','#','$','%','&','?','!');

    	//Ensure the uploads folder exists, if not create it
		if(!file_exists($base_dir)){
			mkdir($base_dir,0755);
		}

		//Ensure the category folder exists, if not create it
    	$target_dir = $base_dir.$this->category."/";
		if(!file_exists($target_dir)){
			mkdir($target_dir,0755);
		}

		$today = date('Y-m-d');

		//Ensure the target folder exists, if not create it
		switch($this->category){
			case 'show_image':
				$show = Show::find($this->foreign_key);
				$stripped_name = str_replace($strip,'',$show->name);
				break;
			case 'episode_image':
				$podcast = Podcast::find($this->foreign_key);
				$stripped_name = str_replace($strip,'',$podcast->show->name);
				break;
			case 'member_resource':
				$resource = Resource::find($this->foreign_key);
				$stripped_name = str_replace($strip,'',$resource->name);
				break;
			case 'friend_image':
				$friend = Friend::find($this->foreign_key);
				$stripped_name = str_replace($strip,'',$friend->name);
				break;
			case 'special_broadcast_image':
				$special_broadcast = SpecialBroadcast::find($this->foreign_key);
				$stripped_name = str_replace($strip,'',$special_broadcast->name);
				break;
			case 'default':
				break;
		}
		$target_file = $target_dir.$stripped_name.".".$today.$this->file_type;
		$target_url = str_replace($_SERVER['DODCUMENT_ROOT'],'http://'.$_SERVER['SERVER_NAME'],$target_file);








    	//Check if the category exists
    	if(array_key_exists($this->category,$djland_upload_types)){
    		//Check if the file type is allowed for that category
    		if( in_array($this->file_type,$djland_upload_types[$this->category])){

    		}
    	}
    }
	public function uploadAudio($file){
		switch($this->category){
			case 'episode_audio':
				$podcast = Podcast::find($this->foreign_key);
				$stripped_show_name = str_replace($strip,'',$podcast->show->name);
				$target_dir = $path['audio_base']."/".date('Y',strtotime($podcast->playsheet->start_time));
				$target_file = $stripped_show_name."-".date('F-d-H-i-s',strtotime($podcast->playsheet->start_time));
				break;
		}
	}
}
