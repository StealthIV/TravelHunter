var data = {
    chatinit: {
        title: ["Hello <span class='emoji'> &#128075;</span>", "I am your Philippines Travel Guide", "How can I assist you?"],
        options: ["Beaches <span class='emoji'> &#127958;</span>", "Mountains <span class='emoji'> &#127956;</span>", "Waterfalls <span class='emoji'> &#128167;</span>", "Islands <span class='emoji'> &#127965;</span>", "Caves <span class='emoji'> &#128200;</span>"] // Added "Caves" option
    },
    beaches: {
        title: ["Here are some famous beaches in the Philippines:"],
        options: ['Boracay', 'El Nido', 'Siargao', 'Pagudpud', 'Dumaluan Beach'], // Added Dumaluan Beach
        url: {
            more: "https://www.tourism.gov.ph/",
            link: ["../include/boracay.php", "#", "#", "#", "#"]
        }
    },
    mountains: {
        title: ["Here are some popular mountains to hike:"],
        options: ['Mount Pulag', 'Mount Apo', 'Mount Mayon', 'Mount Batulao', 'Mount Pico de Loro'], // Added Mount Pico de Loro
        url: {
            more: "https://www.tourism.gov.ph/",
            link: ["#", "#", "#", "#", "#"]
        }
    },
    waterfalls: {
        title: ["Check out these stunning waterfalls:"],
        options: ['Pagsanjan Falls', 'Maria Cristina Falls', 'Tinuy-an Falls', 'Kawasan Falls', 'Asik-Asik Falls'], // Added Asik-Asik Falls
        url: {
            more: "https://www.tourism.gov.ph/",
            link: ["#", "#", "#", "#", "#"]
        }
    },
    islands: {
        title: ["Explore these beautiful islands:"],
        options: ['Palawan', 'Cebu', 'Bohol', 'Camiguin', 'Siquijor'], // Added Siquijor
        url: {
            more: "https://www.tourism.gov.ph/",
            link: ["#", "#", "#", "#", "#"]
        }
    },
    caves: { // Added new "Caves" category
        title: ["Discover some breathtaking caves:"],
        options: ['Puerto Princesa Underground River', 'Callao Cave', 'Hinagdanan Cave', 'Sumaguing Cave', 'Sohoton Cave'],
        url: {
            more: "https://www.tourism.gov.ph/",
            link: ["#", "#", "#", "#", "#"]
        }
    }
};

document.getElementById("init").addEventListener("click", showChatBot);
var cbot = document.getElementById("chat-box");

var len1 = data.chatinit.title.length;

function showChatBot() {
    console.log(this.innerText);
    if (this.innerHTML == '<i class="bx bx-support icon"></i>') {
        document.getElementById('test').style.display = 'block';
        document.getElementById('init').innerText = 'X';
        initChat();
    } else {
        location.reload();
    }
}

function initChat() {
    j = 0;
    cbot.innerHTML = '';
    for (var i = 0; i < len1; i++) {
        setTimeout(handleChat, (i * 500));
    }
    setTimeout(function() {
        showOptions(data.chatinit.options)
    }, ((len1 + 1) * 500))
}

var j = 0;

function handleChat() {
    console.log(j);
    var elm = document.createElement("p");
    elm.innerHTML = data.chatinit.title[j];
    elm.setAttribute("class", "msg");
    cbot.appendChild(elm);
    j++;
    handleScroll();
}

function showOptions(options) {
    for (var i = 0; i < options.length; i++) {
        var opt = document.createElement("span");
        var inp = '<div>' + options[i] + '</div>';
        opt.innerHTML = inp;
        opt.setAttribute("class", "opt");
        opt.addEventListener("click", handleOpt);
        cbot.appendChild(opt);
        handleScroll();
    }
}

function handleOpt() {
    console.log(this);
    var str = this.innerText;
    var textArr = str.split(" ");
    var findText = textArr[0];

    document.querySelectorAll(".opt").forEach(el => {
        el.remove();
    })
    var elm = document.createElement("p");
    elm.setAttribute("class", "test");
    var sp = '<span class="rep">' + this.innerText + '</span>';
    elm.innerHTML = sp;
    cbot.appendChild(elm);

    console.log(findText.toLowerCase());
    var tempObj = data[findText.toLowerCase()];
    handleResults(tempObj.title, tempObj.options, tempObj.url);
}

function handleDelay(title) {
    var elm = document.createElement("p");
    elm.innerHTML = title;
    elm.setAttribute("class", "msg");
    cbot.appendChild(elm);
}

function handleResults(title, options, url) {
    for (let i = 0; i < title.length; i++) {
        setTimeout(function() {
            handleDelay(title[i]);
        }, i * 500)

    }

    const isObjectEmpty = (url) => {
        return JSON.stringify(url) === "{}";
    }

    if (isObjectEmpty(url) == true) {
        console.log("having more options");
        setTimeout(function() {
            showOptions(options);
        }, title.length * 500)

    } else {
        console.log("end result");
        setTimeout(function() {
            handleOptions(options, url);
        }, title.length * 500)

    }
}

function handleOptions(options, url) {
    for (var i = 0; i < options.length; i++) {
        var opt = document.createElement("span");
        var inp = '<a class="m-link" href="' + url.link[i] + '">' + options[i] + '</a>';
        opt.innerHTML = inp;
        opt.setAttribute("class", "opt");
        cbot.appendChild(opt);
    }
    var opt = document.createElement("span");
    var inp = '<a class="m-link" href="' + url.more + '">' + 'See more</a>';

    opt.innerHTML = inp;
    opt.setAttribute("class", "opt link");
    cbot.appendChild(opt);
    handleScroll();
}

function handleScroll() {
    var elem = document.getElementById('chat-box');
    elem.scrollTop = elem.scrollHeight;
}
