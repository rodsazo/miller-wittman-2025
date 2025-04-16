<?php
namespace Theme;

use Picol\PicolBlockGroup;

class CustomBlocks{
    static function start() : void
    {
        $blocks = new PicolBlockGroup('Theme blocks', 'Gifted Healthcare');

        $blocks->addBlock('home-hero', 'Home Hero');
        $blocks->addBlock('home-intro', 'Home Intro');
        $blocks->addBlock('work-preview', 'Work Preview');
        $blocks->addBlock('testimonials', 'Testimonials');
        $blocks->addBlock('page-hero', 'Page Hero');
        $blocks->addBlock('two-column-text', 'Two-column Text');
        $blocks->addBlock('two-column-images', 'Two-column Images');
        $blocks->addBlock('work', 'Work Page');
        $blocks->addBlock('insights', 'Insights Page');

        /*
         * Home Hero
         * - Text, orange, blue
         *
         * Home intro
         * - Text
         * - Link
         * - Services carousel
         *
         * Our Work Block
         * - Max items
         *
         * Quote Block
         * - Text
         * - Image
         * - Name
         * - Position
         * - Company
         *
         * WORK DETAIL PAGE
         *
         * Work Header
         * - Title
         * - Subtitle
         * - Image
         *
         * Work Content
         * - Tags
         * - Text
         * - Gallery
         * - Mini Quote
         * - More Work
         *
         * Page Header
         * - Text
         * - Image
         *
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
