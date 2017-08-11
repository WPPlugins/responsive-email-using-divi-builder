 <p style="color: <?php echo $font_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; text-align: <?php echo $text_orientation ?>; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="<?php echo $text_orientation ?>">

<?php 
if (isset($text_size) && ($text_size == 'small')) {
    echo "<small  style='text-align: $text_orientation'>";
}
if (isset($text_size) && ($text_size == 'large')) {
    echo "<h4 style='text-align: $text_orientation'>";
}

echo $content;

if (isset($text_size) && ($text_size == 'small')) {
    echo '</small>';
}
if (isset($text_size) && ($text_size == 'large')) {
    echo '</h4>';
}

 ?>
 
</p>