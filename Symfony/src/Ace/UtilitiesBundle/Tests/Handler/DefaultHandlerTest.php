<?php

namespace Ace\UtilitiesBundle\Tests\Handler;

use Ace\UtilitiesBundle\Handler\DefaultHandler;

class DefaultHandlerTest extends \PHPUnit_Framework_TestCase
{
	public function testGet_data()
	{
		$handler = new DefaultHandler();

		//Check for wrong URL
		$result = $handler->get_data("http://codebender.cc\\/","", "");
		$this->assertNotEmpty($result);
		$this->assertStringMatchesFormat('%a400 Bad Request%a', $result);

		//Check for No Data
		$result = $handler->get_data("http://codebender.cc/","", "");
		$this->assertNotEmpty($result);
		$this->assertStringMatchesFormat('%a<html>%a</html>%a', $result);

		//Check for POST Data
		$result = $handler->get_data("http://www.htmlcodetutorial.com/cgi-bin/mycgi.pl","data", "test");
		$this->assertNotEmpty($result);
		$this->assertStringMatchesFormat('%a<TR VALIGN=TOP><TH ROWSPAN=1>data</TH><TD><PRE>test</PRE></TD></TR>%a', $result);
	}

	public function testGet($url)
	{
		$this->assertTrue(FALSE);
//		$ch = curl_init();
//		$timeout = 10;
//		curl_setopt($ch,CURLOPT_URL,$url);
//		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//
//		$data = curl_exec($ch);
//		curl_close($ch);
//		return $data;
	}

	public function testJson_request($url, $data)
	{
		$this->assertTrue(FALSE);
//		$ch = curl_init();
//		$timeout = 10;
//		curl_setopt($ch,CURLOPT_URL,$url);
//		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
//		curl_setopt($ch,CURLOPT_POST,1);
//		curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
//		$data = curl_exec($ch);
//		curl_close($ch);
//		return $data;
	}

	public function testDefault_text()
	{
		$this->assertTrue(FALSE);
//		$file = fopen($this::directory.$this::default_file, 'r');
//		$value = fread($file, filesize($this::directory.$this::default_file));
//		fclose($file);
//
//		return $value;
	}

	public function testGet_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() )
	{
		$this->assertTrue(FALSE);
//		$url = 'http://www.gravatar.com/avatar/';
//		$url .= md5( strtolower( trim( $email ) ) );
//		$url .= "?s=$s&d=$d&r=$r";
//		if ( $img ) {
//			$url = '<img src="' . $url . '"';
//			foreach ( $atts as $key => $val ) $url .= ' ' . $key . '="' . $val . '"';
//			$url .= ' />';
//		}
//		return $url;
	}
}

