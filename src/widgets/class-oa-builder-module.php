<?php


/**
 *
 */
class OA_Builder_Module extends ET_Builder_Module
{
    public $fields;

  /**
   * Initialise.
   */
  public function init()
  {
      $this->whitelisted_fields = array_keys($this->fields);

    /*
     * Prefix the slug with et_pb
     */
    if (strpos($this->slug, 'et_pb_') !== 0) {
        $this->slug = 'et_pb_'.$this->slug;
    }

      $defaults = array();

      foreach ($this->fields as $field => $options) {
          if (isset($options['default'])) {
              $defaults[$field] = $options['default'];
          }
      }

      $this->field_defaults = $defaults;
  }

  /**
   * Get fields.
   */
  public function get_fields()
  {
      if (!isset($this->fields['admin_label'])) {
          $this->fields['admin_label'] = array(
        'label' => esc_html__('Admin Label', 'et_builder'),
        'type' => 'text',
        'description' => esc_html__('This will change the label of the module in the builder for easy identification.', 'et_builder'),
      );
      }

      return $this->fields;
  }

  /**
   * Simple View Wrapper. Care to be taken while dealing with attribute names.
   */
  public function view($path, $attrs, $content = null)
  {
      extract($attrs);
      ob_start();
      require $path;

      return ob_get_clean();
  }

    public static function get_template($name)
    {
        $path = __DIR__.'/../templates/'.$name.'.php';

        return file_get_contents($path);
    }
}
