<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
