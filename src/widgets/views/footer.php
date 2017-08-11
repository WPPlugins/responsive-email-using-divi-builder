   <table class="row collapsed footer" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: <?php echo $text_orientation ?>; width: 100%; position: relative; display: table; padding: 0; background-color:<?php echo $background_color ?> !important" bgcolor="<?php echo $background_color ?>"><tbody><tr style="vertical-align: top; text-align: <?php echo $text_orientation ?>; padding: 0;" align="<?php echo $text_orientation ?>">
   	<th class="small-12 large-12 columns first last" style="width: 564px; color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; text-align: <?php echo $text_orientation ?>; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 0 16px 16px;" align="<?php echo $text_orientation ?>">
   		<table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: <?php echo $text_orientation ?>; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: <?php echo $text_orientation ?>; padding: 0;" align="<?php echo $text_orientation ?>">
   			<th style="color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; text-align: <?php echo $text_orientation ?>; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="<?php echo $text_orientation ?>">
   				<table class="spacer" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: <?php echo $text_orientation ?>; width: 100%; padding: 0;"><tbody><tr style="vertical-align: top; text-align: <?php echo $text_orientation ?>; padding: 0;" align="<?php echo $text_orientation ?>"><td height="16px" style="font-size: 16px; line-height: 16px; word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: <?php echo $text_orientation ?>; color: <?php echo $background_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; margin: 0; padding: 0;" align="<?php echo $text_orientation ?>" valign="top">&nbsp;</td></tr></tbody></table>
   				<p class="text-center" style="text-align: <?php echo $text_orientation ?>; color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0 0 10px; padding: 0;" align="<?php echo $text_orientation ?>"><?php
                  if (isset($text_size) && ($text_size == 'small')) {
                      echo "<small  style='text-align: $text_orientation'>";
                  }
                  echo $content;

                  if (isset($text_size) && ($text_size == 'small')) {
                      echo '</small>';
                  }
                   ?></p>
          <?php if ($has_social_links == 'on') : ?>

   				<center data-parsed="" style="width: 100%; min-width: 532px;">
   					<table class="menu float-center" align="center" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: center; width: auto !important; float: none; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td style="word-wrap: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left" valign="top"><table style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left">


            <?php foreach ($providers as $provider) :?>

            <?php $url = isset(${$provider}) ? ${$provider} : ''; ?>

            <?php if ($url) :?>
              <?php
                $base_url = OA_RESPONSIVE_EMAIL_URL;
                ?>
   					<th class="menu-item float-center" style="float: none; text-align: center; color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; line-height: 19px; font-size: 16px; margin: 0 auto; padding: 10px;" align="center"><a href="<?php echo $url ?>" style="color: #2199e8; font-family: Helvetica, Arial, sans-serif; font-weight: normal; text-align: left; line-height: 1.3; text-decoration: none; margin: 0; padding: 0; width:30px;height:30px;" width="30" height="30"><img src="<?php echo $base_url;?>/assets/img/<?php echo $provider ?>-sociocon.png" alt="" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: 30px; max-width: 30px; clear: both; display: block; height: 30px !important; border: none;" width="30" height="30"></a></th>

          <?php endif; ?>
   					<?php endforeach; ?>
   					</tr></table></td></tr></table>
   				</center>
        <?php endif; ?>
   			</th>
   			<th class="expander" style="visibility: hidden; width: 0; color: <?php echo $text_color ?>; font-family: Helvetica, Arial, sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 16px; margin: 0; padding: 0;" align="left"></th>
   		</tr></table>
   	</th>
   </tr></tbody></table>
