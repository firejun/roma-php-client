<?php
require_once 'RomaClient.php';

/**
 * Test class for RomaClient.
 * Generated by PHPUnit on 2010-08-05 at 16:37:31.
 */
class RomaClientJointTest3 extends PHPUnit_Framework_TestCase
{

  protected $roma_client;
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
   * No.--
   * No.
   */
  public function testServerSetting() {
    exec($this->server_script_path . ' starts');
    sleep(30);
    exec($this->server_script_path . ' stop1');
    sleep(30);
    exec($this->server_script_path . ' join1');
    sleep(30);
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
  }

  /**
   * No.4, 5, 6
   * No.
   */
  public function testJoinSetGetDelete() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->set("test-join-get".$i, "test-join-get".$i, 0);
        $this->roma_client->get("test-join-get".$i);
        $this->roma_client->delete("test-join-get".$i);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.7, 8
   * No.
   */
  public function testJoinIncDec() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->set("test-join-incdec", "0", 100);
        $this->roma_client->incr("test-join-incdec", 1);
        $this->roma_client->decr("test-join-incdec", 1);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->roma_client->delete("test-join-incdec");
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.9
   * No.
   */
  public function testJoinAdd() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->add("test-join-add".$i, "test-join-add".$i, 100);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.10
   * No.
   */
  public function testJoinReplace() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->set("test-join-replace".$i, "test-join-replace".$i, 100);
        $this->roma_client->replace("test-join-replace".$i, "test-join-replace".$i, 100);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.11
   * No.
   */
  public function testJoinAppend() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->append("test-join-append", $i, 100);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.12
   * No.
   */
  public function testJoinPrepend() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 10000; $i++) {
      try {
        $this->roma_client->prepend("test-join-prepend", $i, 100);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.13, 14
   * No.
   */
  public function testJoinCasCasUnique() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    $this->roma_client->set("test-join-cas", "test-join-cas", 100);
    for ($i = 0; $i < 10000; $i++) {
      try {
        $val = $this->roma_client->cas_unique("test-join-cas");
        $this->roma_client->cas("test-join-cas", "test-join-cas".$i, $val[0], 100);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.15
   * No.
   */
  public function testJoinAlistSizedInsert() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 100; $i++) {
      try {
        $this->roma_client->alist_sized_insert("test-join-alist", 100, "test-join-alist".$i);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.16
   * No.
   */
  public function testJoinAlistJoin() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 100; $i++) {
      try {
        $this->roma_client->alist_join("test-join-alist", ",");
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.17
   * No.
   */
  public function testJoinAlistDelete() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 50; $i++) {
      try {
        $this->roma_client->alist_delete("test-join-alist", "test-join-alist".$i);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.18
   * No.
   */
  public function testJoinAlistDeleteAt() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 50; $i++) {
      try {
        $this->roma_client->alist_delete_at("test-join-alist", $i);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.19
   * No.
   */
  public function testJoinAlistClear() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    for ($i = 0; $i < 100; $i++) {
      try {
        $this->roma_client->alist_clear("test-join-alist");
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.20
   * No.
   */
  public function testJoinAlistLength() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    $this->roma_client->alist_sized_insert("test-join-alist", 100, "test-join-alist");
    for ($i = 0; $i < 100; $i++) {
      try {
        $this->roma_client->alist_length("test-join-alist");
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.21
   * No.
   */
  public function testJoinAlistUpdateAt() {
    print "\n***TEST*** ". get_class($this) ."::". __FUNCTION__ . "\n";
    $cnt = 0;
    $this->roma_client = RomaClient::getInstance(array("localhost_11211", "localhost_11212"));
    $this->roma_client->alist_sized_insert("test-join-alist", 100, "test-join-alist");
    for ($i = 0; $i < 100; $i++) {
      try {
        $this->roma_client->alist_update_at("test-join-alist", 0, "test-join-alist".$i);
      } catch (Exception $e) {
        $cnt++;
      }
    }
    $this->assertLessThanOrEqual(0, $cnt);
  }

  /**
   * No.--
   * No.
   */
  public function testServerStop() {
    exec($this->server_script_path . ' stops');
  }
}
?>
