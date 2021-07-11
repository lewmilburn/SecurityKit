<?php
    function checkData($mode, $data)
    {
        global $conn;

        $data = mysqli_real_escape_string($conn, $data);
        $data = dataChecker($data, '<?', '&lt;?');
        $data = dataChecker($data, '<script src=', '&lt;script src=');
        $data = dataChecker($data, '<script src =', '&lt;script src =');
        $data = dataChecker($data, '<link', '&lt;link');
        if ($mode == 'DEFAULT') {
            $data = htmlspecialchars($data);
            $data = dataChecker($data, '<script', '&lt;script');
            $data = dataChecker($data, '<css', '&ltstyle');
            $data = dataChecker($data, 'css =', 'blocked =');
            $data = dataChecker($data, 'css=', 'blocked=');
        } elseif ($mode == 'HTML') {
            $data = dataChecker($data, '<script', '&lt;script');
            $data = dataChecker($data, '<css', '&ltstyle');
            $data = dataChecker($data, 'css =', 'blocked =');
            $data = dataChecker($data, 'css=', 'blocked=');
        } elseif ($mode == 'TAGCSS') {
            $data = dataChecker($data, '<script', '&lt;script');
            $data = dataChecker($data, '<css', '&ltstyle');
        } elseif ($mode == 'CSS') {
            $data = dataChecker($data, '<script', '&lt;script');
        } elseif ($mode == 'JS') {
            $data = dataChecker($data, '<css', '&ltstyle');
            $data = dataChecker($data, 'css =', 'blocked =');
            $data = dataChecker($data, 'css=', 'blocked=');
        }

        return $data;
    }

    function dataChecker($data, $illegalCode, $replacement): string
    {
        if (strpos($data, $illegalCode) !== false) {
            $data = str_ireplace($data, $illegalCode, $replacement);
        }

        return $data;
    }
