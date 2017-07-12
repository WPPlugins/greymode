<?php
    class Hiro_Greymode_Admin extends Hiro_Greymode_Settings
    {
        public static function menu_init () 
        {
            self::$options = get_option( self::OPTION_NAME );

            add_menu_page(__( self::MENU_TITLE, 'greymode_page_title' ),
                            __( self::MENU_TITLE, 'greymode_menu_title' ),
                            self::CAPABILITY,
                            self::PAGE_NAME,
                            array(self::CLASSNAME, 'layout'),
                            'dashicons-welcome-view-site',
                            99);

        }

        public static function page_init ()
        {   
            register_setting( self::PAGE_NAME, self::OPTION_NAME );
            
            add_settings_section(self::SECTION_ID, 
                                __( '<i class="dashicons dashicons-welcome-view-site"></i> ' . self::MENU_TITLE, 'greymode_page_title' ),
                                array(self::CLASSNAME, 'render_section_page'), 
                                self::OPTION_NAME);

            add_settings_field('enableGrey', 
                                __( 'Enable Grey', 'greymode_grey_enable' ), 
                                array(self::CLASSNAME, 'render_checkbox'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_regular_field('enable_grey'));

            add_settings_field('button_name', 
                                __( 'Button name', 'greymode_setting_button_name_label' ), 
                                array(self::CLASSNAME, 'render_text_field'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_text_field('button_name', __('If don t need to add text please give some space.', 'greymode_setting_button_name_placeholder')));

            add_settings_field('button_color', 
                                __( 'Button color', 'greymode_setting_button_color_label' ), 
                                array(self::CLASSNAME, 'render_color_field'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_regular_field('button_color'));

            add_settings_field('grey_scale', 
                                __( 'Grey scale', 'greymode_setting_grey_scale_label' ), 
                                array(self::CLASSNAME, 'render_select_field'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_select_field('grey_scale', '-- Please select --', array(
                                    'Minimal'=>'0.25',
                                    'Normal'=>'0.5',
                                    'High'=>'0.75',
                                    'Ultra High'=>'1.0'
                                )));

            add_settings_field('enableRibbon', 
                                __( 'Enable Ribbon', 'greymode_ribbon_enable' ), 
                                array(self::CLASSNAME, 'render_checkbox'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_regular_field('enable_ribbon'));

            add_settings_field('ribbon_size', 
                                __( 'Ribbon Size', 'greymode_ribbon_size_label' ), 
                                array(self::CLASSNAME, 'render_select_field'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_select_field('ribbon_size', '-- Please select --', array(
                                    'Small'=>'small',
                                    'Large'=>'large'
                                )));

            add_settings_field('ribbon_position', 
                                __( 'Ribbon Position', 'greymode_ribbon_position_label' ), 
                                array(self::CLASSNAME, 'render_select_field'), 
                                self::OPTION_NAME,
                                self::SECTION_ID,
                                self::get_select_field('ribbon_position', '-- Please select --', array(
                                    'Top left'=>'top-left',
                                    'Top right'=>'top-right',
                                    'Bottom left'=>'bottom-left',
                                    'Bottom right'=>'bottom-right'
                                )));

        }

        public static function assets_init ($hook)
        {
            if ('toplevel_page_hiro_greymode_page' != $hook) {
                return;
            }
            wp_enqueue_script('hiro_greymode_admin_script', plugin_dir_url(__FILE__) . 'greymode-admin.js');
        }

        public static function layout ()
        {
            self::do_process();
            ?>
                <div class='card'>
                    <form id='greymodeForm' method='post'>
                    <?php
                        do_settings_sections( self::OPTION_NAME );
                        settings_fields( self::OPTION_NAME );
                        submit_button(__( 'Save', 'greymode_setting_save' ));
                    ?>
                    </form>
                </div>
            <?php
        }

        public static function render_section_page ($args)
        {

        }

        public static function render_text_field ($args)
        {
            ?>
                <input type='text' class='regular-text' name='<?php echo $args['name'];?>' placeholder='<?php echo $args['placeholder'];?>' value='<?php echo self::$options[$args['name']];?>'>
            <?php
        }

        public static function render_select_field ($args)
        {
            ?>
                <select name='<?php echo $args['name'];?>'>
                    <option value=''><?php echo $args['placeholder'];?></option>
            <?php
            foreach ($args['vals'] as $key => $value) {
                ?>
                    <option value='<?php echo $value;?>' <?php echo ($value == self::$options[$args['name']]) ? 'selected' : '';?>><?php echo $key;?></option>
                <?php
            }
            ?>
                </select>
            <?php 
        }

        public static function render_checkbox ($args)
        {
            ?>
                <input type='checkbox' name='<?php echo $args['name'];?>' <?php echo isset(self::$options[$args['name']]) ? 'checked' : '';?>>
            <?php
        }

        public static function render_color_field ($args)
        {
            ?>
                <input type='color' name='<?php echo $args['name'];?>' value='<?php echo self::$options[$args['name']];?>'>
            <?php
        }

        private static function get_text_field ($name, $placeholder)
        {
            return array(
                        'name'=>$name,
                        'placeholder'=>$placeholder
                    );
        }

        private static function get_select_field ($name, $placeholder, $multiple_val)
        {
            return array(
                'name'=>$name,
                'placeholder'=>$placeholder,
                'vals'=>$multiple_val
            );
        }

        private static function get_regular_field ($name)
        {
            return array(
                'name'=>$name
            );
        }

        private static function set_grey_settings ($args)
        {
            return array(
                'enable_grey'=>isset($args['enable_grey']) ? $args['enable_grey'] : NULL,
                'enable_ribbon'=>isset($args['enable_ribbon']) ? $args['enable_ribbon'] : NULL,
                'button_name'=>$args['button_name'],
                'button_color'=>$args['button_color'],
                'grey_scale'=>$args['grey_scale'],
                'ribbon_size'=>$args['ribbon_size'],
                'ribbon_position'=>$args['ribbon_position'],
                
            );
        }

        private static function do_process ()
        {
            if (!current_user_can( self::CAPABILITY )) {
                exit;
            }
            if (isset($_POST['button_color'])) {
                $model = self::set_grey_settings($_POST);
                (!empty(get_option(self::OPTION_NAME))) ? update_option(self::OPTION_NAME, $model) : add_option(self::OPTION_NAME, $model);
                self::$options = get_option(self::OPTION_NAME);
            }
        }

    }
?>
