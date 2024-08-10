<?php


$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/channels/followers?broadcaster_id=".$_GET["user"]."&user_id=".$_GET["followed"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer '.$_GET["access_token"],
    'Client-Id: fflmnby8lt25fwu14nke6hukayyhwc'
]);
$result=curl_exec($ch);
curl_close($ch);
$userdata = json_decode($result);
if(count($userdata->data) > 0)
{
    echo '<div class="alert alert-success" role="alert">';
    echo 'User Following you since: '.$userdata->data[0]->followed_at;
    echo '</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">';
    echo 'User Not Following you!';
    echo '</div>';
}
//echo $result;

?>