var hash = window.location.hash.substr(1);

var accesstoken = "";

var result = hash.split('&').reduce(function (res, item) {
    var parts = item.split('=');
    res[parts[0]] = parts[1];
    return res;
}, {});

function ShowAccess() {
    accesstoken = result['access_token'];
    document.getElementById("myText").innerHTML = accesstoken;
  };

 function GetMutual(elem)
 {
    $(this).click(function(){
        var id = $(elem).attr('id');
        var bid = $(elem).attr('value');
        $.get("https://vigilsoft.net/MootBoot/getmutual.php?access_token="+accesstoken+"&user="+bid+"&followed="+id, function(data, status){
          document.getElementById("result_"+id).innerHTML = data;  
          
        });
      });
 };

function Loadmore(elem)
{
    $(this).click(function(){
        var id = $(elem).attr('id');
        $.get("https://vigilsoft.net/MootBoot/fetchfollowers.php?access_token="+accesstoken+"&user="+document.getElementById("username").value+"&page="+id, function(data, status){
            document.getElementById(id).innerHTML = data;  
            //elem.remove();           
        });
    });
};


  $(document).ready(function(){
    $("button#GetFollows").click(function(){
      $.get("https://vigilsoft.net/MootBoot/fetchfollowers.php?access_token="+accesstoken+"&user="+document.getElementById("username").value, function(data, status){
        document.getElementById("results").innerHTML = data;  
      });
    });
  });



