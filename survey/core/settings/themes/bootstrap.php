<?php
$theme['pre']      = '<nav><ul class="pagination">';
$theme['first']    = array('<li><a href="{url}{nr}">First</a></li> ', '<li class="disabled"><a>First</a></li>');
$theme['previous'] = array('<li><a href="{url}{nr}">&laquo;</a></li> ', '<li class="disabled"><a>&laquo;</a></li>');
$theme['numbers']  = array('<li><a href="{url}{nr}">{nr}</a></li> ', '<li class="active"><a href="#">{nr} <span class="sr-only">(current)</span></a></li>');
$theme['next']     = array('<li><a href="{url}{nr}">&raquo;</a></li>', '<li class="disabled"><a>&raquo;</a></li>');
$theme['last']     = array('<li><a href="{url}{nr}">Last</a></li>', '<li class="disabled"><a>Last</a></li>');
$theme['post']     = '</ul></nav>';

return $theme;