<?php

//https://vigilsoft.net/MootBoot/getmutual.php?access_token=wkr76k2xw9vmxc7tlkberue3ipvttm&user=933978243&followed=426226194
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/users?login=".$_GET["user"]);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer '.$_GET["access_token"],
    'Client-Id: fflmnby8lt25fwu14nke6hukayyhwc'
]);
$result=curl_exec($ch);
curl_close($ch);
$userdata = json_decode($result);
//echo $userdata;
//$_GET["user"]
//cho "UserId: ".$userdata->data[0]->id;

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if($_GET["page"]=="")
{
    curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/channels/followed?first=100&user_id=".$userdata->data[0]->id);
} else {
    curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/channels/followed?first=100&user_id=".$userdata->data[0]->id."&after=".$_GET["page"]);
    //echo "https://api.twitch.tv/helix/channels/followed?first=100&user_id=".$userdata->data[0]->id."&after=".$_GET["page"];
}



curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer '.$_GET["access_token"],
    'Client-Id: fflmnby8lt25fwu14nke6hukayyhwc'
]);

$followedresult=curl_exec($ch);
//echo $followedresult;

$followeddata = json_decode($followedresult);
for ($x = 0; $x <= count($followeddata->data); $x++) {
    echo '<div class="card" style="width: 18rem; id="Entry_'.$followeddata->data[$x]->broadcaster_id.'">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title"><a href="https://www.twitch.tv/'.$followeddata->data[$x]->broadcaster_login.'" target="_blank">'.$followeddata->data[$x]->broadcaster_name.'</a></h5>';  
    echo '<p class="card-text">Userid: '.$followeddata->data[$x]->broadcaster_id.'</p>';
    echo '</div>';
    echo '<ul class="list-group list-group-flush">';
    echo '<li class="list-group-item">Followed on: '.$followeddata->data[$x]->followed_at.'</li>';
    echo '<li class="list-group-item"><button type="button" class="btn btn-primary" id="'.$followeddata->data[$x]->broadcaster_id.'" value="'.$userdata->data[0]->id.'" onclick="GetMutual(this)">Check Mutual</button></li>';
    echo '<li class="list-group-item" id="result_'.$followeddata->data[$x]->broadcaster_id.'"></li>';
    echo '</ul>';
    echo '</div>';
    echo '<br/>';
}
echo '</span><span id="'.$followeddata->pagination->cursor.'">';
echo '<button type="button" class="btn btn-primary" id="'.$followeddata->pagination->cursor.'" onclick="Loadmore(this)">Load Next 100</button>';
echo '</span>';
?>