<?php

/**
 *
 */
class OA_Email_Button_Spacer extends OA_Builder_Module
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
      $this->name = 'Email: Spacer';
      $this->slug = 'oa_email_spacer_module';

      $this->fields = array(
        'height' => array(
            'label' => 'Height',
            'type' => 'text',
            'default' => '50',
        ),

    );
  }

    public function shortcode_callback($attrs, $content = null, $function_name)
    {
        return $this->view(__DIR__.'/views/spacer.php', $attrs, $content);
    }
}

return new OA_Email_Button_Spacer();
