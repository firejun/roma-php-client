<?php
require_once 'RomaClient.php';

/**
 * Test class for RomaClient.
 * Generated by PHPUnit on 2010-08-05 at 16:37:31.
 */
class RomaClientJointTest9 extends PHPUnit_Framework_TestCase
{

  //protected $roma_client;
  protected $server_script_path = '../../roma_root/roma.bash';

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   *
   * @access protected
   */
  protected function setUp(){
    //$this->roma_client = RomaClient::getInstance(array("localhost_11211","localhost_11212"));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   *
   * @access protected
   */
  protected function tearDown(){
    //exec($this->server_script_path . ' stops');
  }

  /**
   * No.47
   * No.
   */
  public function testRomaStopReplace() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    exec($this->server_script_path . ' starts');
    sleep(30);
    $flg = True;
    $roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      if ($i == 5000) {
        exec($this->server_script_path . ' stops');
      }
      try {
        $roma_client->set("test-join-replace".$i, "test-join-replace".$i, 100);
        $roma_client->replace("test-join-replace".$i, "test-join-replace".$i, 100);
      } catch (Exception $e) {
        $flg = False;
        break;
      }
    }
    exec($this->server_script_path . ' stops');
    $this->assertFalse($flg);
  }
}
?>
