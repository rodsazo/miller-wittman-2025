<?php

namespace Theme;

use Picol\PicolTaxonomy;

class CustomTaxonomies
{
    const TAX_CASE_STUDY_CAT = 'case-study-cat';
    const TAX_WORK_CAT = 'work-cat';
    public static function start () : void
    {
        $work_cat = new PicolTaxonomy(
            self::TAX_WORK_CAT,
            'work-category',
            CustomPostTypes::WORK,
        );
        $work_cat->autoLabels('Category', 'Categories');
    }
}