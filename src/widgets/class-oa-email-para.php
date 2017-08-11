<?php

/**
 *
 */
class OA_Email_Para_Module extends OA_Builder_Module
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
      $this->name = 'Email: Paragraph';
      $this->slug = 'oa_email_para_module';

      $this->fields = array(
      'font_color' => array(
          'label' => esc_html__('Font Color', 'et_builder'),
          'type' => 'color',
          'custom_color' => true,
          'default' => '#999999',
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
                'normal' => 'Normal',
                'large' => 'Large',
                'small' => 'Small',
             ),
        'default' => 'normal',
        'description' => esc_html__('This controls the how your text size.', 'et_builder'),
      ),
      'content_new' => array(
        'label' => esc_html__('Content', 'et_builder'),
        'type' => 'tiny_mce',
        'option_category' => 'basic_option',
        'description' => esc_html__('Here you can create the content that will be used within the module.', 'et_builder'),
      ),

    );
  }

    public function shortcode_callback($attrs, $content = null, $function_name)
    {
        return $this->view(__DIR__.'/views/row.php', $attrs, $content);
    }
}

return new OA_Email_Para_Module();
