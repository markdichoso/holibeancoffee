<?php
        echo "<H3>".session()->get('firstname')." ";
        echo session()->get('lastname')."</H3><br />";
        echo anchor('timein', 'Time-In', ['class' => 'btn btn-primary', 'title' => 'Time In'])."<br />";
        echo anchor('timeout', 'Time-Out', ['class' => 'btn btn-primary', 'title' => 'Time Out'])."<br /><br />";
        echo anchor('destroy', 'Destroy Session', ['class' => 'btn btn-primary', 'title' => 'Session Destroy']);
?>