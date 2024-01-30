<?php

if ( ! function_exists('_lang')){
	function _lang($string=''){
		
		//return $string;
		//Get Target language
		$target_lang = get_option('language');
		
		if($target_lang == ""){
			$target_lang = "language";
		}
		
		if(file_exists(resource_path() . "/language/$target_lang.php")){
			include(resource_path() . "/language/$target_lang.php"); 
		}else{
			include(resource_path() . "/language/language.php"); 
		}
		
		if (array_key_exists($string,$language)){
			return $language[$string];
		}else{
			return $string;
		}
	}
}

if (!function_exists('as_status')) {
    function as_status($code, $text_only = false)
    {
        if ($code == 'A') {
            return $text_only ? 'Aktif':'Aktif';
        }elseif ($code == 'C') {
            return $text_only ? 'Non Aktif':'Non Aktif';
        }else{
            return $text_only ? 'Deleted':'Deleted';
        }
    }
}

if ( ! function_exists('rupiah')){
    function rupiah($angka){
    	
    	if($angka == 0)
        {
            $hasil_rupiah = "Rp. - ";
        }
        else
        {
    	    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        }
    	return $hasil_rupiah;
     
    }
}

if (!function_exists('ptk_status')) {
    function ptk_status($code, $text_only = false)
    {
        if ($code == 1) {
            return $text_only ? 'Disetujui':'Disetujui, Approver sudah melakukan konfirmasi klaim';
        }elseif ($code == 2) {
            return $text_only ? 'Ditolak':'Ditolak, Approver sudah melakukan konfirmasi klaim';
        }elseif ($code == 3) {
            return $text_only ? 'Dipending':'Dipending, Approver sudah melakukan konfirmasi klaim';
        }else{
            return $text_only ? 'Unavailable':'Unavailable';
        }
    }
}

if (!function_exists('log_status')) {
    function log_status($code, $text_only = false)
    {
        if ($code == 1) {
            return $text_only ? 'success': 'success';
        }elseif ($code == 2) {
            return $text_only ? 'danger' : 'danger';
        }elseif ($code == 3) {
            return $text_only ? 'warning' : 'warning';
        }else{
            return $text_only ? 'secondary' : 'secondary';
        }
    }
}

if (!function_exists('klaim_status')) {
    function klaim_status($code, $text_only = false)
    {
        if ($code == 'A') {
            return $text_only ? 'Menunggu Konfirmasi / Approval':'<span class="badge badge-primary">Menunggu Konfirmasi / Approval</span>';
		}elseif ($code == 'B') {
            return $text_only ? 'Belum Dibayarkan':'<span class="badge badge-warning">Belum Dibayarkan</span>';
		}elseif ($code == 'C') {
            return $text_only ? 'Dibayarkan Finance':'<span class="badge badge-success">Dibayarkan Finance</span>';
        }elseif ($code == 'D') {
            return $text_only ? 'Ditolak':'<span class="badge badge-danger">Klaim Ditolak</span>';
		}elseif ($code == 'F') {
            return $text_only ? 'Dipotong dana pembentukan HCO':'<span class="badge badge-success">Dipotong dana pembentukan HCO</span>';
        }elseif ($code == 'P') {
            return $text_only ? 'Dipending':'<span class="badge badge-dark">Klaim Dipending</span>';
		}elseif ($code == 'T') {
            return $text_only ? 'Tidak Dibayarkan':'<span class="badge badge-danger">Tidak Dibayarkan</span>';
        }elseif ($code == 'N') {
            return $text_only ? 'Claim Baru':'<span class="badge badge-primary">Claim Baru</span>';
        }else{
            return $text_only ? 'Unavailable':'<span class="badge badge-default">Unavailable</span>';
        }
    }
}


if (!function_exists('klaimi_status')) {
    function klaimi_status($code, $text_only = false)
    {
        if ($code == 'A') {
            return $text_only ? 'Menunggu Konfirmasi / Approval':'Menunggu Konfirmasi / Approval';
		}elseif ($code == 'B') {
            return $text_only ? 'Belum Dibayarkan':'Belum Dibayarkan';
		}elseif ($code == 'C') {
            return $text_only ? 'Dibayarkan':'Dibayarkan Finance';
		}elseif ($code == 'F') {
            return $text_only ? 'Dipotong dana pembentukan HCO':'Dipotong dana pembentukan HCO';
        }elseif ($code == 'D') {
            return $text_only ? 'Ditolak':'Klaim Ditolak';
        }elseif ($code == 'P') {
            return $text_only ? 'Dipending':'Klaim Dipending';
		}elseif ($code == 'T') {
            return $text_only ? 'Tidak Dibayarkan':'Tidak Dibayarkan';
        }elseif ($code == 'N') {
            return $text_only ? 'Claim Baru':'Claim Baru';
        }else{
            return $text_only ? 'Unavailable':'Unavailable';
        }
    }
}

