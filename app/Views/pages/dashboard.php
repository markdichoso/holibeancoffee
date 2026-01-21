<?php
        echo "<H3>".session()->get('firstname')." ";
        echo session()->get('lastname')."</H3><br />";
        echo anchor('timein', 'Time-In', ['class' => 'btn btn-primary', 'title' => 'Session Destroy'])."<br />";
        echo anchor('timeout', 'Time-Out', ['class' => 'btn btn-primary', 'title' => 'Session Destroy'])."<br /><br />";
        echo anchor('destroy', 'Destroy Session', ['class' => 'btn btn-primary', 'title' => 'Session Destroy']);
?>