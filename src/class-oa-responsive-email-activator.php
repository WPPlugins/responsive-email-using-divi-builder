<?php


class OA_Responsive_Email_Activator
{
    public static $options;

    /**
     * Plugin Activation.
     *
     * @return [type] [description]
     */
    public static function activate()
    {
        static::getOptions();
        static::activateHeader();
        static::activateFooter();
        static::activateRegisterationEmail();
        static::activateForgotPasswordEmail();
        static::saveOptions();

        $custom_post_types = new OA_Responsive_Email_Custom_Post_Types();
        $custom_post_types->init();
        flush_rewrite_rules();
    }

    public static function getOptions()
    {
        static::$options = json_decode(get_option('oa_responsive_email_activate', '[]'), true);

        return static::$options;
    }

    public static function saveOptions($options = null)
    {
        if (is_null($options)) {
            $options = static::$options;
        }
        update_option('oa_responsive_email_activate', json_encode($options));
    }

    /**
     * Activate Header Module.
     */
    public static function activateHeader()
    {
        if (!isset(static::$options['header_activated'])) {
            $shortcode = '[et_pb_oa_email_header_module admin_label="Email Header" saved_tabs="all" template_type="module" logo_image_src="https://www.w3.org/html/logo/badge/html5-badge-h-solo.png" background_color="#edf000" /]';

            $id = wp_insert_post(array(
                    'post_content' => $shortcode,
                    'post_title' => 'Email Header',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_name' => 'oa-email-header',
                    'post_type' => 'et_pb_layout',
                    'guid' => site_url('/et_pb_layout/oa-email-header'),
               ));

            static::$options['header_activated'] = $id;
        }
    }

    /**
     * Activate Footer Module.
     */
    public static function activateFooter()
    {
        if (!isset(static::$options['footer_activated'])) {
            $shortcode = '[et_pb_oa_email_footer_module admin_label="Email Footer" background_color="#fefefe" text_color="#a3a3a3" text_orientation="center" text_size="small" has_social_links="on" facebook="https://facebook.com" google="https://google.com" twitter="https://twitter.com"]Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi repellat, harum. Quas nobis id aut, aspernatur, sequi tempora laborum corporis cum debitis, ullam, dolorem dolore quisquam aperiam! Accusantium, ullam, nesciunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus consequuntur commodi, aut sed, quas quam optio accusantium recusandae nesciunt, architecto veritatis. Voluptatibus sunt esse dolor ipsum voluptates, assumenda quisquam.[/et_pb_oa_email_footer_module]';

            $id = wp_insert_post(array(
                    'post_content' => $shortcode,
                    'post_title' => 'Email Footer',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_name' => 'oa-email-footer',
                    'post_type' => 'et_pb_layout',
                    'guid' => site_url('/et_pb_layout/oa-email-footer'),
               ));

            static::$options['footer_activated'] = $id;
        }
    }

    /**
     * Activate Default Registration Email.
     */
    public static function activateRegisterationEmail()
    {
        $options = get_option('oa_responsive_email_settings', array());
        $option_key = 'oa_responsive_email_select_user_registration';

        if (!isset($options[$option_key])) {
            $post_content = '[et_pb_section admin_label="section"][et_pb_row admin_label="row"][et_pb_column type="4_4"][et_pb_oa_email_para_module admin_label="Welcome" text_orientation="center" text_size="large"]

Dear ##name##,

[/et_pb_oa_email_para_module][et_pb_oa_email_para_module admin_label="Intro" text_orientation="left" text_size="normal"]

Welcome to ##site_title##. To set your password, click the button below

[/et_pb_oa_email_para_module][et_pb_oa_email_button_module admin_label="CTA" url="##reset_url##" background_color="#e84820" button_text="SET PASSWORD" text_color="#fefefe"]



[/et_pb_oa_email_button_module][/et_pb_column][/et_pb_row][/et_pb_section]';

            $id = wp_insert_post(array(
                    'post_type' => 'responsive-email',
                    'post_content' => $post_content,
                    'post_status' => 'publish',
                    'post_title' => 'User Registration',
                   ));

            $options[$option_key] = $id;
            add_post_meta($id, '_et_pb_use_builder', 'on');
            update_option('oa_responsive_email_settings', $options);
        }
    }

    /**
     * Activate Forgot Password Email.
     */
    public static function activateForgotPasswordEmail()
    {
        $options = get_option('oa_responsive_email_settings', array());
        $option_key = 'oa_responsive_email_forgot_password_field';

        if (!isset($options[$option_key])) {
            $post_content = '[et_pb_section admin_label="section"][et_pb_row admin_label="row"][et_pb_column type="4_4"][et_pb_oa_email_para_module admin_label="Title" text_orientation="center" text_size="large"]

Password Reset Request

[/et_pb_oa_email_para_module][et_pb_oa_email_para_module admin_label="Introduction" text_orientation="left" text_size="normal"]

Someone has requested a password reset. To reset your password, click the button below:

[/et_pb_oa_email_para_module][et_pb_oa_email_button_module admin_label="Reset Password Button" url="##reset_url##" background_color="#e84820" button_text="Reset Password" text_color="#fefefe"]



[/et_pb_oa_email_button_module][et_pb_oa_email_para_module admin_label="Ignore Message" text_orientation="center" text_size="small"]

If this was a mistake, just ignore this email and nothing will happen.

[/et_pb_oa_email_para_module][/et_pb_column][/et_pb_row][/et_pb_section]';

            $id = wp_insert_post(array(
                    'post_type' => 'responsive-email',
                    'post_content' => $post_content,
                    'post_status' => 'publish',
                    'post_title' => 'Forgot Password',
                   ));

            $options[$option_key] = $id;
            add_post_meta($id, '_et_pb_use_builder', 'on');
            update_option('oa_responsive_email_settings', $options);
        }
    }
}
