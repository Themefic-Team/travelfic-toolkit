<?php

defined( 'ABSPATH' ) || exit;

/**
 * Decode legacy demo-menu arrays without constructing PHP objects.
 */
final class Travelfic_Toolkit_Menu_Data_Parser {
	private const MAX_BYTES = 65536;
	private const MAX_ITEMS = 1000;
	private const MAX_DEPTH = 8;

	public static function parse( $input ) {
		if ( ! is_string( $input ) || '' === $input || strlen( $input ) > self::MAX_BYTES ) {
			return false;
		}

		$offset = 0;
		$items  = 0;

		try {
			$value = self::read_value( $input, $offset, $items, 0 );
		} catch ( UnexpectedValueException $exception ) {
			return false;
		}

		return is_array( $value ) && '' === trim( substr( $input, $offset ) ) ? $value : false;
	}

	private static function read_value( $input, &$offset, &$items, $depth ) {
		if ( $depth > self::MAX_DEPTH || ++$items > self::MAX_ITEMS || ! isset( $input[ $offset + 1 ] ) ) {
			throw new UnexpectedValueException();
		}

		$type = $input[ $offset++ ];
		if ( ':' !== $input[ $offset++ ] ) {
			throw new UnexpectedValueException();
		}

		if ( 'i' === $type ) {
			$number = self::read_unsigned_integer( $input, $offset, ';' );
			return $number;
		}

		if ( 's' === $type ) {
			$length = self::read_unsigned_integer( $input, $offset, ':' );
			if ( ! isset( $input[ $offset ] ) || '"' !== $input[ $offset++ ] || $length > self::MAX_BYTES ) {
				throw new UnexpectedValueException();
			}

			$value = substr( $input, $offset, $length );
			$offset += $length;
			if ( strlen( $value ) !== $length || '";' !== substr( $input, $offset, 2 ) ) {
				throw new UnexpectedValueException();
			}
			$offset += 2;
			return $value;
		}

		if ( 'a' !== $type ) {
			throw new UnexpectedValueException();
		}

		$count = self::read_unsigned_integer( $input, $offset, ':' );
		if ( $count > self::MAX_ITEMS || ! isset( $input[ $offset ] ) || '{' !== $input[ $offset++ ] ) {
			throw new UnexpectedValueException();
		}

		$value = array();
		for ( $index = 0; $index < $count; $index++ ) {
			$key = self::read_value( $input, $offset, $items, $depth + 1 );
			if ( ! is_int( $key ) && ! is_string( $key ) ) {
				throw new UnexpectedValueException();
			}
			$value[ $key ] = self::read_value( $input, $offset, $items, $depth + 1 );
		}

		if ( ! isset( $input[ $offset ] ) || '}' !== $input[ $offset++ ] ) {
			throw new UnexpectedValueException();
		}

		return $value;
	}

	private static function read_unsigned_integer( $input, &$offset, $delimiter ) {
		$start = $offset;
		while ( isset( $input[ $offset ] ) && ctype_digit( $input[ $offset ] ) ) {
			$offset++;
		}

		if ( $start === $offset || $offset - $start > 6 || ! isset( $input[ $offset ] ) || $delimiter !== $input[ $offset++ ] ) {
			throw new UnexpectedValueException();
		}

		return (int) substr( $input, $start, $offset - $start - 1 );
	}
}
