
                        <!--------------------
START - Color Scheme Toggler
-------------------->
                       <div class="floated-colors-btn third-floated-btn">
                            <div class="os-toggler-w" id="theme">
                                <div class="os-toggler-i">
                                    <div class="os-toggler-pill">

                                    </div>
                                </div>
                            </div>
                            <span>Dark </span>
                            <span>Mode</span>
                        </div>
                        <!--------------------
END - Color Scheme Toggler
-------------------->
                        <!--------------------
START - Demo Customizer
-------------------->
                        <!-- <div class="floated-customizer-btn third-floated-btn">
                            <div class="icon-w"><i class="os-icon os-icon-ui-46"></i></div><span>Customizer</span></div>
                        <div class="floated-customizer-panel">
                            <div class="fcp-content">
                                <div class="close-customizer-btn"><i class="os-icon os-icon-x"></i></div>
                                <div class="fcp-group">
                                    <div class="fcp-group-header">Menu Settings</div>
                                    <div class="fcp-group-contents">
                                        <div class="fcp-field"><label for="">Menu Position</label><select class="menu-position-selector"><option value="left">Left</option><option value="right">Right</option><option value="top">Top</option></select></div>
                                        <div class="fcp-field"><label for="">Menu Style</label><select class="menu-layout-selector"><option value="compact">Compact</option><option value="full">Full</option><option value="mini">Mini</option></select></div>
                                        <div class="fcp-field with-image-selector-w"><label for="">With Image</label><select class="with-image-selector"><option value="yes">Yes</option><option value="no">No</option></select></div>
                                        <div class="fcp-field"><label for="">Menu Color</label>
                                            <div class="fcp-colors menu-color-selector">
                                                <div class="color-selector menu-color-selector color-bright selected"></div>
                                                <div class="color-selector menu-color-selector color-green "></div>
                                                <div class="color-selector menu-color-selector color-dark"></div>
                                                <div class="color-selector menu-color-selector color-light"></div>
                                                <div class="color-selector menu-color-selector color-transparent"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fcp-group">
                                    <div class="fcp-group-header">Sub Menu</div>
                                    <div class="fcp-group-contents">
                                        <div class="fcp-field"><label for="">Sub Menu Style</label><select class="sub-menu-style-selector"><option value="flyout">Flyout</option><option value="inside">Inside/Click</option><option value="over">Over</option></select></div>
                                        <div class="fcp-field"><label for="">Sub Menu Color</label>
                                            <div class="fcp-colors">
                                                <div class="color-selector sub-menu-color-selector color-bright selected"></div>
                                                <div class="color-selector sub-menu-color-selector color-dark"></div>
                                                <div class="color-selector sub-menu-color-selector color-light"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fcp-group">
                                    <div class="fcp-group-header">Other Settings</div>
                                    <div class="fcp-group-contents">
                                        <div class="fcp-field"><label for="">Full Screen?</label><select class="full-screen-selector"><option value="yes">Yes</option><option value="no">No</option></select></div>
                                        <div class="fcp-field"><label for="">Show Top Bar</label><select class="top-bar-visibility-selector"><option value="yes">Yes</option><option value="no">No</option></select></div>
                                        <div class="fcp-field"><label for="">Above Menu?</label><select class="top-bar-above-menu-selector"><option value="yes">Yes</option><option value="no">No</option></select></div>
                                        <div class="fcp-field"><label for="">Top Bar Color</label>
                                            <div class="fcp-colors">
                                                <div class="color-selector top-bar-color-selector color-bright selected"></div>
                                                <div class="color-selector top-bar-color-selector color-dark"></div>
                                                <div class="color-selector top-bar-color-selector color-light"></div>
                                                <div class="color-selector top-bar-color-selector color-transparent"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!--------------------
END - Demo Customizer
-------------------->
                        <!--------------------
START - Chat Popup Box
-------------------->
                        <!--<div class="floated-chat-btn"><i class="os-icon os-icon-mail-07"></i><span>Demo Chat</span></div>-->
<!--                        <div class="floated-chat-w">
                            <div class="floated-chat-i">
                                <div class="chat-close"><i class="os-icon os-icon-close"></i></div>
                                <div class="chat-head">
                                    <div class="user-w with-status status-green">
                                        <div class="user-avatar-w">
                                            <div class="user-avatar"><img alt="" src="img/avatar1.jpg"></div>
                                        </div>
                                        <div class="user-name">
                                            <h6 class="user-title">John Mayers</h6>
                                            <div class="user-role">Account Manager</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-messages">
                                    <div class="message">
                                        <div class="message-content">Hi, how can I help you?</div>
                                    </div>
                                    <div class="date-break">Mon 10:20am</div>
                                    <div class="message">
                                        <div class="message-content">Hi, my name is Mike, I will be happy to assist you</div>
                                    </div>
                                    <div class="message self">
                                        <div class="message-content">Hi, I tried ordering this product and it keeps showing me error code.</div>
                                    </div>
                                </div>
                                <div class="chat-controls"><input class="message-input" placeholder="Type your message here..." type="text">
                                    <div class="chat-extra"><a href="#"><span class="extra-tooltip">Attach Document</span><i class="os-icon os-icon-documents-07"></i></a><a href="#"><span class="extra-tooltip">Insert Photo</span><i class="os-icon os-icon-others-29"></i></a><a href="#"><span class="extra-tooltip">Upload Video</span><i class="os-icon os-icon-ui-51"></i></a></div>
                                </div>
                            </div>
                        </div>-->
                        <!--------------------
END - Chat Popup Box
-------------------->
                    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    
    let toggleSwitch = document.querySelector('#theme');

    let theme = JSON.parse(localStorage.getItem('theme')); 
    console.log("OLD",theme);

    if (theme){

        if (theme[1] == 'dark'){
            toggleSwitch.className = theme[0]
            document.querySelector("body").classList.add('color-scheme-dark')
            // document.querySelector('.menu-w').classList.add('color-scheme-dark').add('color-style-transparent').remove('selected-menu-color-light').add('selected-menu-color-bright');
            // document.querySelector('.top-bar').classList.add('color-scheme-transparent');
            ele = document.querySelector('body')
            ele.querySelectorAll('div')[2].classList = "menu-w menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright menu-activated-on-hover menu-has-selected-link color-scheme-dark color-style-transparent selected-menu-color-bright"
            
        }
    }
    else{
        localStorage.setItem('theme', JSON.stringify(["os-toggler-w",'light']));
    }
    

    toggleSwitch.addEventListener('click', function(){
        let newTheme = toggleSwitch.className
        // console.log("NEW",newTheme);
        let theme_check = JSON.parse(localStorage.getItem('theme')); 

        if (theme_check[1] != 'dark'){
            localStorage.setItem('theme', JSON.stringify([newTheme+" "+"on",'dark']));

            // console.log('theme change hua bhai');
            console.log(localStorage.getItem('theme'));
        }
        else{
            // let exist_theme = theme[0].replace('on','')
            localStorage.setItem('theme', JSON.stringify([newTheme.replace('on',''),"light"]));
            // console.log('theme nahi change hua bhai');
            console.log(localStorage.getItem('theme'));
        }
    })


        </script>