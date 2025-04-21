<?php
$heading = get_field('heading');
$hightlights = get_field('highlights') ?: [];

foreach ($hightlights as $hightlight) {
    $heading = str_replace(
        $hightlight['text'],
        '<strong>' . $hightlight['text'] . '</strong>',
        $heading
    );
}

?>

<div>
    <h2 class="h-2">
        <?php echo $heading; ?>
    </h2>
</div>
