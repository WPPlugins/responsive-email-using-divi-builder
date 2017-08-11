<?php


class OA_Responsive_Email_Helper
{
    public static function get_template_list()
    {
        global $wpdb;

        return $wpdb->get_results(sprintf('select ID, post_title from %sposts where post_type="responsive-email" and post_status="publish"', $wpdb->prefix), ARRAY_A);
    }
}
