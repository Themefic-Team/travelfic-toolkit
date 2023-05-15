<?php
//option function
if( ! function_exists('travelfic_get_meta') ){
    function travelfic_get_meta( $key, $attr=''){
        if( !empty($attr)){
            $data = get_post_meta( get_the_ID(), $key, true )[$attr];
        }else{
            $data = get_post_meta( get_the_ID(), $key, true );
        }
        return $data;
    }
}

