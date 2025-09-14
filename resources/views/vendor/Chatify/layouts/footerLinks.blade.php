<script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
<script >
    // Gloabl Chatify variables from PHP to JS
    window.chatify = {
        name: "{{ config('chatify.name') }}",
        sounds: {!! json_encode(config('chatify.sounds')) !!},
        allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
        allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
        maxUploadSize: {{ Chatify::getMaxUploadSize() }},
        pusher: {!! json_encode(config('chatify.pusher')) !!},
        pusherAuthEndpoint: '{{route("pusher.auth")}}'
    };
    window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);

    let fullScreenVideo = null;

  function playFullScreen(video) {
    if (video.paused) {
      // درخواست فول‌اسکرین
      if (video.requestFullscreen)             video.requestFullscreen();
      else if (video.mozRequestFullScreen)     video.mozRequestFullScreen();
      else if (video.webkitRequestFullscreen)  video.webkitRequestFullscreen();
      else if (video.msRequestFullscreen)      video.msRequestFullscreen();

      // نگه‌داشتن مرجع ویدیو و شروع پخش
      fullScreenVideo = video;
      video.play();
      // مخفی کردن دکمهٔ پلی
      video.nextElementSibling.style.display = 'none';
    } else {
      // وقتی دوباره کلیک شد: متوقف و خروج از فول‌اسکرین
      video.pause();
      fullScreenVideo = null;
      if (document.exitFullscreen)             document.exitFullscreen();
      else if (document.mozCancelFullScreen)   document.mozCancelFullScreen();
      else if (document.webkitExitFullscreen)  document.webkitExitFullscreen();
      else if (document.msExitFullscreen)      document.msExitFullscreen();
      video.nextElementSibling.style.display = 'flex';
    }
  }

  // شنیدن رویداد تغییر وضعیت فول‌اسکرین در همهٔ مرورگرها
  ['fullscreenchange','webkitfullscreenchange','mozfullscreenchange','MSFullscreenChange']
    .forEach(evtName => {
      document.addEventListener(evtName, () => {
        // اگر دیگر عنصری فول‌اسکرین نیست
        const isFs = document.fullscreenElement 
                  || document.webkitIsFullScreen 
                  || document.mozFullScreen 
                  || document.msFullscreenElement;
        if (!isFs && fullScreenVideo) {
          fullScreenVideo.pause();
          // دوباره دکمهٔ پلی را نمایش ده
          fullScreenVideo.nextElementSibling.style.display = 'flex';
          fullScreenVideo = null;
        }
      });
  });
  
  
  
  
  
  
  
  
  let mediaRecorder, audioChunks = [];
let isRecording = false,
    isRecordingLocked = false,
    recordStartY = 0;

const micBtn    = $("#startRecord");
const sendBtn   = $(".send-button");
const cancelBtn = $("#cancelRecording");
const sendCard  = $(".messenger-sendCard");

// اطمینان از پوزیشن relative برای درست چیدمان فلش
sendCard.css("position", "relative");

// شروع ضبط
micBtn.on("mousedown touchstart", async function(e) {
  e.preventDefault();
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    mediaRecorder = new MediaRecorder(stream);
    audioChunks = [];
    mediaRecorder.start();
    startRecordingTimer(); // ← اضافه کن بعد از start
    isRecording = true;
    isRecordingLocked = false;
    recordStartY = e.pageY || e.originalEvent.touches[0].pageY;

    mediaRecorder.ondataavailable = ev => audioChunks.push(ev.data);

    // UI
    $(" .emoji-button, .m-send , .upload-attachment-label" ).hide();
    sendCard.find(".recording-bar").show();
    sendCard.find(".record-hint").show().html(`<svg viewBox="0 0 576 512"  xmlns="http://www.w3.org/2000/svg" class="lock-open"><path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z"></path></svg>`);
  } catch (err) {
    alert("برای ضبط ویس لطفاً دسترسی میکروفن را تایید کنید.");
  }
});

// کشیدن موس به بالا برای قفل
$(document).on("mousemove touchmove", function(e) {
  if (!isRecording) return;
  const currentY = e.pageY || (e.originalEvent.touches && e.originalEvent.touches[0].pageY);
  if (recordStartY - currentY > 50 && !isRecordingLocked) {
    isRecordingLocked = true;
    sendCard.find(".record-hint").html('<svg viewBox="0 0 448 512"  xmlns="http://www.w3.org/2000/svg" class="lock"><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path></svg>');
  }
});

