<?php
// Plugin Name: beMacadamia
// Plugin URI: http://www.bemacadamia.com/
// Description: Helper para los post
// Version: 1.0.0
// Author: Santiago Sánchez
// Author URI: http://www.bemacadamia.com/
// License: Free
// Text Domain: beMacadamia

/**
 * Created by PhpStorm.
 * User: chadsfather
 * Date: 6/6/15
 * Time: 20:32
 */

class postHelper {
    const CONST_GDRIVE_PATH = 'http://googledrive.com/host/';

    private function getOnlyPosts()
    {
        global $wpdb;

        $results = $wpdb->get_results("select *
        from wp_posts as a
        where a.post_type = 'post'
        and a.post_status = 'publish'", "ARRAY_A");

        return $results;
    }

    public static function getPost($id)
    {
        global $wpdb;

        $results = $wpdb->get_results("select *
        from wp_posts as a
        where a.ID = $id
        and a.post_type = 'post'
        and a.post_status = 'publish'", "ARRAY_A");

        $custom = get_post_custom($id);
        $custom['wpcf-tallas'][0] = unserialize($custom['wpcf-tallas'][0]);
        $custom['wpcf-imagen'][0] = $custom['wpcf-imagen'][0] = self::getImage($custom['wpcf-gdrive'][0], $custom['wpcf-imagen'][0]);

        $post = array(
            'post' => $results,
            'custom' => $custom
        );

        return $post;
    }

    public static function getAllPosts()
    {
       $posts = array();

        $results = self::getOnlyPosts();

        foreach($results as $post) {
            $id = $post['ID'];
            $custom = get_post_custom($id);
            $custom['wpcf-tallas'][0] = unserialize($custom['wpcf-tallas'][0]);
            $custom['wpcf-imagen'][0] = self::getImage($custom['wpcf-gdrive'][0], $custom['wpcf-imagen'][0]);

            $posts[$id] = array(
                'post' => $post,
                'custom' => $custom
            );
        }

        return $posts;
    }

    private static function getImage($id, $img)
    {
        return self::CONST_GDRIVE_PATH . $id . '/' . $img;
    }

    public static function getPreferImagePosts()
    {
        $imgs = array();

        $result = self::getOnlyPosts();

        foreach($result as $post) {
            $id = $post['ID'];

            $custom = get_post_custom($id);
            $imgs[] = array(
                'img' => self::CONST_GDRIVE_PATH . $custom['wpcf-gdrive'][0] . '/' . $custom['wpcf-imagen'][0],
                'link' => '/' . $post['post_name']
            );
        }

        return $imgs;
    }

    public static function sum($cantidad, $precio)
    {
        $precio = (float) str_replace(',', '.', $precio);

        echo str_replace('.', ',', ($precio * $cantidad));
    }

    public static function getName($id) {
        global $wpdb;

        $result = $wpdb->get_results("select post_title
        from wp_posts
        where ID = $id", "ARRAY_A");

        $name = reset($result);

        echo $name['post_title'];
    }

    public static function getImageFromID($id)
    {
        $id = (int)$id;

        $img = get_post_custom($id);
        $img = self::CONST_GDRIVE_PATH . $img['wpcf-gdrive'][0] . '/' . $img['wpcf-imagen'][0];

        echo $img;
    }

    public function getLookBookImages()
    {
        global $wpdb;

        $array = array();

        $results = $wpdb->get_results("select *
        from wp_posts
        where post_status = 'publish'
        and post_type = 'post'", "ARRAY_A");

        foreach($results as $k => $v) {
            $custom = get_post_custom($v['ID']);

            if($custom['wpcf-img-lookbook']) {
                $array[] = array(
                    'img' => self::CONST_GDRIVE_PATH . $custom['wpcf-gdrive'][0] . '/' . $custom['wpcf-img-lookbook'][0],
                    'link' =>'/' .  $v['post_name']
                );
            }
        }

        return $array;
    }
}