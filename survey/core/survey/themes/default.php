<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
