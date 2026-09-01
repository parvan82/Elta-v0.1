document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const openSidebarBtn = document.getElementById("open-sidebar");
    const closeSidebarBtn = document.getElementById("close-sidebar");
    const navHead = document.querySelector(".header");

    if (openSidebarBtn && closeSidebarBtn && sidebar && overlay) {
        openSidebarBtn.addEventListener("click", () => {
            sidebar.classList.add("open");
            overlay.classList.add("active");
        });

        closeSidebarBtn.addEventListener("click", () => {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
        });

        overlay.addEventListener("click", () => {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
        });
    }
});

var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;

$(".next").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    $("#progressbar li")
        .eq($("fieldset").index(current_fs))
        .removeClass("active")
        .addClass("completed");

    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    next_fs.show();
    current_fs.animate(
        { opacity: 0 },
        {
            step: function (now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = now * 50 + "%";
                opacity = 1 - now;
                current_fs.css({
                    transform: "scale(" + scale + ")",
                    position: "absolute",
                });
                next_fs.css({ left: left, opacity: opacity });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: "easeInOutBack",
        }
    );
});

$(".previous").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    $("#progressbar li")
        .eq($("fieldset").index(current_fs))
        .removeClass("active completed");

    $("#progressbar li")
        .eq($("fieldset").index(previous_fs))
        .addClass("active")
        .removeClass("completed");

    previous_fs.show();
    current_fs.animate(
        { opacity: 0 },
        {
            step: function (now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = (1 - now) * 50 + "%";
                opacity = 1 - now;
                current_fs.css({ left: left });
                previous_fs.css({
                    transform: "scale(" + scale + ")",
                    opacity: opacity,
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: "easeInOutBack",
        }
    );
});

$(document).ready(function () {
    setTimeout(function () {
        $("#progressbar li:first-child").addClass("active");
    }, 500);

    // اضافه کردن قابلیت کلیک روی مراحل progress bar
    $("#progressbar li").click(function () {
        if (animating) return false;

        const clickedIndex = $(this).index();
        const currentIndex = $("fieldset").index($("fieldset:visible"));

        // اگر روی مرحله فعلی کلیک شده، کاری نکن
        if (clickedIndex === currentIndex) return;

        // اگر روی مرحله قبلی کلیک شده، به عقب برو
        if (clickedIndex < currentIndex) {
            goToPreviousStep(clickedIndex);
        }
        // اگر روی مرحله بعدی کلیک شده، به جلو برو
        else if (clickedIndex > currentIndex) {
            goToNextStep(clickedIndex);
        }
    });
});

// تابع برای رفتن به مرحله قبلی
function goToPreviousStep(targetIndex) {
    if (animating) return false;
    animating = true;

    current_fs = $("fieldset:visible");
    previous_fs = $("fieldset").eq(targetIndex);

    // به‌روزرسانی progress bar
    $("#progressbar li").removeClass("active completed");
    for (let i = 0; i <= targetIndex; i++) {
        $("#progressbar li").eq(i).addClass("active");
    }

    previous_fs.show();
    current_fs.animate(
        { opacity: 0 },
        {
            step: function (now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = (1 - now) * 50 + "%";
                opacity = 1 - now;
                current_fs.css({ left: left });
                previous_fs.css({
                    transform: "scale(" + scale + ")",
                    opacity: opacity,
                });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            easing: "easeInOutBack",
        }
    );
}

// تابع برای رفتن به مرحله بعدی
function goToNextStep(targetIndex) {
    if (animating) return false;
    animating = true;

    current_fs = $("fieldset:visible");
    next_fs = $("fieldset").eq(targetIndex);

    // به‌روزرسانی progress bar
    $("#progressbar li").removeClass("active completed");
    for (let i = 0; i < targetIndex; i++) {
        $("#progressbar li").eq(i).addClass("completed");
    }
    $("#progressbar li").eq(targetIndex).addClass("active");

    next_fs.show();
    current_fs.animate(
        { opacity: 0 },
        {
            step: function (now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = now * 50 + "%";
                opacity = 1 - now;
                current_fs.css({
                    transform: "scale(" + scale + ")",
                    position: "absolute",
                });
                next_fs.css({ left: left, opacity: opacity });
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
                // به‌روزرسانی کارت پروژه بعد از تغییر مرحله
                setTimeout(updateProjectCard, 100);
            },
            easing: "easeInOutBack",
        }
    );
}

// تابع برای رفتن مستقیم به مرحله خاص
function goToStep(stepIndex) {
    if (animating) return false;

    const currentIndex = $("fieldset").index($("fieldset:visible"));

    if (stepIndex === currentIndex) return;

    if (stepIndex < currentIndex) {
        goToPreviousStep(stepIndex);
    } else {
        goToNextStep(stepIndex);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const skillsTags = document.getElementById("skills-tags");
    const selectedSkillsContainer = document.getElementById("selected-skills");

    window.selectedSkills = [];

    const skillsData = {
        devops: [
            { value: "ruby-on-rails", text: "Ruby on Rails" },
            { value: "html-css", text: "html & css" },
            { value: "vb-script", text: "vb script" },
            { value: "javascript", text: "java script" },
            { value: "android-develpment", text: "android develpment" },
            { value: "go", text: "go" },
            { value: "nodejs", text: "node.js" },
            { value: "php", text: "php" },
            { value: "jquery", text: "jquery" },
            { value: "sharepoint", text: "SharePoint" },
            { value: "assembly", text: "assembly" },
            { value: "fortran", text: "fortran" },
            { value: "xamarin", text: "xamarin" },
            { value: "swift", text: "swift" },
            {
                value: "microsoft-visual-studio",
                text: "Microsoft Visual Studio",
            },
            { value: "netbeans", text: "Netbeans" },
            { value: "eclipse", text: "Eclipse" },
            { value: "android-studio", text: "Android Studio" },
            { value: "notepad-plus-plus", text: "Notepad++" },
            { value: "csharp", text: "C#" },
            { value: "cplusplus", text: "C++" },
            { value: "java", text: "Java" },
            { value: "c", text: "C" },
            { value: "delphi", text: "Delphi" },
            { value: "pascal", text: "Pascal" },
            { value: "python", text: "Python" },
            {
                value: "ios-development-objective-c",
                text: "iOS Development (Objective C)",
            },
            { value: "visual-basic", text: "Visual Basic" },
            { value: "crystal-reports", text: "Crystal Reports" },
            { value: "stimulsoft-report", text: "Stimulsoft Report" },
            { value: "fast-report", text: "Fast Report" },
            { value: "quick-report", text: "Quick Report" },
            { value: "subversion", text: "Subversion" },
            { value: "git", text: "GIT" },
            { value: "xcode", text: "Xcode" },
            { value: "angular", text: "Angular" },
            { value: "django", text: "Django" },
            { value: "hibernate", text: "Hibernate" },
            { value: "laravel", text: "Laravel" },
            { value: "react", text: "React" },
            { value: "rest-api", text: "Rest API" },
            { value: "unit-testing", text: "Unit Testing" },
            { value: "dependency-injection", text: "Dependency Injection" },
            { value: "entity-framework", text: "Entity Framework" },
            { value: "visual-paradigm", text: "Visual Paradigm" },
            { value: "selenium", text: "Selenium" },
            { value: "rational-rose", text: "Rational rose" },
            { value: "jenkins", text: "Jenkins" },
            { value: "microsoft-test-manager", text: "Microsoft Test Manager" },
            { value: "zeromq", text: "ZeroMQ" },
            { value: "kafka", text: "Kafka" },
            { value: "vuejs", text: "VueJS" },
            { value: "elastic-search", text: "Elastic Search" },
            { value: "keras", text: "Keras" },
            { value: "opencv", text: "OpenCV" },
            { value: "java-se", text: "Java SE" },
            { value: "oracle-weblogic", text: "Oracle WebLogic" },
            { value: "oracle-form-report", text: "Oracle Form & Report" },
            { value: "dart", text: "Dart" },
            { value: "react-native", text: "React Native" },
            { value: "dotnet-core", text: ".Net Core / .Net" },
            { value: "flutter", text: "Flutter" },
            { value: "embedded-c", text: "Embedded C" },
            {
                value: "microsoft-azure-devops-tfs",
                text: "Microsoft Azure Devops / TFS",
            },
            { value: "kotlin", text: "Kotlin" },
            { value: "dapper", text: "Dapper" },
            { value: "scala", text: "Scala" },
            { value: "typescript", text: "TypeScript" },
            { value: "erlang", text: "Erlang" },
            { value: "shellscript", text: "ShellScript" },
            { value: "rust", text: "Rust" },
            { value: "groovy", text: "Groovy" },
            { value: "mql", text: "MQL" },
            { value: "elixir", text: "Elixir" },
            { value: "nuxtjs", text: "Nuxt.js" },
            { value: "nextjs", text: "Next.js" },
            { value: "docker", text: "Docker" },
            { value: "rabbitmq", text: "RabbitMQ" },
            { value: "docker-swarm", text: "Docker Swarm" },
            { value: "ceph", text: "Ceph" },
            { value: "kubernetes", text: "Kubernetes" },
            { value: "helm", text: "Helm" },
            { value: "rancher", text: "Rancher" },
            { value: "gerafana", text: "Gerafana" },
            { value: "prometheus", text: "Prometheus" },
            { value: "octupos", text: "Octupos" },
            { value: "teamcity", text: "TeamCity" },
            { value: "gitlab", text: "Gitlab" },
            { value: "ansible", text: "Ansible" },
        ],
        system: [
            { value: "wireshark", text: "Wireshark" },
            { value: "iis", text: "IIS" },
            { value: "isa-server-tmg", text: "ISA Server / TMG" },
            { value: "gfi-lan-guard", text: "GFI LAN GUARD" },
            { value: "gfi-web-monitor", text: "GFI Web Monitor" },
            { value: "exchange-server", text: "Exchange Server" },
            { value: "active-directory", text: "Active Directory" },
            { value: "windows-server", text: "Windows Server" },
            { value: "mikrotik", text: "Mikrotik" },
            { value: "dhcp", text: "DHCP" },
            { value: "dns-settings", text: "DNS Settings" },
            { value: "mac-os", text: "Mac OS" },
            { value: "linux", text: "Linux" },
            { value: "cloud-security", text: "Cloud Security" },
            {
                value: "server-virtualization",
                text: "Server Virtualization (ESX,VMware and …)",
            },
            { value: "scom", text: "SCOM (System Center Operations Manager)" },
            { value: "ccna", text: "CCNA" },
            { value: "ccnp", text: "CCNP" },
            { value: "ccie", text: "CCIE" },
            { value: "juniper", text: "JUNIPER" },
            { value: "mcp", text: "MCP" },
            { value: "mcsa", text: "MCSA" },
            { value: "mpls", text: "MPLS" },
            { value: "voip", text: "VoIP" },
            { value: "firewall", text: "Firewall" },
            { value: "routing", text: "Routing" },
            { value: "switching", text: "Switching" },
            { value: "mtcna", text: "MTCNA" },
            { value: "mtcre", text: "MTCRE" },
            { value: "mtctce", text: "MTCTCE" },
            { value: "mtcume", text: "MTCUME" },
            { value: "mtcwe", text: "MTCWE" },
            { value: "network-plus", text: "Network+" },
            { value: "a-plus", text: "A+" },
            { value: "prtg", text: "PRTG" },
            { value: "solarwinds", text: "Solarwinds" },
            { value: "zabbix", text: "Zabbix" },
            { value: "veeam", text: "Veeam" },
            { value: "ceh", text: "CEH" },
            { value: "security-plus", text: "Security+" },
        ],
        design: [
            { value: "3d-studio-max", text: "3D Studio Max" },
            { value: "acd-see", text: "ACD See" },
            { value: "adobe-dreamweaver", text: "Adobe Dreamweaver" },
            { value: "adobe-flash", text: "Adobe Flash" },
            { value: "adobe-illustrator", text: "Adobe Illustrator" },
            { value: "adobe-indesign", text: "Adobe Indesign" },
            { value: "adobe-photoshop", text: "Adobe Photoshop" },
            { value: "adobe-premiere", text: "Adobe Premiere" },
            { value: "after-effects", text: "After Effects" },
            { value: "art-rage", text: "Art Rage" },
            { value: "blender", text: "Blender" },
            { value: "cinema-4d", text: "Cinema 4D" },
            { value: "corel-draw", text: "Corel Draw" },
            { value: "drawplus", text: "DrawPlus" },
            { value: "gimp", text: "Gimp" },
            { value: "inkscape", text: "Inkscape" },
            { value: "maya", text: "Maya" },
            { value: "photodirector", text: "PhotoDirector" },
            { value: "photoplus", text: "PhotoPlus" },
            { value: "photostudio", text: "PhotoStudio" },
            {
                value: "xara-photo-graphic-designer",
                text: "Xara Photo & Graphic Designer",
            },
            { value: "toon-boom-studio", text: "Toon Boom Studio" },
            { value: "tv-paint", text: "TV Paint" },
            { value: "adobe-xd", text: "Adobe XD" },
            { value: "zbrush", text: "ZBrush" },
            { value: "zeplin", text: "Zeplin" },
            { value: "sketch", text: "Sketch" },
            { value: "axure", text: "Axure" },
            { value: "adobe-audition", text: "Adobe Audition" },
            { value: "davinci-resolve", text: "Davinci Resolve" },
            { value: "speedtree", text: "SpeedTree" },
            { value: "modo", text: "Modo" },
            { value: "adobe-dimension", text: "Adobe Dimension" },
            { value: "edius", text: "Edius" },
            { value: "final-cut", text: "Final Cut" },
            { value: "keyshot", text: "KeyShot" },
            { value: "figma", text: "Figma" },
        ],
        architecture: [
            { value: "archicad", text: "Archicad" },
            { value: "autocad", text: "AutoCad" },
            { value: "grasshopper", text: "Grasshopper" },
            { value: "lumion", text: "Lumion" },
            { value: "post-production", text: "Post Production" },
            { value: "revit", text: "Revit" },
            { value: "rhino", text: "Rhino" },
            { value: "sketchup", text: "Sketchup" },
            { value: "vray", text: "Vray" },
        ],
        civil: [
            { value: "autocad-civil-3d", text: "Autocad Civil 3D" },
            { value: "canvas", text: "Canvas" },
            { value: "csi-bridge", text: "CSI Bridge" },
            { value: "etabs", text: "ETABS" },
            { value: "flac-3d", text: "FLAC 3D" },
            { value: "lusas", text: "Lusas" },
            { value: "opensees", text: "Opensees" },
            { value: "perform", text: "Perform" },
            { value: "plaxis-professional", text: "Plaxis Professional" },
            { value: "safe", text: "Safe" },
            { value: "sam-leap", text: "SAM LEAP" },
            { value: "sap2000", text: "SAP2000" },
            { value: "section-builder", text: "Section Builder" },
            { value: "saze-90", text: "سازه 90" },
            { value: "navisworks", text: "Navisworks" },
            { value: "tedkar", text: "تدکار" },
            { value: "tekla-structures", text: "Tekla Structures" },
        ],
        crm: [
            { value: "microsoft-dynamics", text: "Microsoft Dynamics" },
            { value: "sales-force", text: "Sales Force" },
            { value: "sugar", text: "Sugar" },
            { value: "didar", text: "دیدار" },
            { value: "saru", text: "سرو" },
            { value: "payam-gostar", text: "پیام گستر" },
            { value: "ravesh", text: "روش" },
            { value: "ide-al", text: "ایده آل" },
            { value: "dana", text: "Dana" },
        ],
        erp: [
            { value: "sap", text: "SAP" },
            { value: "oracle-erp", text: "Oracle ERP" },
            { value: "microsoft-erp", text: "Microsoft ERP" },
            { value: "logo", text: "Logo" },
            { value: "ifs", text: "IFS" },
            { value: "odoo-erp", text: "Odoo ERP" },
        ],
        marketing: [
            { value: "wordpress", text: "Wordpress" },
            { value: "google-analytics", text: "Google Analytics" },
            { value: "joomla", text: "Joomla" },
            { value: "drupal", text: "Drupal" },
            { value: "google-tag-manager", text: "Google Tag Manager" },
            { value: "google-search-console", text: "Google Search Console" },
            { value: "google-data-studio", text: "Google Data Studio" },
            { value: "ahrefs", text: "Ahrefs" },
            { value: "keyword-planner", text: "Keyword Planner" },
            { value: "keywordtool", text: "Keywordtool" },
            { value: "kwfinder", text: "KWFinder" },
            { value: "moz", text: "Moz" },
            { value: "screaming-frog", text: "Screaming Frog" },
            { value: "semrush", text: "Semrush" },
            { value: "sitebulb", text: "Sitebulb" },
        ],
        database: [
            { value: "sql-server", text: "Sql Server" },
            { value: "mysql", text: "MySql" },
            { value: "postgresql", text: "PostgreSql" },
            { value: "oracle-database", text: "Oracle Database" },
            { value: "t-sql", text: "T-Sql" },
            { value: "pl-sql", text: "PL-SQL" },
            { value: "redis", text: "Redis" },
            { value: "mongodb", text: "MongoDB" },
            { value: "cassandra", text: "Cassandra" },
            { value: "neo4j", text: "Neo4j" },
            { value: "oracle-nosql", text: "Oracle NoSQL" },
            { value: "couchbase", text: "Couchbase" },
            { value: "couchdb", text: "CouchDB" },
        ],
        data: [
            { value: "rapid-miner", text: "Rapid Miner" },
            { value: "knime", text: "Knime" },
            { value: "qlikview", text: "Qlikview" },
            { value: "qliksense", text: "Qliksense" },
            { value: "tableau", text: "Tableau" },
            { value: "powerbi", text: "PowerBI" },
            { value: "ssis", text: "SSIS" },
            { value: "ssrs", text: "SSRS" },
            { value: "ssas", text: "SSAS" },
            { value: "hadoop", text: "Hadoop" },
            { value: "hbase", text: "Hbase" },
            { value: "mapreduce", text: "MapReduce" },
            { value: "spark", text: "Spark" },
            { value: "zookeeper", text: "Zookeeper" },
            { value: "cloudera", text: "Cloudera" },
            { value: "weka", text: "Weka" },
            { value: "oracle-bi", text: "Oracle BI" },
            { value: "odi", text: "ODI" },
        ],
        game: [
            { value: "unity", text: "Unity" },
            { value: "corona-sdk", text: "Corona SDK" },
            { value: "spritekit", text: "SpriteKit" },
            { value: "appgamekit", text: "AppGameKit" },
            { value: "construct-2", text: "Construct 2" },
            { value: "monogame", text: "MonoGame" },
            { value: "cocos2d", text: "Cocos2D" },
            { value: "gideros", text: "Gideros" },
            { value: "haxe", text: "Haxe" },
            { value: "unreal-engine", text: "Unreal Engine" },
            { value: "gamemaker", text: "GameMaker" },
            { value: "torque-3d", text: "Torque 3D" },
            { value: "buildbox", text: "Buildbox" },
        ],
        music: [
            { value: "ableton-live", text: "Ableton Live" },
            { value: "fl-studio", text: "FL Studio" },
            { value: "logic-pro-x", text: "Logic Pro X" },
            { value: "cubase", text: "Cubase" },
            { value: "pro-tools", text: "Pro Tools" },
            { value: "studio-one", text: "Studio One" },
            { value: "reason", text: "Reason" },
            { value: "reaper", text: "Reaper" },
            { value: "garageband", text: "GarageBand" },
            { value: "bitwig-studio", text: "Bitwig Studio" },
            { value: "nuendo", text: "Nuendo" },
            { value: "audacity", text: "Audacity" },
            { value: "cakewalk", text: "Cakewalk" },
            { value: "bandlab", text: "BandLab" },
            { value: "finale", text: "Finale" },
            { value: "sibelius", text: "Sibelius" },
            { value: "notion", text: "Notion" },
            { value: "dorico", text: "Dorico" },
            { value: "kontakt", text: "Kontakt" },
            { value: "omnisphere", text: "Omnisphere" },
            { value: "serum", text: "Serum" },
            { value: "massive", text: "Massive" },
            { value: "sylenth1", text: "Sylenth1" },
            { value: "nexus", text: "Nexus" },
            { value: "spitfire-audio", text: "Spitfire Audio" },
            { value: "eastwest", text: "EastWest" },
            { value: "izotope-ozone", text: "iZotope Ozone" },
            { value: "izotope-neutron", text: "iZotope Neutron" },
            { value: "melodyne", text: "Melodyne" },
            { value: "auto-tune", text: "Auto-Tune" },
            { value: "waves-plugins", text: "Waves Plugins" },
            { value: "fabfilter", text: "FabFilter" },
            { value: "soundtoys", text: "Soundtoys" },
            { value: "valhalla-dsp", text: "Valhalla DSP" },
            {
                value: "native-instruments-komplete",
                text: "Native Instruments Komplete",
            },
            { value: "loopmasters", text: "Loopmasters" },
            { value: "splice", text: "Splice" },
            { value: "landr", text: "LANDR" },
            { value: "arcade-by-output", text: "Arcade by Output" },
            { value: "uvi-workstation", text: "UVI Workstation" },
        ],
    };

    function updateSelectedSkills() {
        skillsTags.innerHTML = "";

        if (window.selectedSkills.length === 0) {
            selectedSkillsContainer.style.display = "none";
            return;
        }

        selectedSkillsContainer.style.display = "block";

        window.selectedSkills.forEach((skill) => {
            const tag = document.createElement("span");
            tag.className = "skill-tag";
            tag.style.cssText = `
                background-color: #27AE60;
                color: white;
                padding: 5px 10px;
                border-radius: 15px;
                font-size: 12px;
                margin: 2px;
                display: inline-block;
                position: relative;
                padding-right: 25px;
            `;

            tag.innerHTML = `
                ${skill.text}
                <span class="remove-skill" style="
                    position: absolute;
                    right: 5px;
                    top: 50%;
                    transform: translateY(-50%);
                    cursor: pointer;
                    font-weight: bold;
                    font-size: 14px;
                " onclick="removeSkill('${skill.value}')">×</span>
            `;

            skillsTags.appendChild(tag);
        });
    }

    window.removeSkill = function (skillValue) {
        window.selectedSkills = window.selectedSkills.filter(
            (skill) => skill.value !== skillValue
        );
        updateSelectedSkills();
        updateProjectCard();
        updateSkillItems();
    };

    function toggleSkill(skillValue, skillText) {
        const skillExists = window.selectedSkills.some(
            (skill) => skill.value === skillValue
        );

        if (skillExists) {
            window.selectedSkills = window.selectedSkills.filter(
                (skill) => skill.value !== skillValue
            );
        } else {
            window.selectedSkills.push({
                value: skillValue,
                text: skillText,
            });
        }

        updateSelectedSkills();
        updateProjectCard();
        updateSkillItems();
    }

    function createSkillItem(skill) {
        const skillItem = document.createElement("div");
        skillItem.className = "skill-item";
        skillItem.setAttribute("data-value", skill.value);
        skillItem.textContent = skill.text;

        const isSelected = window.selectedSkills.some(
            (s) => s.value === skill.value
        );
        if (isSelected) {
            skillItem.classList.add("selected");
        }

        skillItem.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleSkill(skill.value, skill.text);
        });

        return skillItem;
    }

    function populateSkillGrid(category, skills) {
        const grid = document.getElementById(`skills-grid-${category}`);
        if (!grid) return;

        grid.innerHTML = "";

        if (skills.length === 0) {
            grid.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <p>مهارتی یافت نشد</p>
                </div>
            `;
            return;
        }

        skills.forEach((skill) => {
            const skillItem = createSkillItem(skill);
            grid.appendChild(skillItem);
        });
    }

    function updateSkillItems() {
        Object.keys(skillsData).forEach((category) => {
            const grid = document.getElementById(`skills-grid-${category}`);
            if (grid) {
                const items = grid.querySelectorAll(".skill-item");
                items.forEach((item) => {
                    const skillValue = item.getAttribute("data-value");
                    const isSelected = window.selectedSkills.some(
                        (s) => s.value === skillValue
                    );

                    if (isSelected) {
                        item.classList.add("selected");
                    } else {
                        item.classList.remove("selected");
                    }
                });
            }
        });
    }

    function filterSkills(searchTerm) {
        const allSkills = [];
        Object.values(skillsData).forEach((categorySkills) => {
            allSkills.push(...categorySkills);
        });

        const filteredSkills = allSkills.filter(
            (skill) =>
                skill.text.toLowerCase().includes(searchTerm.toLowerCase()) ||
                skill.value.toLowerCase().includes(searchTerm.toLowerCase())
        );

        Object.keys(skillsData).forEach((category) => {
            const categorySkills = skillsData[category].filter(
                (skill) =>
                    skill.text
                        .toLowerCase()
                        .includes(searchTerm.toLowerCase()) ||
                    skill.value.toLowerCase().includes(searchTerm.toLowerCase())
            );
            populateSkillGrid(category, categorySkills);
        });
    }
let moved = false;

const tabs = document.querySelectorAll(".skill-tab");
const categories = document.querySelectorAll(".skill-category");

document.querySelectorAll(".skill-tabs").forEach(container => {

    let isDown = false;
    let startX = 0;
    let startScroll = 0;
    let moved = false;

    container.addEventListener("pointerdown", e => {

        isDown = true;
        moved = false;

        startX = e.clientX;
        startScroll = container.scrollLeft;

        container.classList.add("dragging");


    });

    container.addEventListener("pointermove", e => {

        if (!isDown) return;

        const dx = e.clientX - startX;

        if (Math.abs(dx) > 5)
            moved = true;

        container.scrollLeft = startScroll - dx;

    });

    function finish() {

        isDown = false;

        container.classList.remove("dragging");

    }

    container.addEventListener("pointerup", finish);
    container.addEventListener("pointercancel", finish);

    container.querySelectorAll(".skill-tab").forEach(tab => {

    tabs.forEach((tab) => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const category = this.getAttribute("data-category");

            tabs.forEach((t) => t.classList.remove("active"));
            this.classList.add("active");

            categories.forEach((cat) => cat.classList.remove("active"));
            document
                .getElementById(`category-${category}`)
                .classList.add("active");

        });
    });

    });

});

document.querySelectorAll(".b2").forEach(tabs=>{

    let startX = 0;
    let dragging = false;

    tabs.addEventListener("pointerdown",e=>{
        dragging = true;
        startX = e.clientX;
    });

    window.addEventListener("pointerup",()=>{
        dragging=false;
        tabs.style.transform="translateX(0)";
    });

    window.addEventListener("pointermove",e=>{

        if(!dragging) return;

        const dx = e.clientX - startX;

        const max = tabs.scrollWidth - tabs.clientWidth;

        if(tabs.scrollLeft <= 0 && dx>0){

            tabs.style.transform=`translateX(${Math.min(dx*.28,28)}px)`;

        }
        else if(tabs.scrollLeft >= max && dx<0){

            tabs.style.transform=`translateX(${Math.max(dx*.28,-28)}px)`;

        }
        else{

            tabs.style.transform="translateX(0)";

        }

    });

});

    const searchInput = document.getElementById("skill-search");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.trim();
            filterSkills(searchTerm);
        });
    }

    function initializeSkills() {
        populateSkillGrid("devops", skillsData.devops);

        document.querySelectorAll(".skill-tab").forEach((tab) => {
            if (tab.getAttribute("data-category") === "devops") {
                tab.classList.add("active");
            } else {
                tab.classList.remove("active");
            }
        });

        document.querySelectorAll(".skill-category").forEach((category) => {
            if (category.id === "category-devops") {
                category.classList.add("active");
            } else {
                category.classList.remove("active");
            }
        });

        Object.keys(skillsData).forEach((category) => {
            populateSkillGrid(category, skillsData[category]);
        });
    }

    initializeSkills();

    if (selectedSkillsContainer) {
        selectedSkillsContainer.style.display = "none";
    }

    const serviceTrigger = document.getElementById("service-trigger");
    const serviceDropdown = document.getElementById("service-dropdown");
    const serviceSelectedText = document.getElementById(
        "service-selected-text"
    );
    const serviceHiddenInput = document.getElementById("service-select");
    const serviceOptions = document.querySelectorAll(".service-option");

    let selectedService = "";

    if (serviceTrigger && serviceDropdown) {
        serviceTrigger.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isActive = serviceDropdown.classList.contains("active");

            document
                .querySelectorAll(".service-dropdown.active")
                .forEach((dropdown) => {
                    if (dropdown !== serviceDropdown) {
                        dropdown.classList.remove("active");
                        dropdown.previousElementSibling.classList.remove(
                            "active"
                        );
                    }
                });

            if (isActive) {
                serviceDropdown.classList.remove("active");
                serviceTrigger.classList.remove("active");
            } else {
                serviceDropdown.classList.add("active");
                serviceTrigger.classList.add("active");
            }
        });
    }

    // Mapping بین سرویس‌ها و تب‌های مهارت‌ها
    const serviceToTabMapping = {
        "برنامه نویسی": "devops",
        "سیستم عامل": "system",
        "طراحی گرافیک": "design",
        معماری: "architecture",
        عمران: "civil",
        CRM: "crm",
        ERP: "erp",
        "تولید محتوا": "marketing",
        دیتابیس: "database",
        "داده کاوی": "data",
        "بازی سازی": "game",
        آهنگسازی: "music",
    };

    // تابع برای تغییر خودکار تب بر اساس سرویس انتخاب شده
    function switchToServiceTab(serviceValue) {
        const tabCategory = serviceToTabMapping[serviceValue];
        if (!tabCategory) return;

        // پیدا کردن تب مربوطه
        const targetTab = document.querySelector(
            `.skill-tab[data-category="${tabCategory}"]`
        );
        if (!targetTab) return;

        // حذف active از همه تب‌ها
        document
            .querySelectorAll(".skill-tab")
            .forEach((tab) => tab.classList.remove("active"));

        // اضافه کردن active به تب مورد نظر
        targetTab.classList.add("active");

        // حذف active از همه دسته‌بندی‌ها
        document
            .querySelectorAll(".skill-category")
            .forEach((category) => category.classList.remove("active"));

        // اضافه کردن active به دسته‌بندی مورد نظر
        const targetCategory = document.getElementById(
            `category-${tabCategory}`
        );
        if (targetCategory) {
            targetCategory.classList.add("active");
        }

        // اسکرول کردن تب‌ها به سمت تب انتخاب شده
        const tabsContainer = document.querySelector(".skill-tabs");
        if (tabsContainer && targetTab) {
            const tabRect = targetTab.getBoundingClientRect();
            const containerRect = tabsContainer.getBoundingClientRect();
            const offset =
                tabRect.left -
                containerRect.left -
                (containerRect.width / 2 - tabRect.width / 2);
            tabsContainer.scrollBy({ left: offset, behavior: "smooth" });
            setTimeout(updateArrows, 300);
        }
    }

    serviceOptions.forEach((option) => {
        option.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const value = this.getAttribute("data-value");
            const text = this.getAttribute("data-text");

            serviceSelectedText.textContent = text;
            serviceHiddenInput.value = value;
            selectedService = value;

            serviceOptions.forEach((opt) => opt.classList.remove("selected"));
            this.classList.add("selected");

            serviceDropdown.classList.remove("active");
            serviceTrigger.classList.remove("active");

            // تغییر خودکار تب بر اساس سرویس انتخاب شده
            if (value && value !== "") {
                switchToServiceTab(value);
            }

            updateProjectCard();
        });
    });

    document.addEventListener("click", function (e) {
        if (
            !serviceTrigger.contains(e.target) &&
            !serviceDropdown.contains(e.target)
        ) {
            serviceDropdown.classList.remove("active");
            serviceTrigger.classList.remove("active");
        }
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            serviceDropdown.classList.remove("active");
            serviceTrigger.classList.remove("active");
        }
    });


    const budgetOptions = document.querySelectorAll(".budget-option");
    let selectedBudget = null;

    budgetOptions.forEach((option) => {
        option.addEventListener("click", function () {
            budgetOptions.forEach((opt) => opt.classList.remove("selected"));

            this.classList.add("selected");
            selectedBudget = this.getAttribute("data-value");

            console.log("بودجه انتخاب شده:", selectedBudget);
        });
    });
const eltaServiceOptions = document.querySelectorAll(".service");
window.selectedServices = [];

// 🔹 تابع اصلی تغییر وضعیت سرویس (باید قبل از استفاده تعریف شود)
function updateServiceSelection(option, isSelected) {
    const serviceValue = option?.getAttribute("data-value");
    const advertisementCard = document.querySelector(".card-advertisement");

    if (isSelected) {
        option.classList.add("selected");
        if (!window.selectedServices.includes(serviceValue)) {
            window.selectedServices.push(serviceValue);
        }
    } else {
        option.classList.remove("selected");
        window.selectedServices = window.selectedServices.filter(
            (s) => s !== serviceValue
        );
    }

    const isDistinguishedSelected = window.selectedServices.includes("متمایز");

    // ✅ فقط اگر کارت وجود داشت، ادامه بده
    if (advertisementCard) {
        if (isDistinguishedSelected) {
            advertisementCard.classList.add("distinguished-card");

            const tagsContainer = advertisementCard.querySelector(".tags-card-advertisement");
            if (tagsContainer && !tagsContainer.querySelector(".service-tag-distinguished")) {
                const tag = document.createElement("span");
                tag.className = "service-tag-distinguished";
                tag.textContent = "متمایز";
                tagsContainer.appendChild(tag);
            }
        } else {
            advertisementCard.classList.remove("distinguished-card");
            const tag = advertisementCard.querySelector(".service-tag-distinguished");
            if (tag) tag.remove();
        }
    }

    console.log("✅ سرویس‌های انتخاب‌شده:", window.selectedServices);

    if (typeof updateProjectCard === "function") updateProjectCard();
    if (typeof updateInvoice === "function") updateInvoice();
}

eltaServiceOptions.forEach((option) => {
    const checkbox = option.querySelector(".service-checkbox");
    const serviceValue = option.getAttribute("data-value");

    // 🎯 کارت آگهی اصلی
    const advertisementCard = document.querySelector(".card-advertisement");

    // 1️⃣ ثبت آگهی همیشه فعال و غیرقابل تغییر
    if (!serviceValue) {
        option.classList.add("selected");
        checkbox.checked = true;
        checkbox.disabled = true;
        window.selectedServices.push("create-project");
        return;
    }

    // 2️⃣ جلوگیری از تداخل کلیک روی چک‌باکس
    checkbox.addEventListener("click", (e) => e.preventDefault());

    // 3️⃣ کلیک روی کارت سرویس برای انتخاب/لغو
    option.addEventListener("click", function () {
        checkbox.checked = !checkbox.checked;
        updateServiceSelection(option, checkbox.checked);
    });
});


    // ---------------- صورتحساب -----------------
    const prices = {
        base: { "create-project": 139000 },
        services: {
            unlimited: 599000,
            "project-manager": 5000000,
            "urgent-featured": 299000,
            urgent: 149000,
            featured: 349000,
            professional: 99000,
            distinctive: 99000,
            "web-hosting": 0,
        },
    };

function formatPrice(amount) {
    try {
        return amount.toLocaleString("fa-IR") + ' <span class="price-label"></span>';
    } catch (e) {
        return (
            amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +
            ' <span class="price-label"></span>'
        );
    }
}


    function getServiceTitle(key) {
        switch (key) {
            case "create-project":
                return "ایجاد پروژه";
            case "unlimited":
                return "بی‌نهایت";
            case "project-manager":
                return "مدیر پروژه";
            case "urgent-featured":
                return "بسته فوری + برجسته (۴۰٪ تخفیف)";
            case "urgent":
                return "فوری";
            case "featured":
                return "برجسته";
            case "professional":
                return "حرفه‌ای";
            case "distinctive":
                return "متمایز";
            case "web-hosting":
                return "میزبانی وب";
            default:
                return key;
        }
    }

    function updateInvoice() {
        const itemsContainer = document.getElementById("invoice-items");
        const totalAmountEl = document.getElementById("invoice-total-amount");
        if (!itemsContainer || !totalAmountEl) return;

        itemsContainer.innerHTML = "";

        let total = 0;

        // ردیف پایه ایجاد پروژه
        total += prices.base["create-project"];
        itemsContainer.insertAdjacentHTML(
            "beforeend",
            `
            <div class="invoice-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 8px;">
                <span>ایجاد پروژه</span>
                <span>${formatPrice(prices.base["create-project"])}</span>
            </div>
            <hr style="margin:0; border-color:#eef2f5;">
        `
        );

        // قوانین قیمت‌گذاری:
        // اگر urgent-featured انتخاب شد، ردیف‌های فوری/برجسته تکی را اضافه نکن
        const hasCombo = window.selectedServices.includes("urgent-featured");

        const uniqueServices = Array.from(
            new Set(window.selectedServices)
        ).filter((s) => s !== "create-project");

        uniqueServices.forEach((serviceKey) => {
            if (serviceKey === "urgent" || serviceKey === "featured") {
                if (hasCombo) return; // نادیده بگیر چون بسته تخفیفی انتخاب شده
            }

            const price = prices.services[serviceKey];
            if (typeof price !== "number") return;

            total += price;
            itemsContainer.insertAdjacentHTML(
                "beforeend",
                `
                <div class="invoice-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 8px;">
                    <span>${getServiceTitle(serviceKey)}</span>
                    <span>${formatPrice(price)}</span>
                </div>
                <hr style="margin:0; border-color:#eef2f5;">
            `
            );
        });

        // اگر بسته urgent-featured انتخاب شده، یک ردیف برای خودش اضافه کن
        if (hasCombo) {
            const comboPrice = prices.services["urgent-featured"];
            total += comboPrice;
            itemsContainer.insertAdjacentHTML(
                "beforeend",
                `
                <div class="invoice-row" style="display:flex; justify-content:space-between; align-items:center; padding:10px 8px;">
                    <span>${getServiceTitle("urgent-featured")}</span>
                    <span>${formatPrice(comboPrice)}</span>
                </div>
                <hr style="margin:0; border-color:#eef2f5;">
            `
            );
        }

totalAmountEl.innerHTML = formatPrice(total);
    }

    // بروزرسانی صورتحساب در لحظه
    updateInvoice();
});

function truncateText(text, maxLength = 80) {
    if (text.length <= maxLength) {
        return text;
    }
    return text.substring(0, maxLength) + "...";
}

function updateProjectCard() {
    const titleElement = document.getElementById("project-title");
    const serviceElement = document.getElementById("project-service");
    const descriptionElement = document.getElementById("project-description");
    const budgetTagElement = document.getElementById("project-budget-tag");
    const skillsElement = document.getElementById("project-skills");
    const servicesTagsContainer = document.getElementById("selected-services-tags");

    // ⛔ اگر در حالت تمدید هستیم
    if (window.isRenewProject) {
        const data = window.renewProjectData;
        if (!data) return;
        
        if (titleElement) titleElement.textContent = data.title || "عنوان پروژه";
        if (serviceElement) serviceElement.textContent = data.service_type || "سرویس انتخاب نشده";
        if (descriptionElement) descriptionElement.textContent = data.description || "توضیحات پروژه";

        if (skillsElement) {
            skillsElement.innerHTML = '';
            if (data.skills && data.skills.length) {
                data.skills.forEach(skill => {
                    const skillTag = document.createElement('h6');
                    skillTag.className = 'userSkill-search-card';
                    skillTag.textContent = skill.skill;
                    skillsElement.appendChild(skillTag);
                });
            } else {
                skillsElement.innerHTML = '<h6 class="userSkill-search-card">مهارت‌ها</h6>';
            }
        }

        // برای تگ‌های خدمات اگر لازم بود
        if (servicesTagsContainer && data.serviceTags && data.serviceTags.length) {
            servicesTagsContainer.innerHTML = '';
            data.serviceTags.forEach(tag => {
                const tagEl = document.createElement("h6");
                tagEl.className = `services-tags ${tag.cssClass || ''}`;
                tagEl.textContent = tag.name;
                servicesTagsContainer.appendChild(tagEl);
            });
        }

        return; // کارت برای فرم عادی آپدیت نشود
    }

    // حالت فرم عادی
    const projectTitle = document.querySelector('input[type="text"]')?.value || "عنوان پروژه";
    const projectDescription = document.querySelector("#project-desc")?.value || "توضیحات پروژه";
    const selectedService = document.querySelector("#service-selected-text")?.textContent || "سرویس انتخاب نشده";
    const selectedBudget = document.querySelector(".budget-option.selected p")?.textContent || "بودجه";
    const selectedPriority = document.querySelector(".priority-option.selected")?.dataset.value;
    const priorityElement = document.getElementById("project-priority");
    const projectCard = document.getElementById("project-card");

// بررسی اینکه آیا تگ متمایز انتخاب شده
const hasDistinctive =
    window.selectedServices?.some(
        s => s.trim() === "متمایز" || s === "distinctive"
    );

if (projectCard) {
    projectCard.classList.toggle("distinguished", hasDistinctive);
}


    document.querySelectorAll(".priority-option").forEach(option => {
        option.addEventListener("click", function () {
            document.querySelectorAll(".priority-option").forEach(o => o.classList.remove("selected"));
            this.classList.add("selected");
            const selectedPriority = this.dataset.value;
            console.log("اولویت انتخاب شده:", selectedPriority);
            updateProjectCard();
        });
    });

    if (priorityElement) {priorityElement.textContent = selectedPriority || "اولویت پروژه انتخاب نشده";}
    if (titleElement) titleElement.textContent = truncateText(projectTitle, 30);
    if (serviceElement) serviceElement.textContent = selectedService;
    if (descriptionElement) descriptionElement.textContent = truncateText(projectDescription, 150);
    if (budgetTagElement) budgetTagElement.textContent = selectedBudget;
    
    // نمایش تگ‌های خدمات
    if (servicesTagsContainer && window.selectedServices?.length) {
        servicesTagsContainer.innerHTML = '';
        window.selectedServices.forEach(serviceValue => {
            if (serviceValue === "create-project") return;
            const serviceTag = document.createElement("h6");

            // تنظیم کلاس و متن بر اساس نوع سرویس
            switch (serviceValue.trim()) {
                case "project-manager":
                case "مدیر پروژه":
                    serviceTag.className = "services-tags modir-proje";
                    serviceTag.textContent = "مدیر پروژه";
                    break;
                case "urgent":
                case "فوری":
                    serviceTag.className = "services-tags fori";
                    serviceTag.textContent = "فوری";
                    break;
                case "featured":
                case "تخصصی":
                case "professional":
                case "حرفه‌ای":
                    serviceTag.className = "services-tags takhasosi";
                    serviceTag.textContent = "تخصصی";
                    break;
                case "distinctive":
                case "متمایز":
                    serviceTag.className = "services-tags motamayez";
                    serviceTag.textContent = "متمایز";
                    break;
                default:
                    serviceTag.className = "services-tags";
                    serviceTag.textContent = serviceValue;
            }

            servicesTagsContainer.appendChild(serviceTag);
        });
    }

    // نمایش مهارت‌ها
    if (skillsElement) {
        skillsElement.innerHTML = '';
        if (window.selectedSkills?.length) {
            window.selectedSkills.forEach(skill => {
                const skillTag = document.createElement("span");
                skillTag.className = "project-skill-pill";
                skillTag.textContent = skill.text;

                skillsElement.appendChild(skillTag);
            });
        } else {
            skillsElement.innerHTML = '<span class="project-skill-pill">مهارت‌ها</span>';
        }
    }
}

// فراخوانی بعد از بارگذاری کامل DOM
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".next").forEach(btn => btn.addEventListener("click", () => setTimeout(updateProjectCard, 1000)));
    updateProjectCard();
});

document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.querySelector('input[type="text"]');
    if (titleInput) {
        titleInput.addEventListener("input", updateProjectCard);
    }

    const descInput = document.querySelector("#project-desc");
    if (descInput) {
        descInput.addEventListener("input", updateProjectCard);
    }

    const serviceSelect = document.querySelector("#service-select");
    if (serviceSelect) {
        serviceSelect.addEventListener("change", updateProjectCard);
    }



    document.querySelectorAll(".budget-option").forEach((option) => {
        option.addEventListener("click", function () {
            setTimeout(updateProjectCard, 100);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch("/unread-messages")
        .then((response) => response.json())
        .then((data) => {
            const sidebarBadge = document.querySelector(".notification-badge");
            const bellBadge = document.querySelector(
                ".notification-bell-badge"
            );

            if (sidebarBadge) {
                if (data.unread > 0) {
                    sidebarBadge.textContent = data.unread;
                    sidebarBadge.style.display = "flex";
                } else {
                    sidebarBadge.style.display = "none";
                }
            }

            if (bellBadge) {
                if (data.unread > 0) {
                    bellBadge.textContent = data.unread;
                    bellBadge.style.display = "inline-block";
                } else {
                    bellBadge.style.display = "none";
                }
            }
        });
});
