<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
