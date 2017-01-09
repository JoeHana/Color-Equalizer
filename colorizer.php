<?php

/**
 * Colorizer Class
 *
 * @package  Colorizer
 * @author   ANEX
 * @version  1.0.0
 */

class Colorizer {
	
	/**
	 * Get Color
	 * Returns the final color
	 *
	 * @param	string	$color		pass a rgb color code
	 * @param	array	$modifier	pass additional attributes
	 *
	 * @since	1.0.0
	 */
	public static function get_color( $color = null, $modifier = array() ) {
		
		if( !array_key_exists( 'type', $modifier ) )
			$modifier['type'] = null;
		
		if( !array_key_exists( 'change', $modifier ) )
			$modifier['change'] = null;
		
		if( !array_key_exists( 'opacity', $modifier ) )
			$modifier['opacity'] = null;
		
		return self::rgb2rgba( self::rgb2str( self::color_shade( self::str2rgb( $color ), $modifier['type'], $modifier['change'] ) ), $modifier['opacity'] );
				
	}
		
	/**
	 * RGB to RGBA
	 * Convert RGB color value to RGBA color value
	 *
	 * @param	string	$color
	 * @param	string	$opacity
	 *
	 * @since	1.0.0
	 */
	public static function rgb2rgba( $color, $opacity = false ) {
	
		// Abort if no color provided
		if( empty( $color ) )
			  return; 
			  
		// Sanitize $color if "rgba()" is provided 
		$color = substr( $color, 4, -1 );
	
		// Check if opacity is set(rgba or rgb)
		if( $opacity ) {
			
			if( abs( $opacity ) > 1)
				$opacity = 1.0;
				
			$output = 'rgba(' . $color . ',' . $opacity . ')';
			
		} else {
			
			$output = 'rgb(' . $color . ')';
			
		}
	
		// Return rgb(a) color string
		return $output;
		
	}
	
	/**
	 * Color Shade
	 * Calculates color shades of a given color
	 *
	 * @param	array	$rgb	- define a rgb color code
	 * @param	string	$type	- choose lighter or leave empty
	 * @param	int		$change - defines the change of the base color (eg. 255 -> 250)
	 *
	 * @since	1.0.0
	 */
	public static function color_shade( array $rgb, $type, $change = 5 ) {
	
		 if( $type == 'lighter' ) {
			 
			$rgb[0] = 255-( 255-$rgb[0] ) + $change;
			$rgb[1] = 255-( 255-$rgb[1] ) + $change;
			$rgb[2] = 255-( 255-$rgb[2] ) + $change;
	
		 } else {
			 
			 $rgb[0] -= $change;
			 $rgb[1] -= $change;
			 $rgb[2] -= $change;
			 
		 }
	
		 return $rgb;
		 
	}
	

	/**
	 * String to RGB
	 * Converts a given string to a RGB Color Value
	 *
	 * @param	array	$str
	 *
	 * @since	1.0.0
	 */
	public static function str2rgb( $str ) {
		
		if( is_array( $str ) )
			return $str;
	
		$str = preg_replace( '/\s+/', '', $str ); // replace all spaces
	
		$str = str_replace( array( 'rgba(', 'rgb(', ')' ), '', $str );
	
		$comp = explode( ',', $str, 4 );
		$cnt  = count( $comp );
	
		if( $cnt < 3 || $cnt > 4 )
			return array( 0,0,0 );
	
		return array_map( 'floatval', $comp );
		
	}

	/**
	 * RGB to String
	 * Converts a given RGB Color Value to a String
	 *
	 * @param	array	$rgb
	 * @param	bool	$raw
	 *
	 * @since	1.0.0
	 */
	public static function rgb2str( $rgb, $raw = false ) {
		
		$str = implode( ',', $rgb );
	
		if( $raw )
			return $str;
	
		return ( ( count( $rgb ) == 3 ) ? 'rgb(' : 'rgba(' ) . $str . ')';
		
	}
	
	
}

/**
 * Colorizer Function
 * Base function which can be used for color manipulation
 *
 * @param	string	$color
 * @param	array	$modifier
 *
 * @since	1.0.0
 */

function colorizer( $color = null, $modifier = array() ) {
	
	return Colorizer::get_color( $color, $modifier );
	
}