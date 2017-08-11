<?php

/**
 *
 */
class OA_Email_Footer_Module extends OA_Builder_Module
{
    protected $providers;
    public function __construct()
    {
        $this->providers = array('facebook', 'google', 'twitter', 'linkedin', 'youtube', 'instagram', 'flickr', 'vimeo', 'github', 'pinterest');

        $this->setup();
        parent::__construct();
    }

  /**
   * Initialise the fields.
   */
  protected function setup()
  {
      $this->name = 'Email Footer';
      $this->slug = 'oa_email_footer_module';

      $affects = array();

      foreach ($this->providers as $provider) {
          $affects[] = '#et_pb_'.$provider;
      }

      $this->fields = array(
        'background_color' => array(
          'label' => esc_html__('Background Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#fefefe',
        ),

        'text' => array(
            'label' => 'Footer Text',
            'type' => 'tiny_mce',
            'default' => '',
        ),

        'text_color' => array(
          'label' => esc_html__('Text Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#444444',
        ),

      'text_orientation' => array(
        'label' => esc_html__('Text Orientation', 'et_builder'),
        'type' => 'select',
        'option_category' => 'layout',
        'options' => et_builder_get_text_orientation_options(),
        'description' => esc_html__('This controls the how your text is aligned within the module.', 'et_builder'),
      ),
      'text_size' => array(
        'label' => esc_html__('Text Size', 'et_builder'),
        'type' => 'select',
        'option_category' => 'layout',
        'options' => array(
                'small' => 'Small',
                'normal' => 'Normal',
             ),
        'default' => 'small',
        'description' => esc_html__('This controls the how your text size.', 'et_builder'),
      ),

        'has_social_links' => array(
          'label' => 'Has Social Links?',
          'type' => 'yes_no_button',
          'option_category' => 'configuration',
          'options' => array(
                        'off' => esc_html__('No', 'et_builder'),
                        'on' => esc_html__('Yes', 'et_builder'),
                    ),
          'affects' => $affects,
          'default' => 'on',
        ),
    );

      foreach ($this->providers as $provider) {
          $this->fields[$provider] = array(
            'label' => ucwords($provider).' URL',
            'type' => 'text',
            'default' => '',
          );
      }
  }

    public function shortcode_callback($attrs, $content = null, $function_name)
    {
        $attrs['providers'] = $this->providers;

        return $this->view(__DIR__.'/views/footer.php', $attrs, $content);
    }
}

return new OA_Email_Footer_Module();
