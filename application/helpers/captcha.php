<?php 
// Captcha configuration
$config = array(
             'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => base_url().'system/fonts/texb.ttf',
            'img_width'     => '120',
            'img_height'    => 30,
            'word_length'   => 5,
            'font_size'     => 24,
             'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
               // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
);
$captcha = create_captcha($config);

?>
