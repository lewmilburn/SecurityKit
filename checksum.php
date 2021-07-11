<?php
    function checksum_generate($data): string
    {
        return hash('sha512', $data);
    }

    function checksum_validate($data, $hash): bool
    {
        $dataHash = hash('sha512', $data);
        if ($hash == $dataHash) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }
