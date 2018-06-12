<?php
function HelpIcon($title, $text)
{
    return '<img border="0" align="absbottom" src="images/admin/help.png" class="tip" title="' .  $title . ' :: ' .  $text . '">&nbsp;&nbsp;';
}

function getSteps($step)
{
    $steps = [
        1 => 'License Agreement',
        2 => 'Database Information',
        3 => 'System Requirements',
        4 => 'Table Creation',
        5 => 'Initial Setup'
    ];

    foreach ($steps as $key => $value) {
        $str = "Step $key: $value";

        switch (true) {
            case $key == $step:
                $str = "<b>$str</b>";
                break;
            case $key < $step:
                $str = "<strike>$str</strike>";
                break;
        }
        $out[] = $str;
    }
    return $out;
}

function CreateQuote()
{
    $quotes = [
        ["Buy a new PC!", "Viper"],
        ["I'm not lazy! I just utilize technical resources!", "Brizad"],
        ["I need to mow the lawn", "sslice"],
        ["Like A Glove!", "Viper"],
        ["Your a Noob and You Know It!", "Viper"],
        ["Get your ass ingame", "Viper"],
        ["Mother F***ing Peices of Sh**", "Viper"],
        ["Shut up Bam", "[Everyone]"],
        ["Hi OllyBunch", "Viper"],
        ["Procrastination is like masturbation. Sure it feels good, but in the end you're only F***ing yourself!", "[Unknown]"],
        ["Rave's momma so fat she sat on the beach and Greenpeace threw her in", "SteamFriend"],
        ["Im just getting a beer", "Faith"],
        ["To be honest..., I DONT CARE!", "Viper"],
        ["Yams", "teame06"],
        ["built in cheat 1.6 - my friend told me theres a cheat where u can buy a car door and run around and it makes u invincible....", "gdogg"],
        ["i just join conversation when i see a chance to tell people they might be wrong, then i quickly leave, LIKE A BAT", "BAILOPAN"],
        ["Lets just blame it on FlyingMongoose", "[Everyone]"],
        ["I wish my lawn was emo, so it would cut itself", "SirTiger"]
    ];
    $rand = rand(0, count($quotes) - 1);
    return ['quote' => $quotes[$rand][0], 'author' => $quotes[$rand][1]];
}