if (!function_exists('fat_status')) {
    function fat_status($code, $text_only = false)
    {
        if ($code == 1) {
            return $text_only ? 'Disetujui':'Disetujui (Nilai klaim sudah diverifikasi dan disetujui oleh accounting)';
        }elseif ($code == 3) {
            return $text_only ? 'Dibayarkan':'Dipotong dana pembentukan HCO (Nilai klaim sudah diverifikasi dan disetujui oleh accounting)';
        }else{
            return $text_only ? 'Ditolak':'Ditolak';
        }
    }
}


if ( ! function_exists('startsWith')){
	function startsWith($haystack, $needle)
	{
		 $length = strlen($needle);
		 return (substr($haystack, 0, $length) === $needle);
	}
}

if ( ! function_exists('currency')){
	function currency()
	{
		 return get_option('currency_symbol','$');
	}
}



if ( ! function_exists('create_option')){
	function create_option($table,$value,$display,$selected="",$where=NULL){
		$options = "";
		$condition = "";
		if($where != NULL){
			$condition .= "WHERE ";
			foreach( $where as $key => $v ){
				$condition.=$key."'".$v."'";
			}
		}

		$query = DB::select("SELECT $value, $display FROM $table $condition");
		foreach($query as $d){
			if( $selected!="" && $selected == $d->$value ){   
				$options.="<option value='".$d->$value."' selected='true'>".ucwords($d->$display)."</option>";
			}else{
				$options.="<option value='".$d->$value."'>".ucwords($d->$display)."</option>";
			} 
		}
		
		echo $options;
	}
}

if ( ! function_exists('create_option_distributor')){
	function create_option_distributor($table,$value,$display,$selected="",$where=NULL){
		$options = "";
		$condition = "";
		if($where != NULL){
			$condition .= "WHERE ";
			foreach( $where as $key => $v ){
				$condition.=$key."'".$v."' ";
			}
		}

		$query = DB::select("SELECT $value, $display FROM $table $condition");
		foreach($query as $d){
			if( $selected!="" && $selected == $d->$value ){   
				$options.="<option value='".$d->$value."' selected='true'>".ucwords($d->$display)."</option>";
			}else{
				$options.="<option value='".$d->$value."'>".ucwords($d->$display)."</option>";
			} 
		}
		
		echo $options;
	}
}

if ( ! function_exists('get_table')){
	function get_table($table,$where=NULL) 
	{
		$condition = "";
		if($where != NULL){
			$condition .= "WHERE ";
			foreach( $where as $key => $v ){
				$condition.=$key."'".$v."' ";
			}
		}
		$query = DB::select("SELECT * FROM $table $condition");
		return $query;
	}
}


if ( ! function_exists('user_count')){
	function user_count($user_type) 
	{
		$count = \App\User::where("user_type",$user_type)
						->selectRaw("COUNT(id) as total")
						->first()->total;
	    return $count;
	}
}


if ( ! function_exists('get_logo')){
	function get_logo() 
	{
		$logo = get_option("logo");
		if($logo ==""){
			return asset("public/images/company-logo.png");
		}
		return asset("public/uploads/$logo"); 
	}
}

if ( ! function_exists('get_favicon')){
	function get_favicon() 
	{
		$favicon = get_option("favicon");
		if($favicon ==""){
			return asset("public/images/favicon.png");
		}
		return asset("public/uploads/$favicon"); 
	}
}

if ( ! function_exists('sql_escape')){
	function sql_escape($unsafe_str) 
	{
		if (get_magic_quotes_gpc())
		{
			$unsafe_str = stripslashes($unsafe_str);
		}
		return $escaped_str = str_replace("'", "", $unsafe_str);
	}
}

if ( ! function_exists('get_option')){
	function get_option($name, $optional="") 
	{
		$setting = DB::table('settings')->where('name', $name)->get();
	    if ( ! $setting->isEmpty() ) {
		   return $setting[0]->value;
		}
		return $optional;

	}
}


if ( ! function_exists('timezone_list'))
{

 function timezone_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['ZONE'] = $zone;
    $zones_array[$key]['GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}

}

if ( ! function_exists('create_timezone_option'))
{

 function create_timezone_option($old="") {
  $option = "";
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
	$selected = $old == $zone ? "selected" : "";
	$option .= '<option value="'. $zone .'"'.$selected.'>'. 'GMT ' . date('P', $timestamp) .' '.$zone.'</option>';
  }
  echo $option;
}

}


if ( ! function_exists( 'get_country_list' ))
{
    function get_country_list( $old_data='' ) {
		if( $old_data == "" ){
			echo file_get_contents( app_path().'/Helpers/country.txt' );
		}else{
			$pattern='<option value="'.$old_data.'">';
			$replace='<option value="'.$old_data.'" selected="selected">';
			$country_list=file_get_contents( app_path().'/Helpers/country.txt' );
			$country_list=str_replace($pattern,$replace,$country_list);
			echo $country_list;
		}
    }	
}

