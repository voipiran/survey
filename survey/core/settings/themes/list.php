<?php
$theme['pre']      = '';
$theme['first']    = array('<li><a href="{url}{nr}" alt="First">First</a></li> ', 'First ');
$theme['previous'] = array('<li><a href="{url}{nr}" alt="Previous">Previous</a></li> ', 'Previous ');
$theme['numbers']  = array('<li><a href="{url}{nr}">{nr}</a></li> ', '<li><a style="background-color:green;color:white"><strong>{nr}</strong> </a></li>');
$theme['next']     = array('<li><a href="{url}{nr}" alt="Next">Next</a></li> ', 'Next ');
$theme['last']     = array('<li><a href="{url}{nr}">Last</a></li>', 'Last ');
$theme['post']     = '';

return $theme;