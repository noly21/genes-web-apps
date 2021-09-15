
    // Render Google Sign-in button
    function renderButton() {
        gapi.signin2.render('gSignIn2', {
            'scope': 'profile email',
            'width': 240,
            'height': 50,
            'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }
    
    // Sign-in success callback
    function onSuccess(googleUser) {
        // Get the Google profile data (basic)
        //var profile = googleUser.getBasicProfile();
        
        // Retrieve the Google account data
        gapi.client.load('oauth2', 'v2', function () {
            var request = gapi.client.oauth2.userinfo.get({
                'userId': 'me'
            });
            request.execute(function (resp) {
                // Display the user details
                // var profileHTML = '<h3>Welcome '+resp.given_name+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></h3>';
                // profileHTML += '<img src="'+resp.picture+'"/><p><b>Google ID: </b>'+resp.id+'</p><p><b>Name: </b>'+resp.name+'</p><p><b>Email: </b>'+resp.email+'</p><p><b>Gender: </b>'+resp.gender+'</p><p><b>Locale: </b>'+resp.locale+'</p><p><b>Google Profile:</b> <a target="_blank" href="'+resp.link+'">click to view profile</a></p>';
                // document.getElementsByClassName("userContent")[0].innerHTML = profileHTML;
                
                // document.getElementById("gSignIn").style.display = "none";
                // document.getElementsByClassName("userContent")[0].style.display = "block";
    
                 saveUserData(resp);
            });
        });
    }
    
    // Sign-in failure callback
    function onFailure(error) {
        alert(error);
    }
    // Save user data to the database
    function saveUserData(userData){
      var targeturl = $('input[name="target_url"]').val();
      var _token = $('input[name="token"]').val();
       $.ajax({
             
             type: "POST",  // Request method: post, get
             data:JSON.stringify({userdata:userData}), 
             url:targeturl,
             headers: {
                // 'X-CSRF-Token': '<?= h($this->request->getParam("_csrfToken")); ?>'
                'X-CSRF-Token': _token
            },
            contentType: "json",
             success: function(data) {
               if (JSON.parse(data)['status'] = 'true') {
                 window.location = JSON.parse(data)['url'];
               }
              },
               error:function (XMLHttpRequest,error, textStatus, errorThrown) {
                alert(error);
             }
          });
         
    }
    // Sign out the user
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            document.getElementsByClassName("userContent")[0].innerHTML = '';
            document.getElementsByClassName("userContent")[0].style.display = "none";
            document.getElementById("gSignIn").style.display = "block";
        });
        
    
        auth2.disconnect();
    }
    function myFunction() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            console.log('User signed out.');
          });
      }