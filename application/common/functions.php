<?php

if (!function_exists('file_list'))
{
    /**
     * 获取本地目录下所有文件
     */
    function file_list($dir, $fileList=[])
    {
        if(!is_dir($dir)){
            throw new \Exception('Not a folder');
        }
        $dir  = rtrim($dir,DIRECTORY_SEPARATOR);
        $list = array_diff(scandir($dir), ['.', '..']);
        foreach($list as $file){
            //跳过.开头的文件
            if(strncasecmp($file, '.', 1) == 0){ 
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR .$file;
            if(is_dir($path)){
                $fileList = file_list($path,$fileList);
            }else{
                $fileList[] = $path;
            }
        }
        $list = null;
        return $fileList;
    }  
}
if (!function_exists('file_list_info'))
{
     /*  
      * 递归获取文件夹中所有文件信息
      */
      function file_list_info($dir)
      {
        if(!is_dir($dir)){
            throw new \Exception('Not a folder');
        }   
        $fileList = file_list($dir);
        $list = []; 
        foreach($fileList as $file){
            $list[] = file_info($file);
        }   
        $fileList = null;
        return $list;
    }
}
if (!function_exists('file_info'))
{
     /* 
      * 获取文件信息
      */
     function file_info($file)
     {
        if(!file_exists($file)){
            throw new \Exception('File does not exist');
        }
        $info['filename']    = basename($file);
        $info['dirname']     = dirname($file);
        $info['path']        = realpath($file);
        $info['owner']       = fileowner($file);
        $info['fileperms']   = substr(base_convert(fileperms($file), 10, 8), -4);
        $info['fileatime']   = fileatime($file);
        $info['filectime']   = filectime($file);
        $info['filemtime']   = filemtime($file);
        $info['filesize']    = filesize($file);
        $info['filetype']    = filetype($file);
        // $info['ext']         = is_file($file) ? strtolower(substr(strrchr(basename($file), '.'), 1)) : '';
        $info['is_dir']      = is_dir($file);
        $info['is_file']     = is_file($file);
        $info['is_link']     = is_link($file);
        $info['is_readable'] = is_readable($file);
        $info['is_writable'] = is_writable($file);
        $info['md5_file']    = md5_file($file);
        $info['ext']         = file_ext($file);
        $info['file_size']   = format_bytes($info['filesize']);
        $info['file_atime']  = date('Y-m-d H:i:s',$info['fileatime']);
        $info['file_ctime']  = date('Y-m-d H:i:s',$info['filectime']);
        $info['file_mtime']  = date('Y-m-d H:i:s',$info['filemtime']);
        return $info;
    }
}
if (!function_exists('file_ext'))
{
     /*
      * 获取文件后缀
      */
      function file_ext($file)
      {
        $mimeType = mime_content_type($file);
        if(empty($mimeType)){
            return '';
        }
        $ext = explode(DIRECTORY_SEPARATOR,$mimeType);
        return array_shift($ext);
        // return finfo_file(finfo_open(FILEINFO_EXTENSION),$file);
    }
}
if (!function_exists('format_bytes'))
{
     /*
      * 格式化字节大小
      */
    function format_bytes($size, $delimiter = '')
    {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
}