// رها کردن موس
$(document).on("mouseup touchend", function() {
  if (!isRecording) return;

  // اگر قفل نشده، ضبط رو قطع و خودکار ارسال کن
  if (!isRecordingLocked) {
    finishRecordingAndSend();
  }
  // در غیر این صورت، نگه داری ضبط تا ارسال دستی
});

// تابع مشترک برای قطع ضبط و ارسال
function finishRecordingAndSend() {
  isRecording = false;
  sendCard.find(".recording-bar, .record-hint").hide();
  stopRecordingTimer(); // ← قبل از stop
  mediaRecorder.stop();

  mediaRecorder.onstop = () => {
    const blob = new Blob(audioChunks, { type: "audio/webm" });

    // حتماً Blob از نوع درست ساخته بشه و بعد توی window ذخیره بشه
    if (blob && blob.size > 0) {
      window.chatifyVoiceBlob = blob;

      // اجرای تابع ارسال
      sendMessage();

      // ریست UI بعد از ارسال
      resetRecorderUI();
    } else {
      alert("ضبط ویس ناموفق بود.");
      resetRecorderUI();
    }
  };
}


// ارسال پیام صوتی با AJAX
function sendVoiceMessage() {
  if (!window.chatifyVoiceBlob) return;
  // prepare FormData و ارسال به سرور
  const fd = new FormData();
  fd.append("id", getMessengerId());
  fd.append("audio", window.chatifyVoiceBlob, "voice.webm");
  fd.append("_token", csrfToken);
  $.ajax({
    url: $("#message-form").attr("action"),
    method: "POST",
    data: fd,
    processData: false,
    contentType: false,
    success: () => {
      window.chatifyVoiceBlob = null;
      // ریست UI پس از ارسال
      resetRecorderUI();
    }
  });
}

// کلیک روی دکمه ارسال (حالت دستی)
sendBtn.on("click", function(e) {
  if (isRecordingLocked && isRecording) {
    e.preventDefault();
    finishRecordingAndSend();
  }
});


// لغو ضبط
cancelBtn.on("click", function(e) {
  e.preventDefault();
  if (isRecording) {
    stopRecordingTimer(); // ← اضافه کن
    mediaRecorder.stop();
  }
  resetRecorderUI();
});

// ریست کردن UI و متغیرها
function resetRecorderUI() {
  isRecording = false;
  isRecordingLocked = false;
  audioChunks = [];
  window.chatifyVoiceBlob = null;
  $(".upload-attachment-label, .emoji-button, .m-send").show();
  sendCard.find(".recording-bar, .record-hint").hide();
  stopRecordingTimer(); // ← اضافه کن

}

// تایمر ضبط
let recordingInterval;
let startTime = 0;

function startRecordingTimer() {
  const timerEl = document.querySelector('.recording-timer');
  startTime = Date.now();
  
  recordingInterval = setInterval(() => {
    const elapsed = Date.now() - startTime;
    const totalSeconds = Math.floor(elapsed / 1000);
    const centiseconds = Math.floor((elapsed % 1000) / 10);
    const m = Math.floor(totalSeconds / 60);
    const s = totalSeconds % 60;

    timerEl.textContent = `${m}:${s < 10 ? '0' + s : s}.${centiseconds < 10 ? '0' + centiseconds : centiseconds}`;
  }, 10);
}

function stopRecordingTimer() {
  clearInterval(recordingInterval);
  const timerEl = document.querySelector('.recording-timer');
  timerEl.textContent = "0:00.00";
}

let editingMessageId = null;

$(document).on("click", ".edit-icon", function () {
    const msgId = $(this).data("message-id");
    const msgText = $(this).data("message");

    editingMessageId = msgId;
    $("#editing-message-text").text(msgText);
    $("textarea[name='message']").val(msgText);
    $("#editing-message-preview").css("display", "flex");
  });

// لغو ویرایش
$(document).on("click", "#cancel-edit", function () {
    editingMessageId = null;
    $("#editing-message-preview").hide();
    $("textarea[name='message']").val('');
});


</script>
<script src="{{ asset('js/chatify/utils.js') }}"></script>
<script src="{{ asset('js/chatify/code.js') }}"></script>
