<?php
        if (isset ($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH']> 0) {
            $httpContent = fopen ('php://input', 'r');
            $data = stream_get_contents($httpContent);
            fclose ($httpContent);
            $files = json_decode ($data, true);
            $file = str_replace('data:image/jpeg;base64,', '', $files['file']);
            $file = str_replace(' ', '+', $file);
            $fileBinary = base64_decode($file);
            $sFileName = "file_{$imageNumber}";
            $arResult = array($sFileName => array());
            $arResult[$sFileName]['id'] = uniqid();
            $sPhotoFilename = "{$arResult[$sFileName]['id']}.jpg";
            $sTempPhotoPath = $sTempDirectory . $sPhotoFilename;
            file_put_contents($sTempPhotoPath, $fileBinary);
        }

        echo json_encode($arResult);
        exit();
