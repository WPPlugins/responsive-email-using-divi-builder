<?php


class OA_Responsive_Email_Plugin
{
    /**
     * Add post type to et builder.
     *
     * @param [type] $post_types [description]
     *
     * @return [type] [description]
     */
    public function et_builder_post_types($post_types)
    {
        $post_types[] = 'responsive-email';

        return $post_types;
    }
    /**
     * Add the shortcodes.
     */
    public function add_shortcodes()
    {
        add_shortcode('oa_email_shortcode_grid_col', array($this, 'oa_email_shortcode_grid_col'));
        add_shortcode('oa_email_shortcode_grid_row', array($this, 'oa_email_shortcode_grid_container'));
        add_shortcode('oa_email_shortcode_grid_main_row', array($this, 'oa_email_shortcode_grid_container'));
        add_shortcode('oa_email_shortcode_grid_section', array($this, 'oa_email_shortcode_noop'));
        add_shortcode('oa_email_shortcode_grid_para', array($this, 'oa_email_shortcode_grid_para'));
    }

    public function oa_email_shortcode_grid_col($attrs, $content = '')
    {
        $start = OA_Builder_Module::get_template($attrs['type'].'_start');
        $end = OA_Builder_Module::get_template($attrs['type'].'_end');

        return sprintf('%s%s%s', $start, do_shortcode($content), $end);
    }

    public function oa_email_shortcode_grid_container($attrs, $content = '')
    {
        $container_start = OA_Builder_Module::get_template('container_start');
        // die($container_start);
        $container_end = OA_Builder_Module::get_template('container_end');

        return sprintf('%s%s%s', $container_start, do_shortcode($content), $container_end);
    }

    public function oa_email_shortcode_grid_row($attrs, $content = '')
    {
        $row_start = OA_Builder_Module::get_template('row_start');
        // die($row_start);
        $row_end = OA_Builder_Module::get_template('row_end');

        return sprintf('%s%s%s', $row_start, do_shortcode($content), $row_end);
    }

    public function oa_email_shortcode_noop($attrs, $content)
    {
        return do_shortcode($content);
    }

    public function oa_email_shortcode_grid_para($attrs, $content = '')
    {
        $start = OA_Builder_Module::get_template('para_start');
        $end = OA_Builder_Module::get_template('para_end');

        return sprintf('%s%s%s', $start, do_shortcode($content), $end);
    }

    /**
     * Register Divi modules.
     *
     * @return [type] [description]
     */
    public function register_divi_modules()
    {
        if (!class_exists('ET_Builder_Module')) {
            require ET_BUILDER_DIR.'ab-testing.php';
            require ET_BUILDER_DIR.'functions.php';
            require ET_BUILDER_DIR.'class-et-global-settings.php';
            require ET_BUILDER_DIR.'class-et-builder-element.php';
            require ET_BUILDER_DIR.'main-structure-elements.php';
            require ET_BUILDER_DIR.'main-modules.php';
        }

        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-builder-module.php';
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-email-header.php';
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-email-footer.php';
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-email-button.php';
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-email-spacer.php';
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/widgets/class-oa-email-para.php';

        do_action('oa_responsive_email_module_registration');
    }

    /**
     * single_template filter.
     *
     * @param [type] $single_template [description]
     *
     * @return [type] [description]
     */
    public function filter_single_template($single_template)
    {
        global $post;

        if ($post->post_type == 'responsive-email') {
            $single_template = OA_RESPONSIVE_EMAIL_DIR.'/single-responsive-email.php';
        }

        return $single_template;
    }

    public function filter_preview_post_link($url)
    {
        if (strpos($url, '?responsive-email=user-registration') !== false) {
            return remove_query_arg('post_format', $url);
        }

        return $url;
    }

    public function admin_menu()
    {
        add_options_page('Responsive Email Templates', 'Email Templates', 'manage_options', 'responsive_email_templates', array($this, 'responsive_email_options_page'));
    }

    public function admin_init()
    {
        $this->init_settings();
    }

    public function init_settings()
    {
        register_setting('OA_Responsive_Emails', 'oa_responsive_email_settings');

        add_settings_section(
                    'oa_responsive_email_pluginPage_section',
                    '',
                    array($this, 'settings_section_callback'),
                    'OA_Responsive_Emails'
                );

        add_settings_field(
                    'oa_responsive_email_select_user_registration',
                    __('User Registration', 'text_domain'),
                    array($this, 'select_user_registration_render'),
                    'OA_Responsive_Emails',
                    'oa_responsive_email_pluginPage_section'
                );

        add_settings_field(
                    'oa_responsive_email_forgot_password_field',
                    __('Forgot Password', 'text_domain'),
                    array($this, 'forgot_password_field_render'),
                    'OA_Responsive_Emails',
                    'oa_responsive_email_pluginPage_section'
                );

        do_action('oa_responsive_email_register_settings');
    }

    public function select_user_registration_render()
    {
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-helper.php';
        $templates = OA_Responsive_Email_Helper::get_template_list();

        $options = get_option('oa_responsive_email_settings');
        $selected = isset($options['oa_responsive_email_select_user_registration']) ? $options['oa_responsive_email_select_user_registration'] : '';
        ?>
    <select name='oa_responsive_email_settings[oa_responsive_email_select_user_registration]'>


    <?php foreach ($templates as $template) :?>
        <option value='<?php echo $template['ID'];
        ?>' <?php selected($selected,  $template['ID']);
        ?>>
            <?php echo $template['post_title']?>

        </option>
        <?php endforeach;
        ?>

    </select>

<?php

    }

    public function forgot_password_field_render()
    {
        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-helper.php';
        $templates = OA_Responsive_Email_Helper::get_template_list();

        $options = get_option('oa_responsive_email_settings');
        $selected = isset($options['oa_responsive_email_forgot_password_field']) ? $options['oa_responsive_email_forgot_password_field'] : '';
        ?>
    <select name='oa_responsive_email_settings[oa_responsive_email_forgot_password_field]'>
        <?php foreach ($templates as $template) :?>
        <option value='<?php echo $template['ID'];
        ?>' <?php selected($selected,  $template['ID']);
        ?>>
            <?php echo $template['post_title']?>

        </option>
        <?php endforeach;
        ?>
    </select>

<?php

    }

    public function settings_section_callback()
    {
        echo __('Mapping of default WordPress Emails - User Registration & Forgot Password', 'text_domain');
    }

    public function responsive_email_options_page()
    {
        ?>
    <form action='options.php' method='post'>

        <h2>Responsive Email Templates</h2>

        <?php
        settings_fields('OA_Responsive_Emails');
        do_settings_sections('OA_Responsive_Emails');
        submit_button();
        ?>

    </form>
    <?php

    }
}
