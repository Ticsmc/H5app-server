<?php
class Configs
{
    public static $error_code = array(
        'success'=> 0,
        'login_fail' =>1,
        'user_invalid' =>2,
        'register_fail'=>3,
        'register_len_fail'=>4,
        'register_type_fail'=>5,
    );

    public static $main_slider_res = array(
        '1.jpg',
        '2.jpg',
        '1 (1).jpg',
        '1 (2).jpg',
    );

    public static $main_source_res = array(
    array('id'=>1,'name'=>'英语','icon'=>'2 (1).png','c_id'=>1),
    array('id'=>2,'name'=>'软件工程','icon'=>'2 (2).png','c_id'=>1),
    array('id'=>3,'name'=>'java','icon'=>'2 (3).png','c_id'=>2)

);
    public static $teacher_source_res = array(
        array('id'=>22,'name'=>'英语','s_id'=>1),
        array('id'=>22,'name'=>'软件工程','s_id'=>2),
        array('id'=>22,'name'=>'java','s_id'=>3)
    );

    public static $main_video_res = array(

        array('id'=>1,'name'=>'高等数学','icon'=>'1 (4).jpg','url'=>'1.mp4'),
        array('id'=>2,'name'=>'英语','icon'=>'1 (3).jpg','url'=>'2.mp4'),

      //  array('id'=>3,'name'=>'java','icon'=>'3.jpg','url'=>'http://127.0.0.1/3.mp3')
    );
}
