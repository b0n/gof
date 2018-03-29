<?php

abstract class TrafficLightState {

	protected $traffic_light;

	public function __construct(TrafficLight $traffic_light)
	{
		// それぞれのカラーカートリッジに親機を憶えさせる
		$this->traffic_light = $traffic_light;
	}

	public function to_state($state)
	{
		// 親機の回路に接続して
		// 親機の保持するカートリッジのうち、指定されたカートリッジに
		// 親機の回路をつなぎかえる
		$this->traffic_light->set_state($this->traffic_light->get_state($state));
	}

	public function to_green() {
		$from = $this->get_last_state();
		$this->to_state('green_state');
		echo $from . "から青に変える", PHP_EOL;
	}

	public function to_red() {
		$from = $this->get_last_state();
		$this->to_state('red_state');
		echo $from . "から赤に変える", PHP_EOL;
	}

	public function to_yellow() {
		$from = $this->get_last_state();
		$this->to_state('yellow_state');
		echo $from . "から黄に変える", PHP_EOL;
	}

	public function get_last_state()
	{
		$current_state = $this->traffic_light->get_state();
		$last_state = '青';

		if ($current_state instanceof RedState) {
			$last_state = '赤';
		}
		if ($current_state instanceof YellowState) {
			$last_state = '黄';
		}
		return $last_state;
	}

}

// 処理が変わるところだけオーバライド
class RedState extends TrafficLightState {
	public function to_red()
	{
		echo "すでに赤に変わっている", PHP_EOL;
	}
}
class GreenState extends TrafficLightState {
	public function to_green()
	{
		echo "すでに青に変わっている" . PHP_EOL;
	}
}
class YellowState extends TrafficLightState {
	public function to_yellow()
	{
		echo "すでに黄に変わっている" . PHP_EOL;
	}
}

class TrafficLight {

	private $state;

	private $red_state;
	private $green_state;
	private $yellow_state;

	public function __construct()
	{
		// 配線を間違わないようにつなぐんじゃなくて
		// カートリッジごと変えてしまう
		// 色を変えるときは、カートリッジを変える
		$this->red_state = new RedState($this);
		$this->green_state = new GreenState($this);
		$this->yellow_state = new YellowState($this);
		$this->state = $this->green_state;
	}

	public function to_green()
	{
		$this->state->to_green();
	}

	public function to_red()
	{
		$this->state->to_red();
	}

	public function to_yellow()
	{
		$this->state->to_yellow();
	}

	public function set_state(TrafficLightState $state)
	{
		$this->state = $state;
	}

	public function get_state($state = null)
	{
		return $state ? $this->$state : $this->state;
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
