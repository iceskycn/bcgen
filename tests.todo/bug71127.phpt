--TEST--
Bug #71127 (Define in auto_prepend_file is overwrite)
--INI--
bcgen.enable=1
bcgen.optimization_level=0x7FFFBFFF
--SKIPIF--
<?php if (!extension_loaded('Zend OPcache')) die("skip"); ?>
--FILE--
<?php
$file = __DIR__ . "/bug71127.inc";

file_put_contents($file, "<?php define('FOO', 'bad'); echo FOO;?>");

define("FOO", "okey");

include($file);
?>
--CLEAN--
<?php
@unlink(__DIR__ . "/bug71127.inc");
?>
--EXPECTF--
Notice: Constant FOO already defined in %sbug71127.inc on line %d
okey
