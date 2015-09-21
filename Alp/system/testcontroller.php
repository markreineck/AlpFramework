<?php
class TestController {

public function __construct($testcase)
{
	$this->TestCnt = 0;

	$testcase->BeforeAll();

	$rootmethods = get_class_methods('TestCase');
	$casemethods = get_class_methods($testcase);
	foreach ($casemethods as $test) {
		if (array_search($test, $rootmethods, true) === FALSE) {
			$this->TestCnt++;

			$testcase->BeforeEach();
			$testcase->SetTestName($test);
			$testcase->$test($this);
			$testcase->AfterEach();
		}
	}

	$testcase->AfterAll();
	$testcase->Summarize($this->TestCnt);
}

}

abstract class TestCase extends AlpFramework 
{

	private $ErrorCnt=0;
	private $ClassName;
	private $MethodName;

	public function GetClassName()
	{
	  return get_class($this);
	}

	public function SetTestName ($method)
	{
		$this->MethodName = $method;
	}

	public function LoadTestLibrary ($libfile)
	{
		$path = $this->FrameworkFilePath($this->SystemPath.'/test/testlibraries',$libfile);
		if (is_file($path)) {
			$this->IncludePhpFile ($path);
		}
	}

	private function AssertMessage ($assert, $msg='')
	{
		$this->ErrorCnt++;
		echo "<br><b>" . $this->GetClassName() . "::$this->MethodName</b> $assert failed";
		if ($msg)
			echo ': ' . $msg;
	}

// Depricated - use AssertTrue()
	public function Validate ($condition, $msg='')
	{
		if (!$condition)
			$this->AssertMessage ('Validate', $msg);
	}

	public function AssertTrue ($condition, $msg='')
	{
		if (!$condition)
			$this->AssertMessage ('AssertTrue', $msg);
	}

	public function AssertFalse ($condition, $msg='')
	{
		if ($condition)
			$this->AssertMessage ('AssertFalse', $msg);
	}

	public function AssertArraySize ($data, $size, $msg='')
	{
		if (!is_array($data))
			$this->AssertMessage ('AssertArraySize', $msg . ' not an array');
		else {
			$cnt = count($data);
			if ($cnt != $size)
			$this->AssertMessage ('AssertArraySize', $msg . "Expected $size, got $cnt");
		}
	}

	private function _AssertArrayHasValues ($expect, $actual, $assert, $msg='')
	{
		foreach ($expect as $key => $val) {
			if (!isset($actual[$key]))
				$this->AssertMessage ($assert, $msg . " [$key] not found");
			else {
				$act = $actual[$key];
				if ($act != $val)
					$this->AssertMessage ($assert, $msg . " [$key] expected [$val] got [$act]");
			}
		}
	}

	public function AssertArrayHasValues ($expect, $actual, $msg='')
	{
		$this->_AssertArrayHasValues ($expect, $actual, 'AssertArrayHasValues', $msg);
	}

	private function _AssertArrayHasKeys ($expect, $actual, $assert, $msg)
	{
		if (!in_array($expect, $actual))
			$this->AssertMessage ($assert, $msg . " [$expect] not found");
	}

	public function AssertArrayHasKeys ($key, $actual, $msg='')
	{
		if (is_array($key)) {
			foreach ($key as $e)
				$this->_AssertArrayHasKeys ($e, $actual, 'AssertArrayHasKeys', $msg);
		} else {
			$this->_AssertArrayHasKeys ($key, $actual, 'AssertArrayHasKeys', $msg);
		}
	}

	private function _AssertValueInArray ($expect, $actual, $msg='')
	{
		if (!array_key_exists($expect, $actual))
			$this->AssertMessage ('AssertInArray', $msg . " [$expect] not found");
	}

	public function AssertValueInArray ($expect, $actual, $msg='')
	{
		if (is_array($expect)) {
			foreach ($expect as $e)
				$this->_AssertValueInArray ($e, $actual, $msg);
		} else {
			$this->_AssertValueInArray ($expect, $actual, $msg);
		}
	}

	public function AssertObjectHasProperties ($props, $data, $msg='')
	{
		$data = get_object_vars($data);
		if (is_array($props)) {
			foreach ($props as $e)
				$this->_AssertArrayHasKeys ($e, $data, 'AssertObjectHasProperties', $msg);
		} else {
			$this->_AssertArrayHasKeys ($props, $data, 'AssertObjectHasProperties', $msg);
		}
	}

	public function AssertObjectPropertyValues ($expect, $actual, $msg='')
	{
		$expect = get_object_vars($expect);
		$actual = get_object_vars($actual);
		$this->_AssertArrayHasValues ($expect, $actual, 'AssertObjectPropertyValues', $msg);
	}

	public function AssertEqual ($expect, $actual, $msg='')
	{
		if ($expect != $actual) {
			if (is_object($expect) && is_object($actual)) {
				$expect = get_object_vars($expect);
				$actual = get_object_vars($actual);
			}
			if (is_array($expect) && is_array($actual)) {
				$msg .= print_r(array_diff_assoc($expect, $actual), true);
			} else {
				$msg .= "Expected [$expect], got [$actual]";
			}
			$this->AssertMessage ('AssertEqual', $msg);
		}
	}

	public function Summarize($testcnt)
	{
		echo "<br><br>" . $this->GetClassName() . ": Tests executed: $testcnt. ";
		if ($this->ErrorCnt)
			echo '<b>';
		echo "Tests failed: $this->ErrorCnt";
		if ($this->ErrorCnt)
			echo '</b>';
	}

	function BeforeAll() 
	{}

	function BeforeEach() 
	{}

	function AfterAll()
	{}

	function AfterEach()
	{}

	function ResetTables($tables)
	{
		$db = $this->Model();

		if (is_array($tables)) {
			foreach($tables as $t)
				$db->Execute('delete from ' . $t);
		} else
				$db->Execute('delete from ' . $tables);
	}
}
?>
