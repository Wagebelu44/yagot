// const microphone = navigator.permissions.query({ name: 'microphone' })
// navigator.permissions.remove(microphone)

let constraintObj = { 
    audio: true,
    video:false
}; 

//handle older browsers that might implement getUserMedia in some way
if (navigator.mediaDevices === undefined) {
    navigator.mediaDevices = {};
    getUserMedia = function(constraintObj) {
        let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (!getUserMedia) {
            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }
        return new Promise(function(resolve, reject) {
            getUserMedia.call(navigator, constraintObj, resolve, reject);
        });
    }
}else{
    navigator.mediaDevices.enumerateDevices()
    .then(devices => {
        devices.forEach(device=>{
            // console.log(device.kind.toUpperCase(), device.label);
            //, device.deviceId
        })
    })
    .catch(err=>{
        // console.log(err.name, err.message);
    })
}
let mediaRecorder = null;
let streamObj  =null;
let start = document.getElementById('btnStart');
let stop = document.getElementById('btnStop');
let cancel = document.getElementById('btnCancel');
let globalTrack = null;
start.addEventListener('click', (ev)=>{
    // if(!mediaRecorder){


    // }
    // else{
    //     mediaRecorder.start();
    //     start.classList.add('d-none');
    //     stop.classList.remove('d-none');
    //     cancel.classList.remove('d-none');
    //     console.log(mediaRecorder.state);
    // }

    navigator.permissions.query({name:'geolocation'}).then(function(result) {
        // if (result.state == 'granted') {
            navigator.mediaDevices.getUserMedia(constraintObj)
            .then(function(mediaStreamObj) {
            streamObj = mediaStreamObj;
            //connect the media stream to the first video element
            // let audio = document.getElementById('audioRecording');
            const options = {mimeType: 'audio/mpeg-3'};
            
            //add listeners for saving video/audio

            mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = [];
            
                mediaRecorder.start();
                start.classList.add('d-none');
                stop.classList.remove('d-none');
                cancel.classList.remove('d-none');
                console.log(mediaRecorder.state);
            stop.addEventListener('click', (ev)=>{
                mediaStreamObj.getTracks()[0].stop();
                mediaRecorder.stop();
                start.classList.remove('d-none');
                stop.classList.add('d-none');
                cancel.classList.add('d-none');
                console.log(mediaRecorder.state);
            });
            cancel.addEventListener('click', (ev)=>{
                window.cancel = true;
                mediaRecorder.stop();
                window.audioRecording = null;
                start.classList.remove('d-none');
                stop.classList.add('d-none');
                cancel.classList.add('d-none');
                console.log(mediaRecorder.state);
            })
            mediaRecorder.ondataavailable = function(ev) {
                chunks.push(ev.data);
            }
            let mediaUrl='';
            mediaRecorder.onstop = (ev)=>{
                // mediaStreamObj.stop();
                let blob = new Blob(chunks, { 'type' : 'audio/mpeg' });
                chunks = [];
                let audioURL = window.URL.createObjectURL(blob);
                // audio.src = audioURL;
                window.audioRecording = blob;

               
                var group_Id = $('.groupId').val();

                let storageRef = firebase.storage().ref();
                
                var audio_name = Date.now()+'.mp3';
                let photoRef = storageRef.child('audios/'+group_Id+'/'+audio_name);
                console.log('sssssssssssssssss');

                if(!window.cancel){

                    // console.log('dur',blob.duration);
                photoRef.put(window.audioRecording).then(function(snapshot) {
                    console.log('Uploaded a blob or file!');

                    snapshot.ref.getDownloadURL().then(function(downloadURL,mediaUrl) {
                        console.log("File available at", downloadURL);
                        mediaUrl = downloadURL;

                            const data = [];
                            data['groupId'] = $('.groupId').val();
                            data['receiverUid'] = $('.userId').val();
                            data['receiverName'] = $('.name').val();
                            data['receiverImage'] = $('.image').val();
                            data['senderUid'] = $('.senderUid').val();
                            data['senderImage'] = $('.senderImage').val();
                            data['senderName'] = $('.senderName').val();
                            data['type'] = 'audio';
                       
                            firebase.database().ref('chat_rooms/'+group_Id+'/messages').push({
                                groupId:data['groupId'],
                                message:'',
                                receiverUid:data['receiverUid'],
                                receiverName:data['receiverName'],
                                receiverImage:data['receiverImage'],
                                senderImage:data['senderImage'],
                                senderUid:data['senderUid'],
                                senderName:data['senderName'],
                                type:data['type'],
                                mediaUrl:mediaUrl,
                                
                            });
                            
                            firebase.database().ref('Recent/'+group_Id).set({
                                groupId:data['groupId'],
                                message:'',
                                receiverUid:data['receiverUid'],
                                receiverName:data['receiverName'],
                                receiverImage:data['receiverImage'],
                                senderImage:data['senderImage'],
                                senderUid:data['senderUid'],
                                senderName:data['senderName'],
                                type:data['type'],
                                mediaUrl:mediaUrl,
                            });
                    
                    
                            firebase.database().ref('Seen/'+data['groupId']+'/'+data['receiverUid']+'/counter').on('value',(snap)=>{
                                counter = snap.val() + 1;
                                firebase.database().ref('Seen/'+data['groupId']+'/'+data['receiverUid']+'/counter').set(counter);
                            });
                        

                    }); 

                });

                }
                window.cancel = false;

            }
        
        
        })
        .catch(function(err) { 
            //console.log(err.name, err.message); 
        });

       });


})

