<?php
        echo session()->get('firstname')." ";
        echo session()->get('lastname')."<br />";
        echo anchor('timein', 'Time-In', ['class' => 'btn btn-primary', 'title' => 'Session Destroy'])."<br />";
        echo anchor('timeout', 'Time-Out', ['class' => 'btn btn-primary', 'title' => 'Session Destroy'])."<br />";
        echo anchor('destroy', 'Destroy Session', ['class' => 'btn btn-primary', 'title' => 'Session Destroy']);
?>