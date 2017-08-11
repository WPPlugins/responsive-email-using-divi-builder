<?php


class OA_Responsive_Email_Overrides
{
    public function filter_retrieve_password_message($message, $key, $user_login, $user_data)
    {
        global $wpdb;
        $reset_url = network_site_url("wp-login.php?action=rp&key=$key&login=".rawurlencode($user_login), 'login');
        $options = get_option('oa_responsive_email_settings');

        $id = $options['oa_responsive_email_forgot_password_field'];

        $result = $wpdb->get_results(sprintf('select * from %sposts where ID=%s', $wpdb->prefix, $id), ARRAY_A);

        $row = $result[0];

        require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-renderer.php';

        $renderer = new OA_Responsive_Email_Renderer();

        $html = $renderer->make($row['post_content']);
        add_filter('wp_mail_content_type', 'oa_set_wp_email_content_type_html');

        $html = str_replace('##reset_url##', $reset_url, $html);

        // file_put_contents(OA_RESPONSIVE_EMAIL_DIR.'/reset.html', $html);

        return $html;
    }
}

if (!function_exists('wp_new_user_notification')) {

// New User Registeration.
function wp_new_user_notification($user_id,  $deprecated = null, $notify = '')
{
    global $wpdb;

    $user = get_userdata($user_id);

    //Send admin an email.
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $message = sprintf(__('New user registration on your site %s:'), $blogname)."\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user->user_login)."\r\n\r\n";
    $message .= sprintf(__('Email: %s'), $user->user_email)."\r\n";

    @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

    //send user the email
    // Generate something random for a password reset key.
    $key = wp_generate_password(20, false);

    /* This action is documented in wp-login.php */
    do_action('retrieve_password_key', $user->user_login, $key);

    // Now insert the key, hashed, into the DB.
    if (empty($wp_hasher)) {
        require_once ABSPATH.WPINC.'/class-phpass.php';
        $wp_hasher = new PasswordHash(8, true);
    }
    $hashed = time().':'.$wp_hasher->HashPassword($key);
    $wpdb->update($wpdb->users, array('user_activation_key' => $hashed), array('user_login' => $user->user_login));

    $reset_url = network_site_url("wp-login.php?action=rp&key=$key&login=".rawurlencode($user->user_login));

    $options = get_option('oa_responsive_email_settings');

    $id = $options['oa_responsive_email_select_user_registration'];

    $result = $wpdb->get_results(sprintf('select * from %sposts where ID=%s', $wpdb->prefix, $id), ARRAY_A);

    $row = $result[0];

    require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-renderer.php';

    $renderer = new OA_Responsive_Email_Renderer();

    $html = $renderer->make($row['post_content']);
    add_filter('wp_mail_content_type', 'oa_set_wp_email_content_type_html');

    $html = str_replace('##reset_url##', $reset_url, $html);
    $html = str_replace('##name##', $user->display_name, $html);
    $html = str_replace('##site_title##', get_bloginfo('name'), $html);

    // file_put_contents(OA_RESPONSIVE_EMAIL_DIR.'/new-user.html', $html);
    wp_mail($user->user_email, $row['post_title'], $html);
}
}
