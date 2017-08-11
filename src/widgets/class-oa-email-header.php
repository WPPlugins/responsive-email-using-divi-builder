<?php

/**
 *
 */
class OA_Email_Header_Module extends OA_Builder_Module
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
      $this->name = 'Email Header';
      $this->slug = 'oa_email_header_module';

      $this->fields = array(
      'logo_image_src' => array(
          'label' => esc_html__('Logo', 'et_builder'),
          'type' => 'upload',
          'option_category' => 'basic_option',
          'upload_button_text' => esc_attr__('Upload an Image', 'et_builder'),
          'choose_text' => esc_attr__('Choose an Image', 'et_builder'),
          'update_text' => esc_attr__('Set As Image', 'et_builder'),
          'description' => esc_html__('Upload your desired logo image, or type in the URL to the image you would like to display over your email header.', 'et_builder'),
        ),

      'logo_orientation' => array(
            'label' => 'Logo Orientation',
            'type' => 'select',
            'options' => array(
                'center' => 'Center',
                'left' => 'Left',
                'right' => 'Right',
               ),
            'default' => 'center',
      ),

        'background_color' => array(
          'label' => esc_html__('Background Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#999999',
        ),

    );
  }

    public function shortcode_callback($attrs, $content = null, $function_name)
    {
        return $this->view(__DIR__.'/views/headers/basic.php', $attrs, $content);
    }
}

return new OA_Email_Header_Module();
