<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
