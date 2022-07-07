<?php
/*
Plugin Name:  Profile WP Rest Api
Plugin URI:   https://kennethowusu.com
Description:  Extend Wp Rest Api for Profile 
Version:      1.0
Author:       Kenneth
Author URI:   https://kennethowusu.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  kenpl44
Domain Path:  /languages
*/?>
<?php 

/***********add resume media link******/
add_option('profile_resume_url','myresumelink');

/*********callback ********/
function callback_add_options_to_rest_api($data){
    $option = $data->get_url_params()['path'];

  
    $is_present = get_option($option);

    if(!$is_present){
        return new WP_Error('option_not_found',
            'option `'.$option.'` not found',array(
                'status'=>404
            ));
    }
    $option_value = array('profile_resume_link'=>$is_present);
    return $option_value;
}

/********* add_options_to_rest_api****/
function add_options_to_rest_api(){
register_rest_route('profile/v1','options/(?P<path>[\S]+)',array(
    'methods'=>'GET',
    'callback'=>'callback_add_options_to_rest_api',
    'permission_callback'=>'__return_true',
));
}

/*********register function********/
add_action('rest_api_init','add_options_to_rest_api');
?>
