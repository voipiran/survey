<?php
$theme['pre']      = '<div class="pagination">';
$theme['first']    = array('<a href="{url}{nr}" alt="First">First</a> ', 'First ');
$theme['previous'] = array('<a href="{url}{nr}" alt="Previous">Previous</a> ', 'Previous ');
$theme['numbers']  = array('<a href="{url}{nr}">{nr}</a> ',  '<strong>{nr}</strong> ');
$theme['next']     = array('<a href="{url}{nr}" alt="Next">Next</a> ', 'Next ');
$theme['last']     = array('<a href="{url}{nr}">Last</a>', 'Last ');
$theme['post']     = '</div>';

return $theme;