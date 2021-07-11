<?php
    function checkData($data, $illegalCode, $replacement): string
    {
        if (strpos($data, $illegalCode) !== false) {
            $data = str_ireplace($data, $illegalCode, $replacement);
        }

        return $data;
    }
