#!/usr/bin/php -q
<?php @"SourceGuardian"; //v10.1.6
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