if ( ! function_exists('decimalPlace'))
{

 function decimalPlace($number){
    return number_format((float)$number, 2);
 }

}


if( !function_exists('load_language') ){
	function load_language($active=''){
		$path = resource_path() . "/language";
		$files = scandir($path);
		$options="";
		
		foreach($files as $file){
		    $name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language"){
				continue;
			}
			
			$selected = "";
			if($active == $name){
				$selected = "selected";
			}else{
				$selected = "";
			}
			
			$options .= "<option value='$name' $selected>".ucwords($name)."</option>";
		        
		}
		echo $options;
	}
}

if (!function_exists('tgl_indo')) {
	function tgl_indo($string){
    // contoh : 2019-01-30 10:20:20
    
    $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
 
    $date = explode(" ", $string)[0];
    $time = explode(" ", $string)[1];
    
    $tanggal = explode("-", $date)[2];
    $bulan = explode("-", $date)[1];
    $tahun = explode("-", $date)[0];
    
    
 
    return $tanggal . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
	}
}

if ( ! function_exists('object_to_string')){
	function object_to_string($object, $col, $quote = false) 
	{
		$string = "";
		foreach($object as $data){
			if($quote == true){
				$string .="'".$data->$col."', ";
			}else{
				$string .=$data->$col.", ";
			}
		}
		$string = substr_replace($string, "", -2);
		echo $string;
	}
}

if( !function_exists('get_language_list') ){
	function get_language_list(){
		$path = resource_path() . "/language";
		$files = scandir($path);
		$array = array();
		
		foreach($files as $file){
		    $name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language"){
				continue;
			}
	
			$array[] = $name;
		        
		}
		return $array;
	}
}

