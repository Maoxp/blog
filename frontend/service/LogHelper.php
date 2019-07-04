<?php
/**
 * yiiplus/yii2-helpers
 *
 * @category  PHP
 * @package   Yii2
 * @copyright 2018-2019 YiiPlus Ltd
 * @license   https://github.com/yiiplus/yii2-helpers/licence.txt Apache 2.0
 * @link      http://www.yiiplus.com
 */

namespace yiiplus\helpers;

use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;

/**
 * LogHelper 提供了在应用程序中生成其他类型日志的工具。
 *
 * @author gengxiankun <gengxiankun@126.com>
 * @since 1.0.0
 */
class LogHelper
{
    /**
     * 数据记录的消息。
     */
    public static $messages = [];
    /**
     * @var string 日志文件路径，如果未设置，它将使用 "@runtime/notice/{type}.log"。
     * 如果不存在，将自动创建包含日志文件的目录。
     */
    public static $logFile;
    /**
     * @var int the permission to be set for newly created log files.
     * This value will be used by PHP chmod() function. No umask will be applied.
     * If not set, the permission will be determined by the current environment.
     */
    public static $fileMode;
    /**
     * @var int 为创建的目录设置权限。
     * PHP chmod() 将使用此值。不会应用umask。
     * 默认为0775，表示目录可由所有者和组读写，但其他用户只读。
     */
    public static $dirMode = 0775;
    /**
     * @var string 日志状态。执行成功的日志消息使用此状态。
     */
    const STATE_SUCCESS = 0x01;
    /**
     * @var string 日志状态。调试的日志信息使用此状态。
     */
    const STATE_DEBUG = 0x02;
    /**
     * @var string 日志状体。打印详细数据是使用此状态。
     */
    const STATE_INFO = 0x03;
    /**
     * @var string 日志状态。执行失败的日志信息使用此状态。
     */
    const STATE_FAIL = 0x04;

    /**
     * 命令行输出格式化
     *
     * @param string $from 来源
     * @param string $state 描述
     *
     * @return null
     */
    public static function commandOutputFormat($from, $state)
    {
        if (YII_ENV == 'prod' && in_array($state, [self::STATE_DEBUG])) {
            return;
        }
        echo '[' . date('Y-m-d H:i:s') . '] [' . $state . '] [' . $from . ']' . PHP_EOL;
    }

    /**
     * 记录通知日志。
     * 当程序运行时，一般比较重要的通知或错误需要发送通知。
     *
     * @param string $type 通知类型
     * @param string $title 通知标题
     * @param string $state 通知状态
     * @param mxied $message 通知详情
     */
    public static function notice($type, $title, $state, $message)
    {
        self::$logFile = Yii::$app->getRuntimePath() . '/logs/notice/' . $type . '.log';
        $time = time();
        self::$messages[] = [$time, $type, $state, $title, $message];
        register_shutdown_function([new self(), 'flush'], true);
    }

    /**
     * 将内存中的日志消息刷新到目标。
     * @param bool $final 这是否是请求期间的最终调用。
     *
     * @throws \yii\base\Exception
     */
    public static function flush()
    {
        $messages = self::$messages;
        // 当目标处理现有消息时，可以记录新消息。
        self::$messages = [];
        // 创建日志文件的目录
        $logPath = dirname(self::$logFile);
        FileHelper::createDirectory($logPath, self::$dirMode, true);

        // 格式化日志信息
        $text = implode("\n", array_map([new self(), 'formatMessage'], $messages)) . "\n";
        // 打开文件
        if (($fp = @fopen(self::$logFile, 'a')) === false) {
            throw new Exception("Unable to append to log file: ".self::$logFile);
        }
        @flock($fp, LOCK_EX);
        // 写入日志
        $writeResult = @fwrite($fp, $text);
        if ($writeResult === false) {
            $error = error_get_last();
            throw new Exception("Unable to export log through file!: {$error['message']}");
        }
        $textSize = strlen($text);
        if ($writeResult < $textSize) {
            throw new Exception("Unable to export whole log through file! Wrote $writeResult out of $textSize bytes.");
        }
        @flock($fp, LOCK_UN);
        @fclose($fp);

        if (self::$fileMode !== null) {
            @chmod(self::$logFile, self::$fileMode);
        }
    }

    /**
     * 将信息格式化成写入到日志的格式。
     *
     * @param array $message 日志所需要的信息信息。
     *
     * @return string 写入到日志的信息。
     */
    protected function formatMessage($messages)
    {
        list($time, $type, $state, $title, $message) = $messages;
        return $time . ' ' . $type . ' ' . $this->getStateName($state) . ' ' . $title . ' ' . $message;
    }

    /**
     * 返回指定状态的文本显示。
     *
     * @param int $state 信息状态，e.g. [[STATE_SUCCESS]], [STATE_FAIL]。
     *
     * @return string 文本显示的状态。
     */
    protected function getStateName($state)
    {
        $states = [
            self::STATE_SUCCESS => 'success',
            self::STATE_DEBUG => 'debug',
            self::STATE_FAIL => 'fail',
            self::STATE_INFO => 'info'
        ];
        return isset($states[$state]) ? $states[$state] : 'unknown';
    }
}