<?php
return array(
    "base_url" => URL::to('/social/authenticate/auth'),
    "providers" => array(
        "twitter" => array(
            "enabled" => true,
            "keys" => array(
                "key" => "mykey",
                "secret" => "9mysecret"
                )
        ),
        "Facebook" => array(
            "enabled" => true,
            "keys" => array(
                "id" => "450678531689902",
                "secret" => "d7fc69ad6f91877aa6c64269cc656e59"
                )
        )
    ),
);
