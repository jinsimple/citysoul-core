<?php
// Created on 05.08.2015
// by: Meik
function beau_instagram_image($username, $slice = 99) {

 $username = strtolower($username);

    // if (!$instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($username))) {
        $remote = wp_remote_get('http://instagram.com/'.trim($username));

        if (is_wp_error($remote))
            return new WP_Error('site_down', __('Unable to communicate with Instagram.', 'bologna'));

        if ( 200 != wp_remote_retrieve_response_code( $remote ) )
            return new WP_Error('invalid_response', __('Instagram did not return a 200.', 'bologna'));

        $shards = explode('window._sharedData = ', $remote['body']);

        $insta_json = explode(';</script>', $shards[1]);
        $insta_array = json_decode($insta_json[0], TRUE);
        if (!$insta_array)
            return new WP_Error('bad_json', __('Instagram has returned invalid data.', 'bologna'));
        $username_fromur = $insta_array['entry_data']['ProfilePage'][0]['user']['username'];
        $images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
        $instagram = array();
        foreach ($images as $images) {
            if ($username_fromur == $username) {
                $instagram[] = array(
                    'link'          => $images['thumbnail_src'],
                    'time'          => $images['date'],
                    'link_to'       => 'https://instagram.com/p/'.$images['code'].'/?taken-by='.$username,
                    'comments'      => $images['comments']['count'],
                    'likes'         => $images['likes']['count'],
                    'type'          => $images['is_video'],
                    'code'          => $images['code'],
                );
            }
        }
        $instagram = base64_encode( serialize( $instagram ) );
        set_transient('instagram-media-'.sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS*2));
    // }
    $instagram = unserialize( base64_decode( $instagram ) );
    return array_slice($instagram, 0, $slice);
}

function beau_instagram_folow($username, $slice = 99) {
    $username = strtolower($username);

        $remote = wp_remote_get('http://instagram.com/'.trim($username));

        if (is_wp_error($remote)){
            return new WP_Error('site_down', __('Unable to communicate with Instagram.', 'beautheme'));
        }

        if ( 200 != wp_remote_retrieve_response_code( $remote ) ){
            return new WP_Error('invalid_response', __('Instagram did not return a 200.', 'beautheme'));
        }

        $shards = explode('window._sharedData = ', $remote['body']);

        $insta_json = explode(';</script>', $shards[1]);

        $insta_array = json_decode($insta_json[0], TRUE);
        if (!$insta_array) return new WP_Error('bad_json', __('Instagram has returned invalid data.', 'beautheme'));
        $follows_insta = $insta_array['entry_data']['ProfilePage'][0]['user']['followed_by']['count'];

        return $follows_insta;
}
?>