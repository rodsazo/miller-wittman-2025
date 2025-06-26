<?php

openBlock();

$layout = get_field('layout') ?: '2col';
$testimonials = get_field('testimonials') ?: [];

$slider_id = 's' . uniqid();

$layout_class = ( $layout === 'full' ) ? 'testimonials__layout--full-width'  : '';
?>

<div class="testimonials">

    <div class="container">

        <div class="testimonials__slider" data-transition="fadeHeight">

            <svg width="51" height="49" viewBox="0 0 51 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.135 49V27.154C27.135 19.927 29.279 13.998 33.569 9.367C37.859 4.666 43.669 1.544 51 0V11.788C48.738 12.419 46.906 13.191 45.502 14.103C44.098 15.015 43.006 16.103 42.226 17.366C41.446 18.629 40.939 20.102 40.706 21.786C40.471 23.4 40.354 25.189 40.354 27.154V28.77H51V49H27.135ZM0 49V27.154C0 19.927 2.145 13.998 6.434 9.367C10.724 4.666 16.534 1.544 23.865 0V11.788C21.604 12.419 19.771 13.191 18.367 14.103C16.963 15.015 15.871 16.103 15.091 17.366C14.389 18.629 13.882 20.102 13.571 21.786C13.336 23.4 13.22 25.189 13.22 27.154V28.77H23.865V49H0Z" fill="#AB1A2D"/>
            </svg>

            <div class="testimonials__slides">

                <?php foreach( $testimonials as $item ):

                    $quote = $item['quote'];
                    $author_image = $item['author_image'];
                    $author_name = $item['author_name'];
                    $job_title = $item['job_title'];
                    $institution = $item['institution'];
                    $linkedin = $item['linkedin'] ?? false;

                    ?>
                    <div class="testimonials__slide" >
                        <div class="testimonials__layout <?php echo $layout_class; ?>">

                            <div class="testimonials__quote">
                                <?php echo $quote; ?>
                            </div>

                            <div class="testimonials__author">

                                <?php if( $author_image && $layout === '2col' ): ?>
                                    <div class="testimonials__authorPic">
                                        <?php echo wp_get_attachment_image( $author_image, 'medium_large'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="testimonials__authorData flow flow--tight">

                                    <div class="testimonials__authorName heading-cap-height">
                                        <?php if( $linkedin ): ?>
                                            <a href="<?php echo $linkedin; ?>" target="_blank">
                                                <?php echo $author_name; ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo $author_name; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if( $job_title ): ?>
                                        <div class="testimonials__meta text-cap-height">
                                            <?php echo $job_title; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if( $institution ): ?>
                                        <div class="testimonials__meta text-cap-height">
                                            <?php echo $institution; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php if( count($testimonials) > 1): ?>

                <div class="testimonials__arrows">
                    <button type="button" class="testimonials__arrow" >
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.414 34.5859L22.586 37.4139L9.172 23.9999L22.586 10.5859L25.414 13.4139L16.828 21.9999H36V25.9999H16.828L25.414 34.5859Z" fill="#121921"/>
                        </svg>
                    </button>
                    <button type="button" class="testimonials__arrow" >
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.586 34.5859L25.414 37.4139L38.828 23.9999L25.414 10.5859L22.586 13.4139L31.172 21.9999H12V25.9999H31.172L22.586 34.5859Z" fill="#121921"/>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

        </div>

    </div>

</div>

<?php
closeBlock();
