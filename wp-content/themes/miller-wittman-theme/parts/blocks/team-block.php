<?php
openBlock();
$title = get_field('title');
$team = get_field('team') ?: [];
?>

<div class="team mt-80 mb-80 scheme--dark">

    <div class="container">

        <div class="team__layout">

            <div class="team__header">
                <h2 class="team__sectionTitle h-2"><?php echo $title; ?></h2>
            </div>

            <div class="team__list">

                <?php foreach( $team as $one_member ):
                    $image      = $one_member['image'];
                    $job_title  = $one_member['job_title'];
                    $name       = $one_member['name'];
                    $bio        = $one_member['bio'];
                    $linkedin   = $one_member['linkedin'];
                    ?>
                    <div class="team__member">
                        <div class="team__image u-of">
                            <?php echo wp_get_attachment_image( $image, 'medium_large' ); ?>
                        </div>

                        <div class="team__content flow flow--small">
                            <?php if( $job_title ): ?>
                                <div class="eyebrow"><?php echo $job_title; ?></div>
                            <?php endif; ?>
                            <h3 class="team__name heading-cap-height">
                                <?php echo $name; ?>
                            </h3>
                            <div class="team__bio text-cap-height">
                                <?php echo $bio; ?>
                            </div>
                            <?php if( $linkedin ): ?>
                                <div class="team__cta text-cap-height">
                                    <a href="<?php echo $linkedin; ?>" target="_blank">
                                        Connect on LinkedIn
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>

</div>

<?php
closeBlock();
