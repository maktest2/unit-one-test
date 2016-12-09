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

	function test_cleaning() {
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
	}
}
