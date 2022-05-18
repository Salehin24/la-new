//all js 

//================= live streming start=============
$(document).ready(function () {
    var zoom_api_key = $("#zoom_api_key").val();
    var zoom_api_secret = $("#zoom_api_secret").val();
    var meetingID = $("#meetingID").val();
    var name = $("#name").val();
    var meeting_password = $("#meeting_password").val();
    var leaveUrl = $("#leaveUrl").val();

    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }

    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareJssdk();
    var meetConfig = {
        apiKey: zoom_api_key,
        apiSecret: zoom_api_secret,
        meetingNumber: meetingID,
        userName: name,
        passWord: meeting_password,
        leaveUrl: leaveUrl,
        role: parseInt(0, 10)
    };
    var signature = ZoomMtg.generateSignature({
        meetingNumber: meetConfig.meetingNumber,
        apiKey: meetConfig.apiKey,
        apiSecret: meetConfig.apiSecret,
        role: meetConfig.role,
        success: function (res) {
            console.log(res.result);
            // ZoomMtg.getAttendeeslist({});
            // ZoomMtg.getCurrentUser({
            //   success: function (res) {
            //     console.log("success getCurrentUser", res.result.currentUser);
            //   },
            // });
        }
    });
    ZoomMtg.init({
        leaveUrl: meetConfig.leaveUrl,
        isSupportAV: true,
        success: function () {
            ZoomMtg.join(
                    {
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: signature,
                        apiKey: meetConfig.apiKey,
                        passWord: meetConfig.passWord,
                        success: function (res) {
                            $('#nav-tool').hide();
                        },
                        error: function (res) {
                            console.log(res);
                            alert(res.result);
                        }
                    }
            );
        },
        error: function (res) {
            console.log(res);
        }
    });

});
