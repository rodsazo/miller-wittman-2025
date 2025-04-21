<?php
$start = get_field('start');
$end = get_field('end');
?>
<div class="dateRange">
    <div class="h-1">
        <span class="dateRange__nowrap"><?php echo $start; ?>&mdash;</span><?php echo $end; ?>
    </div>
</div>