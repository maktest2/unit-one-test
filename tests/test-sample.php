<?php
/**
 * Class SampleTest
 *
 * @package Unit_One_Test
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_sample() {
		// Replace this with some actual testing code.
		//$this->assertTrue( true );
	}
	
	function test_before_cleaning() {
		$set = set_transient( 'unclean', 'this', 5 );
		$this->assertTrue( $set );

		$get = get_transient( 'unclean' );
		$this->assertEquals( $get, 'this' );

		sleep(20);
		
		$raw = get_option( '_transient_unclean' );
		$this->assertEquals( $raw, 'this' );
		
		$raw_timeout = get_option( '_transient_timeout_unclean' );
		$this->assertNotFalse( $raw_timeout );
		$this->assertLessThan( time(), $raw_timeout );

		$fresh = get_transient( 'unclean' );
		$this->assertFalse( $fresh );
	}

	function test_after_cleaning() {
		$set = set_transient( 'row', 'that', 5 );
		$this->assertTrue( $set );

		$get = get_transient( 'row' );
		$this->assertEquals( $get, 'that' );

		sleep(20);

		Clean_Expired_Transients::clean();

		$fresh = get_transient( 'row' );
		$this->assertFalse( $fresh );

		$raw = get_option( '_transient_timeout_row' );
		$this->assertFalse( $raw );

		$raw_value = get_option( '_transient_row' );
		$this->assertFalse( $raw_value );
	}
}
