<?php
if ( ! class_exists( 'BJLL' ) ) {
  class BJLL {
    protected $_placeholder_url;

    protected static $_instance;

    function __construct() {

      // Disable when viewing printable page from WP-Print
      if ( intval( get_query_var( 'print' ) ) == 1 || intval( get_query_var( 'printpage' ) ) == 1 ) {
        return;
      }

      add_filter( 'bj_lazy_load_html', array( __CLASS__, 'filter' ), 10, 1 );

      $this->_placeholder_url = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

      add_filter( 'the_content', array( $this, 'filter' ), 200 );
      add_filter( 'widget_text', array( $this, 'filter' ), 200 );
      add_filter( 'post_thumbnail_html', array( $this, 'filter' ), 200 );
      add_filter( 'get_avatar', array( $this, 'filter' ), 200 );
    }

    static function singleton() {
      if ( ! isset( self::$_instance ) ) {
        $className = __CLASS__;
        self::$_instance = new $className;
      }
      return self::$_instance;
    }

    static function filter( $content ) {

      $run_filter = true;
      $run_filter = apply_filters( 'bj_lazy_load_run_filter', $content );

      if ( ! $run_filter ) {
        return $content;
      }

      $BJLL = BJLL::singleton();

      $content = $BJLL->_filter_images( $content );

      return $content;
    }

    protected function _filter_images( $content ) {

      $matches = array();
      preg_match_all( '/<img[\s\r\n]+.*?>/is', $content, $matches );

      $search = array();
      $replace = array();

      foreach ( $matches[0] as $imgHTML ) {

        // don't to the replacement if the image is a data-uri
        if ( ! preg_match( "/src=['\"]data:image/is", $imgHTML ) ) {
          // replace the src and add the data-src attribute
          $replaceHTML = preg_replace( '/<img(.*?)src=/is', '<img$1src="' . $this->_placeholder_url . '" data-lazy-type="image" data-src=', $imgHTML );

          // add the lazy class to the img element
          if ( preg_match( '/class=["\']/i', $replaceHTML ) ) {
            $replaceHTML = preg_replace( '/class=(["\'])(.*?)["\']/is', 'class=$1lazy lazy-hidden $2$1', $replaceHTML );
          } else {
            $replaceHTML = preg_replace( '/<img/is', '<img class="lazy lazy-hidden"', $replaceHTML );
          }

          $replaceHTML .= '<noscript>' . $imgHTML . '</noscript>';

          array_push( $search, $imgHTML );
          array_push( $replace, $replaceHTML );
        }
      }

      $content = str_replace( $search, $replace, $content );

      return $content;
    }
  }
}
add_action( 'wp', create_function('', 'if ( ! ( is_feed() || is_page() ) ) { BJLL::singleton(); }'), 10, 0 );
?>
