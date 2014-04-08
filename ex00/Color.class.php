<?php

class Color
{
	public static $verbose = false;
	public $red = 0;
	public $green = 0;
	public $blue = 0;

	/**
	 * Returns the documentation of the class, readed
	 * from the __CLASS__.doc.txt file (so Color.doc.txt)
	 * @return string the documentation, or false in failure case.
	 */
	public static function doc()
	{
		if (file_exists(__CLASS__.".doc.txt"))
			return (file_get_contents(__CLASS__.".doc.txt"));
		else
			return (false);
	}

	function __construct(array $argv = array())
	{
		if (array_key_exists("rgb", $argv))
		{
			$this->red = (int) ($argv["rgb"] >> 16) & 0xFF;
			$this->green = (int) ($argv["rgb"] >> 8) & 0xFF;
			$this->blue = (int) ($argv["rgb"] >> 0) & 0xFF;
		}
		else if (count(array_diff_key(
		         $argv,
		         array('red' => 0, 'green' => 0, 'blue' => 0)
			)) == 0)
		{
			$this->red = (int) $argv["red"];
			$this->green = (int) $argv["green"];
			$this->blue = (int) $argv["blue"];
		}
		if (self::$verbose)
		{
			echo $this." constructed.\n";
		}
	}

	public function __toString()
	{
		$str = sprintf("Color( red: %3d, green: %3d, blue: %3d )",
				$this->red,
				$this->green,
				$this->blue
		);
		return ($str);
	}

	function __destruct()
	{
		if (self::$verbose)
		{
			echo $this." destructed.\n";
		}
	}

	public function add($color)
	{
		$r = ($this->red + $color->red > 255 ? 255 : (int) $this->red + $color->red);
		$g = ($this->green + $color->green > 255 ? 255 : (int) $this->green + $color->green);
		$b = ($this->blue + $color->blue > 255 ? 255 : (int) $this->blue + $color->blue);
		$newColor = new Color(array('red' => $r, 'green' => $g, 'blue' => $b));
		return ($newColor);
	}

	public function sub($color)
	{
		$r = ($this->red - $color->red < 0 ? 0 : (int) $this->red - $color->red);
		$g = ($this->green - $color->green < 0 ? 0 : (int) $this->green - $color->green);
		$b = ($this->blue - $color->blue < 0 ? 0 : (int) $this->blue - $color->blue);
		$newColor = new Color(array('red' => $r, 'green' => $g, 'blue' => $b));
		return ($newColor);
	}

	public function mult($factor)
	{
		$r = ($this->red * $factor > 255 ? 255 : (int) $this->red * $factor);
		$g = ($this->green * $factor > 255 ? 255 : (int) $this->green * $factor);
		$b = ($this->blue * $factor > 255 ? 255 : (int) $this->blue * $factor);
		$newColor = new Color(array('red' => $r, 'green' => $g, 'blue' => $b));
		return ($newColor);
	}
}


?>
