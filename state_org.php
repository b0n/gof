<?php

class TrafficLight {

	const R = '赤';
	const G = '青';
	const Y = '黄';
	private $state;

	public function __construct()
	{
		$this->state = TrafficLight::G;
	}

	public function to_green()
	{
		if ($this->state == TrafficLight::G) {
			echo 'すでに青に変わってる', PHP_EOL;
		} else {
			echo $this->state . "から青に変える", PHP_EOL;
			$this->state = TrafficLight::G;
		}
	}

	public function to_red()
	{
		if ($this->state == TrafficLight::R) {
			echo 'すでに赤に変わってる', PHP_EOL;
		} else {
			echo $this->state . "から赤に変える", PHP_EOL;
			$this->state = TrafficLight::R;
		}
	}

	public function to_yellow()
	{
		if ($this->state == TrafficLight::Y) {
			echo 'すでに黄に変わってる', PHP_EOL;
		} else {
			echo $this->state . "から黄に変える", PHP_EOL;
			$this->state = TrafficLight::Y;
		}
	}

}

$traffic_light = new TrafficLight();
?>

$traffic_light->to_green()
<?php $traffic_light->to_green(); ?>
$traffic_light->to_red()
<?php $traffic_light->to_red(); ?>
$traffic_light->to_yellow()
<?php $traffic_light->to_yellow(); ?>
$traffic_light->to_green()
<?php $traffic_light->to_green(); ?>
$traffic_light->to_green()
<?php $traffic_light->to_green(); ?>
$traffic_light->to_yellow()
<?php $traffic_light->to_yellow(); ?>

