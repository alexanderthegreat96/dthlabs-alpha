<?php
namespace Skrz\Meta\Fixtures\Protobuf;

/**
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * !!!                                                     !!!
 * !!!   THIS CLASS HAS BEEN AUTO-GENERATED, DO NOT EDIT   !!!
 * !!!                                                     !!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
class ClassWithStringProperty
{
	/**
	 * @var string
	 *
	 * @Skrz\Meta\Protobuf\ProtobufField(number=1, wireType="string", unsigned=false, packed=false)
	 */
	protected $x;


	/**
	 * @return string
	 */
	public function getX()
	{
		return $this->x;
	}


	/**
	 * @param string $x
	 *
	 * @return self
	 */
	public function setX($x)
	{
		$this->x = $x;
		return $this;
	}

}
