<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