if ( ! function_exists('mail_template')){
	function mail_template($template_name, $id = '')
	{
		$text = get_option($template_name . '_template');

		$token = array();
		$token['company_name'] = get_option('company_name');
		$token['site_title'] = get_option('site_title');
		$token['site_url'] = url('/');
		$token['logo'] = '<img src="' . get_logo() . '">';

		if($template_name == 'ticket_open'){
			$claim = App\Claim::select([
		                                "*", 
		                                "claim.id AS id",
										"users.name AS app_name",
                                        "region.region_city AS region_name",
										"costcenter.cost_number AS cost_number",
										"costcenter.cost_name AS cost_name",
		                                "claim.created_at AS created_at",
		                                "claim.updated_at AS updated_at",
		                                "claim.status AS status",
										"promo.name AS nama_program",
		                            ])
		                            ->join('users', 'users.id', 'created_by')
									->join('users as user', 'user.id', 'approved_by')
									->join('costcenter', 'costcenter.id', 'cost_id')
									->join('promo', 'promo.id', 'promo_idx')
		                            ->join('region', 'region.id', 'region_id')
		                            ->where('claim.id', $id)
		                            ->first();
									
			$token['id'] = $claim->id;
			$token['cost_center'] = $claim->cost_number;
		    $token['client_name'] = $claim->distributor_name->name;
			$token['nama_distributor'] = $claim->distributor_name->name;
			$token['nama_program'] = $claim->nama_program;
			$token['app_name'] = $claim->app_name;
			$token['no_surat_distributor'] = $claim->surat_jalan;
			$token['no_surat_program'] = $claim->no_surat;
			$token['date'] = date('D, jS F Y - H:i', strtotime($claim->created_at));
		}

		
		if($template_name == 'ticket_response'){
			
		    $claim = App\Claim::select([
		                                "*", 
		                                "claim.id AS id",
										"users.name AS app_name",
                                        "region.region_city AS region_name",
										"costcenter.cost_number AS cost_number",
										"costcenter.cost_name AS cost_name",
		                                "claim.created_at AS created_at",
		                                "claim.updated_at AS updated_at",
		                                "claim.status AS status",
										"promo.name AS nama_program",
		                            ])
		                            ->join('users', 'users.id', 'created_by')
									->join('users as user', 'user.id', 'approved_by')
									->join('costcenter', 'costcenter.id', 'cost_id')
		                            ->join('region', 'region.id', 'region_id')
									->join('promo', 'promo.id', 'promo_idx')
		                            ->where('claim.id', $id)
		                            ->first();
                                
		    $situs = secure_url('/');;
		    $token['link'] = $situs;
			$token['subject'] = 'Klaim -'. $claim->cost_name;
			$token['cost_name'] = $claim->cost_name;
			$token['id'] = $claim->id;
			$token['nama_distributor'] = $claim->distributor_name->name;
			$token['cost_center'] = $claim->cost_number;
			$token['nama_program'] = $claim->nama_program;
		    $token['client_name'] = $claim->distributor_name->name;
			$token['app_name'] = $claim->crt_name->name;
			$token['no_surat_distributor'] = $claim->surat_jalan;
			$token['no_surat_program'] = $claim->no_surat;
			
		}
		
	
		
		if($template_name == 'assign'){
			
		    $claim = App\Claim::select([
		                                "*", 
		                                "claim.id AS id",
										"users.name AS app_name",
										"costcenter.cost_number AS cost_number",
										"costcenter.cost_name AS cost_name",
		                                "claim.created_at AS created_at",
		                                "claim.updated_at AS updated_at",
		                                "claim.status AS status",
										"promo.name AS nama_program",
		                            ])
		                            ->join('users', 'users.id', 'created_by')
									->join('users as user', 'user.id', 'approved_by')
									->join('costcenter', 'costcenter.id', 'cost_id')
									->join('promo', 'promo.id', 'promo_idx')
		                            ->where('claim.id', $id)
		                            ->first();
                                
		    $situs = secure_url('/');;
		    $token['link'] = $situs;
			$token['subject'] = 'Klaim -'. $claim->cost_name;
			$token['cost_name'] = $claim->cost_name;
			$token['id'] = $claim->id;
			$token['nama_distributor'] = $claim->distributor_name->name;
			$token['cost_center'] = $claim->cost_number;
		    $token['client_name'] = $claim->distributor_name->name;
			$token['app_name'] = $claim->crt_name->name;
			$token['nama_program'] = $claim->nama_program;
			$token['no_surat_distributor'] = $claim->surat_jalan;
			$token['no_surat_program'] = $claim->no_surat;
			
		}
		
		/*
		if($template_name == 'assign_info'){
			
		    $claim = App\Ticket::select([
		                                "*", 
		                                "claim.id AS id",
		                                "claim.region_id AS region_id",
		                                \DB::raw("CONCAT(first_name, ' ', last_name) AS client_name"),
		                                "ticket_categories.name AS category",
		                                "ticket_categories.respon AS response",
                                        "region.name AS region_name",
		                                "claim.created_at AS created_at",
		                                "claim.updated_at AS updated_at",
		                                "claim.status AS status",
		                            ])
		                            ->join('users', 'users.id', 'created_by')
		                            ->join('region', 'region.id', 'region_id')
		                            ->join('ticket_categories', 'ticket_categories.id', 'ticket_category_id')
		                            ->where('claim.id', $id)
		                            ->first();
                                
		    $situs = secure_url('/');;
		    $token['link'] = $situs;
			$token['subject'] = $claim->subject;
			$token['id'] = $claim->id;

			
		}
		
		*/
		
		if($template_name == 'manager'){
			
			//echo $id;
			//die;
			
		    $claim = App\Claim::select([
		                                "*", 
		                                "claim.id AS id",
										"users.name AS app_name",
                                        "region.region_city AS region_name",
										"costcenter.cost_number AS cost_number",
										"costcenter.cost_name AS cost_name",
		                                "claim.created_at AS created_at",
		                                "claim.updated_at AS updated_at",
		                                "claim.status AS status",
										"promo.name AS nama_program",
		                            ])
		                            ->join('users', 'users.id', 'created_by')
									->join('costcenter', 'costcenter.id', 'cost_id')
		                            ->join('region', 'region.id', 'region_id')
									->join('promo', 'promo.id', 'promo_idx')
		                            ->where('claim.id', $id)
		                            ->first();
									
			///echo $claim;
			//die;
			
				$situs = secure_url('/');
				$token['link'] = $situs;
				$token['subject'] = 'Klaim -'. $claim->cost_name;
				$token['cost_name'] = $claim->cost_name;
				$token['nomor'] = $claim->nomor;
				$token['ap_no'] = $claim->no_ap;
				$token['nominal'] = ($claim->dpp + $claim->ppn - $claim->pph);
				$token['id'] = $claim->id;
				$token['cost_center'] = $claim->cost_number;
				$token['nama_distributor'] = $claim->distributor_name->name;
				$token['app_name'] = $claim->app_name;
				$token['nama_program'] = $claim->nama_program;
				$token['no_surat_distributor'] = $claim->surat_jalan;
				$token['no_surat_program'] = $claim->no_surat;
				$token['pay_date'] = $claim->pay_date;
				if($claim->appz->status_finance == 3)
				{
					$token['note'] = $claim->appz->note_finance;
				}
				else
				{
					$token['note'] = $claim->appz->note_acc;
				}
                      
			
		}
		

		$pattern = '{%s}';
		foreach($token as $key=>$val){
			$varMap[sprintf($pattern,$key)] = $val;
		}
		$content = strtr($text,$varMap);
		return $content;
	}
}
