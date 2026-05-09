<?php
namespace Theme;

use Picol\PicolBlockGroup;

class CustomBlocks{
    static function start() : void
    {
        $blocks = new PicolBlockGroup('Theme blocks', 'Miller Wittman');

        $blocks->addBlock('home-hero', 'Home Hero');
        $blocks->addBlock('home-intro', 'Home Intro');
        $blocks->addBlock('work-preview', 'Work Preview');
        $blocks->addBlock('testimonials', 'Testimonials');
        $blocks->addBlock('work-hero', 'Work Post Hero');
        $blocks->addBlock('image-grid', 'Image Grid');
        $blocks->addBlock('image-stack', 'Image Stack');
        $blocks->addBlock('partnership-hero', 'Partnership Hero');
        $blocks->addBlock('page-hero', 'Page Hero');
        $blocks->addBlock('basic-text', 'Text Block');
        $blocks->addBlock('centered-text', 'Centered Text Block');
        $blocks->addBlock('work', 'Work Page');
        $blocks->addBlock('two-column-text', 'Two-column Text');
        $blocks->addBlock('logo-carousel', 'Logo Carousel');
        $blocks->addBlock('logo-carousel-small', 'Logo Carousel Small');
        $blocks->addBlock('accordions', 'Areas of Expertise');
        $blocks->addBlock('team', 'Team');
        // DONE
        $blocks->addBlock('insights', 'Insights Page');

        /*
         * Team
         *
         * Insights
         *
         * Article detail page
         */


    }
}
