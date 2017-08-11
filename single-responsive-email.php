<?php
/*
Template Name: Responsive Email Template
*/

require_once __DIR__.'/src/class-oa-responsive-email-renderer.php';

$renderer = new OA_Responsive_Email_Renderer();

while (have_posts()) {
    the_post();

    echo $renderer->make(get_the_content());
}
