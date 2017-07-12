<?php
    class Hiro_Greymode_Public extends Hiro_Greymode_Settings
    {
        public static function assets_init ()
        {
            $currentFolder = plugin_dir_url(__FILE__);
            wp_enqueue_style('hiro_greymode_public_style_mourn.css', $currentFolder . '/external/mourn.js/css/mourn.css');
            wp_register_script('hiro_greymode_public_script_mourn.js', $currentFolder . '/external/mourn.js/js/mourn.js', array( 'jquery' ));
            wp_enqueue_script('hiro_greymode_public_script_mourn.js');
            wp_register_script('hiro_greymode_public_script_main', $currentFolder . 'greymode-public.js', array( 'jquery' ));
            wp_enqueue_script('hiro_greymode_public_script_main');
        }

        public static function layout_init ()
        {
            self::$options = get_option( self::OPTION_NAME );
            ?>
                <div id='hiro-greymode' style='display: none !important'
                data-gm-grey-enable='<?php echo self::$options['enable_grey'];?>'
                data-gm-button-name='<?php echo self::$options['button_name'];?>'
                data-gm-button-color='<?php echo self::$options['button_color'];?>'
                data-gm-grey-scale='<?php echo self::$options['grey_scale'];?>'
                data-gm-ribbon-enable='<?php echo self::$options['enable_ribbon'];?>'
                data-gm-ribbon-size='<?php echo self::$options['ribbon_size'];?>'
                data-gm-ribbon-position='<?php echo self::$options['ribbon_position'];?>'
                ></div>
            <?php
        }
    }
?>
