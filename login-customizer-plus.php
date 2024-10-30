<?php
/*
Plugin Name: Login Customizer Plus
Plugin URI: https://techuptodate.com.au/login-customizer-plus/
Description: Customize your boring Login Page to beautiful and elegant layout. Easy to Use & Useful for branding.  
Version: 1.2.1
Author: TechUptodate
Author URI:  https://techuptodate.com.au/
Text Domain:  login-modifications
Domain Path:  /languages
License:     GPL3
 
Login Modification is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Login Modification is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA. 

Copyright 2018
*/

defined( 'ABSPATH' ) or die( 'Hey, You cant access the page' );

if( ! class_exists('LoginCustomizerPlus') ) {

    class LoginCustomizerPlus {

        public $plugin;

        function __construct() {

            $this->plugin = plugin_basename( __FILE__ );

        }

        public function register() {

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );

            add_action( 'admin_menu', array( $this, 'add_admin_pages') );

            add_action( 'admin_enqueue_scripts', array( $this, 'mw_enqueue_color_picker' ) );

            add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
        }

        public function add_admin_pages() {

            add_menu_page( 'Login Customizer', 'Login Customizer', 'manage_options', 'login_customizer_plus', array( $this, 'admin_index' ),plugin_dir_url( __FILE__ ).'image/lcp-menu-icon.png', 111 );

        }

        public function admin_index() {

            require_once plugin_dir_path( __FILE__ ).'templates/admin.php';

        }

        public function settings_link($links) {

            $setting_link = '<a href="admin.php?page=login_customizer_plus">Settings</a>';

            array_push( $links, $setting_link );
            return $links;

        }


        protected function create_post_type() {

            add_action( 'init', array( $this, 'custom_post_type' ) );

        }

        function custom_post_type() {

            register_post_type( 'login_customizer', ['public' => true, 'label' => 'WP Login Customizer'] );
        }


        function enqueue() {

          
            wp_enqueue_style( 'mypluginstyle', plugins_url( '/css/mystyle.css', __FILE__ ) );
            wp_enqueue_script( 'mypluginscript', plugins_url( '/js/myscript.js', __FILE__ ) );
            wp_enqueue_script( 'mypluginscript1', plugins_url( '/js/jquery.min.js', __FILE__ ) );
            wp_enqueue_script( 'mypluginscript2', plugins_url( '/js/bootstrap.min.js', __FILE__ ) );
          

        }
        
        function mw_enqueue_color_picker( $hook_suffix ) {

            // first check that $hook_suffix is appropriate for your admin page
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'my-script-handle', plugins_url( '/js/custom.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
        }

        function activate() {

            require_once plugin_dir_path( __FILE__ ).'include/login-customizer-plus-activate.php';

            LoginCustomizerPlusActivate::activate();
        }

    }

        
        if( class_exists( 'LoginCustomizerPlus' ) ) {

            $login_customizer_plus = new LoginCustomizerPlus(); 
            $login_customizer_plus->register();

        }


    // Activation
        
        register_activation_hook( __FILE__, array( $login_customizer_plus, 'activate') );


    // Deactivation
        require_once plugin_dir_path( __FILE__ ).'include/login-customizer-plus-deactivate.php';
        register_deactivation_hook( __FILE__, array( 'LoginCustomizerPlusDectivate', 'deactivate') );

}


/*display settings in wp-admin login page*/
add_action( 'login_enqueue_scripts', 'lcp_setting_func', 100 );

    function lcp_setting_func() {

        $lcp_admin_icon = get_option('admin_icon',true);  

        $bgimage = get_option('admin_bgimg',true);

        $lcp_bgclr = get_option('admin_bgclr',true);

        if( !empty($lcp_admin_icon) ) {

            echo '<style type="text/css"> 
            body.login div#login h1 a { background-image: url("'.$lcp_admin_icon.'"); background-size: contain !important; width: auto !important;} </style>';  

        }

        if( !empty($bgimage) ) {

            echo '<style type="text/css"> 
            body.login{ background-image: url("'.$bgimage.'");  background-size: cover; background-repeat: no-repeat; background-position: center; -webkit-background-size: 100%;  } </style>';              
        }

        if( !empty($lcp_bgclr) ) {

            echo '<style type="text/css"> body.login{ background-color:'.$lcp_bgclr.'; } </style>';              
        }

    }

/*redirect to home url*/

add_filter( 'login_headerurl', 'lcp_login_logo_url' );

    function lcp_login_logo_url() {

        return home_url();

    }


/*display settings in wp-admin login footer*/

add_action('login_footer', 'lcp_login_footer');

    function lcp_login_footer() {

        wp_enqueue_style('main-styles', plugins_url('/vendor/font-awesome/css/font-awesome.css', __FILE__ ));

    $lcp_fb = get_option('admin_fa_fb',true);

    $lcp_tw = get_option('admin_fa_tw',true);

    $lcp_ig = get_option('admin_fa_ig',true);

    $lcp_ig_clr = get_option('admin_fa_icon_clr',true);

    $lcp_ft_text = get_option('admin_ft_text',true);

    echo'<style type="text/css"> 
            .lcp-fa-icon .fa{ padding: 10px 10px; color: '.$lcp_ig_clr.';} 
            .lcp-footer-tag a{ color: white; text-decoration: none; }
            .lcp-footer-tag{ position: fixed;
                            bottom: 0;
                            right: 0;
                            background-color: #333;
                            padding: 5px;
                            border-top-left-radius: 5px;}
         </style>';
    echo'<div class="lcp-fa-icon" style="text-align: center; ">';

    if( !empty($lcp_fb) ) {

        echo '<a target="_blank" href="'.$lcp_fb.'" class="fa-3x"><i class="fa fa-facebook" aria-hidden="true"></i></a>';

    }
    if( !empty($lcp_tw) ) {

        echo '<a target="_blank" href="'.$lcp_tw.'" class="fa-3x"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

    }
    if( !empty($lcp_ig) ) {
        echo '<a target="_blank" href="'.$lcp_ig.'" class="fa-3x"><i class="fa fa-instagram" aria-hidden="true"></i></a>';

    }

    echo'</div><br />';

    if($lcp_ft_text=='y') {

    echo'<div class="lcp-footer-tag">
         <a target="_blank" href="https://techuptodate.com.au/">Powered by TechUptodate</a>
         </div>';

    }

}

/*activate lcp_plugin*/

    function lcp_activePlug() {

    add_option( 'admin_icon', '');

    add_option( 'admin_bgimg', '');

    add_option( 'admin_bgclr', '');

    add_option( 'admin_fa_fb', '');

    add_option( 'admin_fa_tw', '');

    add_option( 'admin_fa_ig', '');

    add_option( 'admin_fa_icon_clr', '');

    add_option( 'admin_ft_text', '');

}

register_activation_hook(__FILE__, 'lcp_activePlug');

/*deactivate lcp-plugin*/

function lcp_deactivePlug() {

    delete_option( 'admin_icon' );

    delete_option( 'admin_bgimg' );

    delete_option( 'admin_bgclr' );

    delete_option( 'admin_fa_fb' );

    delete_option( 'admin_fa_tw' );

    delete_option( 'admin_fa_ig' );

    delete_option( 'admin_fa_icon_clr' );

    delete_option( 'admin_ft_text' );

}

register_deactivation_hook(__FILE__, 'lcp_deactivePlug');
