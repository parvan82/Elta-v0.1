{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item" data-contact="{{ Auth::user()->id }}" style="direction: rtl; padding: 10px">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="saved-messages avatar av-m">
                <span class="far fa-bookmark"></span>
            </div>
            </td>
            {{-- center side --}}
            <td style="padding: 5px 0px;">
                <p data-id="{{ Auth::user()->id }}" data-type="user">پیام های ذخیره شده</p>
                <span>پیام های خودتو اینجا ذخیره کن</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- Contact list -------------------- --}}
@if($get == 'users' && !!$lastMessage)
<?php
$lastMessageBody = mb_convert_encoding($lastMessage->body, 'UTF-8', 'UTF-8');
$lastMessageBody = strlen($lastMessageBody) > 30 ? mb_substr($lastMessageBody, 0, 30, 'UTF-8').'..' : $lastMessageBody;
?>
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative; padding: 10px 0px">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
        <div class="avatar av-m"
        style="margin: 0px 10px 0px 0px; background-image: url('{{ $user->avatar }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $user->id }}" data-type="user">

            <div style="justify-content: space-between; display:flex; margin: 5px 0px;">
            <p style="margin: 0px;">{{ strlen($user->name) > 30 ? substr($user->name,0,30).'...' : $user->name }}</p>
            <span class="contact-item-time" data-time="{{$lastMessage->created_at}}">{{ $lastMessage->timeAgo }}</span>
            </div>
        <span>
            {{-- Last Message user indicator --}}
            {!!
                $lastMessage->from_id == Auth::user()->id
                ? '<span class="lastMessageIndicator">شما: </span>'
                : ''
            !!}
            {{-- Last message body --}}
            @if($lastMessage->attachment == null)
            {!!
                $lastMessageBody
            !!}
            @else
            <span class="fas fa-file"></span> Attachment
            @endif
        </span>
        {{-- New messages counter --}}
            {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
        </td>
    </tr>
</table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
    <table class="messenger-list-item" data-contact="{{ $user->id }}" style="direction: rtl;">
        <tr data-action="0" style="vertical-align: middle;">
            {{-- Avatar side (راست) --}}
            <td style="width: 50px; padding: 5px;">
                <div class="avatar av-m" style="background-image: url('{{ $user->avatar }}');"></div>
            </td>

            {{-- center side (چپ) --}}
            <td style="padding: 5px 0px;">
                <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 2px;">
                    <span style="font-weight: bold; font-size: 14px;">{{ $user->name }}</span>
                    <span style="color: gray; font-size: 12px;">{{$user->username }}</span>
                </div>
            </td>
        </tr>
    </table>

@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedFile')
    @php
        $imageExts = ['jpg','jpeg','png','gif','webp'];
        $videoExts = ['mp4','webm','ogg'];
        $audioExts = ['mp3','wav','ogg'];
        $zipExts   = ['zip','rar','7z'];
        $pdfExts   = ['pdf'];
    @endphp

    @if(in_array($file_ext, $imageExts))
        <div class="shared-file-item chat-image" style="background-image: url('{{ $file_url }}')"></div>
    @elseif(in_array($file_ext, $videoExts))
        <div class="shared-file-item">
        <div class="video-container">
            <video class="custom-video" src="{{ $file_url }}" type="video/{{ $file_ext }}" onclick="playFullScreen(this)"></video>
            <i class="fas fa-solid fa-play play-icon" onclick="playFullScreen(this.previousElementSibling)"></i>
        </div>
        </div>
    @elseif(in_array($file_ext, $audioExts))
        <div class="shared-file-item">
            <audio controls style="width:100%;">
                <source src="{{ $file_url }}" type="audio/{{ $file_ext }}">
            </audio>
        </div>
    @elseif(in_array($file_ext, $zipExts))
        <div class="shared-file-item">
            <a href="{{ $file_url }}" download>
            <button class="ZipBtn">
                <p>{{ basename($file_url) }}</p>
                <i class="fas fa-solid fa-file"></i>
            </button>
            </a>
        </div>
    @elseif(in_array($file_ext, $pdfExts))
        <div class="shared-file-item">
            <a href="{{ $file_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                <button class="ZipBtn">
                    <p>{{ basename($file_url) }}</p>
                    <i class="fas fa-solid fa-file-pdf"></i>
                </button>
            </a>
        </div>
    @else
        <div class="shared-file-item">
            <a href="{{ $file_url }}" download class="btn btn-sm btn-secondary">
                <button class="ZipBtn">
                    <i class="fa-solid fa-file-zipper"></i>
                </button>
            </a>
        </div>
    @endif
@endif



