<?php
$seen = $seen ?? false;
$created_at = $created_at ?? now();
$isSender = $isSender ?? false;
$timeAgo = $timeAgo ?? '';
$id = $id ?? 0;
$message = $message ?? '';
$attachment = $attachment ?? null;
$seenIcon = (!!$seen ? 'check-double' : 'check');
$timeAndSeen = "<span data-time='$created_at' class='message-time'>
        ".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )." <span class='time'>$timeAgo</span>
    </span>";
?>

<div class="message-card @if($isSender) mc-sender @endif" data-id="{{ $id }}">
    

    {{-- Card --}}
    @if ($attachment != null || $message)
    @php
        $ext = @$attachment && @$attachment->file ? pathinfo($attachment->file, PATHINFO_EXTENSION) : null;
        $url = @$attachment && @$attachment->file ? route(config('chatify.attachments.download_route_name'), ['fileName' => $attachment->file]) : null;
        $hasMessage = !empty($message); // فقط پیام متنی
        $hasFile = @$attachment && !empty($attachment->file); // بررسی فایل ضمیمه
    @endphp

    {{-- فقط فایل بدون پیام متنی --}}
    @if(!$hasMessage)
        <div class="image-wrapper" style="text-align: {{ $isSender ? 'end' : 'start' }}">
            @if(@$attachment->type == 'image')
                <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                    @if(!empty($attachment->title))
                        <div>{{ $attachment->title }}</div>
                    @endif
                </div>
            @elseif(in_array($ext, ['mp4']))
                    <div class="video-container">
                        <video onclick="playFullScreen(this)" width="250"  style="margin-top: 10px; border-radius:5px">
                            <source src="{{ $url }}" type="video/{{ $ext }}">
                            مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                        </video>
                        <i class="fas fa-solid fa-play play-icon" onclick="playFullScreen(this.previousElementSibling)"></i>
                    </div>
                @elseif(in_array($ext, ['webm']))
                <audio controls class="voice" controlsList="nodownload" style="margin-top: 10px;">
                    <source src="{{ $url }}" type="audio/{{ $ext }}">
                    مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
                </audio>
                @elseif(in_array($ext, ['mp3', 'ogg', 'wav', 'm4a']))
                    <audio controls class="audio" style="margin-top: 10px;">
                        <source src="{{ $url }}" type="audio/{{ $ext }}">
                        مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
                    </audio>
            @else
                <a href="{{ $url }}" class="file-download" download>
                    <span class="fas fa-file"></span> {{ $attachment->title }}
                </a>
            @endif

        </div>

    {{-- وقتی پیام متنی داریم --}}
    @else
        @if($isSender)
                <span class="edit-icon" data-message-id="{{ $id }}" data-message="{{ $message }}">
            <i class="fas fa-pencil-alt"></i>
        </span>
         @endif
        <div class="message" style="display: block;">
            @if(@$attachment != null && !empty($attachment->file))
                @if(@$attachment->type == 'image')
                    <div class="image-wrapper" style="text-align: {{ $isSender ? 'end' : 'start' }}">
                        <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                            @if(!empty($attachment->title))
                                <div>{{ $attachment->title }}</div>
                            @endif
                        </div>
                    </div>
                @elseif(in_array($ext, ['mp4']))
                    <video width="300" controls style=" border-radius:5px">
                        <source src="{{ $url }}" type="video/{{ $ext }}">
                        مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                    </video>
                    @elseif(in_array($ext, ['webm']))
                    <audio controls class="voice" controlsList="nodownload" style="margin-top: 10px;">
                        <source src="{{ $url }}" type="audio/{{ $ext }}">
                        مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
                    </audio>
                    @elseif(in_array($ext, ['mp3', 'ogg', 'wav', 'm4a']))
                    <audio controls class="audio" style="margin-top: 10px;">
                        <source src="{{ $url }}" type="audio/{{ $ext }}">
                        مرورگر شما از پخش صدا پشتیبانی نمی‌کند.
                    </audio>
                @else
                    <a href="{{ $url }}" class="file-download" download>
                        <span class="fas fa-file"></span> {{ $attachment->title }}
                    </a>
                @endif
            @endif

            {{-- پیام متنی --}}
            
            <div class="message-text" data-id="{{ $id }}" style=" width: 100%; direction:rtl; {{ $hasFile ? 'margin: 10px 0px 5px 0px;' : '' }}">
                {!! nl2br($message) !!}
            </div>
        </div>
            
    @endif
    
@endif



</div>


<div style="font-size:11px; direction:rtl; margin:2px 15px; margin-bottom: 10px; text-align: {{ $isSender ? 'right' : 'left' }};">
    {!! $timeAndSeen !!}
</div>