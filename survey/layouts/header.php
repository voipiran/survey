<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
