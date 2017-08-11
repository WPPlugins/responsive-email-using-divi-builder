<?php

/**
 *
 */
class OA_Email_Button_Module extends OA_Builder_Module
{
    public function __construct()
    {
        $this->setup();
        parent::__construct();
    }

  /**
   * Initialise the fields.
   */
  protected function setup()
  {
      $this->name = 'Email: Call to action';
      $this->slug = 'oa_email_button_module';

      $this->fields = array(
      'url' => array(
          'label' => esc_html__('URL', 'et_builder'),
          'type' => 'upload',
          'option_category' => 'basic_option',
          'upload_button_text' => esc_attr__('Upload an Asset', 'et_builder'),
          'choose_text' => esc_attr__('Choose an Asset', 'et_builder'),
          'update_text' => esc_attr__('Set As Asset', 'et_builder'),
          'description' => esc_html__('Upload your desired button asset, or type in the URL to the asset you would like to display over your button.', 'et_builder'),
        ),

        'background_color' => array(
          'label' => esc_html__('Button Background Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#2199e8',
        ),

        'button_text' => array(
            'label' => 'Button Text',
            'type' => 'text',
           ),

        'text_color' => array(
          'label' => esc_html__('Header Text Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#fefefe',
        ),

        'padding_top' => array(
            'label' => 'Padding Top',
            'type' => 'text',
            'default' => '10',
         ),

        'padding_bottom' => array(
            'label' => 'Padding Bottom',
            'type' => 'text',
            'default' => '10',
         ),

    );
  }

    public function shortcode_callback($attrs, $content = null, $function_name)
    {
        return $this->view(__DIR__.'/views/button.php', $attrs, $content);
    }
}

return new OA_Email_Button_Module();
