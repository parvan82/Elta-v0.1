<div class="messenger-sendCard">

    <div id="editing-message-preview" style="display: none; justify-content: space-between; padding:5px 10px; margin:5px 5px 0px 5px ; background:rgba(255, 255, 255, 0.1); border-radius: 6px;">
        <i id="cancel-edit" class="fas fa-times" style=" font-size:15px; margin:5px; cursor:pointer; color: #888;"></i>
        <span id="editing-message-text" style="color:white; margin-top:2px;"></span>
    </div>
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <button type="button" id="startRecord"><i class="fas fa-microphone"></i></button>
        <button type="button" id="stopRecord" style="display:none;"><i class="fas fa-stop"></i></button>
        <audio id="audioPreview" controls style="display:none;"></audio>
            <div class="recording-bar">
                <div class="recording-status">
                    <div class="recording-timer">0:00.00</div>
                    <span class="recording-icon"></span>
                </div>
                <button type="button" id="cancelRecording" class="card-button primary cancel-btn">لغو</button>
            </div>
    <div class="record-hint">
    </div>
        <label class="upload-attachment-label">
            <span class="fas fa-solid fa-plus"></span>
            <input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" />
        </label>

        <button class="emoji-button"><span class="fas fa-smile"></span></button>

        <textarea readonly="readonly" name="message" class="m-send app-scroll" placeholder="پیامتو بنویس..." style="direction: rtl; text-align: right; padding-top:13px;"></textarea>

        <button disabled='disabled' class="send-button"><span class="fas fa-paper-plane"></span></button>
    </form>

</div>
