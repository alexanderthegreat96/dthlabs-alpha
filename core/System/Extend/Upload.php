<?php

namespace LexSystems\Core\System\Extend;

use LexSystems\Framework\Config\App\Config;

class Upload
{
    /**
     * @var FileSystem
     */

    protected $filesystem;

    /**
     * @var \Rundiz\Upload\Upload
     */

    protected $uploader;


    public function __construct()
    {
        $this->filesystem = new FileSystem();
    }

    /**
     * @param string $inputKey
     * @param string $fileName
     * @param bool $allowOverwrite
     * @param array|string[] $allowedExt
     * @param array|int[] $maxImgDim
     * @return array|void
     */

    public function bulkUpload(
        string $inputKey = 'my-file', bool $allowOverwrite = false,
        array  $allowedExt = ['gif', 'zip', 'png', 'jpg', 'jpeg', 'pdf', 'mp3', 'mp4'], array $maxImgDim = [1280, 720])
    {
        $uploader = new \Rundiz\Upload\Upload($inputKey);
        $Upload = new \Rundiz\Upload\Upload($inputKey);
        $Upload->move_uploaded_to = $this->filesystem->getRootPath() . '/' .$this->filesystem->organize();
        $Upload->allowed_file_extensions = $allowedExt;
        $Upload->max_file_size = Config::MAX_UPLOAD_SIZE;
        $Upload->max_image_dimensions = $maxImgDim;
        $Upload->overwrite = $allowOverwrite;
        $Upload->web_safe_file_name = true;
        $Upload->security_scan = true;
        $Upload->stop_on_failed_upload_multiple = false;
        $Upload->calculate_hash_file = true;
        $upload_result = $Upload->upload();
        if ($upload_result === true) {
            return ['status' => true, 'data' => $Upload->getUploadedData()];
        } else {
            if (is_array($Upload->error_messages) && !empty($Upload->error_messages)) {
                return ['status' => false, 'errors' => $Upload->error_messages];
            }
        }
    }

    /**
     * @param string $inputKey
     * @param string $filename
     * @param bool $allowOverwrite
     * @param array|string[] $allowedExt
     * @param array|int[] $maxImgDim
     * @return array|void
     */
    public function upload(string $inputKey  = '', string $filename = '',bool $allowOverwrite = true, array  $allowedExt = ['gif', 'zip', 'png', 'jpg', 'jpeg', 'pdf', 'mp3', 'mp4'], array $maxImgDim = [1280, 720])
    {
        $uploader = new \Rundiz\Upload\Upload($inputKey);
        $Upload = new \Rundiz\Upload\Upload($inputKey);
        $Upload->move_uploaded_to = $this->filesystem->getRootPath() . '/' .$this->filesystem->organize();
        $Upload->allowed_file_extensions = $allowedExt;
        $Upload->max_file_size = Config::MAX_UPLOAD_SIZE;
        $Upload->max_image_dimensions = $maxImgDim;
        if ($filename) {
            $Upload->new_file_name = $filename;
        }
        $Upload->overwrite = $allowOverwrite;
        $Upload->web_safe_file_name = true;
        $Upload->security_scan = true;
        $Upload->stop_on_failed_upload_multiple = false;
        $Upload->calculate_hash_file = true;
        $upload_result = $Upload->upload();
        if ($upload_result === true) {
            return ['status' => true, 'data' => $Upload->getUploadedData()];
        } else {
            if (is_array($Upload->error_messages) && !empty($Upload->error_messages)) {
                return ['status' => false, 'errors' => $Upload->error_messages];
            }
        }
    }
}