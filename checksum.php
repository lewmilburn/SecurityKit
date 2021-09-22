<?php
    function checksum_generate($data): string
    {
        return hash(SK_CHECKSUM_HASH, $data);
    }

    function checksum_validate($data, $hash): bool
    {
        $dataHash = hash(SK_CHECKSUM_HASH, $data);
        if ($hash == $dataHash) {
            $return = true;
        } else {
            $return = false;
        }

        return $return;
    }
