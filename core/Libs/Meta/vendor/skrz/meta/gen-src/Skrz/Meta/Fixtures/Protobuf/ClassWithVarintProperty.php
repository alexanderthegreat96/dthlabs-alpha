<?php
namespace Skrz\Meta\Fixtures\Protobuf;

/**
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * !!!                                                     !!!
 * !!!   THIS CLASS HAS BEEN AUTO-GENERATED, DO NOT EDIT   !!!
 * !!!                                                     !!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
class ClassWithVarintProperty
{
	/**
	 * @var int
	 *
	 * @Skrz\Meta\Protobuf\ProtobufField(number=1, wireType="varint", unsigned=false, packed=false)
	 */
	protected $x;


	/**
	 * @return int
	 */
	public function getX()
	{
		return $this->x;
	}


	/**
	 * @param int $x
	 *
	 * @return self
	 */
	public function setX($x)
	{
		$this->x = $x;
		return $this;
	}

}
