<?php
/**
 * Class OverlayInitTest
 *
 * @package Overlay
 */

use PHPUnit\Framework\TestCase;

class OverlayInitTest extends WP_UnitTestCase
{

	public function test_personPostTypeInit()
	{

		//Assert person post type is set
		$postTypes = get_post_types( array( 'public' => true ), 'object' );
		$this->assertTrue( isset( $postTypes[ 'person' ] ) );
		
		$personPostType = $postTypes[ 'person' ];

		//Assert some essential basic properties
		$this->assertTrue( $personPostType->public );
		$this->assertTrue( $personPostType->public_queryable );
		$this->assertTure( 'post', $personPostType->capability_type );
	}
}

?>