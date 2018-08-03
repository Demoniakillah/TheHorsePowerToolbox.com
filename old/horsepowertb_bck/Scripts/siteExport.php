<?php

require_once(dirname(__FILE__) . '/../Config/conf.php');

function read($dir)
{
    $files = scandir($dir);
    $output = array();
    foreach ($files as $file) {
        if (!preg_match('/^.$|^..$|^.git$|^.idea$|^apache$/', $file)) {
            if (is_dir($dir . '/' . $file)) {
                $subDir = $dir . '/' . $file;
                print_r("\033[32m" . 'READ SUBDIR ' . $subDir . "\033[0m\n");
                $output = array_merge($output, read($subDir));
            } elseif (is_file($dir . '/' . $file)) {
                $appendFile = $dir . '/' . $file;
                print_r("\033[32m" . 'PREPARE FILE ' . $appendFile . ' TO BE SEND' . "\033[0m\n");
                $output[] = $appendFile;
            } else {
                print_r("\033[31m" . 'ERROR DURING READ ' . $dir . '/' . $file . "\033[0m\n");
            }
        } else {
            print_r("\033[33m" . $dir . '/' . $file . ' IGNORED' . "\033[0m\n");
        }
    }
    return $output;
}

$connectionId = @ftp_connect($server, $port);
if ($connectionId == false) {
    die('cannot connect to ftp server');
} else {
    $loginResult = @ftp_login($connectionId, $login, $password);
    if ($loginResult == false) {
        die('login/password is not correct');
    } else {
        $filesToPush = read($projectDir);
        foreach ($filesToPush as $fileToPush) {
            $targetFile = preg_replace("#$projectDir#", '', $fileToPush);
            $targetDirectory = dirname($targetFile);
            print_r("\033[34m" . 'PUSH FILE ' . $fileToPush . ' TO FTP SERVER IN ' . $targetFile . "\033[0m\n");
            if (is_dir("ftp://$login:$password@$server:$port$targetDirectory") === false) {
                $toCreate = '';
                $remoteSubDirectories = explode('/', $targetDirectory);
                foreach ($remoteSubDirectories as $remoteSubDirectory) {
                    $toCreate .= $remoteSubDirectory . '/';
                    if (is_dir("ftp://$login:$password@$server:$port$toCreate") === false) {
                        print_r("\033[33m" . 'REMOTE DIRECTORY ' . $toCreate . ' DOES NOT EXIST CREATE IT' . "\033[0m\n");
                        $createResult = @ftp_mkdir($connectionId, $toCreate);
                        if ($createResult == false) {
                            print_r("\033[31m" . 'ERROR DURING CREATE REMOTE DIRECTORY ' . $toCreate . "\033[0m\n");
                        }
                    }
                }
            }
            $putRes = @ftp_put($connectionId, $targetFile, $fileToPush, FTP_BINARY);
            if ($putRes == false) {
                print_r("\033[31m" . 'ERROR DURING PUSH FILE ' . $fileToPush . ' TO ' . $targetFile . "\033[0m\n");
            }
        }
    }
}
@ftp_close($connectionId);