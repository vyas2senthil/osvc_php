<?php

require_once(dirname(__FILE__) . '/../src/Client.php');
require_once(dirname(__FILE__) . '/../src/AnalyticsReportResults.php');

use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testIsAnInstanceOfClient()
    {
		
		$rn_client = new OSvCPHP\Client(array(
			"username" => getenv("OSC_ADMIN"),
			"password" => getenv("OSC_PASSWORD"),
			"interface" => getenv("OSC_SITE"),
			"demo_site" => true
		));

        $this->assertInstanceOf(
            OSvCPHP\Client::class,
            $rn_client
        );
    }

	/* should take "username", "password", and "interface" values from and object and match them */ 

	public function testShouldTakeUsernamePasswordAndInterfaceValuesFromAndObjectAndMatchThem()
	{

		$rn_client = new OSvCPHP\Client(array(
			"username" => getenv("OSC_ADMIN"),
			"password" => getenv("OSC_PASSWORD"),
			"interface" => getenv("OSC_SITE"),
			"demo_site" => true
		));

        $this->assertArrayHasKey('username', $rn_client->config);
        $this->assertEquals($rn_client->config('username'),getenv("OSC_ADMIN"));

        $this->assertArrayHasKey('interface', $rn_client->config);
        $this->assertEquals($rn_client->config('interface'),getenv("OSC_PASSWORD"));

        $this->assertArrayHasKey('password', $rn_client->config);
        $this->assertEquals($rn_client->config('password'), getenv("OSC_SITE"));


	}




	/* should take a "demo_site" from an object and set a url to use the  */ 

	public function testShouldTakeADemositeFromAnObjectAndSetAUrlToUseThe()
	{




	}




	/* should take "no_ssl_verify","version", and "suppress_rules" values from an object and match them */ 

	public function testShouldTakeNosslverifyversionAndSuppressrulesValuesFromAnObjectAndMatchThem()
	{




	}




	/* should raise an error if the object username is blank */ 

	public function testShouldRaiseAnErrorIfTheObjectUsernameIsBlank()
	{




	}




	/* should raise an error if the object password is blank */ 

	public function testShouldRaiseAnErrorIfTheObjectPasswordIsBlank()
	{




	}




	/* should raise an error if the object interface is blank */ 

	public function testShouldRaiseAnErrorIfTheObjectInterfaceIsBlank()
	{




	}




	/* should should have version set to "v1.3" if unspecified */ 

	public function testShouldShouldHaveVersionSetToV13IfUnspecified()
	{




	}




	/* should take an access token */ 

	public function testShouldTakeAnAccessToken()
	{




	}




}