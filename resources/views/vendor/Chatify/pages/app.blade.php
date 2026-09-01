@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header" style="direction: rtl;">
            <nav style="display: flex; justify-content: space-between; align-items: center; padding:10px;">
                    
                <img style="height: 35px;" src="{{ asset('images/' . ($dark_mode == 'dark' ? 'logo-white.jpg' : 'logo.jpg')) }}" alt="">       

                {{-- header buttons سمت چپ --}}
                <div class="m-header-right" style="display: flex; gap: 10px;">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </div>
            </nav>

            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="جست و جو" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span>Contacts</a>
            </div> --}}
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
                <div class="favorites-section">
                 <div class="messenger-listView-tabs">
                     <a href="#" class="active-tab" data-view="users">
                     مخاطبین<span class="far fa-user"></span></a>
                 </div>                
                 <div class="messenger-favorites app-scroll-hidden"></div>
                </div>
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>فضای شخصی</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contact --}}
               <p class="messenger-title"><span>تمام پیام ها</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative; direction: rtl;"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search...</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging"  style="direction: rtl; height: 50px; padding:5px 15px">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                    </div>
                    <div style="display: block; margin-top:5px">
                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                        <p class="info-workarea text-muted" style="font-size:13px; display:none; margin:0;"></p>
                    </div>

                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-light fa-user-plus"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-solid fa-info"></i></a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">متصل شد</span>
                <span class="ic-connecting">در حال اتصال...</span>
                <span class="ic-noInternet">اینترنت در دسترس نیست</span>
            </div>
        </div>

        {{-- Pinned Project Card --}}
        <div id="pinned-project-card" class="pinned-project-card" style="margin-top: -5px; display: none; direction: rtl; position: relative; padding: 12px 15px 12px 25px; cursor: pointer; transition: background-color 0.2s ease;">
            {{-- Curved bar on the right --}}
            <div class="pinned-project-curve" style="
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--primary-color, #27AE60);
    border-radius: 8px 0 0 8px;
    margin-block: 8px;
    margin-right: 6px;
            "></div>
            
            {{-- Bottom border with theme color --}}
            <div style="
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--primary-color, #27AE60);
            "></div>
            
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="flex: 1; min-width: 0;">
                    <h5 id="pinned-project-title" class="pinned-project-title" style="margin: 0; font-size: 16px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        عنوان پروژه
                    </h5>
                    <p class="pinned-project-description" style="margin: 4px 0 0 0; font-size: 12px; opacity: 0.7;">
                        گفتگو در مورد این پروژه
                    </p>
                </div>
                <i class="fa-solid fa-arrow-left pinned-project-arrow" style="font-size: 14px; opacity: 0.6;"></i>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>لطفا یک مکالمه رو انتخاب یا آغاز کنید</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- nav actions --}}
        <nav >
            <a href="#" ><i class="fas fa-times"></i></a>
            <p>اطلاعات</p>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
