<?php


class OA_Responsive_Email_Renderer
{
    public function make($shortcodes)
    {
        if (!class_exists('OA_Builder_Module')) {
            $plugin = new OA_Responsive_Email_Plugin();
            $plugin->register_divi_modules();
        }

        $options = OA_Responsive_Email_Activator::getOptions();

        global $wpdb;
        $output = '';

        if (isset($options['header_activated'])) {
            $header_result = $wpdb->get_results(sprintf('select * from %sposts where ID=%s', $wpdb->prefix, $options['header_activated']), ARRAY_A);
            $output = do_shortcode($header_result[0]['post_content']);
        }

        if (isset($options['footer_activated'])) {
            $footer_result = $wpdb->get_results(sprintf('select * from %sposts where ID=%s', $wpdb->prefix, $options['footer_activated']), ARRAY_A);

            $footer_inject_index = strrpos($shortcodes, '[/et_pb_column]');
            $updated_shortcodes = substr($shortcodes, 0, $footer_inject_index)

                                    .$footer_result[0]['post_content'].substr($shortcodes, $footer_inject_index);

            $shortcodes = $updated_shortcodes;
        }

        $shortcodes = '[oa_email_shortcode_grid_main_row]'.$shortcodes.'[/oa_email_shortcode_grid_main_row]';
        $shortcodes = str_replace('et_pb_section', 'oa_email_shortcode_grid_section', $shortcodes);
        $shortcodes = str_replace('et_pb_row', 'oa_email_shortcode_grid_row', $shortcodes);
        $shortcodes = str_replace('et_pb_column', 'oa_email_shortcode_grid_col', $shortcodes);
        $shortcodes = str_replace('et_pb_text', 'oa_email_shortcode_grid_para', $shortcodes);

        $output .= do_shortcode($shortcodes);

        $output .= '</body></html>';

        return $output;
    }
}
