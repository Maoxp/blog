<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/27
 * Time: 9:48
 */

namespace frontend\service;

use Yii;

class Uploader
{
    private $fileField;                                     //文件域名
    private $file;                                          //文件上传对象
    private $base64;                                        //文件上传base64对象
    private $config;                                        //配置信息
    private $oriName;                                       //原始文件名
    private $fileName;                                      //新文件名
    private $fullName;                                      //完整文件名,即从当前配置目录开始的URL
    private $filePath;                                      //完整文件名,即从当前配置目录开始的URL
    private $fileSize;                                      //文件大小
    private $fileType;                                      //文件类型
    public $stateInfo;                                     //上传状态信息,

    //上传状态映射表，国际化用户需考虑此处数据的国际化
    private $stateMap = [
        "SUCCESS",
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE" => "临时文件错误",
        "ERROR_TMPFILE" => "非post上传",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
        "ERROR_CREATE_DIR" => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
        "ERROR_FILE_MOVE" => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND" => "找不到上传文件",
        "ERROR_WRITE_CONTENT" => "写入文件内容错误",
        "ERROR_UNKNOWN" => "未知错误",
        "ERROR_DEAD_LINK" => "链接不可用",
        "ERROR_HTTP_LINK" => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确",
        "INVALID_URL" => "非法 URL",
        "INVALID_IP" => "非法 IP"

    ];

    /**
     * Uploader constructor.
     * @param string $fileField 表单名称
     * @param array $config 配置项
     */
    public function __construct($fileField, $config = [])
    {
        $this->fileField = $fileField;
        $this->config = $config;
    }


    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }



    public function do_load($type = "upload")
    {
        if ($type == "remote") {
//            $this->saveRemote();
        } else if ($type == "base64") {
//            $this->upBase64();
        } else {
            return $this->upFile();
        }
    }

    /**
     * 获取当前文件名
     * @return bool|string
     */
    private function getFileName()
    {
        return substr($this->filePath, strrpos($this->filePath, "/") + 1);
    }


    /**
     * 获取保存的文件全路径
     * @throws \Throwable
     */
    private function getFilePath()
    {
        $file_ext = pathinfo($this->oriName, PATHINFO_EXTENSION);
        if (!in_array($file_ext, ["jpg", "jpeg", "gif", "png", "bmp", "webp"]))
            throw new \Throwable("上传格式不在范围");
        else {
            $upload_file_dir = Yii::getAlias(Yii::$app->params['uploadFile']). date("Y-m-d", time());
            if (!file_exists($upload_file_dir) && !mkdir($upload_file_dir, 0777, true)) {
                $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
                return '';
            } elseif (!is_writable($upload_file_dir)) {
                $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
                return '';
            }

            return $upload_file_dir;
        }
    }


    /**
     * 上传主要方法
     * @return int|string
     * @throws \Throwable
     */
    public function upFile()
    {
        if (!isset($_FILES[$this->fileField])) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return '';
        }

        $this->file = $file = $_FILES[$this->fileField];
        if ($file['error'] > 0) {
            $this->stateInfo = $this->getStateInfo($file['error']);
            return '';
        } elseif (!file_exists($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
            return '';
        } elseif (!is_uploaded_file($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMPFILE");
            return '';
        }

        $this->oriName = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileName = $this->getFileName();
        $upload_file_dir = $this->getFilePath();

        if (!empty($upload_file_dir)) {
            $randNum = uniqid(microtime(true), true);
            $uniName = $randNum . '.' . pathinfo($this->oriName, PATHINFO_EXTENSION);       //保放的文件名
            $destination = $upload_file_dir . DIRECTORY_SEPARATOR . $uniName;       //放文件的地址

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $this->stateInfo = $this->stateMap[0];
                return "/upload/".substr($upload_file_dir, strrpos($upload_file_dir, "/") +1)."/".$uniName;
            } else {
                $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
                return '';
            }
        } else {
            return '';
        }

    }
}