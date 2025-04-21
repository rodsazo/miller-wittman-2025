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
        $blocks->addBlock('page-hero', 'Page Hero');
        $blocks->addBlock('basic-text', 'Text Block');
        $blocks->addBlock('work', 'Work Page');
        $blocks->addBlock('two-column-text', 'Two-column Text');
        // DONE
        $blocks->addBlock('accordions', 'Accordions');
        $blocks->addBlock('team', 'Accordions');
        $blocks->addBlock('logo-carousel', 'Logo Carousel');
        $blocks->addBlock('insights', 'Insights Page');

        /*
         * Basic text
         * - Heading
         * - Lede
         * - Text
         * - CTA
         *
         * Service accordion
         * - Title
         * - Text
         * - Services
         *
         * Media Text Date
         * - Eyebrow
         * - Lede
         * - Text
         * - Dates
         *
         * Two Col Image
         * - Colored heading and text
         * - Logo reel
         * - Members
         *
         * Insights
         *
         * Article detail page
         */


    }
}
